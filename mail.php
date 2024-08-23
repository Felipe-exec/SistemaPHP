<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'teste@gmail.com';
        $mail->Password   = ''; // Lembre-se de adicionar a senha correta
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Configurações do remetente e destinatários
        $mail->setFrom($_POST["email"], $_POST["name"]);
        $mail->addAddress($_POST["email"]);
        $mail->addReplyTo($_POST["email"], $_POST["name"]);

        // Verifica se um arquivo foi anexado
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['attachment']['tmp_name'];
            $fileName = $_FILES['attachment']['name'];
            $fileSize = $_FILES['attachment']['size'];
            $fileType = $_FILES['attachment']['type'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Apenas anexar se o arquivo for PDF
            if ($fileExtension == 'pdf') {
                $mail->addAttachment($fileTmpPath, $fileName);
            }
        }

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];
        $mail->Body    = $_POST["message"];

        // Envia o email
        $mail->send();
        echo "
        <script> 
            alert('Mensagem enviada com sucesso!');
            document.location.href = 'index.php';
        </script>
        ";
    } catch (Exception $e) {
        echo "Erro ao enviar a mensagem: {$mail->ErrorInfo}";
    }
} // Removi a chave extra aqui
?>
