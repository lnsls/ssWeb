<?php

//包含连接数据库的公共文件
require_once("inc/conn.php");

$time = date('Y-m-d');

//(1)
//仪表盘数据-今日销量
//执行查询的SQL语句
$sql = "SELECT SUM(out_num) AS water_sum FROM top_water_view WHERE out_time LIKE '$time %'";
$result = mysqli_query($link, $sql);

//获取一行数据
$arr = mysqli_fetch_row($result);

$waterNum = $arr[0];

//(2)
//仪表盘数据-最热商品
//执行查询的SQL语句
$sql = "SELECT water_name, SUM(out_num) AS water_sum
FROM top_water_view
WHERE out_time LIKE '$time %'
GROUP BY water_id
ORDER BY water_sum DESC
LIMIT 0,1";
$result = mysqli_query($link, $sql);

//获取一行数据
$arr = mysqli_fetch_row($result);

$waterTop = $arr[0];

//(3)
//仪表盘数据-最佳员工
//执行查询的SQL语句
$sql = "SELECT staff_name, SUM(out_num) AS staff_sum
FROM top_staff_view
WHERE out_time LIKE '$time %'
GROUP BY staff_id
ORDER BY staff_sum DESC
LIMIT 0,1";
$result = mysqli_query($link, $sql);

//获取一行数据
$arr = mysqli_fetch_row($result);

$clientTop = $arr[0];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" http-equiv="refresh" content="6">
    <title>嗖嗖送水</title>
</head>

<link rel="stylesheet" href="css/staticfile-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/index.css"/>
<link rel="stylesheet" type="text/css" href="css/index2.css"/>

<script src="js/staticfile-jquery.js"></script>
<script src="js/staticfile-bootstrap.js"></script>

<body>

<!--头部框架开始-->
<div class="top">

    <a href="index.php" class="top-left"> </a>

    <a href="index.php" class="top-left"> </a>

    <div class="top-right">
        当前登录:<?php echo $_SESSION['admin_name'] ?>
        <a href="login-esc.php" style="color: #ffffff">(退出)</a>
    </div>

</div>
<!--头部框架结束-->

<div class="con">

    <!--左边<框架开始-->
    <div class="left">

        <div class="panel-group" id="accordion">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-1">
                            商品管理
                        </a>
                    </h4>
                </div>
                <div id="collapse-1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <P><a href="water-so.php">查找商品</a></P>
                        <p><a href="water-all.php">全部商品</a></p>
                        <p><a href="water-in.php">补货</a></p>
                        <p><a href="water-down.php">下架</a></p>
                        <p><a href="water-on.php">上架</a></p>
                        <p><a href="water-new.php">发布新品</a></p>
                        <p><a href="water-edit.php">修改商品</a></p>
                        <P><a href="water-auto.php">库存助理</a></P>
                        <P><a href="water-autoPuss.php">自动诊断</a></P>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-2">
                            订单管理
                        </a>
                    </h4>
                </div>
                <div id="collapse-2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p><a href="out-loading.php">等待配送</a></p>
                        <p><a href="out-ing.php">正在配送</a></p>
                        <p><a href="out-ok.php">送达订单</a></p>
                        <p><a href="out-close.php">失效订单</a></p>
                        <p><a href="out-good.php">有效订单</a></p>
                        <P><a href="out-so.php">查找订单</a></P>
                        <p><a href="out-all.php">全部订单</a></p>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-3">
                            销售统计
                        </a>
                    </h4>
                </div>
                <div id="collapse-3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p><a href="top-staff.php">配送员业绩</a></p>
                        <p><a href="top-water.php">产品销售榜</a></p>
                        <P><a href="top-client.php">客户购物榜</a></P>

                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-5">
                            人员管理
                        </a>
                    </h4>
                </div>
                <div id="collapse-5" class="panel-collapse collapse">
                    <div class="panel-body">
                        <P><a href="ren-client.php">客户管理</a></P>
                        <P><a href="ren-staff.php">配送员管理</a></P>
                        <P><a href="ren-supplier.php">供应商管理</a></P>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!--左边<框架结束-->

    <!--分开多一点-->

    <!--右边>框架开始-->
    <div class="right">

        <?php
        if ($waterNum == null) {
            $waterNum = 0;
        }
        if ($waterTop == null) {
            $waterTop = "暂无";
        }
        if ($clientTop == null) {
            $clientTop = "暂无";
        }
        ?>

        <div class="baiduimage">
            <img src="images/logo2.jpg" alt="" width="370" height="129"/>
        </div>

        <div class="floatBox">
            <p>今日销量</p>
            <p class="color1"><?php echo $waterNum; ?></p>

        </div>
        <div class="floatBox">
            <p>最热商品</p>
            <p class="color1"><?php echo $waterTop; ?></p>
        </div>
        <div class="floatBox">
            <p>最佳员工</p>
            <p class="color1"><?php echo $clientTop; ?></p>
        </div>

        <div class="clear"></div>

        <p class="bottom">
            Copyright © 2010-2019 一 嗖嗖送水 All rights reserved 一
            <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=FCUkISAkJiQiISJUZWU6d3t5"
               style="text-decoration:none;">联系作者</a>
        </p>

    </div>
    <!--右边>框架结束-->

</div>

</body>

</html>

