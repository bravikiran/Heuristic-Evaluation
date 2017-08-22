
  var counter = 1;
  var limit = 3;
    function addInput(divName){
         if (counter == limit)  {
            alert("You have reached the limit of adding " + counter + " inputs");
         }
         else {
            var newdiv = document.createElement('div');
            newdiv.innerHTML = "<label>Email:</label><br><input id='email' type='email' class='form-control' placeholder='Email' name='emails[]'>";
            document.getElementById(divName).appendChild(newdiv);
            counter++;
         }
    }
