<script>
function openViewCourse() {
    new bootstrap.Modal(document.getElementById('viewCourseModal')).show();
}

function openEditCourse() {
    new bootstrap.Modal(document.getElementById('editCourseModal')).show();
}

function saveCourse() {

    let form = document.getElementById('courseForm');
    let formData = new FormData(form);
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch("{{ url('institution/electives/elective-courses/store') }}", {
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


function editCourse(id) {

    fetch("{{ url('institution/electives/elective-courses/edit') }}/" + id)
    .then(response => response.json())
    .then(data => {

        document.getElementById('edit_id').value = data.elective_id;
        document.getElementById('edit_elective_title').value = data.elective_title;
        document.getElementById('edit_instructor_name').value = data.instructor_name;
        document.getElementById('edit_category_id').value = data.category_id;
        document.getElementById('edit_duration').value = data.duration;
        document.getElementById('edit_price').value = data.price;
        document.getElementById('edit_start_date').value = data.start_date;
        document.getElementById('edit_description').value = data.description;

        let modal = new bootstrap.Modal(document.getElementById('editCourseModal'));
        modal.show();
    });

}

function updateCourse() {

    let id = document.getElementById('edit_id').value;
    let form = document.getElementById('editCourseForm');
    let formData = new FormData(form);
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch("{{ url('institution/electives/elective-courses/update') }}/" + id, {
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

function deleteCourse(id) {

let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

if (confirm("Delete this course?")) {

    fetch("{{ url('institution/electives/elective-courses/delete') }}/" + id, {
        method: "DELETE",
        headers: {
            'X-CSRF-TOKEN': token
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            location.reload();
        }
    });

}
}

function toggleStatus(id) {

    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch("{{ url('institution/electives/elective-courses/status') }}/" + id, {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': token
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            location.reload();
        }
    });

}

function loadSkills(categoryId) {

fetch("{{ url('institution/electives/elective-courses/skills') }}/" + categoryId)
.then(response => response.json())
.then(data => {

    let skillsSelect = document.getElementById('skills');
    skillsSelect.innerHTML = '';

    data.forEach(skill => {
        let option = document.createElement('option');
        option.value = skill.subcategory_id;
        option.text = skill.subcategory_name;
        skillsSelect.appendChild(option);
    });

});

}

function loadSkills(categoryId, selectedSkills = []) {

fetch("/institution/electives/elective-courses/skills/" + categoryId)
.then(response => response.json())
.then(data => {

    let skillsSelect = document.getElementById('skills');
    skillsSelect.innerHTML = '';

    data.forEach(skill => {
        let option = document.createElement('option');
        option.value = skill.subcategory_id;
        option.text = skill.subcategory_name;

        if (selectedSkills.includes(skill.subcategory_id)) {
            option.selected = true;
        }

        skillsSelect.appendChild(option);
    });

});
}


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
</script>
