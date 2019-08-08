<?php

//包含连接数据库的公共文件
require_once("../inc/conn.php");

//获取地址栏传递的ID
$userId = $_SESSION['user_id'];

//执行查询的SQL语句
$sql = "SELECT * FROM client WHERE client_id=$userId";
$result = mysqli_query($link, $sql);

//获取所有行数据
$arr = mysqli_fetch_assoc($result);

$client_name = $arr['client_name'];
$client_pwd = $arr['client_pwd'];
$client_phone = $arr['client_phone'];
$client_add = $arr['client_add'];

// 判断表单是否合法提交(防止攻击)
if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {
    //获取表单提交数据
    $client_name = $_POST['client_name'];
    $client_pwd = $_POST['client_pwd'];
    $client_phone = $_POST['client_phone'];
    $client_add = $_POST['client_add'];

    //构建插入的SQL语句
    $sql = "UPDATE client SET client_name='$client_name',client_pwd='$client_pwd',client_phone='$client_phone',client_add='$client_add' WHERE client_id=$userId";

    //判断SQL语句是否执行成功
    if (mysqli_query($link, $sql)) {
        echo "<script>alert('修改成功!')</script>";   //通过js弹出窗口
        header("refresh:0;url=me.php");
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
    <title>用户中心-嗖嗖送水</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="stylesheet" type="text/css" href="../css/me.css"/>
    <!-- InstanceEndEditable -->
</head>

<body>

<div class="header">

    <div class="login floatr">
        <?php
        if ($_SESSION['user_name'] == null) {
            echo "<a href=\"login.php\" class='wText-a'>登录 / </a> <a href=\"register.php\" class='wText-a'>注册</a> ";
        } else {
            echo "欢迎您：" . $_SESSION['user_name'] . "<a href=\"login-ecs.php\" class='wText-a'>(退出)</a>";
        }
        ?>
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

    <center>

        <p class='wText'>在这里可以编辑您的个人信息 o_O</p><br><br><br>

        <form method="post" action="">

            <table width="600" bordercolor="#FFF" border="1" rules="all" align="center" cellpadding="5">

                <tr>
                    <td width="120" align="right">用户名：</td>
                    <td><input type="text" name="client_name" value="<?php echo $client_name ?>"></td>
                    <td width="120" align="right">密码：</td>
                    <td><input type="password" name="client_pwd" value="<?php echo $client_pwd ?>"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td width="120" align="right">地址：</td>
                    <td><input type="text" name="client_add" value="<?php echo $client_add ?>"></td>
                    <td width="120" align="right">手机号：</td>
                    <td><input type="text" name="client_phone" value="<?php echo $client_phone ?>"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>
                        <br>
                        <input type="submit" class="wText" value=" 提 交 ">
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                    </td>
                    <td>&nbsp;</td>
                </tr>

            </table>

        </form>

        <br><br><br><br>

    </center>

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