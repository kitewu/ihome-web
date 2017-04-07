<?php
$id = $_GET["id"];
?>

<!DOCTYPE html>
<head>
    <title>绑定账号</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/templatemo_style.css" rel="stylesheet" type="text/css">
</head>
<body class="templatemo-bg-gray">
<div class="container">
    <div class="col-md-12">
        <h1 class="margin-bottom-15">绑定账号</h1>
        <form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="control-wrapper">
                        <label for="username" class="control-label fa-label"><i class="fa fa-user fa-medium"></i></label>
                        <input type="text" class="form-control" id="id_username" placeholder="用户名">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="control-wrapper">
                        <label for="password" class="control-label fa-label"><i class="fa fa-lock fa-medium"></i></label>
                        <input type="password" class="form-control" id="id_password" onkeypress="getKey();"placeholder="密码">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <div class="control-wrapper">
                        <input type="button" id="bindaccount" onclick="bindAccount()" value="确定" class="btn btn-info">
                    </div>
                </div>
            </div>
        </form>
        <div class="text-center">
            <font size="6" color="#000000" id="show"></font>
        </div>
    </div>
</div>

<script>
    function getKey(){
        if (event.keyCode == 13){
            event.returnValue=false;
            event.cancel = true;
            var btn = document.getElementById('bindaccount');
            btn.focus();
            btn.click();
        }
    }
    function bindAccount() {
        var username = document.getElementById('id_username').value;
        var password = document.getElementById('id_password').value;
        $.ajax({
            type:"POST",
            url:"WechatCheckBindAccount.php",
            data:{email: username, passwd: password, wechatid : "<?php echo $id;?>"},
            data_type:"text",
            success: function(data){
                $('#show').empty();
                $('#show').append(data);
            }
        });
    }
</script>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>
</html>
