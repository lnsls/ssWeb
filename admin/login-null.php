<?php

echo "<h3>未登录,请登录!</h3>";

//告诉浏览器执行代码：等待3秒，并跳转文件
header("refresh:3;url=login.php");

echo "3秒后跳转到登录界面,或者 <a href='login.php'> 点击这里 </a> 立刻跳转";

