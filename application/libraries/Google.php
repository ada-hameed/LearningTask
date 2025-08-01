<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (file_exists(dirname(APPPATH) . '/vendor/autoload.php')) {
    require_once dirname(APPPATH) . '/vendor/autoload.php'; // Live
} else {
    require_once APPPATH . '../vendor/autoload.php'; // Local
}

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
