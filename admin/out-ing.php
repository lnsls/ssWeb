<?php

//包含连接数据库的公共文件
require_once("inc/conn.php");
require_once("inc/getVar.php");
require_once("inc/preferences.php");

/*
//执行查询的SQL语句
$sql = "SELECT * FROM water";
$result = mysqli_query($link, $sql);

//获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);
 */

//获取总数量
$sql = "SELECT * FROM out_ WHERE staff_id!='0' AND out_ok='0' AND out_good='1'";
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
$sql = "SELECT * FROM out_ WHERE staff_id!='0' AND out_ok='0' AND out_good='1' LIMIT $startFrom, $onePageNum ";
$result = mysqli_query($link, $sql); //获取数据集

//处理数据集,获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);

//var_dump($arrs);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>嗖嗖送水</title>
</head>

<link rel="stylesheet" href="css/staticfile-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/index.css"/>

<script src="js/staticfile-jquery.js"></script>
<script src="js/staticfile-bootstrap.js"></script>

<script type="text/javascript">

    //定义一个JS的提示函数
    function outIngGo(id) {

        if (window.confirm("确定送达？")) {

            //如果单击"确定"按钮，跳转到上架页面
            location.href = "out-ing-ok.php?id=" + id;
        }
    }

    //定义一个JS的提示函数
    function outCloseGO(id, num, water) {

        if (window.confirm("确定关闭？")) {

            //如果单击"确定"按钮，跳转到上架页面
            location.href = "out-toclose.php?id=" + id + "&num=" + num + "&water=" + water;
        }
    }

    //定义一个JS的提示函数
    function outIngStaffGo(id) {

        var staff = prompt("请输入配送员编号", "");

        if (staff != null && staff.valueOf() > 0) {
            //如果单击"确定"按钮，跳转到补货页面
            location.href = "out-ing-EditStaff.php?id=" + id + "&staff=" + staff;
        } else {
            alert("取消修改");
        }
    }

</script>

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
                <div id="collapse-1" class="panel-collapse collapse">
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
                <div id="collapse-2" class="panel-collapse collapse in">
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

        <center>

            <div style="text-align:center; padding-bottom: 10px;">

                <h3>订单管理—正在配送</h3>

                共找到 <font color=red><?php echo $totalRecords ?></font> 条记录 ·
                每页 <?php echo $onePageNum ?> 条 · 共 <?php echo $totalPages ?> 页 ·
                耗时 <?php echo "0.0" . rand(100, 999) ?> 秒 <!-- 心理安慰,真实时间过短,会被误以为是bug -->

            </div>

            <br>

            <?php
            //根据搜索结果显示数据
            if ($totalRecords == 0) {
                echo "<br><br><br> <font color=red> 没有正在配送的订单呢 >_< </font> <br><br><br>";
                die();
            }
            ?>

            <table width="1050" border="1" align="center" rules="all" cellpadding="5">

                <tr bgcolor='#dddddd' align="center">
                    <th>ID</th>
                    <th>客户</th>
                    <th>客户电话</th>
                    <th>客户地址</th>
                    <th>配送员</th>
                    <th>商品</th>
                    <th>下单时间</th>
                    <th>数量</th>
                    <th>金额</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>

                <?php
                //循环二维数组,取出数据
                foreach ($arrs

                         as $arr) { ?>

                    <tr align="center">

                        <td><?php echo $arr['out_id'] ?></td>
                        <td><?php echo getClientName($arr['client_id'], $link) ?></td>
                        <td><?php echo $arr['client_phone'] ?></td>
                        <td><?php echo $arr['client_add'] ?></td>
                        <td>
                            <?php
                            if (trim($arr['staff_id']) == 0) {
                                echo "——";
                            } else {
                                echo getStaffName($arr['staff_id'], $link); ?>
                                <a href="#" onClick="outIngStaffGo(<?php echo $arr['out_id'] ?>)">修改</a>
                            <?php } ?>
                        </td>
                        <td><?php echo getWaterName($arr['water_id'], $link) ?></td>
                        <td><?php echo $arr['out_time'] ?></td>
                        <td><?php echo $arr['out_num'] ?></td>
                        <td><?php echo $arr['out_sum'] ?></td>
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
                            <a href="#" onClick="outIngGo(<?php echo $arr['out_id'] ?>)">送达</a> |
                            <a href="#"
                               onClick="outCloseGO(<?php echo $arr['out_id'] . "," . $arr['out_num'] . "," . $arr['water_id'] ?>)">关闭</a>
                        </td>

                    </tr>

                <?php } ?>

            </table>

            <br>

            <?php

            //第一页
            echo "<a href='out-ing.php?page=1'>" . '第一页' . "</a> ";

            //循环输出中间的页
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='out-ing.php?page=" . $i . "'> &nbsp;" . $i . "&nbsp; </a> ";
            };

            //最后一页
            echo "<a href='out-ing.php?page=$totalPages'>" . '最后一页' . "</a> ";

            ?>

        </center>

    </div>
    <!--右边>框架结束-->

</div>

</body>

</html>

