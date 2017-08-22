function get_date(){
	var x = document.getElementById("myInput").value;
	var date = new Date(x); // some mock date
	var milliseconds = date.getTime(); 
	var real = new Date();
	var com = real.getTime();
	
	if ( milliseconds == null || milliseconds < com || milliseconds == com) {
    	alert("Please select a future date");
    	document.getElementById("myBtn").disabled = true;  

	}else{
		 document.getElementById("myBtn").disabled = false;
	}
}

function check_fields(){
	var x  = document.getElementById("myInput").value;
	var btn = document.getElementById("myBtn");

	if (x == "" || x == null ) {
		alert("Please select Date.")
		document.getElementById("myBtn").disabled = true;  
	}else{
		document.getElementById("myBtn").disabled = false;  
	}

}