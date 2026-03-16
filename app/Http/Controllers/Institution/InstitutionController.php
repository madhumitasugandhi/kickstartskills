<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Models\Institution\Institution;
use App\Models\Institution\InstitutionType;
use App\Models\Institution\InstitutionAddress;
use App\Models\Institution\InstitutionDepartment;
use App\Models\Institution\InstitutionProgram;
use App\Models\Institution\CourseType;
use App\Models\Institution\CourseTypeRequirement;
use App\Models\Institution\CourseRequirement;
use App\Models\Institution\InstitutionAdmin;
use App\Models\Institution\InstitutionDocument;
use App\Models\Institution\InstitutionSetupProgress;

use App\Models\Country;
use App\Models\State;
use App\Models\City;

class InstitutionController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INSTITUTION REGISTRATION
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {

        if ($request->isMethod('get')) {

            $countries = Country::pluck('name', 'id');
            $types = InstitutionType::all();

            $formData = Session::get('institution_register', []);

            return view(
                'frontend.institutionPortal.auth.instituteregister',
                compact('countries', 'types', 'formData')
            );
        }


        $formData = $request->all();
        Session::put('institution_register', $formData);


        $request->validate([

            'institution_name' => 'required|max:255',
            'representative_name' => 'required|max:255',
            'email' => 'required|email|unique:institutions,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required|max:20',

            'country_id' => 'required',
            'city' => 'required',
            'state' => 'required',
            'address_line1' => 'required|max:255',
            'zip' => 'required|max:20',

            'institution_type_id' => 'required',
            'terms_accepted' => 'accepted'

        ]);


        DB::beginTransaction();

        try {

            $institution = Institution::create([

                'institution_name' => $formData['institution_name'],
                'representative_name' => $formData['representative_name'],
                'email' => $formData['email'],
                'phone' => $formData['phone'],
                'institution_type_id' => $formData['institution_type_id'],
                'password_hash' => Hash::make($formData['password']),
                'status' => 'pending',
                'setup_status' => 'registered',
                'terms_accepted' => $formData['terms_accepted'] ?? 0
                
                ]);

            InstitutionSetupProgress::create([
                'institution_id' => $institution->institution_id
            ]);

            InstitutionAddress::create([

                'institution_id' => $institution->institution_id,
                'country_id' => $formData['country_id'],
                'state_id' => $formData['state'],
                'city_id' => $formData['city'],
                'address_line1' => $formData['address_line1'],
                'address_line2' => $formData['address_line2'] ?? null,
                'postal_code' => $formData['zip']

            ]);


            DB::commit();

            Session::forget('institution_register');

            return redirect('/institution-login')
                ->with('success', 'Institution registered successfully');
        } catch (\Exception $e) {

            DB::rollback();

            return back()
                ->with('error', 'Registration failed')
                ->withInput();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW SETUP WIZARD
    |--------------------------------------------------------------------------
    */


    public function showSetup()
    {
        $institutionId = Session::get('institution_id');

        $institution = Institution::with('addresses')->findOrFail($institutionId);

        $types = InstitutionType::all();
        $requirements = CourseRequirement::all();

        $address = $institution->addresses->first();

        $states = State::pluck('name', 'id');

        $cities = [];

        if ($address && $address->state_id) {
            $cities = City::where('state_id', $address->state_id)
                ->pluck('name', 'id');
        }

        $progress = InstitutionSetupProgress::where(
            'institution_id',
            $institutionId
        )->first();

        return view(
            'frontend.institutionPortal.dashboard.core-management.institution-setup.index',
            compact(
                'institution',
                'requirements',
                'progress',
                'types',
                'address',
                'states',
                'cities'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE BASIC INFO
    |--------------------------------------------------------------------------
    */

    public function saveBasicInfo(Request $request)
    {
        $institutionId = Session::get('institution_id');

        $request->validate([
            'institution_name' => 'required',
            'institution_type_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'state' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        Institution::where('institution_id', $institutionId)
->update([
'institution_name' => $request->institution_name,
'institution_type_id' => $request->institution_type_id,
'phone' => $request->phone,
'email' => $request->email,
'website' => $request->website,
'established_year' => $request->established_year,
'setup_status' => 'basic_completed'
]);

        InstitutionAddress::updateOrCreate(
            ['institution_id' => $institutionId],
            [
                'state_id' => $request->state,
                'city_id' => $request->city,
                'address_line1' => $request->address_line1,
                'postal_code' => $request->postal_code
            ]
        );

        InstitutionSetupProgress::where('institution_id', $institutionId)
            ->update(['basic_info_completed' => 1]);

        return response()->json(['status' => 'success']);
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE DEPARTMENTS + PROGRAMS
    |--------------------------------------------------------------------------
    */

    public function saveAcademicStructure(Request $request)
    {

        $institutionId = Session::get('institution_id');

        DB::beginTransaction();

        try {

            foreach ($request->departments as $dept) {
                InstitutionDepartment::firstOrCreate([

                    'institution_id' => $institutionId,
                    'department_name' => $dept

                ]);
            }

            InstitutionSetupProgress::where('institution_id', $institutionId)
                ->update([
                    'academic_completed' => 1
                ]);

            foreach ($request->programs as $program) {

                InstitutionProgram::firstOrCreate([

                    'institution_id' => $institutionId,
                    'program_name' => $program

                ]);
            }

            DB::commit();

            Institution::where('institution_id',$institutionId)
->update(['setup_status' => 'academic_completed']);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['status' => 'error']);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE COURSES
    |--------------------------------------------------------------------------
    */

    public function saveCourses(Request $request)
    {

        $institutionId = Session::get('institution_id');

        DB::beginTransaction();

        try {

            foreach ($request->courses as $course) {

                $courseType = CourseType::firstOrCreate([

                    'institution_id' => $institutionId,
                    'course_name' => $course['name']

                ], [

                    'duration_years' => $course['years'],
                    'duration_months' => $course['months'],
                    'code_extension' => $course['code']

                ]);

                InstitutionSetupProgress::where('institution_id', $institutionId)
                    ->update([
                        'courses_completed' => 1
                    ]);

                if (!empty($course['requirements'])) {

                    foreach ($course['requirements'] as $req) {

                        CourseTypeRequirement::create([

                            'course_type_id' => $courseType->course_type_id,
                            'requirement_id' => $req

                        ]);
                    }
                }
            }

            DB::commit();
            Institution::where('institution_id',$institutionId)
->update(['setup_status' => 'courses_completed']);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json(['status' => 'error']);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE REGULATORY DATA
    |--------------------------------------------------------------------------
    */

    public function saveRegulatory(Request $request)
    {

        $institutionId = Session::get('institution_id');

        Institution::where('institution_id', $institutionId)->update([

            'aishe_code' => $request->aishe_code,
            'aicte_id' => $request->aicte_id,
            'ugc_number' => $request->ugc_number,
            'affiliated_university' => $request->affiliated_university

        ]);

        InstitutionSetupProgress::where('institution_id', $institutionId)
            ->update([
                'regulatory_completed' => 1
            ]);

            Institution::where('institution_id',$institutionId)
->update(['setup_status' => 'regulatory_completed']);

        return response()->json(['status' => 'success']);
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE ADMIN
    |--------------------------------------------------------------------------
    */

    public function saveAdmin(Request $request)
    {

        $institutionId = Session::get('institution_id');

        InstitutionAdmin::create([

            'institution_id' => $institutionId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'password_hash' => Hash::make($request->password)

        ]);

        InstitutionSetupProgress::where('institution_id', $institutionId)
            ->update([
                'admin_completed' => 1
            ]);

            Institution::where('institution_id',$institutionId)
->update(['setup_status' => 'admin_completed']);

        return response()->json(['status' => 'success']);
    }


    /*
    |--------------------------------------------------------------------------
    | UPLOAD DOCUMENT
    |--------------------------------------------------------------------------
    */

    public function uploadDocument(Request $request)
    {

        $institutionId = Session::get('institution_id');

        $path = $request->file('document')
            ->store('institution_documents', 'public');


        InstitutionDocument::create([

            'institution_id' => $institutionId,
            'document_type' => $request->document_type,
            'file_path' => $path,
            'verification_status' => 'pending'

        ]);

        InstitutionSetupProgress::where('institution_id', $institutionId)
            ->update([
                'documents_uploaded' => 1
            ]);

            Institution::where('institution_id',$institutionId)
->update(['setup_status' => 'verification_pending']);
        return response()->json(['status' => 'success']);
    }
}
