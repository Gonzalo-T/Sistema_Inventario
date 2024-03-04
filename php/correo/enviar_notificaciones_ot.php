<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';


foreach ($ots as $ot) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'mail.construmelrl.cl';
        $mail->SMTPAuth = true;
        $mail->Username = 'informacion@construmelrl.cl';
        $mail->Password = 'Login1234?*';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('informacion@construmelrl.cl', 'Notificaciones OT Construmel RL');
        $mail->addAddress('ca.acunah@duocuc.cl'); // Correo específico para notificaciones internas

        $mail->isHTML(true);
        $mail->Subject = 'Informe de Estado de OT: ' . $ot['id_ot'];

        // Formato del mensaje
        $estadoMensaje = $ot['dias_restantes'] == -1 ? "Atrasada: Lleva un día de atraso" : ($ot['dias_restantes'] == 0 ? "Por entregar hoy" : ($ot['dias_restantes'] == 2 ? "Próxima a finalizar: 2 días restantes" : ""));

        $mensaje = "<h3>Informe de Gestión - Orden de Trabajo N° " . $ot['id_ot'] . "</h3>" .
            "<p>Información relevante para seguimiento interno:</p>" .
            "<ul>" .
            "<li><strong>ID OT:</strong> " . $ot['id_ot'] . "</li>" .
            "<li><strong>Cliente:</strong> " . $ot['nombre_cliente'] . " (ID: " . $ot['id_cliente'] . ")</li>" .
            "<li><strong>Mueble:</strong> " . $ot['nombre_mueble'] . "</li>" .
            "<li><strong>Fecha de Finalización:</strong> " . $ot['fecha_fin'] . "</li>" .
            "<li><strong>Estado Actual:</strong> " . $estadoMensaje . "</li>" .
            "</ul>" .
            "<p>Es esencial mantener un seguimiento adecuado para garantizar la eficiencia y puntualidad en las entregas.</p>" .
            "<p>Atentamente,<br><strong>Equipo de Gestión Construmel RL</strong></p>";

        $mail->Body = $mensaje;

        $mail->send();
        echo "El mensaje de seguimiento para OT: " . $ot['id_ot'] . " ha sido enviado a ca.acunah@duocuc.cl.\n";
    } catch (Exception $e) {
        echo "El mensaje de seguimiento para OT: " . $ot['id_ot'] . " no se pudo enviar a ca.acunah@duocuc.cl. Error de PHPMailer: {$mail->ErrorInfo}\n";
    }
}
