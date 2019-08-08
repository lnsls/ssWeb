<?php

//******************************上传图片*******************************

//(1)
//判断上传图片是否有错误发生
if ($_FILES['uploadFile']['error'] != 0) {
    echo "<h2>上传图片有错误发生！</h2>";
    header("refresh:3;url=../water-new.php");
    echo "3秒后自动返回,或者 <a href='../water-new.php'> 点击这里 </a> 立刻返回";
    die();
}

//(2)
//判断上传文件内容类型是不是图片
$arr1 = array("image/jpeg", "image/png", "image/gif");

//创建finfo的资源：获取文件内容类型，与扩展名无关
$finfo = finfo_open(FILEINFO_MIME_TYPE);

//获取文件内容的原始类型，不会随着扩展名改名而改变
$mime = finfo_file($finfo, $_FILES['uploadFile']['tmp_name']);

if (!in_array($mime, $arr1)) {
    echo "<h2>上传的必须是图像！</h2>";
    header("refresh:3;url=../water-new.php");
    echo "3秒后自动返回,或者 <a href='../water-new.php'> 点击这里 </a> 立刻返回";
    die();
}

//(3)
//判断上传的文件扩展名是不是图片
$arr2 = array("jpg", "gif", "png");

$ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION); //文件扩展名

if (!in_array($ext, $arr2)) {
    echo "<h2>上传的必须是图像！</h2>";
    header("refresh:3;url=../water-new.php");
    echo "3秒后自动返回,或者 <a href='../water-new.php'> 点击这里 </a> 立刻返回";
    die();
}

//(4)
//移动图片到 images目录中
$tmp_name = $_FILES['uploadFile']['tmp_name'];
$dst_name = "./images/water/" . uniqid() . "." . $ext;
move_uploaded_file($tmp_name, $dst_name);

echo $tmp_name;
echo "<br>";
echo $dst_name;

die();

////(5)
////将表单提交数据保存到数据库
//$sql = "INSERT INTO photos VALUES(null,'$title','$imgsrc','$intro',0,$addate)";
//if (mysqli_query($link, $sql)) {
//    echo "<h2>上传照片成功！</h2>";
//    header("refresh:3;url=./index.php");
//}
