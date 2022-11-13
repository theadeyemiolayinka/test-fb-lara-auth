<?php

return [
    
    /**
     * Session name to store authentication information.
     */
    'session_name' => env('FIREBASE_SESSION_NAME', 'fb_lara_by_sage_s'),

    /**
     * Cookie name to store persistent authentication information.
     */
    'cookie_name' => env('FIREBASE_COOKIE_NAME', 'fb_lara_by_sage_c'),
];

?>