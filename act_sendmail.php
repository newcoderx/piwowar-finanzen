<?php
//var_dump($_REQUEST);
//exit;
//if "email" variable is filled out, send email
  if (isset($_REQUEST['EmailInput']))  {
  //Email information
  
  //Spamcheck mit jedem neuem Absenden zurücksetzen
	$spamcheck = false; 
	//Spamcheck
	//!isset($_POST["repeat_email"]) || !empty($_POST["repeat_email"]) || 
	
	if(!isset($_REQUEST["repeat_email"]) || !empty($_REQUEST["repeat_email"]) || isset($_REQUEST["terms"]) || $_REQUEST["repeat_email"] == "beth.levi@yahoo.com") {
		$errors[] = "Zusatzfelder wurden ausgefüllt, wir vermuten Spam und brechen hier ab.";	
	} else {
		$spamcheck = true;
	}
	
  if($spamcheck == true) {
  $to = "info@piwowar-finanzen.de";
  $subject = "Kontaktanfrage aus piwowar-finanzen Webseite";
  $message = "Name und Vorname:  " . utf8_decode($_REQUEST['NameInput']) . "\r\n\r\n";
  $message .= "Straße und Hausnummer:  " . utf8_decode($_REQUEST['AdressInput']) . "\r\n\r\n";
  $message .= "Postleitzahl:  " . utf8_decode($_REQUEST['PlzInput']) . "\r\n\r\n";
  $message .= "Telefonnummer:  " . utf8_decode($_REQUEST['TelInput']) . "\r\n\r\n";
  $message .= "E-mail:  " . utf8_decode($_REQUEST['EmailInput']) . "\r\n\r\n";
  $message .= "Nachricht:  " . utf8_decode($_REQUEST['Message']);
  $from = utf8_decode($_REQUEST['EmailInput']);
  $headers = "From:" . $from;
  mail($to,$subject,$message,$headers, "-f info@piwowar-finanzen.de");
  //mail an Absender
  $to = $_REQUEST['EmailInput'];
  $subject = "Piwowar Finanzen";
  $message = utf8_decode("Sehr geehrte Damen und Herren,vielen Dank für Ihre Nachricht. Sie bekommen von uns schnellstmöglich eine Antwort.");
  $from = "info@piwowar-finanzen.de";
  $headers = "From:" . $from;
  mail($to,$subject,$message,$headers, "-f info@piwowar-finanzen.de");
  
  //Email response
  //echo "Thank you for contacting us!";
  header("Location: ../index.html?send=1");
  }
  }
  //if "email" variable is not filled out, display the form
  else  {
?>

 <form method="post">
  Email: <input name="email" type="text" /><br />
  Subject: <input name="subject" type="text" /><br />
  Message:<br />
  <textarea name="comment" rows="15" cols="40"></textarea><br />
  <input type="submit" value="Submit" />
  </form>
  
<?php
  }
?>

