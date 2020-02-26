<?php
include "src\PHPMailer.php";
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerName = $_POST['fname'];
    $customerEmail = $_POST['email'];
    $customerPhone = $_POST['phone'];
    $message = $_POST['message'];
    sendMail($customerName, $customerEmail, $customerPhone, $message);
    echo "<script>alert('Successfully submitted');</script>";
    header("Location:https://varungowda24.github.io/craftsmengraff/contact.html");
}

function sendMail($customerName, $customerEmail, $customerPhone, $message)
{
	$SviBody = '<html><body><p>Customer Name : ' . $customerName . '</p>' .
	'<p>Customer Email : ' . $customerEmail . '</p>' .
	'<p>Phone : ' . $customerPhone . '</p>' .
	'<p>Message: ' . $message . '</p>';
	
    $mail = new PHPMailer(true);
    try {
		//Server settings
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'mail.smtp2go.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // // Enable SMTP authentication
		$mail->Username= 'testmailservice3@gmail.com';   // SMTP username
		$mail->Password = 'testmailservice3@';     
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 2525; // TCP port to connect to
		
        //Send To Customer
        $mail->setFrom($customerEmail, $customerName);
        $mail->addAddress('varun.varu11@gmail.com', 'Enquiry'); // Add a recipient  info@svikrti.com
        $mail->isHTML(true);
        $mail->Subject = 'Customer Details';
        // Set email format to HTML
        $mail->Body = $SviBody;
        $mail->send();
		// print_r($mail/);exit;
        //             $mail->addAddress('ellen@example.com');                 // Name is optional
        //             $mail->addReplyTo('info@svikrti.com', 'Enquery');
        //             $mail->addCC('cc@example.com');
        //             $mail->addBCC('bcc@example.com');

        //Attachments
        //             $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //             $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    } catch (Exception $e) {
		// echo $e;
		print_r($e);exit;
        echo 'Message could not be sent.';
    }
}
