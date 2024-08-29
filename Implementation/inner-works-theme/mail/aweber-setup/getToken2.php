<?php
session_start();

$auth_code = 'vq9IwGUpIh0fbdBSSkXppzIDqReau50M'; // The authorization code you received
$code_verifier = $_SESSION['pkce_code_verifier'];

$client_id = 'qTj1H1MWVLylZgxww4usj8TxCe7PKwkw';
$redirect_uri = 'https://polis-finans.ru/';

$token_url = "https://auth.aweber.com/oauth2/token";

$data = [
    'grant_type' => 'authorization_code',
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'code' => $auth_code,
    'code_verifier' => $code_verifier
];

$ch = curl_init($token_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
$response = curl_exec($ch);
curl_close($ch);

$token_info = json_decode($response, true);
$access_token = $token_info['access_token'];
$refresh_token = $token_info['refresh_token'];

echo "Access Token: " . $access_token . "<br>";
echo "Refresh Token: " . $refresh_token . "<br>";

//polis-finans.ru/wp-content/themes/inner-works-theme/mail/aweber-setup/getToken2.php
//Access Token: 62SNXOmnXY
//Refresh Token: CeBgpLPg8XE
?>