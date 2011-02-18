<?php

//-------------------------------------------------------------------------------------------------
// Sentry.php
//
// Utility class to do session management and control access to pages
//
// Based on code by Peter Zeidman (http://www.intranetjournal.com/php-cms/)
//
// Dave Masterson, Sept 2009
//-------------------------------------------------------------------------------------------------

class Sentry 
{
    var $userdata;            //  Array to contain user's data
    
    // Starts session, kills password caching
    function Sentry()
    {
        session_start();
        header("Cache-control: private"); 
		
		// Set a session variable to tell other pages if the site is connected to the net or not
		require('/var/www/html/icro/config/config.php');
		
		if ($OFFLINE_SITE)
		{
		    $_SESSION['offline'] = true;
		}
		else
		{
		    $_SESSION['offline'] = false;
		}
    }

    // Kills session data on logout
    function logout()
    {
        unset($this->userdata);
        session_destroy();
        return true;
    }

    // Checks if a user is logged in with good credentials or not
    // Also is used to login non-logged in users
    function login($user = '', $pass = '')
    {
        require_once('DBLink.php');
        require_once('Validator.php');

        $loginConnector = new DBLink();
        $validate = new Validator();
       
        // If user is already logged in then use those credentials instead
        if (isset($_SESSION['username']) && isset($_SESSION['password']))
        {
            $user = $_SESSION['username'];
            $pass = $_SESSION['password'];
        }

        // Validate input
        if (!$validate->validateTextOnly($user)){return false;}
        if (!$validate->validateTextOnly($pass)){return false;}

        $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass' AND active = 1";

        $this->userdata = $loginConnector->fetchQuery($sql);

        if (!$this->userdata)
        {
            // Existing user not ok, logout
            $this->logout();

            return false;
        }
        else
        {
            $date = date("Y-m-d H:i:s");

            $loginConnector->doQuery("UPDATE users SET last_login = '$date' WHERE username = '$user'");

            $_SESSION["username"]  = $this->userdata[0]['username'];
            $_SESSION["password"]  = $this->userdata[0]['password'];
            $_SESSION["user_id"]   = $this->userdata[0]['user_id'];
            $_SESSION["lat"]       = $this->userdata[0]['lat'];
            $_SESSION["lng"]       = $this->userdata[0]['lng'];
            
            return true;
        }
    }

    // checks if the logged in user has permissions for a given role_id (from ROLES table in DB)
    function hasPermission($role_id = 0)
    {
        $db = new DBLink();

        // Check for admin rights - they always work...
        $sql = "select * from user_roles where role_id=1 and user_id = '".$_SESSION['user_id']."';";
        $result = $db->fetchQuery($sql);

        if (!$result)
        {
            $sql = "select * from user_roles where role_id=$role_id and user_id = '".$_SESSION['user_id']."';";
            $result = $db->fetchQuery($sql);
    
            if (!$result)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return true;
        }
    }   
}    

?>
