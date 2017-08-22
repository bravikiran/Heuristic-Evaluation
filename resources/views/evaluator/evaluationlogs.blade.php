@extends('layouts.evaluatorlayout')
@extends('layouts.css')

@section('content')	
<div class="container">
	<div class="row">
		<div class="col-md-8 maindiv">
			<form action="{!! url('evaluationlogs/logs') !!}" method="POST" id="formid" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="projectid" value="{!! $project_id !!}">
				<div class="logs">
					<div id="tableid">
						<table class="table table-bordered">
						  <tr>
		     				<th><label class="control-label">Heuristic</label></th>
							  <td>
                  <select name="heuristicrule[]" id="lstFruits" multiple="multiple">
                  @foreach($hrule as $rule)
                    <option value="{{ $rule->title }}">{{ $rule->title }}</option>
                  @endforeach
                  </select>    
              </td>
            </tr>
				
						<tr>
							<th>Notes</th>
							<td class="form-group">
                  <textarea type="text" name="note" class="form-control" rows="4"></textarea>
              </td>
						</tr>
			
						<tr>
							<th>Recommendation</th>
							<td class="form-group">
                <textarea type="text" name="recommendation" class="form-control" rows="4"></textarea>
              </td>
						</tr>

            <tr>
              <th>Positive Usability</th>
              <td><input type="checkbox" name="positive" value="1"></td>
            </tr>
			
						<tr>
							<th>Severity</th>
							<td><input type="number" name="severity" min="1" max="5"></td>
						</tr>
			
						<tr>
							<th>Screenshot</th>
              <td><input type="file" name="screenshot[]" id="screenshot" accept="image/*" />
							<div id="image-holder"></div></td>
						</tr>

						<tr>
							<th>Reference Screenshot</th>
							<td><input type="file" name="referencescreenshot[]" id="rscreenshot" accept="image/*" />
							<div id="image-holder1"></div></td>
						</tr>				
						</table>
					</div>
				</div>

				<div>
					<input type="submit" name="finished" class="btn-lg btn-success" type="submit" value="Save and Evaluation Finished" id="submitform" formaction="{!! url('evaluationlogs/lastlogs') !!}" method="post" enctype="multipart/form-data" />
          
					<input type="submit" name="submit" id="addlog" class="btn btn-lg btn-primary" value="Save and Add New Log" />
				</div>	
			</form>
			 <div id="err"></div>
		</div>
    <div class="col-md-4">
      <div class="">
        <div class="table-responsive"> 
          <table class="table table-bordered">
          <caption>Assigned Heuristic Principles</caption>
          <thead>
          @foreach($hrule as $titledescription)
            <tr>
              <th>{{ $titledescription->title }}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $titledescription->description }}</td>
            </tr>
          </tbody>
          @endforeach
        </table>
      </div>
      </div>
    </div>
	</div>
</div>
@endsection

@section('script')

<script>
//This script is to preview the image
$(document).ready(function() {
        $("#screenshot").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img  />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
      });
</script>

<script>
//second image
$(document).ready(function() {
        $("#rscreenshot").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder1 = $("#image-holder1");
          image_holder1.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img  />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder1);
                }
                image_holder1.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
      });
</script>


<script>
$( document ).on( "pagecreate", function() {
    $( ".photopopup" ).on({
        popupbeforeposition: function() {
            var maxHeight = $( window ).height() - 60 + "px";
            $( ".photopopup img" ).css( "max-height", maxHeight );
        }
    });
});
</script>


<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
<link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script>

<script type="text/javascript">
        $(function () {
            $('#lstFruits').multiselect({
                includeSelectAllOption: true
            });
            $('#btnSelected').click(function () {
                var selected = $("#lstFruits option:selected");
                var message = "";
                selected.each(function () {
                    message += $(this).text() + " " + $(this).val() + "\n";
                });
                alert(message);
            });
        });
    </script>
@endsection