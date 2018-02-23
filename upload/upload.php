
<?php
   if (isset($_POST["PHPSESSID"])) {
		session_id($_POST["PHPSESSID"]);
	} else if (isset($_GET["PHPSESSID"])) {
		session_id($_GET["PHPSESSID"]);
	}
	@session_start();
	
	//检验post的最大上传的大小
	$POST_MAX_SIZE = ini_get('post_max_size');
	$unit = strtoupper(substr($POST_MAX_SIZE, -1));
	$multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));

	if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
		header("HTTP/1.1 500 Internal Server Error"); // This will trigger an uploadError event in SWFUpload
		echo "fai:超过最大允许后的尺寸";
		exit(0);
	}
	// 设置
	$filenameset=false;    //此处设置保存文件的文件名，true为以月日和时间加随机数为文件名，其他为指定编号为文件名
	$upbool=1;         //设置是否开始上传功能。0为关闭上传，其他为正常上传
	$tipmsg="为节省空间暂时关闭演示程序上传功能，如有不周之处，还请原谅";  //设置关闭上传返回的信息
	$dir_file=date("Ymd");  //获取当前时间
	$qhjsw=date('YmdHis');
	$imgpath="./";  //图片保存的路径,其格式必须如此
	$rootfoldername="null";   //如果你把整个文件夹(upfile)放到你网站中的话就无需更改此配置，如果你把upfile文件夹下文件和文件夹放到网站中请填写为:null 。例如：$rootfoldername="null".如果你更改了整个文件夹(upfile)的名称，请改为你更改的名称。
	$save_path = getcwd() .'/'.$imgpath.$dir_file.'/';				// 保存的路径
	$upload_name = "Filedata";
	$max_file_size_in_bytes = 4147483647;				// 2GB in bytes 最大上传的文件大小为2G
	$extension_whitelist = array("jpg","jpeg","gif","png","bmp");	// 上传允许的文件扩展名称
	$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-'; //允许在文件名字符(在一个正则表达式格式)
   
   
	//其他的验证
	$MAX_FILENAME_LENGTH = 260;
	$file_name = "";
	$file_extension = "";
	$uploadErrors = array(
        0=>"没有错误,文件上传有成效",
        1=>"上传的文件的upload_max_filesize指令在你只有超过",
        2=>"上传的文件的超过MAX_FILE_SIZE指示那个没有被指定在HTML表单",
        3=>"未竟的上传的文件上传",
        4=>"没有文件被上传",
        6=>"错过一个临时文件夹"
	);
	///关闭上传功能
	if($upbool===0)
	{
		HandleError("fai:".$tipmsg);
		exit(0);
	}
	//验证上传
	if (!isset($_FILES[$upload_name])) {
		HandleError("fai:没有发现上传 \$_FILES for " . $upload_name);
		exit(0);
	} else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
		HandleError($uploadErrors[$_FILES[$upload_name]["error"]]);
		exit(0);
	} else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
		HandleError("fai:Upload failed is_uploaded_file test.");
		exit(0);
	} else if (!isset($_FILES[$upload_name]['name'])) {
		HandleError("fai:文件没有名字.");
		exit(0);
	}
	

	// 验证这个文件的大小(警告:最大的文件支持这个代码2 GB)
	$file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
	if (!$file_size || $file_size > $max_file_size_in_bytes) {
		HandleError("fai:超过最高允许的文件的大小");
		exit(0);
	}
	
	if ($file_size <= 0) {
		HandleError("fai:超出文件的最小大小");
		exit(0);
	}
	
	// 验证文件名称(对于我们而言我们只会删除无效字符)
	$file_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "", basename($_FILES[$upload_name]['name']));
	if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
		HandleError("fai:无效的文件");
		exit(0);
	}
	//创建目录
	if(!create_folders($save_path))
	{
		HandleError("fai:文件夹创建失败");
		exit(0);
		
	}
	//确认我们不会地盖写现有的一个文件
	if (file_exists($save_path . $file_name)) {
		HandleError("fai:这个名字的文件已经存在");
		exit(0);
	}
	
	//验证文件扩展名
	$path_info = pathinfo($_FILES[$upload_name]['name']);
	$file_extension = $path_info["extension"];
    $is_valid_extension = true;
	
	
	if (!$is_valid_extension) {
		HandleError("fai:无效的扩展名");
		exit(0);
	}
	
	if (file_exists($save_path . $file_name)) {
		HandleError("fai:这个文件的名称已经存在");
		exit(0);
	}
	 $resultstring="";
	if(is_dir($imgpath.$dir_file)){ 
		
        //$fileName=$filenameset?createdatefilename($file_extension):CreateNextName($file_extension,$save_path);
         $fileName=$_FILES[$upload_name]['name'];
      
        
        if(!move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path.$fileName)) {
			HandleError("fai:文件移动失败");
			exit(0);
	 	}
	 	else {
	 	     if($rootfoldername!=="null")
	         {
	         	$resultstring=$rootfoldername."/".$imgpath.$dir_file."/";
		       //HandleError("suc:".$rootfoldername."/".$imgpath.$dir_file."/,".$fileName.",".$file_size);
	         }
	       else
	          {
	          	$resultstring=$imgpath.$dir_file."/";
		       //HandleError("suc:".$imgpath.$dir_file."/,".$fileName.",".$file_size);
	          }
	 			//exit(0);
	 		}	
	}else{
		if(mkdir($imgpath.$dir_file)){
			
            //$fileName=$filenameset?createdatefilename($file_extension):CreateFirstName($file_extension);
            $fileName=$_FILES[$upload_name]['name'];

            
            
            
			if(!move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path.$fileName)) {
				HandleError("fai:文件移动失败");
				exit(0);
	 		}
	 		else {
	 		if($rootfoldername!=="null")
	         {
	         	$resultstring=$rootfoldername."/".$imgpath.$dir_file."/";
		       //HandleError("suc:".$rootfoldername."/".$imgpath.$dir_file."/,".$fileName.",".$file_size);
	         }
	       else
	          {
	          	$resultstring=$imgpath.$dir_file."/";
		       //HandleError("suc:".$imgpath.$dir_file."/,".$fileName.",".$file_size);
	          }
	 			//exit(0);
	 		}	
		}
		else {
			HandleError("fai:创建目录失败");
			exit(0);
		}
	}
	
	  
    HandleError("suc:".$resultstring.",".$fileName.",".$file_size);
	exit(0);
	


    
//错误
function HandleError($message) {
		echo trim($message);
	}
//参数是文件的扩展名称
function CreateFirstName($file_extension ){
	$num=date('mdHis').rand(1,100);
	$fileName=$num.".".$file_extension;
	return $fileName;
}

//参数是文件的扩展名称
function CreateNextName($file_extension,$file_dir){
	//在文件的目录下找最大的;
	$fileName_arr = scandir($file_dir,1);
	$fileName=$fileName_arr[0];
	//$aa=explode('.',$fileName);
	$aa=floatval($fileName);
	$num=0;
	$num=(1+$aa);
if(empty($aa))
{
	$num = date('mdHis').rand(1,100);
}
	return $num.".".$file_extension;
}
//返回以时间组合的文件名
function createdatefilename($file_extension)
{
	date_default_timezone_set('PRC');
	return date('mdHis').rand(1,100).".".$file_extension;
}
//判断是否存在目录，不存在递归创建目录
function create_folders($dir){ 
       return is_dir($dir) or (create_folders(dirname($dir)) and mkdir($dir, 0777));
     }
?>