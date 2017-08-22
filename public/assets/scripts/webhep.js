
window.onload = function()
{

	// Get the modal
	$(".myImg").on("click",function(event) {
		var modal = $('.myModal');
		var modalImg = $(".modal-content");		
    	$(".modal-content").attr({src: this.src});
    	modal.css( "display", "block");    
	});
	// Get the <span> element that closes the modal
	var span = $(".close")[0];

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() { 
		$('.myModal').css( "display", "none");
	}
}