<?php
if(isset($_GET['doc_id']))
{
  include 'classes/DBLink.php';

  $theDB = new DBLink();

  $query = "SELECT name, type, size, content FROM documents WHERE doc_id = '".$_GET['doc_id']."'";
  $res = $theDB->fetchQuery($query);

  if ($res)
  {
    $name    = $res[0]['name'];
    $size    = $res[0]['size'];
    $type    = $res[0]['type'];
    $content = $res[0]['content'];

    header("Content-length: $size");
    header("Content-type: $type");
    header("Content-Disposition: attachment; filename=$name");
    echo $content;

    exit;
  }
  else
  {
    echo "Document retieval failed - ".$theDB->lasterror()."<br/>";
  }
}
?>
