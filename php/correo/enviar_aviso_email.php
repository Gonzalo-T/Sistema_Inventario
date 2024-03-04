<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'mail.construmelrl.cl';
    $mail->SMTPAuth = true;
    $mail->Username = 'informacion@construmelrl.cl';
    $mail->Password = 'Login1234?*';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('informacion@construmelrl.cl', 'Informacinn Construmel RL');
    $mail->addAddress('ca.acunah@duocuc.cl');

    $mail->isHTML(true);
    $mail->Subject = 'Aviso de Stock Bajo de Materiales';
    $mail->Body    = $body;

    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo "El mensaje no se pudo enviar. Error de PHPMailer: {$mail->ErrorInfo}";
}
?>
