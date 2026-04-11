<script>

document.addEventListener("DOMContentLoaded", function () {

    initCreateCourse();
    initEditCourse();
    initCategorySkillLoader();

});


/* ================= CREATE COURSE ================= */
function initCreateCourse(){
    document.addEventListener('submit', function(e){

        if(e.target && e.target.id === 'createCourseForm'){
            e.preventDefault();

            let formData = new FormData(e.target);
            let token = document.querySelector('meta[name="csrf-token"]').content;

            fetch("/institution/electives/elective-courses/store", {
                method: "POST",
                headers: { 'X-CSRF-TOKEN': token },
                body: formData
            })
            .then(res => res.json())
            .then(data => {

                if(data.status){

                    Swal.fire({
                        icon: 'success',
                        title: 'Course Created',
                        timer: 1200,
                        showConfirmButton: false
                    });

                    bootstrap.Modal.getInstance(
                        document.getElementById('createCourseModal')
                    ).hide();

                    setTimeout(()=> location.reload(), 800);
                }

            });
        }

    });
}


/* ================= EDIT COURSE LOAD ================= */
function editCourse(id){

    fetch("/institution/electives/elective-courses/edit/" + id)
    .then(res => res.json())
    .then(data => {

        let modal = document.getElementById('editCourseModal');

        modal.querySelector('#elective_id').value = data.elective_id;
        modal.querySelector('#elective_title').value = data.elective_title;
        modal.querySelector('#faculty_id').value = data.faculty_id;
        modal.querySelector('#category_id').value = data.category_id;
        modal.querySelector('#duration').value = data.duration;
        modal.querySelector('#price').value = data.price;
        modal.querySelector('#start_date').value = data.start_date;
        modal.querySelector('#description').value = data.description;

        let selectedSkills = [];
        if (data.skills) {
            data.skills.forEach(skill => {
                selectedSkills.push(skill.id);
            });
        }

        loadSkills(data.category_id, selectedSkills, modal);

        new bootstrap.Modal(modal).show();
    });
}


/* ================= UPDATE COURSE ================= */
function initEditCourse(){
    document.addEventListener('submit', function(e){

        if(e.target && e.target.id === 'editCourseForm'){
            e.preventDefault();

            let id = document.getElementById('elective_id').value;
            let formData = new FormData(e.target);
            let token = document.querySelector('meta[name="csrf-token"]').content;

            fetch("/institution/electives/elective-courses/update/" + id, {
                method: "POST",
                headers: { 'X-CSRF-TOKEN': token },
                body: formData
            })
            .then(res => res.json())
            .then(data => {

                if(data.status){

                    Swal.fire({
                        icon: 'success',
                        title: 'Course Updated',
                        timer: 1200,
                        showConfirmButton: false
                    });

                    bootstrap.Modal.getInstance(
                        document.getElementById('editCourseModal')
                    ).hide();

                    setTimeout(()=> location.reload(), 800);
                }

            });

        }

    });
}


/* ================= VIEW COURSE ================= */
function viewCourse(id){

    fetch("/institution/electives/elective-courses/edit/" + id)
    .then(res => res.json())
    .then(data => {

        document.getElementById('view_title').innerText = data.elective_title;
        document.getElementById('view_faculty').innerText = data.faculty.name;
        document.getElementById('view_category').innerText = data.category.name;
        document.getElementById('view_duration').innerText = data.duration;
        document.getElementById('view_price').innerText = data.price;
        document.getElementById('view_start_date').innerText = data.start_date;
        document.getElementById('view_description').innerText = data.description;

        let skillsHtml = '';
        data.skills.forEach(skill => {
            skillsHtml += `<span class="skill-chip">${skill.name}</span>`;
        });

        document.getElementById('view_skills').innerHTML = skillsHtml;

        new bootstrap.Modal(document.getElementById('viewCourseModal')).show();
    });
}


/* ================= DELETE COURSE ================= */
function deleteCourse(id){

    let token = document.querySelector('meta[name="csrf-token"]').content;

    Swal.fire({
        title: 'Delete Course?',
        text: "This course will be deleted",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#14b8a6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes Delete'
    }).then((result) => {

        if (result.isConfirmed) {

            fetch("/institution/electives/elective-courses/delete/" + id, {
                method: "DELETE",
                headers: { 'X-CSRF-TOKEN': token }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    Swal.fire('Deleted!', 'Course deleted.', 'success')
                        .then(() => location.reload());
                }
            });

        }

    });
}


/* ================= TOGGLE STATUS ================= */
function toggleStatus(id){

    let token = document.querySelector('meta[name="csrf-token"]').content;

    fetch("/institution/electives/elective-courses/status/" + id, {
        method: "POST",
        headers: { 'X-CSRF-TOKEN': token }
    })
    .then(res => res.json())
    .then(data => {
        if (data.status) {
            Swal.fire({
                icon: 'success',
                title: 'Status Updated',
                timer: 1200,
                showConfirmButton: false
            }).then(() => location.reload());
        }
    });
}


/* ================= LOAD SKILLS ================= */
function loadSkills(categoryId, selectedSkills = [], modal = null){

    fetch("/institution/electives/elective-courses/skills/" + categoryId)
    .then(res => res.json())
    .then(data => {

        let container;

        if(modal){
            container = modal.querySelector('#skillsContainer');
        } else {
            container = document.getElementById('skillsContainer');
        }

        container.innerHTML = '';

        data.forEach(skill => {

            let checked = selectedSkills.includes(skill.id) ? 'checked' : '';

            container.innerHTML += `
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="skills[]"
                           value="${skill.id}"
                           ${checked}>
                    <label class="form-check-label">
                        ${skill.name}
                    </label>
                </div>
            `;
        });

    });
}


/* ================= CATEGORY CHANGE LOAD SKILLS ================= */
function initCategorySkillLoader(){
    document.addEventListener('change', function(e){

        if(e.target && e.target.id === 'category_id'){
            let categoryId = e.target.value;
            if(categoryId){
                loadSkills(categoryId);
            }
        }

    });
}

</script>