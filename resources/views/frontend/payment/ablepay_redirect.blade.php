<form id="payForm" method="POST" action="https://pgbiz.ablepay.co.in/payment/request">

<input type="hidden" name="api_key" value="{{ $data['api_key'] }}">
<input type="hidden" name="order_id" value="{{ $data['order_id'] }}">
<input type="hidden" name="amount" value="{{ $data['amount'] }}">
<input type="hidden" name="callback_url" value="{{ $data['callback_url'] }}">
<input type="hidden" name="customer_email" value="{{ $data['customer_email'] }}">
<input type="hidden" name="signature" value="{{ $data['signature'] }}">

</form>

<script>
document.getElementById('payForm').submit();
</script>