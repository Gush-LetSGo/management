<?php
if ((($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
/*	    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	    echo "Type: " . $_FILES["file"]["type"] . "<br />";
	    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";*/


	    //防止文件名重复
	    $filename ="upload/".time().$_FILES["file"]["name"];
	    //转码，把utf-8转成gb2312,返回转换后的字符串， 或者在失败时返回 FALSE。
	    $filename =iconv("UTF-8","gb2312",$filename);
	     //检查文件或目录是否存在
	    if(file_exists($filename))
	    {
	        echo"该文件已存在";
	    }
	    else
	    {  
	        //保存文件,   move_uploaded_file 将上传的文件移动到新位置  
	        move_uploaded_file($_FILES["file"]["tmp_name"],$filename);//将临时地址移动到指定地址 
	        $res = array('url' => $filename);
	        $res = json_encode($res);
	        echo $res;
	    }



    }
  }else{
	echo "Invalid file";
  }
?>