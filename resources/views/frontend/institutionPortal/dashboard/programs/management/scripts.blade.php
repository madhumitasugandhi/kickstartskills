<script>
function openCreateProgram() {
    showModal('createProgramModal');
}

function openEditProgram(id) {
    // later: fetch program data via AJAX
    showModal('editProgramModal');
}

function openViewProgram(id) {
    showModal('viewProgramModal');
}

function showModal(id) {
    document.getElementById(id).classList.remove('hidden');
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function(){

/* =============================
   EDIT PROGRAM
============================= */

document.querySelectorAll('.editProgramBtn').forEach(btn => {

btn.addEventListener('click', function(){

let id = this.dataset.id;

fetch(`/institution/program-management/edit/${id}`)
.then(res => res.json())
.then(data => {

document.getElementById('edit_program_name').value = data.program_name;
document.getElementById('edit_department_id').value = data.department_id;
document.getElementById('edit_duration').value = data.duration;
document.getElementById('edit_fees').value = data.fees;
document.getElementById('edit_description').value = data.description;

document.getElementById('editProgramForm').action =
`/institution/program-management/update/${id}`;

let modal = new bootstrap.Modal(document.getElementById('editProgramModal'));
modal.show();

});

});

});


/* =============================
   VIEW PROGRAM
============================= */

document.querySelectorAll('.viewProgramBtn').forEach(btn => {

btn.addEventListener('click', function(){

let id = this.dataset.id;

fetch(`/institution/program-management/edit/${id}`)
.then(res => res.json())
.then(data => {

document.getElementById('view_program_name').innerText = data.program_name;
document.getElementById('view_department').innerText = data.department?.department_name ?? 'N/A';
document.getElementById('view_duration').innerText = data.duration;
document.getElementById('view_fees').innerText = '₹'+data.fees;
document.getElementById('view_description').innerText = data.description;

let modal = new bootstrap.Modal(document.getElementById('viewProgramModal'));
modal.show();

});

});

});

});

document.addEventListener("DOMContentLoaded", function(){

const searchInput = document.getElementById("programSearch");
const departmentFilter = document.getElementById("departmentFilter");
const statusFilter = document.getElementById("statusFilter");

const cards = document.querySelectorAll(".program-card");
const countElement = document.getElementById("programCount");

function filterPrograms(){

let search = searchInput.value.toLowerCase();
let dept = departmentFilter.value;
let status = statusFilter.value;

let visibleCount = 0;

cards.forEach(card => {

let name = card.dataset.name;
let department = card.dataset.department;
let cardStatus = card.dataset.status;

let matchSearch = name.includes(search);
let matchDept = dept === "" || department === dept;
let matchStatus = status === "" || cardStatus === status;

if(matchSearch && matchDept && matchStatus){

card.style.display = "block";
visibleCount++;

}else{

card.style.display = "none";

}

});

countElement.innerText = visibleCount;

}

searchInput.addEventListener("keyup", filterPrograms);
departmentFilter.addEventListener("change", filterPrograms);
statusFilter.addEventListener("change", filterPrograms);

});
</script>
