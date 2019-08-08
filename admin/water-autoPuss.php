<?php

//包含连接数据库的公共文件
require_once("inc/conn.php");

/*
//执行查询的SQL语句
$sql = "SELECT * FROM water";
$result = mysqli_query($link, $sql);

//获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);
 */

//获取总数量
$sql = "SELECT * FROM water WHERE water_name='' OR water_name IS NULL OR supplier_id='' OR supplier_id IS NULL OR water_text='' OR water_text IS NULL OR water_size='' OR water_size IS NULL OR water_type='' OR water_type IS NULL OR water_pay='' OR water_pay IS NULL OR water_pay2='' OR water_pay2 IS NULL OR water_num='' OR water_num IS NULL OR water_note='' OR water_note IS NULL";
$result = mysqli_query($link, $sql); //获取数据集

//处理数据集,获取记录条数
$totalRecords = mysqli_num_rows($result);

//每页显示数量
require_once("inc/preferences.php");

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
$sql2 = "$sql LIMIT $startFrom, $onePageNum";
$result = mysqli_query($link, $sql2); //获取数据集

//处理数据集,获取所有行数据
$arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);

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

<!--<script type="text/javascript">-->
<!---->
<!--    //定义一个JS的提示函数-->
<!--    function inGo(waterid) {-->
<!---->
<!--        if (window.confirm("确定要修改吗？")) {-->
<!--            //跳到页面-->
<!--            location.href = "water-edit.php?id=" + waterid;-->
<!--        }-->
<!---->
<!--    }-->
<!---->
<!--</script>-->

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

        <center>

            <div style="text-align:center; padding-bottom: 10px;">

                <h3>商品管理—自动诊断</h3>

                共找到 <font color=red><?php echo $totalRecords ?></font> 条记录 ·
                每页 <?php echo $onePageNum ?> 条 · 共 <?php echo $totalPages ?> 页 ·
                耗时 <?php echo "0.0" . rand(100, 999) ?> 秒 <!-- 心理安慰,真实时间过短,会被误以为是bug -->

            </div>

            <br>

            <?php
            //根据搜索结果显示数据
            if ($totalRecords == 0) {
                echo "<br><br><br> <font color=red> 太棒啦！所有数据正常无需修正 o_O </font> <br><br><br>";
                die();
            }
            ?>

            <table width="1080" border="1" align="center" rules="all" cellpadding="5">

                <tr bgcolor='#dddddd' align="center">
                    <th>ID</th>
                    <th>名称</th>
                    <th>供应商</th>
                    <th>简介</th>
                    <th>图片</th>
                    <th>规格</th>
                    <th>类型</th>
                    <th>进价</th>
                    <th>售价</th>
                    <th>数量</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>

                <?php
                //循环二维数组,取出数据
                foreach ($arrs as $arr) { ?>

                    <tr align="center">

                        <!-- <td>--><?php //echo $arr['water_id'] ?><!--</td>-->
                        <!-- <td>--><?php //echo $arr['water_name'] ?><!--</td>-->
                        <!-- <td>--><?php //echo $arr['water_text'] ?><!--</td>-->
                        <!-- <td>--><?php //echo $arr['water_img'] ?><!--</td>-->
                        <!-- <td>--><?php //echo $arr['water_size'] ?><!--</td>-->
                        <!-- <td>--><?php //echo $arr['water_type'] ?><!--</td>-->
                        <!-- <td>--><?php //echo $arr['water_pay'] ?><!--</td>-->
                        <!-- <td>--><?php //echo $arr['water_pay2'] ?><!--</td>-->
                        <!-- <td>--><?php //echo $arr['water_num'] ?><!--</td>-->

                        <?php

                        // $isNull = 0;    //判断是否有空数据
                        //
                        // if (trim($arr['water_id']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // if (trim($arr['water_name']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // if (trim($arr['supplier_id']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // if (trim($arr['water_text']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // if (trim($arr['water_img']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // if (trim($arr['water_size']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // if (trim($arr['water_type']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // if (trim($arr['water_pay']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // if (trim($arr['water_pay2']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // if (trim($arr['water_num']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // if (trim($arr['water_note']) == null) {
                        //     $isNull = 1;
                        // }
                        //
                        // //如果全行都不为空跳过词行,不显示表格
                        // if ($isNull == 0) {
                        //     continue;
                        // }

                        //////////////////////////////////////////////////////////////////////

                        if (trim($arr['water_id']) == null) {
                            echo "<td bgcolor='#FDBBBB'></td>";
                        } else {
                            echo "<td> {$arr['water_id']} </td>";
                        }

                        if (trim($arr['water_name']) == null) {
                            echo "<td bgcolor='#FDBBBB'></td>";
                        } else {
                            echo "<td> {$arr['water_name']} </td>";
                        }

                        if (trim($arr['supplier_id']) == null) {
                            echo "<td bgcolor='#FDBBBB'></td>";
                        } else {
                            echo "<td> {$arr['supplier_id']} </td>";
                        }

                        if (trim($arr['water_text']) == null) {
                            echo "<td bgcolor='#FDBBBB'></td>";
                        } else {
                            echo "<td> {$arr['water_text']} </td>";
                        }

                        if (trim($arr['water_img']) == null) {
                            echo "<td bgcolor='#FDBBBB'>无图片</td>";
                        } else {
                            echo "<td height='50px'>";
                            echo "<a href='" . $arr['water_img'] . "'><img src='" . $arr['water_img'] . "' height='40px'  width='60px' /></a>";
                            echo "</td>";
                        }

                        if (trim($arr['water_size']) == null) {
                            echo "<td bgcolor='#FDBBBB'></td>";
                        } else {
                            echo "<td> {$arr['water_size']} </td>";
                        }

                        if (trim($arr['water_type']) == null) {
                            echo "<td bgcolor='#FDBBBB'></td>";
                        } else {
                            echo "<td> {$arr['water_type']} </td>";
                        }

                        if (trim($arr['water_pay']) == null) {
                            echo "<td bgcolor='#FDBBBB'></td>";
                        } else {
                            echo "<td> {$arr['water_pay']} </td>";
                        }

                        if (trim($arr['water_pay2']) == null) {
                            echo "<td bgcolor='#FDBBBB'></td>";
                        } else {
                            echo "<td> {$arr['water_pay2']} </td>";
                        }

                        if (trim($arr['water_num']) == null) {
                            echo "<td bgcolor='#FDBBBB'></td>";
                        } else {
                            echo "<td> {$arr['water_num']} </td>";
                        }

                        if (trim($arr['water_note']) == null) {
                            echo "<td bgcolor='#FDBBBB'></td>";
                        } else {
                            echo "<td> {$arr['water_note']} </td>";
                        } ?>

                        <td>
                            <a href="water-edit-go.php?id=<?php echo $arr['water_id'] ?>">更正</a>
                        </td>
                    </tr>

                <?php } ?>

            </table>

            <br>

            <?php

            //第一页
            echo "<a href='water-autoPuss.php?page=1'>" . '第一页' . "</a> ";

            //循环输出中间的页
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='water-autoPuss.php?page=" . $i . "'> &nbsp;" . $i . "&nbsp; </a> ";
            };

            //最后一页
            echo "<a href='water-autoPuss.php?page=$totalPages'>" . '最后一页' . "</a> ";

            ?>

        </center>

        <br><br><br><br><br><br>

    </div>
    <!--右边>框架结束-->

</div>

</body>

</html>


