<?php
// store session data
session_start();
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <!-- InstanceBeginEditable name="head-edt" -->
    <title>联系我们-嗖嗖送水</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="stylesheet" type="text/css" href="../css/call.css"/>

    <!--引用百度地图API-->
    <style type="text/css">
        html, body {
            margin: 0;
            padding: 0;
        }

        .iw_poi_title {
            color: #CC5522;
            font-size: 14px;
            font-weight: bold;
            overflow: hidden;
            padding-right: 13px;
            white-space: nowrap
        }

        .iw_poi_content {
            font: 12px arial, sans-serif;
            overflow: visible;
            padding-top: 4px;
            white-space: -moz-pre-wrap;
            word-wrap: break-word
        }
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true">
    </script>

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

        <!-- 天气 -->
<!--        <iframe name="weather_inc" src="http://i.tianqi.com/index.php?c=code&id=2&num=3" width="440" height="70"-->
<!--                frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>-->

        <p class='wText'>以下方式都可以联系我们哟 o_O</p><br><br><br>

        <img src="../images/call.png" width="800px"><br>

        <br><br><br>

        <!--百度地图容器-->
        <div style="width:600px;height:500px;border:#ccc solid 1px;" id="dituContent"></div>

        <br><br><br><br><br>

    </center>

    <script type="text/javascript">

        //创建和初始化地图函数：
        function initMap() {
            createMap();//创建地图
            setMapEvent();//设置地图事件
            addMapControl();//向地图添加控件
        }

        //创建地图函数：
        function createMap() {
            var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图

            //原用法
            //var point = new BMap.Point(108.373351, 22.823037);//定义一个中心点坐标
            // map.centerAndZoom(point, 11);//设定地图的中心点和坐标并将地图显示在地图容器中
            // window.map = map;//将map变量存储在全局

            //浮窗地点用法
            map.centerAndZoom(new BMap.Point(108.332630, 22.853892), 14);//定义一个中心点坐标,并设定地图的中心点和坐标并将地图显示在地图容器中
            var local = new BMap.LocalSearch(map, {
                renderOptions: {map: map}
            });
            local.search("南宁师范大学明秀校区-北门");
            window.map = map;//将map变量存储在全局
        }

        //地图事件设置函数：
        function setMapEvent() {
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }

        //地图控件添加函数：
        function addMapControl() {
            //向地图中添加缩放控件
            var ctrl_nav = new BMap.NavigationControl({
                anchor: BMAP_ANCHOR_TOP_LEFT,
                type: BMAP_NAVIGATION_CONTROL_LARGE
            });
            map.addControl(ctrl_nav);
            //向地图中添加缩略图控件
            var ctrl_ove = new BMap.OverviewMapControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: 1});
            map.addControl(ctrl_ove);
            //向地图中添加比例尺控件
            var ctrl_sca = new BMap.ScaleControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT});
            map.addControl(ctrl_sca);
        }

        initMap();//创建和初始化地图

    </script>

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