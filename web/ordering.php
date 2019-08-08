<?php

//包含连接数据库的公共文件
require_once("../inc/conn.php");
require_once("../inc/getVar.php");
require_once("../inc/preferences.php");

/*
//执行查询的SQL语句
$sql = "SELECT * FROM water";
$result = mysqli_query($link, $sql);

//获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);
 */

//获取该客户的订单
$userId = $_SESSION['user_id'];

//获取总数量
$sql = "SELECT * FROM out_ WHERE client_id=$userId AND out_ok='0' AND out_good='1'";
$result = mysqli_query($link, $sql); //获取数据集

//处理数据集,获取记录条数
$totalRecords = mysqli_num_rows($result);

//计算总页数
$totalPages = ceil($totalRecords / $onePageNum);

//获取要查询的页
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};

//根据获取的页面,计算开始的条数
$startFrom = ($page - 1) * $onePageNum;

//查询 从 $startFrom 开始,查询后面的 $onePageNum 条数据
$sql2 = "$sql LIMIT $startFrom, $onePageNum ";
$result = mysqli_query($link, $sql2); //获取数据集

//处理数据集,获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);

//var_dump($arrs);

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- InstanceBeginEditable name="head-edt" -->
    <title>订单-嗖嗖送水</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="stylesheet" type="text/css" href="../css/ordering.css"/>
    <!-- InstanceEndEditable -->
</head>

<script type="text/javascript">

    //定义一个JS的提示函数
    function oderCloseGO(id, num, water) {

        if (window.confirm("确定取消订单？")) {

            //如果单击"确定"按钮，跳转到上架页面
            location.href = "ordering-close.php?id=" + id + "&num=" + num + "&water=" + water;
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
        if ($totalRecords == 0) {
            echo "<br><br><br> <p class='wText'><font color=red> 没有配送中的订单耶 >_< </font></p> <br><br><br>";
            require_once("../inc/footer.php");
            die();
        } else {
            echo "<p class='wText'>订单很快就送达了呢 o_O </p><br><br><br>";
        }
        ?>

        <table width="900" class="dataintable" border="1" align="center" rules="all" cellpadding="5">

            <tr bgcolor='#dddddd' align="center">
                <th>订单号</th>
                <th>配送员</th>
                <th>商品</th>
                <th>下单时间</th>
                <th>数量</th>
                <th>金额</th>
                <th>下单电话</th>
                <th>下单地址</th>
                <th>状态</th>
                <th>操作</th>
            </tr>

            <?php
            //循环二维数组,取出数据
            foreach ($arrs

                     as $arr) { ?>

                <tr align="center">

                    <td><?php echo $arr['out_id'] ?></td>
                    <td>
                        <?php
                        if (trim($arr['staff_id']) == 0) {
                            echo "——";
                        } else {
                            echo getStaffName($arr['staff_id'], $link); ?>
                        <?php } ?>
                    </td>
                    <td><?php echo getWaterName($arr['water_id'], $link) ?></td>
                    <td><?php echo $arr['out_time'] ?></td>
                    <td><?php echo $arr['out_num'] ?></td>
                    <td><?php echo $arr['out_sum'] ?></td>
                    <td><?php echo $arr['client_phone'] ?></td>
                    <td><?php echo $arr['client_add'] ?></td>
                    <td>
                        <?php
                        if (trim($arr['staff_id']) == 0) {
                            echo "等待配送";

                        } else {
                            if (trim($arr['out_ok']) == 1) {
                                echo "配送成功";

                            } else if (trim($arr['out_ok']) == 2) {
                                echo "结算完成";

                            } else {
                                echo "正在配送";
                            }
                        }
                        if (trim($arr['out_good']) == 0) {
                            echo "(关闭)";
                        } ?>
                    </td>
                    <td>
                        <?php
                        if (trim($arr['staff_id']) == 0) {
                            echo "<a href=\"#\" onClick=\"oderCloseGO(" . $arr['out_id'] . "," . $arr['out_num'] . "," . $arr['water_id'] . ")\">退单</a>";
                        } else {
                            echo "——";
                        }
                        ?>
                    </td>

                </tr>

            <?php } ?>

        </table>

        <br><br>

        <?php

        //第一页
        echo "<ul><a href='ordering.php?page=1'>" . '第一页' . "</a> ";

        //循环输出中间的页
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='ordering.php?page=" . $i . "'> &nbsp;" . $i . "&nbsp; </a> ";
        };

        //最后一页
        echo "<a href='ordering.php?page=$totalPages'>" . '最后一页' . "</a> </ul> ";

        ?>

        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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