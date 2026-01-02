<?php
header('Content-Type: application/json');

// Response structure
$response = [
    'success' => false,
    'message' => 'Hubo un error al procesar tu solicitud.'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Sanitize and Validate Input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if (empty($name) || empty($email) || empty($message)) {
        $response['message'] = 'Por favor completa todos los campos requeridos.';
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'El correo electrónico no es válido.';
        echo json_encode($response);
        exit;
    }

    // 2. Email Configuration
    // TODO: For production, use PHPMailer for better deliverability and SMTP support.
    // Replace this email with your corporate email later: admin@ovcsystems.com
    $to = 'osvicor1964@gmail.com';
    $subject = "Nueva Solicitud desde OVCSYSTEMS: " . ucfirst($type);

    // 3. Email Body Construction
    $email_content = "Has recibido un nuevo mensaje desde tu sitio web.\n\n";
    $email_content .= "Detalles del Contacto:\n";
    $email_content .= "------------------------\n";
    $email_content .= "Nombre: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Tipo de Solicitud: " . ucfirst($type) . "\n\n";
    $email_content .= "Mensaje:\n";
    $email_content .= "------------------------\n";
    $email_content .= "$message\n";

    // 4. Headers
    $headers = "From: webmaster@ovcsystems.com\r\n"; // Fake sender for now, change in prod
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // 5. Send Email
    // Note: In local XAMPP, this requires sendmail configuration in php.ini to actually work with Gmail.
    // If it fails locally, it's expected without config.
    if (mail($to, $subject, $email_content, $headers)) {
        $response['success'] = true;
        $response['message'] = '¡Gracias! Tu mensaje ha sido enviado correctamente. Te contactaremos pronto.';
    } else {
        // Fallback for local testing (simulating success if mail() fails due to config)
        // In a real server this strictly means failure.
        // For now, let's treat it as an error to alert the user.
        $response['message'] = 'No se pudo enviar el correo. Por favor intenta más tarde o contáctanos directamente.';

        // DEBUG ONLY: Remove this else block in production if you want strict failure.
        // On local XAMPP without sendmail configured, mail() returns false.
    }
} else {
    $response['message'] = 'Método no permitido.';
}

echo json_encode($response);
