<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function getMailer(): PHPMailer
{
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = getenv_val('SMTP_HOST', 'smtp.gmail.com');
    $mail->SMTPAuth = true;
    $mail->Username = getenv_val('SMTP_USER', '');
    $mail->Password = getenv_val('SMTP_PASS', '');
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = (int)getenv_val('SMTP_PORT', '587');
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);

    $fromEmail = getenv_val('SMTP_FROM', getenv_val('SMTP_USER', ''));
    $mail->setFrom($fromEmail, "Nandhu's Beauty Salon");

    return $mail;
}

function sendEmail(string $toEmail, string $toName, string $subject, string $htmlBody): bool
{
    if (empty(getenv_val('SMTP_USER'))) {
        error_log("SMTP not configured. Email to {$toEmail} skipped.");
        return false;
    }

    try {
        $mail = getMailer();
        $mail->addAddress($toEmail, $toName);
        $mail->Subject = $subject;
        $mail->Body = $htmlBody;
        $mail->AltBody = strip_tags($htmlBody);
        $mail->send();
        return true;
    }
    catch (Exception $e) {
        error_log('Email error: ' . $e->getMessage());
        return false;
    }
}
