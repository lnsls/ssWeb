<?php

//包含连接数据库的公共文件
require_once("../inc/conn.php");
require_once("../inc/getVar.php");

/*
//执行查询的SQL语句
$sql = "SELECT * FROM water";
$result = mysqli_query($link, $sql);

//获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);
 */

//获取该客户的购物车内容
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM car WHERE client_id = $userId LIMIT 0, 50"; //购物车最高50条数据
$sqlSum = "SELECT SUM(car_sum) AS sums FROM car WHERE client_id = $userId";

$result = mysqli_query($link, $sql); //获取数据集
$resultSum = mysqli_query($link, $sqlSum); //获取数据集

//处理数据集,获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);

//获取所有行数据
$arrSum = mysqli_fetch_assoc($resultSum);

//var_dump($arrSum);
//echo 1111111;
//echo $arrSum['sums'];

//echo $sql;a
//var_dump($arrs);

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- InstanceBeginEditable name="head-edt" -->
    <title>购物车-嗖嗖送水</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="stylesheet" type="text/css" href="../css/car.css"/>
    <!-- InstanceEndEditable -->
</head>

<script type="text/javascript">

    //定义一个JS的提示函数
    function carDelGo(id) {
        if (window.confirm("确定删除吗？")) {
            location.href = "car-del.php?id=" + id;
        }
    }

    //定义一个JS的提示函数
    function carShopGo() {
        if (window.confirm("确定结算吗？")) {
            location.href = "car-shop.php";
        }
    }

    //定义一个JS的提示函数
    function carNumGo(id) {

        var num = prompt("请输入新数量", "2");

        if (num != null  && num.valueOf() > 0) {
            //如果单击"确定"按钮，跳转到补货页面
            location.href = "car-num.php?id=" + id + "&num=" + num;
        } else {
            alert("取消修改");
        }
    }

</script>

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

        <?php
        //根据搜索结果显示数据
        if (count($arrs) < 1) {
            echo "<br><br><br> <p class='wText'><font color=red> 购物车 空空如也呢 >_< </font></p> <br><br><br>";
            require_once("../inc/footer.php");
            die();
        }else{
            echo "<p class='wText'>还等什么呢, 赶快结算下单吧 o_O</p><br><br><br>";
        }
        ?>

        <table width="900" class="dataintable" align="center" rules="all" cellpadding="5">

            <tr bgcolor='#dddddd' align="center">
                <th>购物车号</th>
                <th>商品名称</th>
                <th>单价</th>
                <th>数量</th>
                <th>金额</th>
                <th>操作</th>
            </tr>

            <?php

            //循环二维数组,取出数据
            foreach ($arrs as $arr) { ?>

                <tr align="center">

                    <td><?php echo $arr['car_id'] ?></td>
                    <td><?php echo getWaterName($arr['water_id'], $link) ?></td>
                    <td><?php echo getWaterPay($arr['water_id'], $link) ?></td>
                    <td><?php echo $arr['car_num'] ?><a href="#" onClick="carNumGo(<?php echo $arr['car_id'] ?>)"> 修改</a></td>
                    <td><?php echo $arr['car_sum'] ?></td>
                    <td><a href="#" onClick="carDelGo(<?php echo $arr['car_id'] ?>)">删除</a></td>

                </tr>

            <?php } ?>

        </table>

        <br><br>

        <p class="wText">
            总金额:
            <font color="#FF0000" size="4px"> <?php echo $arrSum['sums']; ?> 元 <font color="#FF0000">
        </p>
        <p>
            <a href="#" onClick="carShopGo()">
                <img src="../images/car-shop.png" width="80px" class="wImg"> </a>
        </p>

    </center>

    <br><br><br><br><br><br>

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