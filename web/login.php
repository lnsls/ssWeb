<?php

// store session data
session_start();

//使用独立的数据库连接

//(1)数据库配置信息
$db_host = "localhost";    //主机名  localhost:3306
$db_port = "8889";        //端口号
$db_user = "root";        //用户名
$db_pass = "root";        //密码
$db_name = "ss_db";    //数据库名
$charset = "utf8";        //字符集

//(2)PHP连接MySQL服务器
if (!$link = mysqli_connect($db_host . ":" . $db_port, $db_user, $db_pass)) {
    echo "<h2>PHP连接MySQL服务器失败！</h2>";
    echo "系统错误信息：" . mysqli_connect_error();
    die(); //中止程序向下运行
}

//(3)选择当前数据库
if (!mysqli_select_db($link, $db_name)) {
    echo "<h2>选择数据库{$db_name}失败！</h2>";
    die();
}

//(4)设置数据库返回数据字符集
mysqli_set_charset($link, $charset);

// 判断表单是否合法提交(防止攻击)
if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {
    //获取表单提交数据
    $loginName = $_POST['login_name'];
    $loginPwd = $_POST['login_pwd'];

    //登录验证的SQL语句
    $sql = "SELECT * FROM client WHERE client_name = '$loginName' && client_pwd = '$loginPwd'";
    $result = mysqli_query($link, $sql);

    //获取一行数据
    $arr = mysqli_fetch_assoc($result);

    //判断SQL语句是否执行成功
    if ($arr['client_id'] != null) {

        $_SESSION['user_name'] = $loginName;
        $_SESSION['user_id'] = $arr['client_id'];

        header("Location: index.php");

    } else {
        echo "<script>alert('登录失败,密码错误!')</script>";   //通过js弹出窗口

    }

}

//产生表单验证随机字符串
$_SESSION['token'] = uniqid();

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- InstanceBeginEditable name="head-edt" -->
    <title>首页-嗖嗖送水</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="stylesheet" type="text/css" href="../css/index.css"/>
    <!-- InstanceEndEditable -->
</head>

<body>

<div class="header">

    <div class="login floatr">
        欢迎登录嗖嗖送水!
    </div>

    <div class="mianboy">

			<span class="top-links floatr">
				<ul>
					<li>
						<a class="top-a1" href="index.php">首页</a>
					</li>
					<li>
						<a class="top-a2" href="shopping.php">商品选购</a>
					</li>
					<li>
						<a class="top-a3" href="car.php">购物车</a>
					</li>
                    <li>
						<a class="top-a40" href="ordering.php">配送中</a>
					</li>
					<li>
						<a class="top-a4" href="order.php">历史订单</a>
					</li>
					<li>
						<a class="top-a5" href="me.php">用户中心</a>
					</li>
					<li>
						<a class="top-a6" href="call.php">联系我们</a>
					</li>		
				</ul>
			</span>

        <div class="clear"></div>

    </div>

</div>

<div class="mianboy">

    <!-- InstanceBeginEditable name="mainBoy-edt" -->

    <img src="../images/kefu.jpg" class="img-kefu">

    <form method="post" action="" class="wInput floatr">

        <table width="230px" class="wText" bordercolor="#FFF" border="1" rules="all" align="center" cellpadding="5">

            <tr>
                <td width="80" align="right">用户名：</td>
                <td><input type="text" name="login_name"></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>

            <tr>
                <td align="right">密码：</td>
                <td><input type="password" name="login_pwd"></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" value=" 登 录 " class="wText">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>"></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>

        </table>

    </form>

    <!-- InstanceEndEditable -->

</div>

<div class="clear"></div>

<div class="footer">
    <div class="footer-links">
        <ul>
            <li>
                <a href="../admin/index.php" target="blank">转到商家</a>
            </li>
            <li>
                <a href="https://github.com/lnsaaa" target="blank">关于作者</a>
            </li>
            <li>
                <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=FCUkISAkJiQiISJUZWU6d3t5"
                   style="text-decoration:none;">联系作者</a>
            </li>
        </ul>
        <div class="clear"></div>
        Copyright &copy; 2010-2019 一 嗖嗖送水 All rights reserved.
    </div>
</div>

</body>
</html>