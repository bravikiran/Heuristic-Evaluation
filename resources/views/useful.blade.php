<label>Email:</label>
    <input id="email" type="email" class="form-control" placeholder="Email" name="emails[]">
	    <input type="button" value="Add another Email" onClick="addInput('dynamicInput');">


	    <script type="text/javascript" src="assets/javascript/addemail.js"></script>
	    
  <script>
    $(document).ready(function(){
      $('#butt').click(function(){
        $('#checkboxes').toggleClass("checkboxes");
      });
    });
  </script>


  <div class="col-md-2 defaultheight" id="left_div">
      @for ($i = 1; $i < 5; $i++)
          <div class="panelid" data-panelid="panel"><h4>This is side bar {{ $i }}</h4><sub><strong> Just like it {{ $i-1 }}</strong></sub></div> 
      @endfor
    </div>    

  <script>
$(document).ready(function() {
 $('#changecolor').is(':empty')
  $('#changecolor').text( "No Evaluation Logs!" )
  .css( {"background": "rgb(255,220,200)", "padding": "10px", "margin":"10px" });
  $('input[type="submit"]').prop('disabled', true);
});
</script>

<script>
$("input, textarea, select ").focus(function(){
    $(this).css("background-color", "#cccccc");
});
</script>


<script>
$( document).ready(function() {
  $("#addlog").click( function(){
          
            $('#tableid').append('<table class="table table-bordered"><tr><th>Heuristic Rule(*)</th><td><input type="text" name="hrule[]"/></td></tr>'
                    +'<tr><th>Place</th><td><textarea type="text" name="place[]" rows="1" cols="10" /></textarea></td></tr>'
                    +'<tr><th>Description</th><td><textarea type="text" name="desc[]" rows="1" cols="10" /></textarea></td><tr>'
                    +'<tr><th>Hello</th><td><input type="text" name="element[]" /></td></tr>'
                    +'<tr><th>Rating</th><td><input type="number" name="rating[]" min="1" max="5"></td></tr>'
                    +'<tr><th>Image(*)</th><td><input type="text" name="good[]"><button>upload</button></td></tr>'
                    +'<tr><th>Image2</th><td><input type="text" name="bad[]"><button>upload</button></td></tr>'
                    +'</table>'
                    )
        });

  $('#remove_field').click( function(){

    $('#tableid:last').remove();
  });    
    
});
</script>


<script>
// This script is to add new evaluation log form 
  $(document).ready(function(){   
    $('#addlog').click(function(e){
      e.preventDefault();
       var data = $("#formid").serialize();
      
      var oldlog = $("#tableid").html();
      $(".logs").append(oldlog);

    });
  });
</script>


<script>
// This script is to save evaluation log form into database ajax 
$(document).ready(function (e) {
 $("#submitform").on('submit',(function(e) {
  e.preventDefault();
  var id = $(".maindiv").attr("id");
  console.log(id);
  $.ajax({
         url: "logs"+id,
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
      {
    if(data=='invalid file')
    {
     // invalid file format.
     $("#err").html("Invalid File !").fadeIn();
    }
    else
    {
     // view uploaded file.
     $("#preview").html(data).fadeIn();
     $("#formid")[0].reset(); 
    }
      },
     error: function(e) 
      {
    $("#err").html(e).fadeIn();
      }          
    });
 }));
});
</script>


$('.popup').on('click',function(e){
    e.preventDefault();
    var $item = $( this ),
    $target = $( event.target );
    viewLargerImage($target);
  });
    // Image preview function, demonstrating the ui.dialog used as a modal window
    function viewLargerImage( $link ) {
      var src = $link.attr( "href" ),
        title = $link.siblings( "img" ).attr( "alt" ),
        $modal = $( "img[src$='" + src + "']" );
        var img = $( "<img alt='" + title + "' width='384' height='288' style='display: none; padding: 8px;' />" )
          .attr( "src", src ).appendTo( "body" );
        setTimeout(function() {
          img.dialog({
            title: title,
            width: 400,
            modal: true
          });
        }, 1 );
    }



    //For UnderStanding
    public function ImageUpload($checkimage){
        if (Input::hasFile('screenshot')) {            
                $images = Input::file('screenshot')[0]->getRealPath();
                $size = Input::file('screenshot')[0]->getSize();
                $original_name = Input::file('screenshot')[0]->getClientOriginalName();
                $file_name = $id . $original_name;
                $extension = Input::file('screenshot')[0]->getClientOriginalExtension();
                $mime = Input::file('screenshot')[0]->getMimeType();
                $path = Input::file('screenshot')[0]->getRealPath();
                Input::file('screenshot')[0]->move($target_dir, $file_name );
        }
        
    }