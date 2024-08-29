<?php
$access_token = '62SNXOmnXY1SBegC2JtYJjQgNNptBGy4';
$account_id = '2309605';

$ch = curl_init("https://api.aweber.com/1.0/accounts/$account_id/lists");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token"
]);

$response = curl_exec($ch);
curl_close($ch);

$lists = json_decode($response, true);
$list_id = $lists['entries'][0]['id'];
echo "List ID: " . $list_id;
//polis-finans.ru/wp-content/themes/inner-works-theme/mail/aweber-setup/getListId3.php
//6806
?>
