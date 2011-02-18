<?php

//-------------------------------------------------------------------------------------------------
// Validator.php
//
// Utility class to validate inputs from users, etc...
//
// Based on code by Peter Zeidman (http://www.intranetjournal.com/php-cms/)
//
// Dave Masterson, Sept 2009
//-------------------------------------------------------------------------------------------------


class Validator 
{
    var $errors; // A variable to store a list of error messages

    // Validate something's been entered
    // NOTE: Only this method does nothing to prevent SQL injection
    // use with addslashes() command
    function validateGeneral($theinput,$description = '')
    {
        if (trim($theinput) != "") 
        {
            return true;
        }
        else
        {
            $this->errors[] = $description;
            return false;
        }
    }
    

    // Validate the input is text only - changed to deal with special characters (damn you database)
    function validateTextOnly($theinput,$description = '')
    {
        $result = ereg ("^[A-Za-z0-9\()' ]+$", $theinput );

        if ($result)
        {
            return true;
        }
        else
        {
            $this->errors[] = $description;
            return false; 
        }
    }

    // Validate the input is text only, no spaces allowed
    function validateTextOnlyNoSpaces($theinput,$description = '')
    {
        $result = ereg ("^[A-Za-z0-9]+$", $theinput );

        if ($result)
        {
            return true;
        }
        else
        {
            $this->errors[] = $description;
            return false; 
        }
    }

    // Validate email address
    function validateEmail($themail,$description = '')
    {
        $result = ereg ("^[^@ ]+@[^@ ]+\.[^@ \.]+$", $themail );

        if ($result)
        {
            return true;
        }
        else
        {
            $this->errors[] = $description;
            return false; 
        }
    }

    // Validate numbers only
    function validateNumber($theinput,$description = '')
    {
        if (is_numeric($theinput)) 
        {
            return true;
        }
        else
        { 
            $this->errors[] = $description; 
            return false;
        }
    }

    // Validate date
    function validateDate($thedate,$description = '')
    {
        if (strtotime($thedate) === -1 || $thedate == '') 
        {
            $this->errors[] = $description;
            return false;
        }
        else
        {
            return true;
        }
    }

    // Check whether any errors have been found (i.e. validation has returned false)
    // since the object was created
    function foundErrors() 
    {
        if (count($this->errors) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // Return a string containing a list of errors found,
    // Seperated by a given deliminator
    function listErrors($delim = ' ')
    {
        return implode($delim,$this->errors);
    }

    // Manually add something to the list of errors
    function addError($description)
    {
        $this->errors[] = $description;
    }    
}

?>
