<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';


// getting all values from the HTML form
if (isset($_POST['submit'])) {
  $fullname = $_POST['fullname'];
  $phone = $_POST['mobile'];
  $gmail = $_POST['mail'];
  $amount = $_POST['amount'];
  $query = $_POST['query'];
}

$message = $fullname . ", Your  Call back request for Loan Settlement has been successfully received, Our Experts will be in touch with you shortly. <br> <br> please check the details below <br> <br> Fullname = " . $fullname . "<br>Phone number = " . $phone . "<br> E-Mail = " . $gmail . "<br> Amount = " . $amount . "<br> Query = " . $query;

$message2 = $fullname . " Requested a Call back for Loan Settlement. <br> <br> please check the details below <br> <br> Fullname = " . $fullname . "<br> Phone number = " . $phone . "<br> E-Mail = " . $gmail . "<br> Amount = " . $amount . "<br> Query = " . $query;

$message3 = "";

// database details
$host = "localhost";
      $username = "u688193508_shubhchintak";
      $password = "Shubhchintak@7";
      $dbname = "u688193508_backend_data";

// creating a connection
$con = mysqli_connect($host, $username, $password, $dbname);

// to ensure that the connection is made
// if (!$con)
// {
//     die("Connection failed!" . mysqli_connect_error());
// }

// using sql to create a data entry query
$sql = "INSERT INTO callback(id, fullname, phone, mail, amount, query) VALUES ('0', '$fullname', '$phone', '$gmail', '$amount', '$query')";

// send query to the database to add values and confirm if successful
$rs = mysqli_query($con, $sql);

if ($rs) {

  //   include("thanks.html");
  //   mail("piyanshum2002@gmail.com",$fullname." Requested a CallBack",$message);

  $mail = new PHPMailer(true);

  try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'info@shubhchintak.org.in';                     //SMTP username
            $mail->Password   = 'Bhardwaj@subhchintak#77';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@shubhchintak.org.in', 'Shubh Chintak');
    $mail->addAddress("$gmail", "$fullname");   //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "$fullname , Your Call back request has Been Submitted ";
    $mail->Body    =file_get_contents('callbackmail.html');


    $mail->send();



    //   include("thanks.html");

  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error:";
  }

  $mail = new PHPMailer(true);

  try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'info@shubhchintak.org.in';                     //SMTP username
            $mail->Password   = 'Bhardwaj@subhchintak#77';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                      //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@shubhchintak.org.in', 'Shubh Chintak');
    $mail->addAddress('info.shubhchintak7@gmail.com', 'Shubh Chintak');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "New Query , $fullname Requested a Call back ";
    $mail->Body    = "$message2";

    $mail->send();



    include("thanks.html");
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error:";
  }
}

// close connection
mysqli_close($con);
