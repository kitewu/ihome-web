<?php
/**
 * 微信温度湿度亮度数据图表
 */
$flag = $_GET['flag'];
$homeid = $_GET['homeid'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IHomeChart</title>
    <link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <!--温度-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2><?php
                        if ($flag == "light")
                            echo "亮度";
                        else if ($humidity == "humidity") {
                            echo "湿度";
                        } else {
                            echo "温度";
                        }
                        ?> </a></li></h2>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <form role="form">
                            <div class="row">
                                <div class="form-group">
                                    <label> 选择时间</label>
                                    <input id="startdate" onchange="<?php
                                    echo "ChangePage(";
                                    echo "'" . $flag . "'";
                                    echo ",";
                                    echo "'" . $homeid . "'";
                                    echo ")";
                                    ?>" type="date" class="form-control" value="<?php echo date('Y-m-d', time()); ?>"/>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="DivChartContainer" class="canvas-wrapper">
                        <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>    <!--/.main-->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="../js/chart.min.js"></script>
<script>
    window.onload = function () {
        ChangePage(<?php echo '"' . $flag . '"';?> , <?php echo '"' . $homeid . '"';?>);
    };	//网页载入时触发
    function ChangePage(flag, homeid) {
        var mydate = document.getElementById("startdate").value;
        $.ajax({
            type: "GET",
            url: "WechatGetData.php",
            data: {mydate: mydate, flag: flag, homeid: homeid},
            dataType: 'json',
            success: function (data) {
                if (data.x == null) {
                    $('#DivChartContainer').empty();	//清空此标签
                    $('#DivChartContainer').append('<h1>无数据</h1>');
                } else {
                    lineChartData = {
                        labels: data.x,
                        datasets: [
                            {
                                label: "My Second dataset",
                                fillColor: "rgba(48, 164, 255, 0.2)",
                                strokeColor: "rgba(148, 164, 255, 1)",
                                pointColor: "rgba(48, 164, 255, 1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(48, 164, 255, 1)",
                                data: data.y
                            },
                        ]
                    }
                    $('#DivChartContainer').empty();
                    $('#DivChartContainer').append('<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>');	//重新填充8
                    chart = document.getElementById("line-chart").getContext("2d");
                    window.myLine = new Chart(chart).Line(lineChartData, {
                        responsive: true
                    });
                }
            }
        });
    }
</script>
</body>
</html>

