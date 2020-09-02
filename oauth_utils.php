<?php
namespace OAuth2_Client;

function GetAccessToken($code, $accessTokenURL, $clientID, $clientSecret, $redirectURL) {
    
    $response = wp_remote_post($accessTokenURL, array(
        'timeout' => 60,
        'headers' => array(),
        'cookies' => array(),
        'body' => array(
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => $clientID,
            'client_secret' => $clientSecret,
            'redirect_uri' => $redirectURL
        )
    ));

    if (is_array($response))
    {
        $response = json_decode($response['body'], true);
        if (is_array($response)) return $response['access_token'];
    }
    return false;
}

function GetAccountDetails($accessToken, $accountDetailsURL) {
    
    $response = wp_remote_get($accountDetailsURL, array(
        'timeout' => 60,
        'headers' => array(
            'Authorization' => 'Bearer ' . $accessToken
        ),
        'cookies' => array(),
        'body' => array()
    ));

    if (is_array($response))
    {
        $response = json_decode($response['body'], true);
        if (is_array($response) && !isset($response['error'])) return $response;
    }
    return false;
}

?>
