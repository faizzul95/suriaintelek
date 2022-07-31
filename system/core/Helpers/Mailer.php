<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function replaceTextWithData($string = NULL, $arrayOfStringToReplace = array(), $prefix = '%', $suffix = '%')
{
    return str_replace(array_keys($prefix . $arrayOfStringToReplace . $suffix), array_values($arrayOfStringToReplace), $string);

    // foreach($arrayOfStringToReplace as $index => $value){
    //     $string = str_replace($prefix.$index.$suffix, $value, $string);
    // }
}

function contentData($contentType, $table = "general_content")
{
    return db()->where("content_type", $contentType)->where("content_status", '1')->fetchRow($table);
}

function sentMail($emailType = NULL, $parentData = NULL, $data = NULL)
{
    // decodeID($id);
    $content = contentData($emailType);

    if (!empty($content)) {

        if ($content['content_with_data'] == '1') {
            $dataReplace = arrayDataReplace($data);
            $content['content_description'] = str_replace(array_keys($dataReplace), array_values($dataReplace), $content['content_description']);
        }
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            // $mail->isSMTP();                                            //Send using SMTP
            // $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            // $mail->Username   = 'bogusus57@gmail.com';                      //SMTP username
            // $mail->Password   = 'bomb@1986';                               //SMTP password
            // $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
            // $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('no-reply@suria.canthinksolution.com', 'Tadika Suria Intelek');
            $mail->addAddress($parentData['parent_email'], $parentData['parent_name']);     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $parentData['subject'];
            $mail->Body    = $content['content_description'];

            $mail->send();
            // echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}

function arrayDataReplace($data)
{
    $newKey = $newValue = $newData = [];
    foreach ($data as $key => $value) {
        array_push($newKey, '%' . $key . '%');
        array_push($newValue, $value);
    }

    foreach ($newKey as $key => $data) {
        $newData[$data] = $newValue[$key];
    }

    return $newData;
}
