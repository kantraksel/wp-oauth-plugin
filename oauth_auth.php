<?php
namespace OAuth2_Client;
require_once 'oauth_cfg.php';
require_once 'oauth_utils.php';

function OAuth_Begin() {

    if (isset($_GET['oauth']))
    {
        $authUrl = home_url();
        try
        {
            if((session_id() == '' || !isset($_SESSION)) && session_start()) 
            {
                $_SESSION['oauth_state'] = $state = base64_encode(session_id());
                $authUrl = Config::AuthorizationURL . '?response_type=code&client_id=' . Config::ClientID .
                    '&scope=' . Config::Scope . '&state=' . $state . '&redirect_uri=' . Config::RedirectURL;
            }
        }
        catch (Exception $e) {}

        wp_redirect($authUrl);
        exit;
    }
}

function OAuth_Finish() {

    if(isset($_GET['code']) && isset($_GET['state'])) {
        try
        {
            if((session_id() == '' || !isset($_SESSION)) && session_start()) {
                if (isset($_SESSION['oauth_state']) && hash_equals($_SESSION['oauth_state'], $_GET['state'])) {
                    $accessToken = GetAccessToken($_GET['code'], Config::AccessTokenURL, Config::ClientID, 
                        Config::ClientSecret, Config::RedirectURL);
    
                    if ($accessToken) {
                        $accountDetails = GetAccountDetails($accessToken, Config::AccountDetailsURL);
                        if ($accountDetails)
                        {
                            $user = get_user_by('email', $accountDetails[email]);
                            if ($user) {
                                wp_set_current_user($user->ID);
                                wp_set_auth_cookie($user->ID);
                                do_action('wp_login', $user->user_login, $user);
                            }
                        }
                    }
                }
            }
        }
        catch (Exception $e) {}
        
        wp_redirect(home_url());
        exit;
    }
}

?>
