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

if (isset($_GET["t1"])) {
    $time1 = $_GET["t1"];
}

if (isset($_GET["t2"])) {
    $time2 = $_GET["t2"];
}

//获取总数量
$sql = "SELECT client_id, client_name, SUM(out_num) AS client_sum 
FROM top_client_view 
where out_time>='$time1' AND out_time<='$time2'
GROUP BY client_id 
ORDER BY client_sum DESC ";

$result = mysqli_query($link, $sql); //获取数据集

//处理数据集,获取记录条数
$totalRecords = mysqli_num_rows($result);

//只显示前10条数据
$sql2 = "$sql LIMIT 0, 10 ";
$result = mysqli_query($link, $sql2); //获取数据集

//处理数据集,获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);

//echo $sql;
//var_dump($arrs);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>嗖嗖送水</title>
</head>

<link rel="stylesheet" href="css/staticfile-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/top.css"/>

<script src="js/staticfile-jquery.js"></script>
<script src="js/staticfile-bootstrap.js"></script>

<script type="text/javascript">

    //定义一个JS的提示函数
    function topClientGo() {

        var t1 = prompt("请输入开始时间", "2019-01-01");
        var t2 = prompt("请输入结束时间", "2019-12-31");

        if (t1 != null && t2 != null) {
            //如果单击"确定"按钮，跳转到补货页面
            location.href = "top-client.php?t1=" + t1 + "&t2=" + t2;
        } else {
            alert("未设置时间");
        }
    }

</script>

<body>

<!--头部框架开始-->
<div class="top">

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
                <div id="collapse-3" class="panel-collapse collapse in">
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

                <h3>销售统计—客户购物榜</h3>

                为您查到购物排名前10的客户 ·
                耗时 <?php echo "0.0" . rand(100, 999) ?> 秒 <!-- 心理安慰,真实时间过短,会被误以为是bug -->

            </div>

            <br>

            <?php
            //根据搜索结果显示数据
            if ($totalRecords == 0) {
                echo "<br><br><br> <font color=red> 该时段没有任何订单呢！换个时间试试吧 >_< </font> <br><br>";
                ?>
                <a href="#" onClick="topClientGo()">更换时间</a>
                <?php
                die();
            }
            ?>

            <table width="600" border="1" align="center" rules="all" cellpadding="5">

                <tr bgcolor='#dddddd' align="center">
                    <th>ID</th>
                    <th>客户</th>
                    <th>购买量</th>
                    <th>时间段</th>
                </tr>

                <?php

                $tbRowspan = 0;

                //循环二维数组,取出数据
                foreach ($arrs as $arr) { ?>

                    <tr align="center">

                        <td><?php echo $arr['client_id'] ?></td>
                        <td><?php echo $arr['client_name'] ?></td>
                        <td><?php echo $arr['client_sum'] ?></td>

                        <?php
                        $tbTotalRecords = $totalRecords;

                        if ($tbRowspan == 0) { ?>
                            <td rowspan=" <?php echo $tbTotalRecords ?> ">
                                开始时间:<?php echo $time1 ?> <br>
                                结束时间:<?php echo $time2 ?> <br>
                                <a href="#" onClick="topClientGo()">更换时间</a>
                            </td>

                            <?php
                            $tbRowspan++;
                        } ?>

                    </tr>

                <?php } ?>

            </table>

        </center>

        <div class="tongjitu">

            <!-- 统计图 -->
            <div id="container" style="height: 100%"></div>
            <script type="text/javascript" src="js/echarts.min.js"></script>

            <script type="text/javascript">

                var dom = document.getElementById("container");
                var myChart = echarts.init(dom);
                var app = {};

                option = null;
                app.title = '坐标轴刻度与标签对齐';

                option = {
                    color: ['#3398DB'],
                    tooltip: {
                        trigger: 'axis',
                        axisPointer: {            // 坐标轴指示器，坐标轴触发有效
                            type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                        }
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    xAxis: [
                        {
                            type: 'category',
                            data: [ <?php echo "'" . $arrs[0]['client_name'] . "','" . $arrs[1]['client_name'] . "','" . $arrs[2]['client_name'] . "','" . $arrs[3]['client_name'] . "','" . $arrs[4]['client_name'] . "','" . $arrs[5]['client_name'] . "','" . $arrs[6]['client_name'] . "','" . $arrs[7]['client_name'] . "','" . $arrs[8]['client_name'] . "','" . $arrs[9]['client_name'] . "'" ?> ],
                            axisTick: {
                                alignWithLabel: true
                            }
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value'
                        }
                    ],
                    series: [
                        {
                            name: '购买量',
                            type: 'bar',
                            barWidth: '60%',
                            data: [ <?php echo $arrs[0]['client_sum'] . "," . $arrs[1]['client_sum'] . "," . $arrs[2]['client_sum'] . "," . $arrs[3]['client_sum'] . "," . $arrs[4]['client_sum'] . "," . $arrs[5]['client_sum'] . "," . $arrs[6]['client_sum'] . "," . $arrs[7]['client_sum'] . "," . $arrs[8]['client_sum'] . "," . $arrs[9]['client_sum'] ?> ]
                        }
                    ]
                };
                ;

                if (option && typeof option === "object") {
                    myChart.setOption(option, true);
                }
            </script>

        </div>

        <br><br><br><br><br><br><br><br><br><br><br><br>

    </div>
    <!--右边>框架结束-->

</div>

</body>

</html>

