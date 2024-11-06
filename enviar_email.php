<?php
// Incluye PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/MAMP/htdocs/wm-rent_2/vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'mail.rentacarwm.com.py'; // Servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'reservas_wm_autos@rentacarwm.com.py'; // Tu dirección de correo
    $mail->Password = 'Rent@caR_WM'; // Contraseña de la cuenta de correo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Configuración del remitente y destinatario
    $mail->setFrom('reservas_wm_autos@rentacarwm.com.py', 'Reservas WM Autos');
    $mail->addAddress('elvitoca@gmail.com', 'Nombre del Destinatario');

    // Adjuntar el archivo PDF
    $mail->addAttachment('C:\MAMP\htdocs\wm-rent_2\pedidos en pdf\Reserva_Rent_a_Car_WM.pdf', 'Reserva_Rent_a_Car_WM.pdf'); // Cambia la ruta al archivo PDF

    // Configuración del contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Pedido de Reserva Rent a Car WM';
    $mail->Body    = 'Aquí tienes tu pedido en formato PDF.';

    // Enviar correo
    $mail->send();
    echo 'Mensaje enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar mensaje: {$mail->ErrorInfo}";
}
