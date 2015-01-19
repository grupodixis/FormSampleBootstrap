<!DOCTYPE html>
<!-- This is a simple Form with the Bootstrap format -->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Form Sample</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <h1>Booking Form Sample</h1>
      <p class="lead">Simply I try to show some sample coding here, hopefully this help to my success</p>
      <div id="alert" class="alert" role="alert" hidden="true"></div>
      <form name="book"class="form-signin" id="book">

        <div class="form-group">
          <label class="control-label" for="from">Date from:</label>
          <input type="date" name="from" class="form-control" placeholder="From date" required="" autofocus="" id="from">
        </div>
        <div class="form-group">
          <label class="control-label" for="to">To:</label>
        <input type="date" name="to" id="to" class="form-control" placeholder="To date" required="" autofocus="">
        </div>
         <div class="form-group">
          <label class="control-label" for="name">Name:</label>
        <input type="Text" name="name" id="name" class="form-control" placeholder="Ej. Jhony B." required="" autofocus="">
        </div>
        <div class="form-group">
          <label class="control-label" for="surname">Surname:</label>
        <input type="Text" name="surname" id="surname" class="form-control" placeholder="Good" required="" autofocus="">
        </div>
        <div class="form-group">
          <label class="control-label" for="age">Age:</label>
        <input type="number" name="age" id="age" class="form-control" placeholder="00" required="" autofocus="">
        </div>
        <div class="form-group">
          <label class="control-label" for="phone">Phone:</label>
          <input type="tel" name="phone" id="phone" class="form-control bfh-phone" data-format="(dddd) ddd-dddddd" placeholder="897 452112111" required="" autofocus="" maxlength ="13">
        </div>
        <div class="form-group">
          <label class="control-label" for="email">Email:</label>
          <input type="email" id="email" class="form-control" placeholder="Ej. jhonybgood@gmail.com" required="" autofocus="">
        <div class="checkbox">
            <label>
              <input name="copy" id="copy" type="checkbox" value="copy"> Receive a copy in your email
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="no-submit" id="send">Check now!</button>
      </form>
    </div>  
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
   <script type="text/javascript" src="js/scripts.js"></script>
  </body>
</html>