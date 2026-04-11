<div class="card-custom">


<h6 class="section-title">
    <i class="bi bi-currency-dollar"></i> Compensation Details
</h6>

<div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox"name="is_paid" value="1" id="isPaid">
    <label class="form-check-label">Is Paid Internship</label>
</div>

<!-- <div id="paymentFields" class="d-none">

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label  class="form-label">Amount</label>
            <input type="number" name="amount" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Currency</label>
            <select name="currency" class="form-select">
                <option>INR</option>
                <option>USD</option>
                <option>EUR</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Payment Frequency</label>
        <select name="payment_frequency" class="form-select">
            <option>Monthly</option>
            <option>Weekly</option>
            <option>One Time</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Payment Terms</label>
        <textarea name="payment_terms" class="form-control"></textarea>
    </div>

   

</div> -->

<div class="form-footer">
<button type="button" class="btn btn-secondary prev-tab" data-prev="tab-timeline">Back</button>
        <button type="submit" name="action" value="draft" class="btn btn-primary fw-bold px-4" style="background-color: var(--accent-color); border: none;">
            <i class="bi bi-save me-2"></i> Save Drive
        </button>
        <!-- <button type="submit" name="action" value="publish" class="btn btn-success fw-bold px-4">
            <i class="bi bi-send me-2"></i> Save & Publish
        </button> -->
    </div>

<script>
    document.getElementById('isPaid').addEventListener('change', function() {
        document.getElementById('paymentFields').classList.toggle('d-none', !this.checked);
    });
</script>

</div>