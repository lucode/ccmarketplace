function randomads(params,modid) {
	var params = JSON.parse(params);
	var ajaxRequest;  // The variable that makes Ajax possible!
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}

	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			var ajaxDisplay = document.getElementById(modid);
			ajaxDisplay.innerHTML = ajaxRequest.responseText;
		}
	}
	
	var params_data = "&";

	for (x in params) {
		params_data += x + "=" + params[x] + "&";
	}
	
	var path = document.getElementById('path').value;
	var url  = path+'modules/mod_ccmp_randomads/randomads.php?req=ajx';
	ajaxRequest.open("POST", url, true);
	ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxRequest.send(params_data);
}