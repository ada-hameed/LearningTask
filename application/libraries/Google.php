<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';

class Google {

    public function getClient() {
        $client = new Google_Client();

        $client->setClientId('830539986231-m7aqpnk29b7mnahettmhjki12qdv5ags.apps.googleusercontent.com');
        $client->setClientSecret('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');

       $client->setRedirectUri(base_url('login/googleCallback'));

        $client->setAccessType('offline'); 
        $client->setPrompt('select_account consent');

        $client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
        $client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

        return $client;
    }
}
