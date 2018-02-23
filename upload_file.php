<?php

  $dir=date("Ymd");  //获取当前时间
  $URL="http://10.42.222.70/AEOverlay";
 
  if ($_FILES["file"]["error"] > 0)
  {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
  }
  else
  {
      echo "FileName: " . $_FILES["file"]["name"] . "\n";
      echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb\n";

      
        //创建目录
      if(!create_folders($dir))
      {
        HandleError("fai:文件夹创建失败");
        exit(0);
      }
        else
      {
         move_uploaded_file($_FILES["file"]["tmp_name"], $dir."/". $_FILES["file"]["name"]);
         echo "DownloadURL:\n" .$URL."/".$dir."/".$_FILES["file"]["name"];
      }
    }
  


//判断是否存在目录，不存在递归创建目录
function create_folders($dir){ 
       return is_dir($dir) or (create_folders(dirname($dir)) and mkdir($dir, 0777));
     }

?>