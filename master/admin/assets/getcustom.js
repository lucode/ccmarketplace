function getcustomfields(serverurl) {
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

	var path         = document.getElementById('path').value;
	var customfields = document.getElementById('custom_fields');
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			customfields.style.textAlign  = "left";
			customfields.innerHTML  = ajaxRequest.responseText;
		}
	}

	customfields.style.textAlign  = "center";
	customfields.innerHTML  = '<img src="'+ path +'components/com_ccmarketplace/assets/loading.gif" />';

	var url = path+'index.php?option=com_ccmarketplace&view=webservice&task=getfields&cs_root='+serverurl+'&ajax=1';
	ajaxRequest.open("GET", url, true);
	ajaxRequest.send(null);
}