<?php
// Extract the post array to independent variables.
// Create the message and the subject

extract($_POST);
$message = "New Booking from the website\n\r";
$message.= "Name: ".$name." ".$surname." Age: ".$age."\n\r";
$message.= "From:".$from." To:".$to."\n\r";
$message.= "Email:".$email." Phone:".$phone."\n\r";
$subject = "New Booking from web of: ".$Name." ".$surname ;

//Headers
$headers = "From:" . $email."\r\n";

//send email and respond to ajax 
if (@mail("yo@pablosanchezweb.com",$subject,$message,$headers)) {
  		// build JSON and control if I want the access (for crossdomain).
  		$result = array("result"=>"success", "message" => "The message was sent successfully");
		header("Content-Type: application/json");
		header('Access-Control-Allow-Origin: *');
		echo json_encode($result);
		if ($copy) { // If the user want a copy of email
			$headers = "BCC:" . $email."\r\n";
			mail($email,$subject,$message,$headers);

		}	
	} else { // if there any problem. 
		$result = array("result"=>"Failed", "message" => "The message failed, Try to our Phone: 999 365 3232");
		echo json_encode($result);
	}