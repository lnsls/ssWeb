<?php

// store session data
session_start();

echo "<h3>" . $_SESSION['user_name'] . "退出成功!</h3>";

//清空登录信息
$_SESSION['user_name'] = null;
$_SESSION['user_id'] = null;

//告诉浏览器执行代码：等待3秒，并跳转文件
header("refresh:3;url=login.php");

echo "3秒后跳转到登录界面,或者 <a href='login.php'> 点击这里 </a> 立刻跳转";