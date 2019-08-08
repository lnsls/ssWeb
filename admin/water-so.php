<?php

//包含连接数据库的公共文件
require_once("inc/conn.php");
require_once("inc/getVar.php");
require_once("inc/preferences.php");

$isSo = 0;
$page = 1;

//获取要查询的页
if (isset($_GET["page"])) {
    $page = $_GET["page"];
    $isSo = 1;

} else {
    $page = 1;
}

//产生表单验证随机字符串
$_SESSION['token'] = uniqid();

// 判断表单是否合法提交
if (isset($_POST['token']) || $isSo == 1) {

    //获取表单提交数据
    $soInput = $_POST['soInput'];

    if (($soInput == "" && $isSo != 1) || ($soInput == null && $isSo != 1)) {
        echo "<script>alert('输入为空!')</script>";   //通过js弹出窗口

    } else {

        //构建插入的SQL语句
        $sql = "SELECT * FROM water_so_view WHERE water_id LIKE '%$soInput%' OR water_name LIKE '%$soInput%' OR supplier_id LIKE '%$soInput%' OR water_text LIKE '%$soInput%' OR water_size LIKE '%$soInput%' OR water_type LIKE '%$soInput%' OR water_pay LIKE '%$soInput%' OR water_pay2 LIKE '%$soInput%' OR water_num LIKE '%$soInput%' OR water_note LIKE '%$soInput%' OR supplier_name LIKE '%$soInput%'";
        //echo $sql;

        $result = mysqli_query($link, $sql);

        //处理数据集,获取记录条数
        $totalRecords = mysqli_num_rows($result);

        //获取数据集
        if ($totalRecords > 0) {
            $isSo = 1;

        } else {
            $isSo = -1;
        }

        //计算总页数
        $totalPages = ceil($totalRecords / $onePageNum);

        //根据获取的页面,计算开始的条数
        $startFrom = ($page - 1) * $onePageNum;

        //查询 从 $startFrom 开始,查询后面的 $onePageNum 条数据
        $sql2 = "$sql LIMIT $startFrom, $onePageNum";
        $result = mysqli_query($link, $sql2); //获取数据集

        //echo $sql2;

        //处理数据集,获取所有行数据
        $arrs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>嗖嗖送水</title>
</head>

<link rel="stylesheet" href="css/staticfile-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/index.css"/>
<link rel="stylesheet" type="text/css" href="css/water-so.css"/>

<script src="js/staticfile-jquery.js"></script>
<script src="js/staticfile-bootstrap.js"></script>

<body>

<!--头部框架开始-->
<div class="top">

    <a href="index.php" class="top-left"> </a>

    <div class="top-right">
        当前登录:<?php echo $_SESSION['admin_name'] ?>
        <a href="login-esc.php" style="color: #ffffff" style="color: #ffffff">(退出)</a>
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

        <!-- 搜索框 -->
        <div>
            <div>
                <img src="images/logo2.jpg" alt="" width="370" height="129" class="baiduimage"/>
            </div>

            <div>
                <form method="post" action="">
                    <input name="soInput" type="text" class="so-text" placeholder=" 输入任意关键字全局查找" maxlength="20">
                    <input type="submit" class="so-button" value="查找">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                </form>
            </div>
        </div>

        <br><br><br>

        <center>

            <?php

            //根据搜索结果显示数据
            if ($isSo == 0) {
                echo "<br><br><br> 输入关键字搜索吧 o_O <br><br><br>";
                die();

            } elseif ($isSo == -1) {
                echo "<br><br><br> <font color=red> 搜索 $soInput 未发现任何记录噢 >_< </font> <br><br><br>";
                die();
            }
            ?>

            <div style="text-align:center; padding-bottom: 10px;">

                <h3>商品管理—查找商品</h3>

                搜索 <font color=red> <?php echo $soInput ?> </font> 共找到 <font
                        color=red><?php echo $totalRecords ?></font> 条记录 ·
                每页 <?php echo $onePageNum ?> 条 · 共 <?php echo $totalPages ?> 页 ·
                耗时 <?php echo "0.0" . rand(100, 999) ?> 秒 <!-- 心理安慰,真实时间过短,会被误以为是bug -->

            </div>

            <br>

            <table width="1050" border="1" align="center" rules="all" cellpadding="5">

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
                </tr>

                <?php
                //循环二维数组,取出数据
                foreach ($arrs as $arr) { ?>

                    <tr align="center">

                        <td><?php echo $arr['water_id'] ?></td>
                        <td><?php echo $arr['water_name'] ?></td>
                        <td><?php echo getSupplierName($arr['supplier_id'], $link) ?></td>
                        <td><?php echo $arr['water_text'] ?></td>
                        <td height="50px">
                            <?php
                            if (trim($arr['water_img']) == null) {
                                echo 无图片;
                            } else {
                                echo "<a href='" . $arr['water_img'] . "'><img src='" . $arr['water_img'] . "' height='40px'  width='60px' /></a>";
                            } ?>
                        </td>
                        <td><?php echo $arr['water_size'] ?></td>
                        <td><?php echo $arr['water_type'] ?></td>
                        <td><?php echo $arr['water_pay'] ?></td>
                        <td><?php echo $arr['water_pay2'] ?></td>
                        <td><?php echo $arr['water_num'] ?></td>
                        <td>
                            <?php
                            if (trim($arr['water_note']) == null) {
                                echo 无;
                            } else {
                                echo $arr['water_note'];
                            } ?>
                        </td>

                    </tr>

                <?php } ?>

            </table>

            <br>

            <?php

            //第一页
            echo "<a href='water-so.php?page=1'>" . '第一页' . "</a> ";

            //循环输出中间的页
            for ($i = 1; $i <= $totalPages; $i++) {
                echo "<a href='water-so.php?page=" . $i . "'> &nbsp;" . $i . "&nbsp; </a> ";
            };

            //最后一页
            echo "<a href='water-so.php?page=$totalPages'>" . '最后一页' . "</a> ";

            ?>

            <br><br><br><br><br><br><br>

        </center>

    </div>
    <!--右边>框架结束-->

</div>

</body>

</html>


<!--

    <frameset cols="170px,*" frameborder="no">

		<frame src="nBar.php">
		<frame src="welcome.php" name ="ssWebAdminGO">

    </frameset>

-->