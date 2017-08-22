$(document).on('click','#addlog',function(e) {
  var data = $("#formid").serialize();
  $.ajax({
         data: data,
         type: "post",
         url: "storeevaluationlogs",
         success: function(data){
              alert("Data Save: " + data);
         }
	});
});