<script>
    // ===============================
    // Assessment Modals
    // ===============================

    function openCreateAssessment() {
        const modal = new bootstrap.Modal(
            document.getElementById('createAssessmentModal')
        );
        modal.show();
    }

    function openEditAssessment(id) {
        // 🔜 Later: fetch assessment data by ID via AJAX
        const modal = new bootstrap.Modal(
            document.getElementById('editAssessmentModal')
        );
        modal.show();
    }

    function openViewAssessment(id) {
        // 🔜 Later: fetch assessment data by ID via AJAX
        const modal = new bootstrap.Modal(
            document.getElementById('viewAssessmentModal')
        );
        modal.show();
    }

    function confirmDeleteAssessment(id) {
        if (confirm('Are you sure you want to delete this assessment?')) {
            // 🔜 Later: submit delete request
            console.log('Deleting assessment:', id);
        }
    }

    // ===============================
    // Filters (optional)
    // ===============================
    document.addEventListener('DOMContentLoaded', function () {
        // Placeholder for filter logic
        console.log('Assessment scripts loaded');
    });
</script>
