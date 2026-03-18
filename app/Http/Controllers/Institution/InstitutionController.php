<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Models\Institution\Institution;
use App\Models\Institution\InstitutionType;
use App\Models\Institution\InstitutionAddress;
use App\Models\Institution\InstitutionDepartment;
use App\Models\Institution\InstitutionProgram;
use App\Models\Institution\CourseType;
use App\Models\Institution\CourseTypeRequirement;
use App\Models\Institution\CourseRequirement;
use App\Models\Institution\AccreditationBody;
use App\Models\Institution\InstitutionAccreditation;
use App\Models\Institution\InstitutionAdmin;
use App\Models\Institution\InstitutionDocument;
use App\Models\Institution\InstitutionSetupProgress;

use App\Models\Country;
use App\Models\State;
use App\Models\City;

class InstitutionController extends Controller
{

    private function generateInstitutionCode($name, $pincode)
    {
        $words = preg_split('/\s+/', trim($name));

        // Generate 3-letter institution prefix
        if (count($words) >= 3) {
            $prefix =
                substr($words[0], 0, 1) .
                substr($words[1], 0, 1) .
                substr($words[2], 0, 1);
        } elseif (count($words) == 2) {
            $prefix =
                substr($words[0], 0, 2) .
                substr($words[1], 0, 1);
        } else {
            $prefix = substr($words[0], 0, 3);
        }

        $prefix = strtoupper($prefix);

        // Registration year
        $year = date('Y');

        // Last 3 digits of pincode
        $pinPart = str_pad(substr($pincode, -3), 3, '0', STR_PAD_LEFT);
        return $prefix . '-' . $year . '-' . $pinPart;
    }

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

