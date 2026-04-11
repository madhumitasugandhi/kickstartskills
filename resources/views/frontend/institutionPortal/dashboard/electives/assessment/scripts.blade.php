<script>

document.addEventListener("DOMContentLoaded", function () {

    initCreateAssessment();
    initEditAssessment();
    initKebabMenu();

});


/* ================= CREATE ASSESSMENT ================= */
function initCreateAssessment(){

    document.addEventListener('submit', function(e){

        if(e.target && e.target.id === 'createAssessmentForm'){
            e.preventDefault();

            let formData = new FormData(e.target);
            let token = document.querySelector('meta[name="csrf-token"]').content;

            fetch('/institution/assessments/store', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': token },
                body: formData
            })
            .then(res => res.json())
            .then(data => {

                if(data.status){

                    Swal.fire({
                        icon: 'success',
                        title: 'Assessment Created',
                        timer: 1200,
                        showConfirmButton: false
                    });

                    bootstrap.Modal.getInstance(
                        document.getElementById('createAssessmentModal')
                    ).hide();

                    setTimeout(()=> location.reload(), 800);
                }

            });

        }

    });

}


/* ================= EDIT ASSESSMENT ================= */
function editAssessment(id){

    fetch('/institution/assessments/edit/' + id)
    .then(res => res.json())
    .then(data => {

        let modal = document.getElementById('editAssessmentModal');

        modal.querySelector('#assessment_id').value = data.id;
        modal.querySelector('#assessment_title').value = data.title;
        modal.querySelector('#course_id').value = data.course_id;
        modal.querySelector('#type').value = data.type;
        modal.querySelector('#duration').value = data.duration;
        modal.querySelector('#total_marks').value = data.total_marks;
        modal.querySelector('#schedule_date').value = data.schedule_date;
        modal.querySelector('#pass_percentage').value = data.pass_percentage;
        modal.querySelector('#status').value = data.status;

        new bootstrap.Modal(modal).show();
    });

}


/* ================= UPDATE ASSESSMENT ================= */
function initEditAssessment(){

    document.addEventListener('submit', function(e){

        if(e.target && e.target.id === 'editAssessmentForm'){
            e.preventDefault();

            let id = document.getElementById('assessment_id').value;
            let formData = new FormData(e.target);
            let token = document.querySelector('meta[name="csrf-token"]').content;

            fetch('/institution/assessments/update/' + id, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': token },
                body: formData
            })
            .then(res => res.json())
            .then(data => {

                if(data.status){

                    Swal.fire({
                        icon: 'success',
                        title: 'Assessment Updated',
                        timer: 1200,
                        showConfirmButton: false
                    });

                    bootstrap.Modal.getInstance(
                        document.getElementById('editAssessmentModal')
                    ).hide();

                    setTimeout(()=> location.reload(), 800);
                }

            });

        }

    });

}


/* ================= VIEW ASSESSMENT ================= */
function viewAssessment(id){

    fetch('/institution/assessments/view/' + id)
    .then(res => res.json())
    .then(data => {

        document.getElementById('view_title').innerText = data.title;
        document.getElementById('view_course').innerText = data.course;
        document.getElementById('view_type').innerText = data.type;
        document.getElementById('view_duration').innerText = data.duration;
        document.getElementById('view_marks').innerText = data.total_marks;
        document.getElementById('view_date').innerText = data.schedule_date;
        document.getElementById('view_status').innerText = data.status;

        new bootstrap.Modal(
            document.getElementById('viewAssessmentModal')
        ).show();
    });

}


/* ================= DELETE ASSESSMENT ================= */
function deleteAssessment(id){

    let token = document.querySelector('meta[name="csrf-token"]').content;

    Swal.fire({
        title: 'Delete Assessment?',
        text: "This assessment will be deleted",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#14b8a6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes Delete'
    }).then((result) => {

        if (result.isConfirmed) {

            fetch('/institution/assessments/delete/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': token }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    Swal.fire('Deleted!', 'Assessment deleted.', 'success')
                        .then(() => location.reload());
                }
            });

        }

    });

}


/* ================= KEBAB MENU ================= */
function initKebabMenu(){

    document.addEventListener('click', function(e){

        if(e.target.closest('.kebab-toggle')){
            e.stopPropagation();

            document.querySelectorAll('.kebab-menu')
                .forEach(m => m.classList.remove('show'));

            e.target.closest('.student-actions')
                .querySelector('.kebab-menu')
                .classList.toggle('show');

            return;
        }

        document.querySelectorAll('.kebab-menu')
            .forEach(m => m.classList.remove('show'));

    });

}

</script>