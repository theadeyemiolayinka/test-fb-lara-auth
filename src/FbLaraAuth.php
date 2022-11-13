<?php

namespace TheAdeyemiOlayinka\FbLaraAuth;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Kreait\Laravel\Firebase\Facades\Firebase;

use Kreait\Firebase\Exception\Auth\FailedToVerifySessionCookie;
use TheAdeyemiOlayinka\FbLaraAuth\Exceptions\UIDCheckFailed;

use function TheAdeyemiOlayinka\FbLaraAuth\Helpers\redirect_now;

class FbLaraAuth{

    /**
     * The Kreatit\Laravel\Firebase\Authentication client instance.
     * 
     * @var Kreatit\Laravel\Firebase\Facades\Firebase
     */
    protected $auth;

    /**
     * The current user login status.
     * 
     * @var bool
     */
    protected $logged_in;

    /**
     * The current logged in user uid.
     * 
     * @var string
     */
    protected $uid;

    /**
     * The unverified session cookie string.
     * 
     * @var string
     */
    protected $sessionCookieString;


    /**
     * Cook Greatness!
     */
    public function __construct()
    {
       $this->auth = Firebase::auth();
       $this->logged_in = false;
       $this->uid = null;
       $this->sessionCookieString = null;
    }

    /**
     * Check Authentication status.
     * 
     * @return TheAdeyemiOlayinka\FbLaraAuth\FbLaraAuth;
     */
    public function auth_check(){

        $this->logged_in = false;
    
        if (Session::get(config('fb-lara-auth.session_name'), 0)) {
            // Check Session For SessionCookie
            $this->sessionCookieString = Session::get(config('fb-lara-auth.session_name'));
            
            try {
                $verifiedSessionCookie = $this->auth->verifySessionCookie($this->sessionCookieString);
                $this->logged_in = true;
            } catch (FailedToVerifySessionCookie $e) {
                $this->logged_in = false;
            } catch (\Throwable $th){
                $this->logged_in = false;
            }

        }  else if (Cookie::get(config('fb-lara-auth.cookie_name')) != null) {
            // Check Cookie For SessionCookie
            $this->sessionCookieString = Cookie::get(config('fb-lara-auth.cookie_name'));
    
            try {
                $verifiedSessionCookie = $this->auth->verifySessionCookie($this->sessionCookieString);
                $this->logged_in = true;
            } catch (FailedToVerifySessionCookie $e) {
                $this->logged_in = false;
            } catch (\Throwable $th){
                $this->logged_in = false;
            }

        }
        
        return $this;
    }

    /**
     * Check the UID of the logged in user.
     * 
     * @return TheAdeyemiOlayinka\FbLaraAuth\FbLaraAuth;
     */
    public function uid_check(){

        $this->auth_check();

        try {
            $verifiedSessionCookie = $this->auth->verifySessionCookie($this->sessionCookieString);
            $this->logged_in = true;
        } catch (FailedToVerifySessionCookie $e) {
            $this->logged_in = false;
        } catch (\Throwable $th){
            $this->logged_in = false;
        }
        
        if($this->logged_in){
            $this->uid = $verifiedSessionCookie->claims()->get('sub');
            return $this;
        }else{
            throw new UIDCheckFailed("The Session Cookie couldn't be verified.");
        }
        return $this;
    }




    //====================================================================\\//====================================================================\\
    //====================================================================\\//====================================================================\\
    /*                                                                 User Functions                                                             *\
    //====================================================================\\//====================================================================\\
    //====================================================================\\//====================================================================\\

    /**
     * Get the UID of the logged in user.
     * 
     * @return string
     */
    public function getUid(){

        $this->uid_check();

        return $this->uid;
    }

    /**
     * Get the authentication status.
     * 
     * @return bool
     */
    public function isAuthenticated(){

        $this->auth_check();

        return $this->logged_in;
    }
}
?>