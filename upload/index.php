<html><head><meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>PDPM picture update</title>

<link href="css/default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.lightbox-0.5.js"></script>
<script type="text/javascript" src="swfupload/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type="text/javascript">
var swfu;
function Init(){
    var settings = {
        flash_url : "swfupload/swfupload.swf",
    upload_url: "upload.php",	// Relative to the SWF file
    post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
				file_size_limit : "2048 MB",
				file_types : "*.*",//"*.jpg;*.gif;*.png",
				file_types_description : "Í¼Ïñ»òÕßflashÎÄ¼þ",
				file_upload_limit : 100,
				file_queue_limit : 100,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "images/btn1.gif",	//Relative to the Flash file
				button_width: "125",
				button_height: "25",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '',
				button_text_style: "",
				button_text_left_padding: 0,
				button_text_top_padding: 0,

				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};
			swfu = new SWFUpload(settings);
	     }
	     AddonloadEvent(Init);
	</script>
	<script type="text/javascript" src="js/pictip.js"></script>
</head>
<body>



<div id="content">
	<div id="cmain">
		<div id="uploadform">
			<form id="form1" action="#" method="post" enctype="multipart/form-data">
				<div class="button">
					<span id="spanButtonPlaceHolder"></span>
					<input id="btnUpload" type="button" value="" onclick="swfu.startUpload();" disabled="disabled" style="margin-left: 2px; width:121px; height: 25px; background:url(images/btn2.gif) no-repeat; border:0;" />
					<input id="btnCancel" type="button" value="" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; width:121px; height: 25px; background:url(images/btn3.gif) no-repeat; border:0;" />
					<span id="divStatus" class="status">0 个文件被上传 </span>
				</div>

				<div class="textads">
上传页面正在加载中如果未出现选择上传按扭请捎等片刻... 
</div>

				<div class="fieldset flash" id="fsUploadProgress">
					<span class="legend">上传队列</span>
				</div>

			</form>
		</div>

</div>
</div>

</body>
</html>
