<?php    

 define('FPDF_FONTPATH','font/');
 require_once 'classes/fpdf.php';

 require_once("classes/Sentry.php");
 require_once("classes/DBLink.php");
 require_once("classes/Logger.php");

 $theSentry = new Sentry();
 $theDB = new DBLink();
 $theLogger = new Logger($theDB);

 if ($theSentry->login())
 {
     $theLogger->log("Callout list requested by user ".$_SESSION['username']);
     
     // Start the PDF file
     $p = new FPDF('P', 'mm', 'A4');
     $p->setTitle('ICRO Callout List');
     $p->setCreator('Auto-generated by ICRO Website');

     $p->open();
     $p->addPage();

     // Header Cell - Bold Font
     $p->SetFillColor(0,0,0);
     $p->SetTextColor(255);
     $p->setFont('arial', 'B' , 20);

     $date = date('d-m-Y');
     $p->cell(190,15,"ICRO Callout List - generated on $date",1,0,'C',true);
     $p->Ln();

     $p->Ln(6);
     
     // Normal Font
     $p->SetFillColor(255,255,255);
     $p->SetTextColor(0);
     $p->setFont('arial', '' , 10);

     $regions = $theDB->fetchQuery("select * from regions where region_id != 0");

     if (!$regions)
     {
         echo "Error - No regions found in DB";
         die();
     }

     for ($j=0; $j < count($regions); $j++)
     {
         if ($regions[$j]['region_id'] == 1) {  $p->SetFillColor(0,63,135); $p->SetTextColor(255); }
         if ($regions[$j]['region_id'] == 2) {  $p->SetFillColor(0,100,0);  $p->SetTextColor(255); }
         if ($regions[$j]['region_id'] == 3) {  $p->SetFillColor(139,90,0); $p->SetTextColor(255); }
         
         $p->setFont('arial', 'B' , 10);

         $p->cell(190,10,"Wardens - ".$regions[$j]['region'],1,0,'C',true);
         $p->Ln();

         $p->SetFillColor(255,255,255);
         $p->SetTextColor(0);

         $p->cell(45,5,"Name",1,0,'L');
         $p->cell(5,5,' ',1,0,'C');
         $p->cell(32,5,"Mobile",1,0,'C');
         $p->cell(32,5,"Home",1,0,'C');
         $p->cell(32,5,"Work",1,0,'C');
         $p->cell(32,5,"Other",1,0,'C');
         $p->cell(12,5,'    ',1,0,'C');
         $p->Ln();

         // Normal Font
         $p->setFont('arial', '' , 10);

         $result = $theDB->fetchQuery("select u.* from users u,counties c where u.county = c.name and c.region_id = ".$regions[$j]['region_id']." and u.user_id in (select user_id from user_roles where role_id = '2') order by last_name");

         if($result)
         {
             for ($i=0; $i < count($result); $i++)
             {
                 $p->cell(45,5,$result[$i]['last_name'].', '.$result[$i]['first_name'],1,0,'L');
                 $p->cell(5,5,' ',1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['mobile_phone'],1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['home_phone'],1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['work_phone'],1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['other_phone'],1,0,'C');
                 $p->cell(12,5,'    ',1,0,'C');
                 $p->Ln();
             }
         }
     }
 
     $p->Ln(6);

     for ($j=0; $j < count($regions); $j++)
     {
         if ($regions[$j]['region_id'] == 1) {  $p->SetFillColor(0,63,135); $p->SetTextColor(255); }
         if ($regions[$j]['region_id'] == 2) {  $p->SetFillColor(0,100,0);  $p->SetTextColor(255); }
         if ($regions[$j]['region_id'] == 3) {  $p->SetFillColor(139,90,0); $p->SetTextColor(255); }

         $p->setFont('arial', 'B' , 10);

         $p->cell(190,10,"Core Team - ".$regions[$j]['region'],1,0,'C',true);
         $p->Ln();

         $p->SetFillColor(255,255,255);
         $p->SetTextColor(0);

         $p->cell(45,5,"Name",1,0,'L');
         $p->cell(5,5,' ',1,0,'C');
         $p->cell(32,5,"Mobile",1,0,'C');
         $p->cell(32,5,"Home",1,0,'C');
         $p->cell(32,5,"Work",1,0,'C');
         $p->cell(32,5,"Other",1,0,'C');
         $p->cell(12,5,'    ',1,0,'C');
         $p->Ln();

         // Normal Font
         $p->setFont('arial', '' , 10);
         
         $result = $theDB->fetchQuery("select u.* from users u,counties c where u.county = c.name and c.region_id = ".$regions[$j]['region_id']." and u.user_id in (select user_id from user_roles where role_id = '3') and u.user_id not in (select user_id from user_roles where role_id = '2') order by last_name");

         if($result)
         {
             for ($i=0; $i < count($result); $i++)
             {
                 $p->cell(45,5,$result[$i]['last_name'].', '.$result[$i]['first_name'],1,0,'L');
                 $p->cell(5,5,' ',1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['mobile_phone'],1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['home_phone'],1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['work_phone'],1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['other_phone'],1,0,'C');
                 $p->cell(12,5,'    ',1,0,'C');
                 $p->Ln();
             }
         }
     }

     $p->Ln(6);

     for ($j=0; $j < count($regions); $j++)
     {
         if ($regions[$j]['region_id'] == 1) {  $p->SetFillColor(0,63,135); $p->SetTextColor(255); }
         if ($regions[$j]['region_id'] == 2) {  $p->SetFillColor(0,100,0);  $p->SetTextColor(255); }
         if ($regions[$j]['region_id'] == 3) {  $p->SetFillColor(139,90,0); $p->SetTextColor(255); }

         $p->setFont('arial', 'B' , 10);

         $p->cell(190,10,"General Members - ".$regions[$j]['region'],1,0,'C',true);
         $p->Ln();

         $p->SetFillColor(255,255,255);
         $p->SetTextColor(0);

         $p->cell(45,5,"Name",1,0,'L');
         $p->cell(5,5,' ',1,0,'C');
         $p->cell(32,5,"Mobile",1,0,'C');
         $p->cell(32,5,"Home",1,0,'C');
         $p->cell(32,5,"Work",1,0,'C');
         $p->cell(32,5,"Other",1,0,'C');
         $p->cell(12,5,'    ',1,0,'C');
         $p->Ln();

         // Normal Font
         $p->setFont('arial', '' , 10);

         $result = $theDB->fetchQuery("select u.* from users u,counties c where u.county = c.name and c.region_id = ".$regions[$j]['region_id']." and u.user_id in (select user_id from user_roles where role_id = '4') and u.user_id not in (select user_id from user_roles where role_id = '3' or role_id = '2') order by last_name");

         if($result)
         {
             for ($i=0; $i < count($result); $i++)
             {
                 $p->cell(45,5,$result[$i]['last_name'].', '.$result[$i]['first_name'],1,0,'L');
                 $p->cell(5,5,' ',1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['mobile_phone'],1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['home_phone'],1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['work_phone'],1,0,'C');
                 $p->cell(32,5,"+".$result[$i]['other_phone'],1,0,'C');
                 $p->cell(12,5,'    ',1,0,'C');
                 $p->Ln();
             }
         }
     }
 
     // This will only work if everything is ok to this point
     $p->output("ICRO-Callout-List-$date.pdf",'D');
     $p->close();
 }
 else
 {
     echo "You need to be <a href='login.php'>logged in to do this</a>";
 }

?>