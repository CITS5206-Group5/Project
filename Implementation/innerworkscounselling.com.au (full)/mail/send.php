<?php
error_reporting(E_ALL ^ E_NOTICE);
header("Content-type: text/html; charset=utf-8");

require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

$error = 1;

$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$message_content = $_POST['message'] ?? '';

if (!$first_name || !$last_name) {
    $error = 'Enter name';
}

if ($error == 1) {
    global $wpdb;
    $table_name = $wpdb->prefix . "contacts";

    $is_sent = 0;
    $date_added = current_time('mysql');

    $inserted = $wpdb->insert(
        $table_name,
        [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'email' => $email,
            'message' => $message_content,
            'is_sent' => $is_sent,
            'date_added' => $date_added
        ]
    );

    if ($inserted === false) {
        echo "Error inserting data into the database: " . $wpdb->last_error;
        die();
    }

    $contact_id = $wpdb->insert_id;

    // Notify Lita
    $message = 'Name: ' . $first_name . ' ' . $last_name . ', Phone: ' . $phone . ', Email: ' . $email . ' Message: ' . $message_content;
    $subject = 'Request from the website';

    $headers = ['Content-Type: text/html; charset=UTF-8'];
    $success = wp_mail(get_option('admin_email'), $subject, $message, $headers);

    if (!$success) {
        echo "Error during sending the mail";
        die();
    }

    // Send Free_Wellbeing_Tips.pdf
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
            $message = "
                    <p>Hello $first_name $last_name,</p>
                    <p>Thank you for your interest! You can download the Free Wellbeing Tips PDF by clicking the link below:</p>
                    <p><a href='$pdf_url'>$pdf_url</a></p>
                    <p>Best regards,<br>Inner Works Counselling Team</p>
                        ";
            $subject = 'Your Free Wellbeing Tips';

            $success = wp_mail($email, $subject, nl2br($message), $headers);

            if ($success) {
                $wpdb->update(
                    $table_name,
                    ['is_sent' => 1],
                    ['id' => $contact_id]
                );
            } else {
                echo "Error during sending the PDF";
                die();
            }
        }
    }
} else {
    echo $error;
    die();
}

echo '1';
