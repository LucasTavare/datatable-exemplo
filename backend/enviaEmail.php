<?php

date_default_timezone_set('America/Sao_Paulo');

;


//  <=========================================> quem recebe <=========================================> \\


/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */




//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function enviaEmail($destinario, $destinatario_nome, $token)
{
    $email_servidor = 'smtp.gmail.com';

    $email_porta = 465;

    $email_usuario = 'tecnico22asenac@gmail.com';

    $email_senha = 'zvfarpeztyqgtrhe';

    $email_assunto = 'Sistema senac - ative sua conta';
    // usada so se tiver gerenciadndo pacotes composer
    // require '../vendor/autoload.php';

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    $mail->CharSet = 'UTF-8';

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    //Set the hostname of the mail server
    $mail->Host = $email_servidor;
    //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
    //if your network does not support SMTP over IPv6,
    //though this may cause issues with TLS

    //Set the SMTP port number:
    // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
    // - 587 for SMTP+STARTTLS
    $mail->Port = $email_porta;

    //Set the encryption mechanism to use:
    // - SMTPS (implicit TLS on port 465) or
    // - STARTTLS (explicit TLS on port 587)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = $email_usuario;

    //Password to use for SMTP authentication
    $mail->Password = $email_senha;

    //Set who the message is to be sent from
    //Note that with gmail you can only use your account address (same as `Username`)
    //or predefined aliases that you have configured within your account.
    //Do not use user-submitted addresses in here
    $mail->setFrom($email_usuario, 'Tecnico 22a');

    //Set an alternative reply-to address
    //This is a good place to put user-submitted addresses
    // $mail->addReplyTo('tecnico22asenac@gmail.com', 'T??cnico 22A');

    //Set who the message is to be sent to
    $mail->addAddress($destinario);

    //Set the subject line
    $mail->Subject = $email_assunto;

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);

    //Replace the plain text body with one created manually
    // $mail->AltBody = 'This is a plain-text message body';

    $email_corpo = <<<EMAIL
    <h1>Ol?? $destinatario_nome, bem viindo ao Sistema Senac</h1>
    <p>Ative o seu login, acessando o link abaixo:</p>
    <a href="http://localhost/datatable-exemplo/backend/ativaUsuario.php?token=$token"> Ativar acesso</a>
    <small>Esse ?? um email automatico, nao responda</small>
    
EMAIL;

$mail->Body = $email_corpo;
$mail->isHTML(true);

    //Attach an image file
    // $mail->addAttachment('../img/nyan-cat.gif');

    //send the message, check for errors
    if (!$mail->send()) {
        return false;
    } else {
        return true;
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}
