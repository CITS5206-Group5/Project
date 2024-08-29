<?php
$access_token = '62SNXOmnXY1SBegC2JtYJjQgNNptBGy4';

$ch = curl_init("https://api.aweber.com/1.0/accounts");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token"
]);

$response = curl_exec($ch);
curl_close($ch);

$accounts = json_decode($response, true);
$account_id = $accounts['entries'][0]['id'];
echo "Account ID: " . $account_id;
//polis-finans.ru/wp-content/themes/inner-works-theme/mail/aweber-setup/getAccountId3.php
//2309
?>