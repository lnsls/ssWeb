<?php

//包含连接数据库的公共代码
require_once("../inc/conn.php");
require_once("../inc/getVar.php");

//获取地址栏传递的ID
$waterid = $_GET['id'];
$num = $_GET['num'];
$userId = $_SESSION['user_id'];
$sumpay = getWaterSumPay($waterid, $num, $link);

//构建删除的SQL语句
$sql = "INSERT INTO car VALUES(null,$userId,$waterid,$num,$sumpay,'')";
//echo $sql;

//执行SQL语句
if (mysqli_query($link, $sql)) {

    echo "<h3>成功加入购物车!</h3>";

    //告诉浏览器执行代码：等待3秒，并跳转文件
    header("refresh:3;url=shopping.php");

    echo "3秒后自动返回,或者 <a href='shopping.php'> 点击这里 </a> 立刻返回";

}
