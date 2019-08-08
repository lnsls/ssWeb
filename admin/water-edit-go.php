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

//获取地址栏传递的ID
$id = $_GET['id'];

//执行查询的SQL语句
$sql = "SELECT * FROM water WHERE water_id=$id";
$result = mysqli_query($link, $sql);

//获取所有行数据
$arr = mysqli_fetch_assoc($result);

$water_name = $arr['water_name'];
$supplier_id = $arr['supplier_id'];
$water_text = $arr['water_text'];
$water_img = $arr['water_img'];
$water_size = $arr['water_size'];
$water_type = $arr['water_type'];
$water_pay = $arr['water_pay'];
$water_pay2 = $arr['water_pay2'];
$water_num = $arr['water_num'];
$water_note = $arr['water_note'];

// 判断表单是否合法提交(防止攻击)
if (isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {

    //******************************上传图片*******************************

    //判断是否选择了图片
    if (!empty($_FILES['uploadFile']['tmp_name'])) {

        //(1)
        //判断上传图片是否有错误发生
        if ($_FILES['uploadFile']['error'] != 0) {
            echo "<h2>上传图片有错误发生！</h2>";
            header("refresh:3;url=water-new.php");
            echo "3秒后自动返回,或者 <a href='water-new.php'> 点击这里 </a> 立刻返回";
            die();
        }

        //(2)
        //判断上传文件内容类型是不是图片
        $arr1 = array("image/jpeg", "image/jpg", "image/png", "image/gif");

        //创建finfo的资源：获取文件内容类型，与扩展名无关
        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        //获取文件内容的原始类型，不会随着扩展名改名而改变
        $mime = finfo_file($finfo, $_FILES['uploadFile']['tmp_name']);

        if (!in_array($mime, $arr1)) {
            echo "<h2>上传的必须是图像1！</h2>";
            header("refresh:3;url=water-new.php");
            echo "3秒后自动返回,或者 <a href='water-new.php'> 点击这里 </a> 立刻返回";
            die();
        }

        //(3)
        //判断上传的文件扩展名是不是图片
        $arr2 = array("jpg", "gif", "png", "jpeg");

        $ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION); //文件扩展名

        if (!in_array($ext, $arr2)) {
            echo "<h2>上传的必须是图像2！</h2>";
            header("refresh:3;url=water-new.php");
            echo "3秒后自动返回,或者 <a href='water-new.php'> 点击这里 </a> 立刻返回";
            die();
        }

        //(4)
        //移动图片到 images目录中
        $tmp_name = $_FILES['uploadFile']['tmp_name'];  //获得本地临时文件
        $dst_name = "images/a/" . uniqid() . "." . $ext;    //设置上传到服务器的路径
        move_uploaded_file($tmp_name, $dst_name);   //移动图片

        //(5)
        //将图片保存到数据库

        //如果有图片,就获取表单提交的图片数据
        $water_img = $dst_name; //数据库存储图片路径
    }

    //获取表单提交数据
    $water_name = $_POST['water_name'];
    $supplier_id = $_POST['supplier_id'];
    $water_text = $_POST['water_text'];
    //如果没有图片,还使用原来的图片数据
    $water_size = $_POST['water_size'];
    $water_type = $_POST['water_type'];
    $water_pay = $_POST['water_pay'];
    $water_pay2 = $_POST['water_pay2'];
    $water_num = $_POST['water_num'];
    $water_note = $_POST['water_note'];

    //构建插入的SQL语句
    $sql = "UPDATE water SET water_name='$water_name',supplier_id='$supplier_id',water_text='$water_text',water_img='$water_img',water_size='$water_size',water_type='$water_type',water_pay='$water_pay',water_pay2='$water_pay2',water_num='$water_num' WHERE water_id = $id";

    //echo $sql;

    //判断SQL语句是否执行成功
    if (mysqli_query($link, $sql)) {
        echo "<script>alert('修改成功!')</script>";   //通过js弹出窗口
        //告诉浏览器执行代码：等待0秒，并跳转文件
        header("refresh:0;url=water-edit.php");
    }else{
        echo "<script>alert('输入有误,修改失败!')</script>";   //通过js弹出窗口
        //告诉浏览器执行代码：等待0秒，并跳转文件
        header("refresh:0;url=water-edit.php");
    }

}

//产生表单验证随机字符串
$_SESSION['token'] = uniqid();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>嗖嗖送水</title>
</head>

<link rel="stylesheet" href="css/staticfile-bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/water-edit-go.css"/>

<script src="js/staticfile-jquery.js"></script>
<script src="js/staticfile-bootstrap.js"></script>

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

        <div style="text-align:center; padding-bottom: 10px;">
            <h3>商品管理—修改商品</h3>
            改点什么好呢 o_O
        </div>

        <br>

        <div class="right-body">

            <form method="post" action="" enctype="multipart/form-data">

                <table width="600" bordercolor="#FFF" border="1" rules="all" align="center" cellpadding="5">

                    <tr>
                        <td width="120" align="right">商品名称：</td>
                        <td><input type="text" name="water_name" value="<?php echo $water_name ?>"></td>
                        <td width="120" align="right">供应商ID：</td>
                        <td><input type="text" name="supplier_id" value="<?php echo $supplier_id ?>"></td>
                        <!--  <td>-->
                        <!--      <select name="supplier_id">-->
                        <!--          <option value="1">青青草原水厂</option>-->
                        <!--          <option value="2" selected="selected">小太阳水厂</option>-->
                        <!--      </select>-->
                        <!--  </td>-->
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td width="120" align="right">商品简介：</td>
                        <td><input type="text" name="water_text" value="<?php echo $water_text ?>"></td>
                        <td width="120" align="right">商品图片：</td>
                        <td><input type="file" name="uploadFile" value="<?php echo $water_img ?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td width="120" align="right">商品规格：</td>
                        <td><input type="text" name="water_size" placeholder="升/桶" value="<?php echo $water_size ?>"></td>
                        <td width="120" align="right">商品类别：</td>
                        <td><input type="text" name="water_type" placeholder="矿泉水,纯净水,等" value="<?php echo $water_type ?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td width="120" align="right">商品进价：</td>
                        <td><input type="text" name="water_pay" value="<?php echo $water_pay ?>"></td>
                        <td width="120" align="right">商品售价：</td>
                        <td><input type="text" name="water_pay2" value="<?php echo $water_pay2 ?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td width="120" align="right">商品数量：</td>
                        <td><input type="text" name="water_num" value="<?php echo $water_num ?>"></td>
                        <td width="120" align="right">商品状态：</td>
                        <td><input type="text" name="water_note" value="<?php echo $water_note ?> (不能修改)"
                                   readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <br>
                            <input type="submit" value="  提  交  ">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                        </td>
                        <td>&nbsp;</td>
                    </tr>

                </table>

            </form>

        </div>

    </div>
    <!--右边>框架结束-->

</div>

</body>

</html>


