<?php

// store session data
session_start();

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
    $client_name = $_POST['client_name'];
    $client_pwd = $_POST['client_pwd'];
    $client_time = date('Y-m-d H:i:s'); //获取系统时间
    $client_phone = $_POST['client_phone'];
    $client_add = $_POST['client_add'];

    $isOk = 0;

    if ($client_name == "" || $client_name == null) {
        echo "<script>alert('请输入用户名!')</script>";   //通过js弹出窗口

    } else if ($client_pwd == "" || $client_pwd == null) {
        echo "<script>alert('请输入密码!')</script>";   //通过js弹出窗口

    } else if ($client_add == "" || $client_add == null) {
        echo "<script>alert('请输入地址!')</script>";   //通过js弹出窗口

    } else if ($client_phone == "" || $client_phone == null) {
        echo "<script>alert('请输入手机号!')</script>";   //通过js弹出窗口

    } else if (is_numeric($client_name)) {
        echo "<script>alert('用户名不能全为数字!')</script>";   //通过js弹出窗口

    } else if (strlen($client_pwd) < 6 || strlen($client_pwd) > 18) {
        echo "<script>alert('密码长度在6-18之间!')</script>";   //通过js弹出窗口

    } else if (is_numeric($client_phone)) {
        echo "<script>alert('手机号必须是数字!')</script>";   //通过js弹出窗口

    } else if (strlen($client_phone) != 11) {
        echo "<script>alert('手机号是11位!')</script>";   //通过js弹出窗口

    } else if (strlen($client_phone) < 6) {
        echo "<script>alert('请填写详细地址!')</script>";   //通过js弹出窗口

    } else if (strlen($client_name) > 50) {
        echo "<script>alert('用户名也太长了吧!')</script>";   //通过js弹出窗口

    } else {
        $isOk = 1;
    }

    //执行查询的SQL语句
    $sqlNmd = "SELECT * FROM client WHERE client_name = '$client_name'";
    $result = mysqli_query($link, $sqlNmd);

    //获取所有行数据,0无重名但不符合条件,1重名符合条件
    if (mysqli_num_rows($result)) {
        echo "<script>alert('该名称已存在,请更换!')</script>";   //通过js弹出窗口

    } else {
        //构建插入的SQL语句
        $sql = "INSERT INTO client VALUES(null,'$client_name','$client_pwd','$client_time','$client_phone','$client_add','')";
        //echo $sql;

        //判断SQL语句是否执行成功
        if (mysqli_query($link, $sql) && $isOk) {
            echo "<script>alert('注册成功!')</script>";   //通过js弹出窗口
            header("refresh:0;url=login.php");
        } else {
            echo "<script>alert('输入有误,注册失败!')</script>";   //通过js弹出窗口
        }
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
        欢迎注册嗖嗖送水!
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
                <td><input type="text" name="client_name"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>

            <tr>
                <td align="right">密码：</td>
                <td><input type="password" name="client_pwd" placeholder="6-18位"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>

            <tr>
                <td width="50" align="right">手机号：</td>
                <td><input type="text" name="client_phone"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>

            <tr>
                <td width="50" align="right">地址：</td>
                <td><input type="text" name="client_add" placeholder="详细,用于配送"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>

            <tr>
                <td></td>
                <td><input type="submit" value=" 注 册 " class="wText">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>"></td>
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