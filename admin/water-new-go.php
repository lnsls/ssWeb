<?php

//包含连接数据库的公共文件
require_once("inc/conn.php");

// 判断表单是否合法提交(防止攻击)
if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {

    //******************************上传图片*******************************

    //判断是否选择了图片
    if (!empty($_FILES['uploadFile']['tmp_name'])) {

        //(1)
        //判断上传图片是否有错误发生
        if ($_FILES['uploadFile']['error'] != 0) {
            echo "<h2>上传图片有错误发生！</h2>";
            header("refresh:3;url=water-new.php");
            echo "3秒后自动返回,或者 <a href='water-new.php'> 点击这里 </a> 立刻返回";
            die();
        }

        //(2)
        //判断上传文件内容类型是不是图片
        $arr1 = array("image/jpeg", "image/jpg", "image/png", "image/gif");

        //创建finfo的资源：获取文件内容类型，与扩展名无关
        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        //获取文件内容的原始类型，不会随着扩展名改名而改变
        $mime = finfo_file($finfo, $_FILES['uploadFile']['tmp_name']);

        if (!in_array($mime, $arr1)) {
            echo "<h2>上传的必须是图像1！</h2>";
            header("refresh:3;url=water-new.php");
            echo "3秒后自动返回,或者 <a href='water-new.php'> 点击这里 </a> 立刻返回";
            die();
        }

        //(3)
        //判断上传的文件扩展名是不是图片
        $arr2 = array("jpg", "gif", "png", "jpeg");

        $ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION); //文件扩展名

        if (!in_array($ext, $arr2)) {
            echo "<h2>上传的必须是图像2！</h2>";
            header("refresh:3;url=water-new.php");
            echo "3秒后自动返回,或者 <a href='water-new.php'> 点击这里 </a> 立刻返回";
            die();
        }

        //(4)
        //移动图片到 images目录中
        $tmp_name = $_FILES['uploadFile']['tmp_name'];  //获得本地临时文件
        $dst_name = "images/a/" . uniqid() . "." . $ext;    //设置上传到服务器的路径
        move_uploaded_file($tmp_name, $dst_name);   //移动图片

        //(5)
        //将图片保存到数据库

    }

    //获取表单提交数据
    $water_name = $_POST['water_name'];
    $supplier_id = $_POST['supplier_id'];
    $water_text = $_POST['water_text'];
    $water_img = $dst_name; //数据库存储图片路径
    $water_size = $_POST['water_size'];
    $water_type = $_POST['water_type'];
    $water_pay = $_POST['water_pay'];
    $water_pay2 = $_POST['water_pay2'];
    $water_num = $_POST['water_num'];
    $water_note = $_POST['water_note'];

    //构建插入的SQL语句
    $sql = "INSERT INTO water VALUES(null,'$water_name',$supplier_id,'$water_text','$water_img',$water_size,'$water_type',$water_pay,$water_pay2,$water_num,'$water_note')";

    //判断SQL语句是否执行成功
    if (mysqli_query($link, $sql)) {
        echo "<h2>新品发布成功, 祝大卖!</h2>";
        header("refresh:3;url=water-new.php");
        echo "3秒后自动返回,或者 <a href='water-new.php'> 点击这里 </a> 立刻返回";
    } else {
        echo "<h2>输入有误,新增失败!</h2>";
        header("refresh:3;url=water-new.php");
        echo "3秒后自动返回,或者 <a href='water-new.php'> 点击这里 </a> 立刻返回";
    }

}
?>