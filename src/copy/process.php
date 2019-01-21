<?php
// Configure your Subject Prefix and Recipient here
$subjectPrefix = "פניה מעמוד נחיתה";
$emailTo       = 'denisb@seo-extra.co.il';
$email - 'denisb@seo-extra.co.il';
$errors = array(); // array to hold validation errors
$data   = array(); // array to pass back data
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = stripslashes(trim($_POST['name']));
	$tel   = stripslashes(trim($_POST['tel']));
	$email   = stripslashes(trim($_POST['mail']));
	
	
	
	$info = getdate();
	$date = $info['mday'];
	$month = $info['mon'];
	$year = $info['year'];
	$hour = $info['hours'];
	$min = $info['minutes'];
	$sec = $info['seconds'];

	$current_date = "$date/$month/$year - $hour:$min";
    // if there are any errors in our errors array, return a success boolean or false
    if (!empty($errors)) {
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
        $subject = "$subjectPrefix $subject";
        $body    = '<div style="direction:rtl">
            <strong>שם: </strong>'.$name.'<br />
			<strong>טלפון: </strong>'.$tel.'<br />
			<strong>דואל: </strong>'.$email.'<br />
        ';
        $headers  = "MIME-Version: 1.1" . PHP_EOL;
        $headers .= "Content-type: text/html; charset=utf-8" . PHP_EOL;
        $headers .= "Content-Transfer-Encoding: 8bit" . PHP_EOL;
        $headers .= "Date: " . date('r', $_SERVER['REQUEST_TIME']) . PHP_EOL;
        
		$headers .= "Message-ID: <" . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . '>' . PHP_EOL;
		$headers .= "From: noreply@polishcristal.co.il"  . "\r\n";
        $headers .= "Return-Path: $emailTo" . PHP_EOL;
        
		$headers .= "Reply-To: $email" . PHP_EOL;
        $headers .= "X-Mailer: PHP/". phpversion() . PHP_EOL;
        $headers .= "X-Originating-IP: " . $_SERVER['SERVER_ADDR'] . PHP_EOL;
		
$headers .= 'Cc: itay@extra.co.il' . "\r\n";

		mail("denisb@extra.co.il", "=?utf-8?B?" . base64_encode($subject) . "?=", $body, $headers);
		
        $data['success'] = true;
        $data['message'] = 'Congratulations. Your message has been sent successfully';
    }
    // return all our data to an AJAX call
    echo json_encode($data);
}




