<?php
if(isset($_GET['doc_id']))
{
  include 'classes/DBLink.php';
  include 'classes/Sentry.php';
  include 'classes/Logger.php';

  $theSentry = new Sentry();

  if ($theSentry->login())
  {
    $theDB = new DBLink();
    $theLogger = new Logger($theDB);

    $theLogger->log("Document (doc_id: ".$_GET['doc_id'].") requested");

    $query = "SELECT name, type, size, content FROM documents WHERE doc_id = '".$_GET['doc_id']."'";
    $res = $theDB->fetchQuery($query);

    if ($res)
    {
      $name    = $res[0]['name'];
      $size    = $res[0]['size'];
      $type    = $res[0]['type'];
      $content = $res[0]['content'];

      $theLogger->log("Document (doc_id: ".$_GET['doc_id'].", name: $name) sucessfully delivered");

      header("Content-length: $size");
      header("Content-type: $type");
      header("Content-Disposition: attachment; filename=$name");
      echo $content;

      exit;
    }
    else
    {
      $theLogger->log("Document retrieval failed - ".$theDB->lasterror());
      echo "Document retrieval failed - ".$theDB->lasterror()."<br/>";
    }
  }
  else
  {
     $_SESSION['login_retval'] = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ;
     header('location:login.php');
     exit;
  }
}
?>
