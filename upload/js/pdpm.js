var flag =1;var image="";var out="<table align='middle'  width=320 border='0'><TR>";

function $(id){return document.getElementById(id);}
function dowhat(url) {location.href="?dowhat="+url;}
function Picturesupload(){window.open("imageupload.php","subWindow","top=100,left=300,width=600,height=480,resizable resizable=no");}
function searchinfo(id){window.open("search.php?ID="+id,'_blank',"top=100,left=300,width=530,height=600");}
function seldownpage(page){ dowhat("downloadinfo&page="+page);}
function selpage(page)    { dowhat("searchownpdpm&page="+page);}
function runsearch()
{
    if ($('search').value.length !="0") 
    {
        searchinfo($('search').value);
        $('search').value="";
    }
}

function updateinfo(picture)
{
    for(i=0;i<picture.length;i++)
    {
        if(flag !=1) {image+=",";}
        image+=picture[i];
        out+="<TD align='middle' width=80><img src=\"\showimages.php?name="+picture[i]+"\"width=60 height=60 /></TD>";
        if((flag++)%4 == 0) out+="</TR><TR>";
    }
    $("pictureinfo").innerHTML=out+"</TR></table>";
    $("images").value=image;
}

function checknewpdpm()
{
    var RecordIDflag = 0;
    var checkRecordID=document.getElementsByName("user[]");
    for(i=0;i<checkRecordID.length;i++){if (checkRecordID[i].checked == true ) { RecordIDflag=1; break;}}
    if ($('title').value.length =="0")  alert("檔案標題不能為空！");
    else if (RecordIDflag =="0")             alert("至少勾選一個需求部門！");
    else if ($('images').value.length =="0") alert("圖像資料不能為空！");
    else if ($('Detail').value.length =="0") alert("詳細說明不能為空！");
    else    {$('newdowhat').value ="newpdpmdo";$('newpdpm').submit();}
}


function checkpsw()
{
    if( $('newonepsw').value != $('newtwopsw').value) $('checkpsw').innerHTML= "<font  color=\"#CE0000\" size=\"3\">*兩次密碼不一致</font>";
    else $('checkpsw').innerHTML= "<font  color=\"#00A600\" size=\"3\">* ok *</font>";
}


function checkpswsubmit()
{
    if ($('oldpsw').value.length =="0")               alert("原始密碼不能為空！");
    else if ($('newonepsw').value.length =="0")            alert("新的密碼不能為空！");
    else if ($('newtwopsw').value.length =="0")            alert("確認密碼不能為空！");
    else if ($('newonepsw').value != $('newtwopsw').value) alert("兩次密碼不一致！");
    else    {$('changepsw').submit();}
}

function checkresetpswsubmit()
{
    if ($('resetname').value.length =="0")               alert("需求部門不能為空！");
    else    {$('resetpsw').submit();}
}