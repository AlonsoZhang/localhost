<?php
header('Content-type:text/json');

$List         = array();
$List['list'] =read_all_dir("file");
echo urldecode(json_encode($List));

function read_all_dir ( $dir )
{
  $result = array();
  $handle = opendir($dir);
  if ( $handle )
  {
    while ( ( $file = readdir ( $handle ) ) !== false )
    {
     if ( checkstr($file,"AE Limits"))
       {
         array_push($result,$file);
       }
    }
      closedir($handle);
    }
    return $result; 
}

function checkstr($str,$needle)
{
  $tmparray = explode($needle,$str);   
  if(count($tmparray)>1)
    return true;   
  else
    return false;     
} 
?>
