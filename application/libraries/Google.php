<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

<<<<<<< HEAD
require_once APPPATH . '../vendor/autoload.php';

class Google {

    public function getClient() {
        $client = new Google_Client();

        $client->setClientId('830539986231-m7aqpnk29b7mnahettmhjki12qdv5ags.apps.googleusercontent.com');
        $client->setClientSecret('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');

       $client->setRedirectUri(base_url('login/googleCallback'));

        $client->setAccessType('offline'); 
=======
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
>>>>>>> hameed
        $client->setPrompt('select_account consent');

        $client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
        $client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

        return $client;
    }
}
