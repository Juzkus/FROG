function handleEndpointResponseCallback(responsePromise, callback)
{
	responsePromise.then(res => {
		res.json().then(json => {
			callback(json);
		});
	});
}

// url = endpoint string (with params)
// callback = what to do with response json.
window.get = function(url, callback) {
	let responsePromise = fetch(url, {method: "GET"});
  
	handleEndpointResponseCallback(responsePromise, callback);
}

// url = endpoint string
// data = request body (json)
// callback = what to do with response json.
window.post = function(url, data, callback) {
	let responsePromise = fetch(url, {method: "POST", body: JSON.stringify(data)});
	
	handleEndpointResponseCallback(responsePromise, callback);
}