<?php

//
// *** To Email ***
$to = 'dhruveshpatel2004@gmail.com';
//
// *** Subject Email ***
$subject = 'Welcome to our company!';
//
// *** Content Email ***
$template=file_get_contents('./EmailTemplate.php');
$template = str_replace('{Name}',$Username,$template);
$template = str_replace('{Email}', $Email, $template);
$template = str_replace('{Password}', $Password, $template);

//
//*** Head Email ***
// $headers = "From: mailserveraddress7089@gmail.com\r\n".
// 'Content-type: text/html; charset=UTF-8' . "\r\n" .;
$headers = 'From: mailserveraddress7089@gmail.com' . "\r\n" .
'Reply-To: mailserveraddress7089@gmail.com' . "\r\n" .
'Content-type: text/html; charset=UTF-8' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
//
//*** Show the result... ***
if (mail($to, $subject, $template, $headers))
{
	echo "Mail sent Successfully";
} 
else 
{
    echo "ERROR";
}
?>