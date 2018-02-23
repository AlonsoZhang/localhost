<?php
echo "开始发送邮件\n";
require_once("./functions.php");
echo "123";
$flag = sendMail('Alonso_Zhang@wistron.com','Test','测试成功');
if($flag){
    echo "发送邮件成功！";
}else{
    echo "发送邮件失败！";
}
?>