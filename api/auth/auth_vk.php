<?php

class auth_vk extends api {
    
    
    private function make_url()
    {
        $url = 'https://oauth.vk.com/authorize';
        $redirect_uri = 'http://localhost/api/auth/auth_vk/auth';
        $params =
        [
            'client_id'     => '5121785',
            'redirect_uri'  => $redirect_uri,
            'response_type' => 'code',
            'scope' => 'notify,status' ,
        ];
        return $url.'?'. http_build_query($params);
    }
    
    protected function display_auth () {
        return
        [
            "data" => $this->make_url(),
            "design" => "auth/auth_vk",
        ];
    }
    protected function auth () {
        
    }
}