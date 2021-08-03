<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    include_once "database.php";
    $obj = new database();

    $email = $_POST['email'];
    $error = 0;

    $obj->validEmail('login', 'email', "email = '$email'");
    $result = $obj->getResult();

    if($result[0] != '0'){
        
        //Load Composer's autoloader
        require '../vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp-relay.sendinblue.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'nitesh887369@gmail.com';                     //SMTP username
            $mail->Password   = 'OSmfCXQ8tPYUL7VH';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('nitesh887369@gmail.com', 'Student Management System');
            $mail->addAddress($result[1]['email'], $result[1]['first_name'.' '. $result[1]['last_name']]);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('nitesh887369@gmail.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Student Management System';
            $mail->Body    = 'Your forgot password opt here!'. $result[0];
            // $mail->AltBody = '';

            $mail->send();
            $error = 0;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }else{
        $error++;
    }
    if($error > 0){
        echo 0;
    }else{
        echo 1;
    }
?>