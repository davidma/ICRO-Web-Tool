<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Upload Document</div>
<div class='newscontent'>

<?php
 if ($theSentry->login())
 {
     if ($theSentry->hasPermission(3))
     {
         if (isset($_POST['userfilename']) && $_FILES['userfile']['size'] > 0)
         {
             $title    = $_POST['userfilename'];
             $fileName = $_FILES['userfile']['name'];
             $tmpName  = $_FILES['userfile']['tmp_name'];
             $fileSize = $_FILES['userfile']['size'];
             $fileType = $_FILES['userfile']['type'];

             $fp      = fopen($tmpName, 'r');
             $content = fread($fp, filesize($tmpName));
             $content = addslashes($content);
             fclose($fp);

             if(!get_magic_quotes_gpc())
             {
                 $fileName = addslashes($fileName);
                 $title    = addslashes($title);
             }
 
             $query = "INSERT INTO documents (title, name, size, type, content ) VALUES ('$title', '$fileName', '$fileSize', '$fileType', '$content')";

             $res = $theDB->doQuery($query);
 
             if ($res)
             {
                 echo "File $fileName uploaded<br>";
             }
             else
             {
                 echo "File $fileName upload failed - ".$theDB->lasterror()."<br>"; 
             }
         }
         else
         {
             echo "<form action='upload_document.php' method='post' enctype='multipart/form-data'>";
             echo "<table align='center' border='1' cellspacing='0' cellpadding='3'>";
             echo "<tr><td>Title*:</td><td>";
             echo "<input name='userfilename' type='text' maxlength='50'><br/>";
             echo "</td></tr>";
             echo "<tr><td>File to Upload:</td><td>";
             echo "<input type='hidden' name='MAX_FILE_SIZE' value='2000000'>";
             echo "<input name='userfile' type='file' ><br/>";
             echo "</td></tr>";
             echo "<tr><td colspan='2' align='right'>";
             echo "<input type='submit' value='Upload File'>";
             echo '</td></tr>';
             echo '</table>';
             echo "</form>";
         }
     }
     else
     {
         echo "You don't have permission to do this";
     }
 }
 else
 {
     echo "You need to be logged in to do this - use the links above...";
 }
?>


</div>
</div>

<?php
 require("template/footer.html");
?>

