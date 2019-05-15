<?php 

namespace App\Helpers;

class Base64{

    static function url_encode( $data ){
        return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
    }
    
    static function url_decode( $data ){
        return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
    }
    
}