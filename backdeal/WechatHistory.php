<?php
/**
 * 微信历史记录图表
 */
include_once "WechatGetDevice.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>操作记录</title>
    <link href="../css/bootstrap-table.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">历史记录</div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <form role="form">
                            <div class="row">
                                <div class="form-group">
                                    <label>选择设备</label>
                                    <select id="select_devicename" class="form-control" onchange="ChangePage('<?php echo $_GET['homeid'];?>')">
                                        <?php
                                        echo "<option>" . "全部操作记录" . "</option>";
                                        $len = count($devicename);
                                        for ($i = 0; $i < $len; $i++)
                                            echo "<option>" . $devicename[$i] . "</option>";
                                        ?>
                                    </select>
                                </div>
                            </div><!--/.row-->
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form role="form">
                            <div class="row">
                                <div class="form-group">
                                    <label> 开始时间</label>
                                    <input id="startdate" onchange="ChangePage('<?php echo $_GET['homeid'];?>')" type="date" class="form-control"/>
                                </div>
                            </div><!--/.row-->
                        </form>
                    </div>
                    <div class="col-md-4">
                        <form role="form">
                            <div class="row">
                                <div class="form-group">
                                    <label>结束时间</label>
                                    <input id="lastdate" onchange="ChangePage('<?php echo $_GET['homeid'];?>')" type="date" class="form-control"/>
                                </div>
                            </div><!--/.row-->
                        </form>
                    </div>
                    <div>
                        <table id="TABLES" data-toggle="table" data-show-refresh="true"
                               data-url="./backdeal/GetHistoryOperation.php" data-show-toggle="true"
                               data-show-columns="true" data-select-item-name="toolbar1" data-pagination="true"
                               data-sort-name="name" data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="date" data-sortable="true">日期</th>
                                <th data-field="time" data-sortable="true">时间</th>
                                <th data-field="operation" data-sortable="true">操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div>

<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="../js/bootstrap-table.js"></script>
<script>
    window.onload = function () {
        ChangePage("<?php echo $_GET['homeid']?>");
    };	//网页载入时触发
    function ChangePage(homeid) {
        var devicename = document.getElementById('select_devicename').value;
        var startdate = document.getElementById('startdate').value;
        var lastdate = document.getElementById('lastdate').value;
        var myurl = "WechatGetHistoryData.php" + "?" + "devicename="  + devicename  + "&startdate=" + startdate + "&lastdate=" + lastdate + "&homeid=" + homeid;
        $('#TABLES').bootstrapTable('refresh', {url: myurl});
    }
</script>
</body>
</html>


