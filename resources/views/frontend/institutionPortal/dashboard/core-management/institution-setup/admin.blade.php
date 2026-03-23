<div class="setup-step" id="adminStep">

    <!-- SESSION DATA -->
    <div id="adminData"
         data-session='@json($sessionData["admin"] ?? [])'>
    </div>

    <!-- ================= HEADER ================= -->
    <div class="mb-4">
        <h6 class="section-title-custom mb-1">Administrator Setup</h6>
        <p class="small">
            Configure the primary administrator account for your institution
        </p>
    </div>

    <div class="config-card p-4">

        <!-- ================= ADMIN DETAILS ================= -->
        <div class="mb-4">
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label-custom">Admin Full Name *</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ $sessionData['admin']['name'] ?? ($admin->name ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Admin Email *</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ $sessionData['admin']['email'] ?? ($admin->email ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Phone Number *</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ $sessionData['admin']['phone'] ?? ($admin->phone ?? '') }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label-custom">Designation *</label>
                    <input type="text" name="designation" class="form-control"
                        value="{{ $sessionData['admin']['designation'] ?? ($admin->designation ?? '') }}">
                </div>

            </div>
        </div>

        <!-- PASSWORD -->
        <div class="mb-4">
            <label class="form-label-custom">Initial Password *</label>
            <div class="input-group-custom">
                <i class="bi bi-lock"></i>
                <input type="password" name="password"
                    class="form-control ps-5"
                    placeholder="Enter initial password">
            </div>

            <small class="small">
                Minimum 8 characters with uppercase, lowercase, number & special character
            </small>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

let initialized = false;

function initAdminStep(){

    if(initialized) return;
    initialized = true;

    const data = JSON.parse(
        document.getElementById('adminData').dataset.session || '{}'
    );

    const name = document.querySelector('[name="name"]');
    const email = document.querySelector('[name="email"]');
    const phone = document.querySelector('[name="phone"]');
    const designation = document.querySelector('[name="designation"]');
    const password = document.querySelector('[name="password"]');

    // SESSION override DB
    if(data.name) name.value = data.name;
    if(data.email) email.value = data.email;
    if(data.phone) phone.value = data.phone;
    if(data.designation) designation.value = data.designation;

    // SAVE FUNCTION
    window.saveAdminStep = async function () {

        if(!name.value || !email.value || !phone.value || !designation.value){
            Swal.fire({
                icon:'warning',
                title:'Please fill all admin fields'
            });
            return false;
        }

        // Password validation only if entered
        if(password.value){
            if(password.value.length < 8){
                Swal.fire({
                    icon:'warning',
                    title:'Password must be at least 8 characters'
                });
                return false;
            }
        }

        await fetch('/institution/core-management/setup/save-step',{
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                step:'admin',
                data:{
                    name: name.value,
                    email: email.value,
                    phone: phone.value,
                    designation: designation.value,
                    password: password.value
                }
            })
        });

        return true;
    };
}

// Initialize when step opened
document.addEventListener('stepChanged', e => {
    if(e.detail.step === 5){
        initAdminStep();
    }
});

});
</script>