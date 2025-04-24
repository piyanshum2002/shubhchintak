<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

    // getting all values from the HTML form
    if(isset($_POST['submit']))
    {
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $gmail = $_POST['mail'];
        $maritalstatus = $_POST['maritalstatus'];
        $employment = $_POST['employment'];
        $income = $_POST['monthlyincome'];
        $ccdue = $_POST['ccdue'];
        $pldue = $_POST['pldue'];
        $paystatus = $_POST['paystatus'];
        $harassment = $_POST['harassment'];
        $languages = $_POST['language'];
        $query=$_POST['query'];

    }

    $message= $fullname." filled the Free Consultation form for Loan Settlement. <br> <br> please check the details below <br> Fullname = ".$fullname."<br> Phone number = ".$phone."<br> E-Mail = ".$gmail."<br> Marital Status = ".$maritalstatus."<br> Employment Status = ".$employment."<br> Monthly Income = ".$income."<br> Credit Card Dues = ".$ccdue."<br> Personal Loan Dues = ".$pldue."<br> Payment Status = ".$paystatus."<br> Harassment Level = ".$harassment."<br> Language Preferred = ".$languages."<br> Query or Message = ".$query;

    $message2= $fullname." , Your Free Consultation request has been submitted and Our Experts will be in touch with you shortly <br> <br> please check the details below for your Loan Settlement Query Form". "<br> Fullname = ".$fullname."<br> Phone number = ".$phone."<br> E-Mail = ".$gmail."<br> Marital Status = ".$maritalstatus."<br> Employment Status = ".$employment."<br> Monthly Income = ".$income."<br> Credit Card Dues = ".$ccdue."<br> Personal Loan Dues = ".$pldue."<br> Payment Status = ".$paystatus."<br> Harassment Level = ".$harassment."<br> Language Preferred = ".$languages."<br> Query or Message = ".$query;

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
      $sql ="INSERT INTO consultationform(id, fullname, phone, mail, maritalstatus, employment, income, ccdue, pldue, paystatus, harassment, languages, query) VALUES ('0', '$fullname', '$phone', '$gmail', ' $maritalstatus','$employment', '$income', '$ccdue', '$pldue', '$paystatus', '$harassment', '$languages', '$query')";
    
      // send query to the database to add values and confirm if successful
      $rs = mysqli_query($con, $sql);
      
      if($rs)
      {
        //Create an instance; passing `true` enables exceptions
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
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('info@shubhchintak.org.in', 'Shubh Chintak');
            $mail->addAddress("$gmail", "$fullname");     //Add a recipient
          
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "$fullname , Your Loan settlement Query has Been Submitted ";
            $mail->Body    =file_get_contents('consultationmail.html');

            $mail->send();

 
  
          // include("thanks.html");

      }catch (Exception $e) {
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
        $mail->Subject = "New Query , $fullname Filled the Consultation form ";
        $mail->Body    = "$message";

        $mail->send();



      include("thanks.html");

  }catch (Exception $e) {
    echo "Message could not be sent. Mailer Error:";
}

    }
     
    
      // close connection
      mysqli_close($con);
  