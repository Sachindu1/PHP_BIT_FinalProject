<?php
include_once '../classes/mail_class.php';

    $mail=new mail();

    $mail->c_name = "ESOFT - Virtual HR Service";
    $mail->c_email = "kushan.sachindu@gmail.com";
    $mail->m_subject = "we are hiring";
    $mail->m_message = "pelase apply";
    $mail->send_mail($mail->c_name, $mail->c_email, $mail->m_subject,$mail->m_message);
     
?>
