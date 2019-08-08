<?php

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

// store session data
session_start();

// 判断表单是否合法提交(防止攻击)
if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {
    //获取表单提交数据
    $login_name = $_POST['login_name'];
    $login_pwd = $_POST['login_pwd'];

    //登录验证的SQL语句
    $sql = "SELECT * FROM admin WHERE admin_name = '$login_name' && admin_pwd = '$login_pwd'";
    $result = mysqli_query($link, $sql);
    $login_ok = mysqli_num_rows($result);

    //判断SQL语句是否执行成功
    if ($login_ok >= 1) {

        $_SESSION['admin_name'] = $login_name;
        header("Location: index.php");

    } else {
        echo "<script>alert('登录失败,密码错误!')</script>";   //通过js弹出窗口

    }

}

//产生表单验证随机字符串
$_SESSION['token'] = uniqid();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>嗖嗖送水</title>
</head>

<link rel="stylesheet" href="css/staticfile-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/login.css"/>

<script src="js/staticfile-jquery.js"></script>
<script src="js/staticfile-bootstrap.js"></script>

<body>

<!--头部框架开始-->
<div class="top">

    <a href="index.php" class="top-left"> </a>
    <div class="top-right"> 欢迎登录 嗖嗖送水 商家端</div>

</div>
<!--头部框架结束-->

<div class="con">

    <div class="right-body">

        <div>
            <img src="images/logo2.jpg" alt="" width="370" height="129" class="baiduimage"/>
        </div>

        <form method="post" action="">

            <table width="600" bordercolor="#FFF" border="1" rules="all" align="center" cellpadding="5">

                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td width="120" align="right">账名：</td>
                    <td><input type="text" name="login_name"></td>
                    <td width="120" align="right">密码：</td>
                    <td><input type="password" name="login_pwd"></td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
                        <br>&nbsp;&nbsp;
                        <input type="submit" value=" 登 录 ">
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                    </td>
                    <td>&nbsp;</td>
                </tr>

            </table>

        </form>

    </div>


</div>

</body>

</html>

