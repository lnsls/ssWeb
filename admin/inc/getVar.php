<?php
/**
 * Created by PhpStorm.
 * User: lns
 * Date: 2019/4/18
 * Time: 10:23
 */

//包含连接数据库的公共文件
require_once("conn.php");

//
//echo getWaterName(1, $link);
//

function getWaterName($id, $link)
{
    //执行查询的SQL语句
    $sql = "SELECT water_name FROM water WHERE water_id = $id";
    $result = mysqli_query($link, $sql);

    //获取所有行数据
    $arr = mysqli_fetch_assoc($result);

    return $arr['water_name'];
}

function getNameAdmin($id, $link)
{
    //执行查询的SQL语句
    $sql = "SELECT admin_name FROM admin WHERE admin_id = $id";
    $result = mysqli_query($link, $sql);

    //获取所有行数据
    $arr = mysqli_fetch_assoc($result);

    return $arr['admin_name'];
}

function getClientName($id, $link)
{
    //执行查询的SQL语句
    $sql = "SELECT client_name FROM client WHERE client_id = $id";
    $result = mysqli_query($link, $sql);

    //获取所有行数据
    $arr = mysqli_fetch_assoc($result);

    return $arr['client_name'];
}

function getStaffName($id, $link)
{
    //执行查询的SQL语句
    $sql = "SELECT staff_name FROM staff WHERE staff_id = $id";
    $result = mysqli_query($link, $sql);

    //获取所有行数据
    $arr = mysqli_fetch_assoc($result);

    return $arr['staff_name'];
}

function getSupplierName($id, $link)
{
    //执行查询的SQL语句
    $sql = "SELECT supplier_name FROM supplier WHERE supplier_id = $id";
    $result = mysqli_query($link, $sql);

    //获取所有行数据
    $arr = mysqli_fetch_assoc($result);

    return $arr['supplier_name'];
}

function getWaterPay($id, $link)
{
    //执行查询的SQL语句
    $sql = "SELECT water_pay2 FROM water WHERE water_id = $id";
    $result = mysqli_query($link, $sql);

    //获取所有行数据
    $arr = mysqli_fetch_assoc($result);

    return $arr['water_pay2'];
}

function getWaterSumPay($id, $num, $link)
{
    //执行查询的SQL语句
    $sql = "SELECT water_pay2 FROM water WHERE water_id = $id";
    $result = mysqli_query($link, $sql);

    //获取所有行数据
    $arr = mysqli_fetch_assoc($result);

    return $arr['water_pay2'] * $num;
}