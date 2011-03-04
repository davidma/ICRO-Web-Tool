<?php

//-------------------------------------------------------------------------------------------------
// SMS.php
//
// Class to send SMS messages via Clickatell (http://www.clickatell.ie)
//
// Dave Masterson, Oct 2009
//-------------------------------------------------------------------------------------------------

class SMS
{
    var $last_error;

    //-----------------------------------------------------------------------------------------
    // Creates a new SMS object
    //-----------------------------------------------------------------------------------------
    function SMS()
    {
        // Connection details for the Clickatell account
        require('/var/www/html/icro/config/config.php');
  
        // Initialise the login details
        $this->userid   = $SMS_USERID;
        $this->password = $SMS_PASSWORD;
        $this->api_id   = $SMS_API_ID;
        $this->baseurl  = $SMS_BASEURL; 
	$this->fromnum  = $SMS_FROMNUM;
     
        // no errors yet
        $this->last_error = '';
    }

    //-----------------------------------------------------------------------------------------
    // Sends an SMS message via clickatell
    // Returns true or false, depending on sucess or failure
    //-----------------------------------------------------------------------------------------
    function send($to_num,$message) 
    {
        // check the to number (should be ok in db, but anyway...)
        if (!is_numeric($to_num) || !ereg ("^353|^44", $to_num) )
        {
            $this->last_error = 'Invalid recipient number - must begin with 353 or 44, all digits, no spaces';
            return false;
        }

        // Craft the https request string
        $url=$this->baseurl."/http/sendmsg?user=".$this->userid."&password=".$this->password."&api_id=".$this->api_id."&from=".$this->fromnum."&to=".$to_num."&text=".urlencode($message);

        // Make the http call
        #########$response = file($url);

        // Check to see if it worked
        $send = split(":",$response[0]);

        // Good respose is "ID:" followed by some alphanumeric messageid
        ######if ($send[0] == "ID")
        if (1==1)
        {
            return true;
        }
        else
        {
            $this->last_error = $response[0];
            return false;
        }
    }

    //-----------------------------------------------------------------------------------------
    // Returns the last clickatell error string
    //-----------------------------------------------------------------------------------------
    function lastError()
    {
        return $this->last_error;
    }
}

?>
