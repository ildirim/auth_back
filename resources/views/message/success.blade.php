@if(Session::has('success' ))
	<script type="text/javascript">
	      toastr.success("{{ Session::get('success') }}")
	</script>
@endif