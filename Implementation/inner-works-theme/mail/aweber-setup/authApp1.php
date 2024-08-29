<?php
function generate_code_verifier($length = 128) {
    return bin2hex(random_bytes($length / 2));
}

function generate_code_challenge($code_verifier) {
    return rtrim(strtr(base64_encode(hash('sha256', $code_verifier, true)), '+/', '-_'), '=');
}

$code_verifier = generate_code_verifier();
$code_challenge = generate_code_challenge($code_verifier);

session_start();
$_SESSION['pkce_code_verifier'] = $code_verifier;

$client_id = 'qTj1H1MWVLylZgxww4usj8TxCe7PKwkw';
$redirect_uri = 'https://polis-finans.ru/';
$scope = 'account.read list.read list.write subscriber.read subscriber.write';

$auth_url = "https://auth.aweber.com/oauth2/authorize?client_id=$client_id&response_type=code&redirect_uri=" . urlencode($redirect_uri) . "&scope=" . urlencode($scope) . "&code_challenge=" . $code_challenge . "&code_challenge_method=S256";

header("Location: $auth_url");
exit;

//polis-finans.ru/wp-content/themes/inner-works-theme/mail/aweber-setup/authApp1.php
?>
