<div class="card-custom">


<h6 class="section-title">
    <i class="bi bi-calendar-event"></i> Application Period
</h6>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Application Start Date</label>
        <input type="date" name="application_start" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">Application End Date</label>
        <input type="date" name="application_end" class="form-control">
    </div>
</div>

<h6 class="section-title mt-4">
    <i class="bi bi-clock"></i> Internship Duration
</h6>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label class="form-label">Internship Start Date</label>
        <input name="internship_start" type="date" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">Internship End Date</label>
        <input name="internship_end" type="date" class="form-control">
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Duration in Weeks</label>
    <input name="duration_weeks" type="range" class="form-range" min="4" max="52">
</div>

<div class="form-check form-switch">
    <input name="flexible_duration" class="form-check-input" type="checkbox">
    <label  value="1" class="form-check-label">Flexible Duration</label>
</div>

<div class="form-footer">
    <button type="button" class="btn btn-secondary prev-tab" data-prev="tab-eligibility">Back</button>
    <button type="button" class="btn btn-primary next-tab" data-next="tab-package">Next</button>
</div>

</div>
<script>
document.querySelector('#tab-timeline .next-tab').addEventListener('click', function () {

    let formData = new FormData();

    formData.append('application_start', document.querySelector('[name="application_start"]').value);
    formData.append('application_end', document.querySelector('[name="application_end"]').value);
    formData.append('internship_start', document.querySelector('[name="internship_start"]').value);
    formData.append('internship_end', document.querySelector('[name="internship_end"]').value);
    formData.append('duration_weeks', document.querySelector('[name="duration_weeks"]').value);

    if(document.querySelector('[name="flexible_duration"]').checked){
        formData.append('flexible_duration', 1);
    }

    fetch('/mentor/drive/save-timeline', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    });

});
</script>
