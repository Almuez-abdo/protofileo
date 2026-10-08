<?php
/* Contact form endpoint. Accepts POST (form-encoded or JSON), validates,
   and emails the message to the site owner via SMTP. Returns JSON. */
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/lib/PHPMailer.php';
require_once __DIR__ . '/includes/lib/SMTP.php';
require_once __DIR__ . '/includes/lib/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

function fail($msg, $code = 422) {
    http_response_code($code);
    echo json_encode(['ok' => false, 'error' => $msg], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    fail('Method not allowed.', 405);
}

$in = $_POST;
if (empty($in)) {
    $raw = file_get_contents('php://input');
    $json = json_decode($raw, true);
    if (is_array($json)) { $in = $json; }
}

$name    = trim($in['name'] ?? '');
$email   = trim($in['email'] ?? '');
$subject = trim($in['subject'] ?? '');
$message = trim($in['message'] ?? '');

if ($name === '') { fail('Please enter your name.'); }
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { fail('Please enter a valid email address.'); }
if ($subject === '') { fail('Please enter a subject.'); }
if (mb_strlen($message) < 10) { fail('Please write your message (10+ characters).'); }
if (!isset($MAIL) || ($MAIL['pass'] ?? '') === '[GMAIL-APP-PASSWORD]') {
    fail('Email delivery is not configured yet (missing app password).', 503);
}

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $MAIL['host'];
    $mail->Port = (int) $MAIL['port'];
    $mail->SMTPAuth = true;
    $mail->Username = $MAIL['user'];
    $mail->Password = $MAIL['pass'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->CharSet = 'UTF-8';
    $mail->setFrom($MAIL['user'], 'Portfolio Contact Form');
    $mail->addAddress($MAIL['to']);
    $mail->addReplyTo($email, $name);
    $mail->Subject = 'Portfolio: ' . mb_substr($subject, 0, 120);
    $mail->Body = "Name: {$name}\nEmail: {$email}\n\n{$message}";
    $mail->send();
    echo json_encode(['ok' => true], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    fail('Could not send the message. Please try again later.', 500);
}
