$(document).ready(function(){
    $("#someh").on('click', function(event) {
      event.preventDefault();
       $('#showh').toggle();
    });
});


$(document).ready(function($) {
     $('#some').on('click', function(event) {
       event.preventDefault();
       $("#show").toggle();
     });     
});  

$(document).ready(function($) {
     $('#somed').on('click', function(event) {
       event.preventDefault();
       $("#showd").toggle();
     });     
});  

$(function() {
    setTimeout(function() {
        $("#errormessage").hide('blind', {}, 300)
    }, 5000);
});
