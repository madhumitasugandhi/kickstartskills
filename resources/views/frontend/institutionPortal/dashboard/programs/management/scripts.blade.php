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
</script>
