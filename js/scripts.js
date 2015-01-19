 
/* JS code for: on click checknow button, validate all the fields,
(I disable bootstrap validation, to develop by my self like a example)
After validation, of all elements, get an ajax requierment, who return a json object
with paramenter of success or fail, after sending the contact email and if user wants 
a selfcopy.  

*/
// I create the click function
$( "#send" ).click(function(event) {
    // disable submit button and Bootstrap validation.
    event.preventDefault();
    var formData = {};
    //function to validate dates creating 2 objects, validate "From" minor than "To"                             
    function validateDate(f,t){

      var start= new Date(f.val());
      var end= new Date(t.val());
      if (start < end) {
        formData["from"] = f.val();
        formData["to"] = t.val();
        f.parent().removeClass("has-error");
        t.parent().removeClass("has-error");
        return true;
        } else {
        f.parent().addClass("has-error");
        t.parent().addClass("has-error");
        return false;
           }

    }
    //Define a function to validate the Text fields are not empty, and include the value in obj formData
    var a = "";
    function validateText(a){
      if (a.val()=="" ) {
        a.parent().addClass('has-error');
        return false;  
      } else {
        formData[a.attr('name')] = a.val();
        a.parent().removeClass('has-error');
        return true;
        } 
    }
    //validate the text format of the email and include the value in obj formData
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    //Function to validate the input email. and include the value in obj formData

    function validateEmail(a){
        if ( !isEmail(a.val())) {
          a.parent().addClass('has-error');
          return false;
        }else{
          formData["email"] = a.val();
          formData["copy"] = $("#copy").is('checked');
          console.log(formData["copy"]);
          a.parent().removeClass('has-error');
          return true;
        }   
    }
    //Validate all fields
    var validForm = true;
    validForm = validateText($("#name")) && validForm;
    validForm = validateText($("#surname")) && validForm;
    validForm = validateText($("#age")) && validForm;
    validForm = validateText($("#phone")) && validForm;
    validForm = validateEmail($("#email")) && validForm;
    validForm = validateDate($("#from"),$("#to")) && validForm;
    // If all ok, then I Make ajax requirement to mail.php, sending the object formData through POST.
    if (validForm) {
        console.log (validForm, "es valido");
        $.ajax({
          type: 'post', 
          url: 'mail.php',
          data: formData,
          success: function(result){
            //Receive the message from PHP and event status.
            $("#alert").html(result.message);
            if (result.result =='success' ) {
               $("#alert").removeClass("alert-danger");
               $("#alert").addClass("alert-success");
               $("#alert").attr("hidden", false);
            } else {
              $("#alert").addClass("alert-danger");
               $("#alert").attr("hidden", false);
            }
          }
        });
    } else {
      // if Some field is wrong, we show an alert.
        $("#alert").html("Some fields are wrong!");
        $("#alert").addClass("alert-danger");
        $("#alert").attr("hidden", false);
    }
});





