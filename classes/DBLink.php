<?php

//-------------------------------------------------------------------------------------------------
// DBLink.php
//
// Utility class to connect to the DB and run queries, etc...
// Uses in-built php mysql classes
//
// Based on code by Peter Zeidman (http://www.intranetjournal.com/php-cms/)
//
// Dave Masterson, Sept 2009
//-------------------------------------------------------------------------------------------------

class DBLink
{
    var $db_object;    // The connection to the DB
    var $last_error;   // Store the last error, for logging/debugging

    //-----------------------------------------------------------------------------------------
    // Creates a new link to the DB
    // Returns true or false, depending on sucess or failure
    //-----------------------------------------------------------------------------------------
    function DBLink()
    {
        // Connection details for the DB
        require('/var/www/html/icro/config/config.php');
  
        // Initialise the error record
        $this->last_error = 'No Error';

        // Connect to DB  
        $this->db_object = mysql_connect($DB_HOST, $DB_USER, $DB_PASS);

        if (!$this->db_object)
        {
            // Connection Failure
            $this->last_error = mysql_error();
            die();
        }

        // select DB
        mysql_select_db($DB_NAME);

        // callback to destructor
        register_shutdown_function(array(&$this, 'close'));
    }

    //-----------------------------------------------------------------------------------------
    // Execute a database query, that expects no response (insert, update, replace, etc...)
    // Returns true or false, depending on sucess or failure
    //-----------------------------------------------------------------------------------------
    function doQuery($query) 
    {
        $this->theQuery = $query;
        $result = mysql_query($query, $this->db_object);
        
        if (!$result)
        {
            $this->last_error = mysql_error();
            return false;
        }
        else
        {
            return true;
        }
    }

    //-----------------------------------------------------------------------------------------
    // Execute a database query, return the result set as an array
    // Returns an Array or false, depending on success or failure
    //-----------------------------------------------------------------------------------------
    function fetchQuery($query) 
    {
        $result = mysql_query($query, $this->db_object);

        if (!$result)
        {
            $this->last_error = mysql_error();
            return false; // Bad Query
        }
        else
        {
            for ($i=0; $i < mysql_num_rows($result); $i++)
            {
                $res_array[$i] = mysql_fetch_array($result,MYSQL_BOTH);
            }

            // Return a matrix containing all the rows
            return $res_array;
        }
    }

    //-----------------------------------------------------------------------------------------
    // Close the connection 
    //-----------------------------------------------------------------------------------------
    function close() 
    {
        mysql_close($this->db_object);
    }

    //-----------------------------------------------------------------------------------------
    // Return the last error (debugging)
    //-----------------------------------------------------------------------------------------
    function lasterror()
    {
        return $this->last_error;
    }
}

?>
