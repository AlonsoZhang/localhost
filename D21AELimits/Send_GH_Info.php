<?php
if (isset($_REQUEST["Data"]) )
{
   include_once "Classes/PHPMailer.class.php";

   $DataArry = json_decode($_REQUEST["Data"]);
   $subject  = 'The Overlay of these stations is not default';
   $MailFlag = 0;
   $Body     = '';
   $tbody    = '';
   $tfoot    = '';
   $tbodyC   = 1 ;
   $tfootC   = 1 ;

   $Body     .= '
    <html ><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css"> 
     body 
            { 
                text-align:center;
                margin:0px auto;
                padding:20px; 
                font:13px "Lucida Grande", "Lucida Sans Unicode", Helvetica, Arial, sans-serif;
            }
                
            p,table,tr, th 
            {
                margin:0;
                padding:0;
                font-weight:normal;
            }
      
            table 
            {
                margin:0px auto;
                border-collapse:collapse;
                margin-bottom:15px;
                width:90%;
            }
    table td, table th {padding:5px; border:1px solid #000;border-width:1px 1px 1px 1px;}
    thead th {background:#538DD5;color:#FFFFFF;font-weight:bold;}       
    </style>
    </head>
    <body>
     <P><font size="6" color="CadetBlue">'.$subject .'<br/></font><br/></P>
     <table >
      <thead>    
        <tr>
            <th scope="col">Project</th>
            <th scope="col">Station</th>
            <th scope="col">Line</th>
            <th scope="col">ID</th>
            <th scope="col">IP</th>
        </tr>        
    </thead>
   ';




for ($i=0; $i < count($DataArry) ; $i++) 
{ 
   $tbody.= '<tr>';
   $OneStation = explode(',',$DataArry[$i]);

   foreach ($OneStation as $value) 
   {
     $tbody.= '<td align ="center" >'.$value.'</td> ';   
   }
   $tbody.='</tr>';
}
$Body.='<tbody>'.$tbody.'</tbody><tfoot>'.$tfoot.'</tfoot></table></body></html>';


//echo $Body;


if(sendmail($subject,$Body,$_REQUEST["Mail"]))
{
  echo "Send Mail PASS!";
}else
{
  echo 'Send Mail FAIL!';
}


}
else
{
  echo "NO Data";
}






      
?>