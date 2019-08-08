<?php
/**
 * Created by PhpStorm.
 * User: lns
 * Date: 2019/4/19
 * Time: 01:38
 */

//包含连接数据库的公共代码
require_once("../inc/conn.php");
require_once("../inc/getVar.php");

//获取该客户的购物车内容
$userId = $_SESSION['user_id'];
$time = date('Y-m-d H:i:s');    //获取当前时间

//获取该客户的购物车内容
$sql = "SELECT * FROM car WHERE client_id = $userId LIMIT 0, 50"; //购物车最高50条数据

//获取该客户的下单信息,电话,地址
$sql2 = "SELECT * FROM client WHERE client_id = $userId";

//echo $sql2;

$result = mysqli_query($link, $sql); //获取数据集
$result2 = mysqli_query($link, $sql2); //获取数据集

//处理数据集,获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);
$arr2 = mysqli_fetch_assoc($result2);

//var_dump($arr2);

$userPhone = $arr2['client_phone'];
$userAdd = $arr2['client_add'];

//echo getWaterNum(1, $link);

//循环二维数组,检查库存
foreach ($arrs as $arr) {

    $water = $arr['water_id'];
    $num = $arr['car_num'];
    $numNow = getWaterNum($water, $link);

    if ($num > $numNow) {
        echo "<h3>" . getWaterName($arr['water_id'], $link) . " 库存不足, 当前库存: " . $numNow . ", 请修改后再下单</h3>";

        //告诉浏览器执行代码：等待3秒，并跳转文件
        header("refresh:5;url=car.php");
        echo "3秒后自动返回,或者 <a href='car.php'> 点击这里 </a> 立刻返回";
        die();
    }
}

//循环二维数组,下单
foreach ($arrs as $arr) {

    $water = $arr['water_id'];
    $num = $arr['car_num'];
    $sum = $arr['car_sum'];

    //下单SQL语句
    $sqlAddOut = "INSERT INTO out_ VALUES(null,$userId,'$userPhone','$userAdd',0,$water,'$time',$num,$sum,0,1,'')";
    //echo $sqlAddOut;

    if (!mysqli_query($link, $sqlAddOut)) {
        echo "出现了错误,请稍后再试..";
        die();
    }

    //库存调整SQL语句
    $sqlNumEdit = "UPDATE water SET water_num = water_num-$num WHERE water_id = $water";
    mysqli_query($link, $sqlNumEdit);

}

//获取该客户的购物车内容
$sqlDel = "DELETE FROM car WHERE client_id = $userId";

if (!mysqli_query($link, $sqlDel)) {
    echo "下单成功,购物车未清空,请勿重复下单..";
    die();
}

echo "<h3> 下单成功! 嗖嗖即将为您送货..</h3>";

//告诉浏览器执行代码：等待3秒，并跳转文件
header("refresh:3;url=car.php");

echo "3秒后自动返回,或者 <a href='car.php'> 点击这里 </a> 立刻返回";


////执行SQL语句
//if (mysqli_query($link, $sql)) {
//    echo "<h3> 删除 $id 操作成功!</h3>";
//
//    //告诉浏览器执行代码：等待3秒，并跳转文件
//    header("refresh:3;url=car.php");
//
//    echo "3秒后自动返回,或者 <a href='car.php'> 点击这里 </a> 立刻返回";
//
//}









