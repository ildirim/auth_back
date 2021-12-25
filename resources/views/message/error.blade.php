@if(Session::has('error' ))
{{dd(1)}}
	<script type="text/javascript">
	      toastr.error("{{ Session::get('error') }}")
	</script>
@endif