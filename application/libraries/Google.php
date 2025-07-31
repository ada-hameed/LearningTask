<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load Composer autoload
require_once APPPATH . '../vendor/autoload.php';

// Load environment variables (using vlucas/phpdotenv)
use Dotenv\Dotenv;

class Google {

    public function getClient() {
        $dotenv = Dotenv::createImmutable(APPPATH . '../');
        $dotenv->safeLoad(); 
        $client = new Google_Client();

        $client->setClientId(getenv('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));

        $client->setRedirectUri(base_url('login/googleCallback'));

        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
        $client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

        return $client;
    }
}
