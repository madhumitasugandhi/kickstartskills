<script>
    function openViewCourse() {
        new bootstrap.Modal(document.getElementById('viewCourseModal')).show();
    }

    function openEditCourse() {
        new bootstrap.Modal(document.getElementById('editCourseModal')).show();
    }


    // ================= SAVE COURSE =================
    function saveCourse() {

        let form = document.getElementById('courseForm');
        let formData = new FormData(form);
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("/institution/electives/elective-courses/store", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    location.reload();
                }
            });
    }


    // ================= EDIT COURSE =================
    function editCourse(id) {

        fetch("/institution/electives/elective-courses/edit/" + id)
            .then(response => response.json())
            .then(data => {

                let modal = document.getElementById('editCourseModal');

                modal.querySelector('#edit_id').value = data.elective_id;
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
    
    
    //viewCourse
    function viewCourse(id) {

        fetch("/institution/electives/elective-courses/edit/" + id)
            .then(response => response.json())
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
                    skillsHtml += `<span class="chip-item">${skill.name}</span>`;
                });

                document.getElementById('view_skills').innerHTML = skillsHtml;

                let modal = new bootstrap.Modal(document.getElementById('viewCourseModal'));
                modal.show();
            });
    }

    // ================= UPDATE COURSE =================
    function updateCourse() {

        let id = document.getElementById('edit_id').value;
        let form = document.getElementById('editCourseForm');
        let formData = new FormData(form);
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("/institution/electives/elective-courses/update/" + id, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    location.reload();
                }
            });
    }


    // ================= DELETE COURSE =================
    function deleteCourse(id) {

        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        Swal.fire({
            title: 'Are you sure?',
            text: "This course will be deleted",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#14b8a6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it'
        }).then((result) => {

            if (result.isConfirmed) {

                fetch("/institution/electives/elective-courses/delete/" + id, {
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': token
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            Swal.fire('Deleted!', 'Course deleted.', 'success')
                                .then(() => location.reload());
                        }
                    });
            }
        });
    }


    // ================= TOGGLE STATUS =================
    function toggleStatus(id) {

        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("/institution/electives/elective-courses/status/" + id, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => response.json())
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

    // ================= LOAD SKILLS BY CATEGORY =================
    function loadSkills(categoryId, selectedSkills = [], modal = null) {

        fetch("/institution/electives/elective-courses/skills/" + categoryId)
            .then(response => response.json())
            .then(data => {

                let container;

                if (modal) {
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
    document.addEventListener("DOMContentLoaded", function() {
        let categorySelect = document.getElementById('category_id');

        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                let categoryId = this.value;
                if (categoryId) {
                    loadSkills(categoryId);
                }
            });
        }
    });
</script>