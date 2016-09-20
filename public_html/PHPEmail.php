<!DOCTYPE>
<html>
<head>
<title><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.3c.org/TR/html4/strict.dtd">PHP E-mail</title>
</head>
<body>
<?php

	/*$from = "Jeremiah Hall <jthall97@gmail.com>";
	$to = str_replace("\r\n", ",", $_GET['to']);
	$cc = str_replace("\r\n", ",", $_GET['cc']);

	$bcc = str_replace("\r\n", ",", $_GET['bcc']);
	$subject = "Agenda for tomorrow's meeting";
	$message = "In tomorrow's meeting, we will discuss our new marketing campaign and third-quarter sales result. We will also introduce the sales associates who made this quarter's \"100% Club\".";*/

	function validateSender($address){
		if(strpos($address,'@') !== FALSE && strpos($address,'.') !== FALSE){
			return true;
		}else{
			return false;
		}
	}

	function validateRecipients($addresses){
		$address = explode(",",$addresses);
		$retValue = true;
		foreach($address as $email){
			
			if(strpos($email, '@') !== FALSE && strpos($email, ".") !== FALSE){
				$retValue = true;
			}else{
				$retValue = false;
				break;
			}
		}
		return $retValue;
	}

	function checkForDuplicates($addresses){
		$address = explode(",", $addresses);
		$Count = count($address);
		$retValue = false;
		$i = 0;
		while($i<$Count){
			$j = 0;
			while($j<$Count){
				if(strcasecmp($address[$i], $address[$j]) == 0 && $i != $j){
					$retValue = true;
				}
				++$j;
			}
			++$i;
		}
		return $retValue;
	}


	$from = "{$_GET['sender_name']} <{$_GET['sender_email']}>";
	$to = str_replace("\r\n", ",",$_GET['to']);
	$cc = str_replace("\r\n", ",",$_GET['cc']);
	$bcc = str_replace("\r\n", ",",$_GET['bcc']);
	$subject = $_GET['subject'];
	$message = $_GET['message'];	

	$headers = "From: $from\r\n";
	$headers .= "CC: $cc\r\n";
	$headers .= "BCC: $bcc\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
	$headers .= "Content-Transfer-Encoding: 8bit\r\n";
	
	if(empty($_GET['sender_name']) || empty($_GET['sender_email']) || empty($_GET['to']) || empty($_GET['subject']) || empty($_GET['message'])){

		echo "<p>You must enter values in the sender name, sender email, To, subject, and message fields.</p>";
	
	}else if(validateSender($_GET['sender_email']) == false){
		echo "The sender's e-mail address does not appear to be valid. Click your browser's back button to return to the message.";
	}else if(validateRecipients($to) == false){
		echo "<p>One or more of the \"To\" e-mail addresses does not appear to be valid. click your browser's back button to return to the message.</p>";
	
	}else if(isset($GET['cc']) && validateRecipients($cc) == false){

		echo "<p>One or more of the \"CC\" e-mail addresses does not appear to be valid. click your browser's back button to return to the message.</p>";
	}else if(isset($GET['bcc']) && validateRecipients($bcc) == false){

		echo "<p>One or more of the \"BCC\" e-mail addresses does not appear to be valid. click your browser's back button to return to the message.</p>";

	}else if(checkForDuplicates($to) == true){
		echo "<p>The \"To\" e-mail addresses contain duplicates. Click your browser's back button to return to the message</p>";

	}else if(checkForDuplicates($cc) == true){
		
		echo "<p>The \"CC\" e-mail addresses contain duplicates. Click your browser's back button to return to the message</p>";

	}else if(checkForDuplicates($bcc) == true){
		
		echo "<p>The \"BCC\" e-mail addresses contain duplicates. Click your browser's back button to return to the message</p>";
	}else{

	$messageSent = mail($to,$subject,$message,$headers);
		//$messageSent = true;

		if($messageSent){
			echo "<p>The following message was sent successfully:</p>";
			echo "<p><strong>From</strong>: $from</p>";
			echo "<p><strong>To</strong>: $to</p>";
			echo "<p><string>CC</strong>: $cc</p>";
			echo "<p><strong>BCC</strong>: $bcc</p>";
			echo "<p><strong>Subject</strong>: $subject</p>";
			echo "<p><strong>Message</strong>: $message</p>";
		}else{
			echo "<p>The message was not sent successfully!</p>";
		}	
	}
?>

<hr /><p><a href = "PHPEmail.html">Return to email form</a></p>

</body>
</html>