            $institutionCode = $this->generateInstitutionCode(
                $formData['institution_name'],
                $formData['zip']
            );
            $institution = Institution::create([
                'institution_name' => $formData['institution_name'],
                'institution_code' => $institutionCode,
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

    public function showSetup(Request $request)
    {

        $institutionId = Session::get('institution_id');

        $sessionData = session('institution_setup', []);
        if ($request->isMethod('post')) {
            return $this->uploadDocument($request);
        }

        $institution = Institution::with('addresses')->findOrFail($institutionId);

        $types = InstitutionType::all();
        $requirements = CourseRequirement::all();

        $address = $institution->addresses->first();

        $states = State::pluck('name', 'id');
        $cities = [];

        if ($address && $address->state_id) {
            $cities = City::where('state_id', $address->state_id)->pluck('name', 'id');
        }

        $accreditationBodies = AccreditationBody::all();

        $selectedAccreditations = InstitutionAccreditation::where('institution_id', $institutionId)
            ->pluck('accreditation_body_id')
            ->toArray();

        $admin = InstitutionAdmin::where('institution_id', $institutionId)->first();

        $documents = InstitutionDocument::where('institution_id', $institutionId)
            ->get()
            ->keyBy('document_type');

        $progress = InstitutionSetupProgress::where('institution_id', $institutionId)->first();

        $isCompleted = $progress &&
            $progress->basic_info_completed &&
            $progress->academic_completed &&
            $progress->courses_completed &&
            $progress->regulatory_completed &&
            $progress->admin_completed &&
            $progress->documents_uploaded;

        return view(
            'frontend.institutionPortal.dashboard.core-management.institution-setup.index',
            compact(
                'institution',
                'requirements',
                'progress',
                'types',
                'address',
                'states',
                'cities',
                'accreditationBodies',
                'selectedAccreditations',
                'admin',
                'documents',
                'isCompleted',
                'sessionData'
            )
        );
    }

    public function saveStep(Request $request)
    {
        $step = $request->step;
        $data = $request->data;

        // DEBUG (optional)
        // dd($step, $data);

        session()->put("institution_setup.$step", $data);

        return response()->json([
            'status' => 'success'
        ]);
    }


    public function uploadDocument(Request $request)
    {
        $institutionId = Session::get('institution_id');

        if (!$institutionId) {
            return back()->with('error', 'Session expired');
        }

        $request->validate([
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'document_type' => 'required|string|max:100'
        ]);

        DB::beginTransaction();

        try {

            // ================= FOLDER PATH =================
            $folderPath = public_path("documents/institutions/{$institutionId}");

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }

            // ================= DELETE OLD FILE =================
            $existing = InstitutionDocument::where([
                'institution_id' => $institutionId,
                'document_type' => $request->document_type
            ])->first();

            if ($existing && file_exists(public_path($existing->file_path))) {
                unlink(public_path($existing->file_path));
                $existing->delete();
            }

            // ================= GENERATE FILE NAME =================
            $file = $request->file('document');
            $fileName = $request->document_type . '_' . time() . '.' . $file->getClientOriginalExtension();

            // ================= MOVE FILE =================
            $file->move($folderPath, $fileName);

            // ================= SAVE RELATIVE PATH =================
            $relativePath = "documents/institutions/{$institutionId}/{$fileName}";

            InstitutionDocument::create([
                'institution_id' => $institutionId,
                'document_type' => $request->document_type,
                'file_path' => $relativePath,
                'verification_status' => 'pending'
            ]);

            // ================= UPDATE PROGRESS =================
            InstitutionSetupProgress::where('institution_id', $institutionId)
                ->update(['documents_uploaded' => 1]);

            Institution::where('institution_id', $institutionId)
                ->update(['setup_status' => 'verification_pending', 'status' => 'verification_pending']);



            // ================= FINAL SAVE ALL SESSION DATA =================

            $data = session('institution_setup');

            if (!empty($data)) {
                // ================= BASIC =================
                if (isset($data['basic'])) {
                    Institution::where('institution_id', $institutionId)->update([
                        'institution_name' => $data['basic']['institution_name'],
                        'institution_type_id' => $data['basic']['institution_type_id'],
                        'phone' => $data['basic']['phone'],
                        'email' => $data['basic']['email'],
                        'website' => $data['basic']['website'] ?? null,
                        'established_year' => $data['basic']['established_year'] ?? null
                    ]);

                    InstitutionAddress::updateOrCreate(
                        ['institution_id' => $institutionId],
                        [
                            'state_id' => $data['basic']['state'],
                            'city_id' => $data['basic']['city'],
                            'address_line1' => $data['basic']['address_line1'],
                            'postal_code' => $data['basic']['postal_code']
                        ]
                    );
                }

                // ================= ACADEMIC =================
                if (isset($data['academic'])) {
                    foreach ($data['academic']['departments'] as $dept) {
                        InstitutionDepartment::firstOrCreate([
                            'institution_id' => $institutionId,
                            'department_name' => $dept
                        ]);
                    }

                    foreach ($data['academic']['programs'] as $program) {
                        InstitutionProgram::firstOrCreate([
                            'institution_id' => $institutionId,
                            'program_name' => $program
                        ]);
                    }
                }

                //===================Code==================
                if(isset($data['code'])){
                    Institution::where('institution_id', $institutionId)->update([
                        'institution_code_prefix' => $data['code']['prefix'] ?? null
                    ]);
                }

                // ================= COURSES =================
                if (isset($data['courses'])) {
                    foreach ($data['courses'] as $course) {

                        $courseType = CourseType::firstOrCreate(
                            [
                                'institution_id' => $institutionId,
                                'course_name' => $course['name']
                            ],
                            [
                                'duration_years' => $course['years'],
                                'duration_months' => $course['months'],
                                'code_extension' => $course['code'] ?? null
                            ]
                        );

                        if (!empty($course['requirements'])) {
                            foreach ($course['requirements'] as $req) {
                                CourseTypeRequirement::create([
                                    'course_type_id' => $courseType->course_type_id,
                                    'requirement_id' => $req
                                ]);
                            }
                        }
                    }
                }

                // ================= REGULATORY =================
                if (isset($data['regulatory'])) {
                    Institution::where('institution_id', $institutionId)->update([
                        'aishe_code' => $data['regulatory']['aishe_code'],
                        'aicte_id' => $data['regulatory']['aicte_id'],
                        'ugc_number' => $data['regulatory']['ugc_number'],
                        'affiliated_university' => $data['regulatory']['affiliated_university']
                    ]);

                    if (!empty($data['regulatory']['accreditation_ids'])) {
                        $ids = explode(',', $data['regulatory']['accreditation_ids']);

                        foreach ($ids as $id) {
                            InstitutionAccreditation::create([
                                'institution_id' => $institutionId,
                                'accreditation_body_id' => $id,
                                'accreditation_status' => 'active'
                            ]);
                        }
                    }
                }

                InstitutionAdmin::where('institution_id', $institutionId)->delete();

                // ================= ADMIN =================
                if (isset($data['admin'])) {
                    InstitutionAdmin::create([
                        'institution_id' => $institutionId,
                        'name' => $data['admin']['name'],
                        'email' => $data['admin']['email'],
                        'phone' => $data['admin']['phone'],
                        'designation' => $data['admin']['designation'],
                        'password_hash' => Hash::make($data['admin']['password'])
                    ]);
                }

                // CLEAR SESSION AFTER SAVE
                session()->forget('institution_setup');
            }

            DB::commit();

            return back()->with('success','Completed');
            
        } catch (\Exception $e) {

            DB::rollback();

            return back()->with('error', 'Upload failed');
        }
    }

    public function completeSetup()
{
    try {

        $institutionId = Session::get('institution_id');

        if(!$institutionId){
            return response()->json([
                'status' => 'error',
                'message' => 'Session expired'
            ]);
        }

        // mark setup complete
        Institution::where('institution_id', $institutionId)
            ->update([
                'setup_status' => 'completed',
                'status' => 'active'
            ]);

        return response()->json([
            'status' => 'success'
        ]);

    } catch (\Exception $e) {

        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
}
}
