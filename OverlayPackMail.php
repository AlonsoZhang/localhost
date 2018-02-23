<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once("./functions.php");
if (isset($_REQUEST["Data"]) )
{
    echo $_REQUEST["Data"];
    $DataArry = json_decode($_REQUEST["Data"]);
    $subject  = 'Auto Packet AEOverlay';
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
        margin:0px auto;
        padding:20px; 
        font:13px "Lucida Grande", "Lucida Sans Unicode", Helvetica, Arial, sans-serif;
    }
    p,table,td, tr, th {margin:0;padding:0;font-weight:normal;}
    table {border-collapse:collapse;margin-bottom:15px;width:650;}    
    table td, table th {padding:5px; border:1px solid #000;border-width:1px 1px 1px 1px;}
    thead th {background:#538DD5;color:#FFFFFF;font-weight:bold;}       
    </style>
    </head>
    <body>
    <P><font size="4" color="#284B7B">AELimits Version:<br></font></P>
    <font size="3">'.$DataArry->AELimits.'</font><br/><br/>
    <P><font size="4" color="#284B7B">Download Address:<br></font></P>
    <font size="3">'.$DataArry->download.'</font><br/><br/>
    <P><font size="4" color="#284B7B">Release Note:<br></font></P>
    <table>
    <thead>    
    <tr>
    <th scope="col">Station</th>
    <th scope="col">Version</th>
    <th scope="col">Release Note</th>
    <th scope="col">Offline Validation</th>
    </tr>        
    </thead>
    ';
    $ReleaseArry =  $DataArry->release;
    for ($i=0; $i < count($ReleaseArry) ; $i++) 
    { 
     $tbody.= '<tr>
     <td align ="center" >'.$ReleaseArry[$i]->station.'</td>
     <td align ="center" >'.$ReleaseArry[$i]->version.'</td>
     <td align ="left">'.str_replace("\n","<br/>",$ReleaseArry[$i]->releasenote).'</td>
     <td align ="center" bgcolor="#91D050" ><font size="4" color="FF0000">[Uncheck]</font></td> 
     </tr>';
    }
    $Body.='<tbody>'.$tbody.'</tbody><tfoot>'.$tfoot.'</tfoot></table></body></html>';
    if(sendMail($DataArry->mail,$subject,$Body))
    {
        echo "Send Mail PASS!";
    }
    else
    {
        echo 'Send Mail FAIL!';
    }
}
else
{
  echo "NO Data";
}









?>