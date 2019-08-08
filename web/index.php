<?php
// store session data
session_start();
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

    <p class="zhengwen" style="text-indent: 2em">嗖嗖送水, 甄选优质水源, 为您送货上门, 多名配送员实时待命, 节省您宝贵的时间, 及时解决您的燃眉之急.</p>

    <center>
        <audio controls="controls">
            <source src="../media/song.mp3" type="audio/ogg">
            <source src="../media/song.mp3" type="audio/mpeg">
            <embed height="100" width="100" src="../media/song.mp3"/>
        </audio>
    </center>

    <br><br>

    <img src="../images/1.jpg" width="900px">

    <br><br><br>

    <p class="zhengwen" style="text-indent: 2em">干净明亮的仓库, 给您安全的保障, 避免饮用水煤气共同存放, 杜绝有害物质污染, 保障您的安全.</p>

    <center><img src="../images/2.jpg" width="900px"></center>

    <br><br><br>

    <p class="zhengwen" style="text-indent: 2em">最新上市的天龙山矿泉水, 富含32种矿物质, 采用大明山优质水资源, 新上市仅10元一桶, 一次性购入10桶再送一桶.</p>

    <img src="../images/3.jpg" width="900px">

    <br><br><br><br>

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