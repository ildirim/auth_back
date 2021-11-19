<script type="text/javascript">
	
const userAction = async () => {
	let body = {
		'search_pin': '6HUG118'
	}

	const response = await fetch('http://mlspp.integration.services/api/v1/procedures/labcontract/getAllContractsDetailByPinV6', {
		method: 'POST',
		body: myBody, // string or object
		headers: {
			'RequestKey': '38WVc6l7pKAixlQYNqMByFHhFOIZ67',
	    	'RequestClientIP': '172.16.248.27',
		}
	});
		const myJson = await response.json(); //extract JSON from the http response
		return myJson;
		// do something with myJson
}


userAction();
</script>