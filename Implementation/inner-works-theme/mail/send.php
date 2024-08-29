<?php
error_reporting(E_ALL ^ E_NOTICE);
header("Content-type: text/html; charset=utf-8");

include 'mail.php';

$error = 1;

$name = $_POST['first_name'] . ' ' . $_POST['last_name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if (!$name) {
    $error = 'Enter name';
}

//Notify Lita
if ($error == 1) {
    $message = 'Name: ' . $name . ', Phone: ' . $phone . ', Email: ' . $email . ' Message: ' . $message;
    $smtp = new SMTP($from, $username, $password, $host, $port);
    $success = $smtp->send($to, 'Request from the website', $message);

    if (!$success) {
        echo "Error during sending the mail";
        die();
    }
} else {
    echo $error;
    die();
}

//Send Free_Wellbeing_Tips.pdf
if (isset($_POST['action']) && $_POST['action'] === 'submit_wellbeing_tips_form') {
    function find_pdf_file($filename) {
        $upload_path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads';
        $upload_url = 'https://polis-finans.ru/wp-content/uploads';

        $directory_iterator = new RecursiveDirectoryIterator($upload_path, RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($directory_iterator);

        foreach ($iterator as $file) {
            if ($file->getFilename() === $filename) {
                $file_url = str_replace($upload_path, $upload_url, $file->getPathname());
                return $file_url;
            }
        }

        return false;
    }

    $pdf_url = find_pdf_file('Free_Wellbeing_Tips.pdf');

    if ($pdf_url) {
        $message = "Hello $name,\n\nThank you for your interest! You can download the Free Wellbeing Tips PDF by clicking the link below:\n\n$pdf_url\n\nBest regards,\nInner Works Counselling Team";
        $smtp = new SMTP($from, $username, $password, $host, $port);
        $success = $smtp->send($email, 'Your Free Wellbeing Tips', $message);

        if (!$success) {
            echo "Error during sending the mail";
            die();
        }
    }
}

//Aweber
$access_token = '62SNXOmnXY1SBegC';
$account_id = '2309';
$list_id = '689';

$subscriber_data = [
    'name' => $name,
    'email' => $email
];

$api_url = "https://api.aweber.com/1.0/accounts/$account_id/lists/$list_id/subscribers";

$ch = curl_init($api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($subscriber_data));
$response = curl_exec($ch);
curl_close($ch);

$response_data = json_decode($response, true);
if ($response_data !== null) {
    echo 'Failed to add subscriber: ' . json_encode($response_data);
    die();
}

echo "1";