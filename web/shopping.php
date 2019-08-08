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

//获取总数量
$sql = "SELECT * FROM water WHERE water_num > 0 and water_note LIKE '%在售%'";

$sqlTop = "SELECT water_id, water_img, water_name, water_pay2, water_size, water_text, water_num, SUM(out_num) AS out_sum 
FROM top_water2_view 
WHERE water_num > 0 and water_note LIKE '%在售%'
GROUP BY water_id 
ORDER BY out_sum DESC 
LIMIT 0, 4 ";

$result = mysqli_query($link, $sql); //获取数据集
$resultTop = mysqli_query($link, $sqlTop); //获取数据集

//处理数据集,获取记录条数
$totalRecords = mysqli_num_rows($result);

//每页显示数量
$onePageNum = 12;

//计算总页数
$totalPages = ceil($totalRecords / $onePageNum);

//获取要查询的页
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

//根据获取的页面,计算开始的条数
$startFrom = ($page - 1) * $onePageNum;

//查询 从 $startFrom 开始,查询后面的 $onePageNum 条数据
$sql2 = "$sql LIMIT $startFrom, $onePageNum";
$result = mysqli_query($link, $sql2); //获取数据集

//处理数据集,获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);

//处理数据集,获取所有行数据
$arrsTop = mysqli_fetch_all($resultTop, MYSQLI_ASSOC);

?>

<!doctype html>
<html><!-- InstanceBegin template="/Templates/main.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
    <meta charset="UTF-8">
    <!-- InstanceBeginEditable name="head-edt" -->
    <title>商品选购-嗖嗖送水</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="stylesheet" type="text/css" href="../css/shopping.css"/>
    <!-- InstanceEndEditable -->
</head>

<script type="text/javascript">

    //定义一个JS的提示函数
    function shopGo(waterid) {

        var num = prompt("请输入数量", "1");

        if (num != null && num.valueOf() > 0) {
            //如果单击"确定"按钮，跳转到页面
            location.href = "shopping-go.php?id=" + waterid + "&num=" + num;
        } else {
            alert("取消购入");
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

        <p class="wText-h2">热销商品</p>

        <?php
        //循环二维数组,取出数据
        foreach ($arrsTop as $arr) { ?>

            <div class="water-box floatl">
                <?php
                $img = $arr['water_img'];
                if ($img != "" && $img != null) {
                    $img = "../admin/" . $img;
                    echo "<p><img src=\"../admin/$img \" width=\"205px\" height=\"136px\"></p>";
                } else {
                    echo "<p><img src=\"../images/a.jpg\" width=\"205px\" height=\"136px\"></p>";
                }
                ?>
                <p class="wText-big"><?php echo $arr['water_name'] ?></p>
                <p class="wText"><font color="#FF0000"> <?php echo $arr['water_pay2'] ?>元 </font>
                    &nbsp; <?php echo $arr['water_size'] ?>升</p>
                <p class="wText"><?php echo $arr['water_text'] ?></p>
                <p class="wText">
                    <a href="#" onClick="shopGo(<?php echo $arr['water_id'] ?>)">
                        <img src="../images/add-shop.png" width="80px" class="wImg">
                    </a>
                </p>
            </div>

        <?php } ?>

        <div class="clear"></div>
        <br><br><br>

        <p class="wText-h2">全部商品</p>

        <?php
        //循环二维数组,取出数据
        foreach ($arrs as $arr) { ?>

            <div class="water-box floatl">
                <?php
                $img = $arr['water_img'];
                if ($img != "" && $img != null) {
                    $img = "../admin/" . $img;
                    echo "<p><img src=\"../admin/$img \" width=\"205px\" height=\"136px\"></p>";
                } else {
                    echo "<p><img src=\"../images/a.jpg\" width=\"205px\" height=\"136px\"></p>";
                }
                ?>
                <p class="wText-big"><?php echo $arr['water_name'] ?></p>
                <p class="wText"><font color="#FF0000"> <?php echo $arr['water_pay2'] ?>元 </font>
                    &nbsp; <?php echo $arr['water_size'] ?>升</p>
                <p class="wText"><?php echo $arr['water_text'] ?></p>
                <p class="wText">
                    <a href="#" onClick="shopGo(<?php echo $arr['water_id'] ?>)">
                        <img src="../images/add-shop.png" width="80px" class="wImg">
                    </a>
                </p>
            </div>

        <?php } ?>

        <div class="clear"></div>

        <br>&nbsp;<br>&nbsp;

        <?php

        //第一页
        echo "<a class='wText' href='shopping.php?page=1'>" . '第一页' . "</a> ";

        //循环输出中间的页
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a class='wText' href='shopping.php?page=" . $i . "'> &nbsp;" . $i . "&nbsp; </a> ";
        };

        //最后一页
        echo "<a class='wText' href='shopping.php?page=$totalPages'>" . '最后一页' . "</a>";

        ?>

        <br>&nbsp;<br>&nbsp;

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