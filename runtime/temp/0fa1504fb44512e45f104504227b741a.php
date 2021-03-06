<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"F:\www\DBM\public/../application/index\view\login\index.html";i:1539153484;}*/ ?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>后台登录</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            overflow: hidden;
        }
    </style>
    <link href="/static/system/files/font.css" rel="stylesheet">
    <link rel="stylesheet" href="/static/system/files/style.css">
    <link rel="stylesheet" href="/static/system/files/style-search.css" media="screen" type="text/css">
    <link rel="stylesheet" type="text/css" href="/static/system/dist/css/global.css" />
    <link rel="stylesheet" type="text/css" href="/static/system/dist/css/login.css" />
    <link rel="stylesheet" type="text/css" href="/static/swal/sweetalert2.min.css" />
    <!--<link rel="stylesheet" href="/static/Amaranjs/amaran.min.css">-->
    <link rel="stylesheet" href="/static/bootstrap/css/font-awesome.min.css">

    <script type="text/javascript" src="/static/jQuery/jquery.min.js"></script>
    <script type="text/javascript" src="/static/swal/sweetalert2.min.js"></script>
    <!--<script type="text/javascript" src="/static/Amaranjs/jquery.amaran.min.js"></script>-->
    <script>
        function c(){
            location.href="http://www.baidu.com/s?wd="+$("#input").val();
        }
    </script>
</head>
<body style="">
<canvas id="canvas" width="1920" height="1080"> 您的浏览器不支持canvas标签，请您更换浏览器 </canvas>
<script src="/static/system/files/word.js"></script>

    <div id="login">
        <h1>
            <strong><span class="en-font"></span>数据库管理系统</strong>
            <em class="en-font">Database Manage System</em>
        </h1>
        <form id="UserForm">
            <input type="hidden" name="__token__" value="0bdfa70fd4894b47e136ae023e2db7c2"/>
            <div class="user info">
                <label>U</label>
                <input type="text" name="data[User][username]" value="" id="username" class="en-font" placeholder="账号"
                       autocomplete="off">
            </div>
            <div class="pwd info">
                <label>P</label>
                <input type="password" name="data[User][password]" value="" id="password" class="en-font"
                       placeholder="密码" autocomplete="off">
            </div>
            <div class="code info">
                <label>V</label>
                <input type="text" name="captcha" value="" id="code" class="en-font" autocomplete="off" placeholder="验证码">
                <span class="vimg">
                    <img src="<?php echo captcha_src(); ?>"  onclick="this.src='<?php echo captcha_src(); ?>?'+Math.random()"/>
			    </span>
            </div>
            <div class="sub">
                <input type="button" id="LoginU" value="立即登录"/>
            </div>
        </form>
        <div class="copy"></div>
    </div>

</span> </div>

<script type="text/javascript">

    $(window).resize(function () {
        var wh = $(window).height();
        $('#canvas').height(wh);
    }).trigger('resize')

    $(function () {

        $("#LoginU").on('click', function () {
            var setData = [];
            var username = $.trim($("#username").val());
            var password = $.trim($("#password").val());
            var code = $.trim($("#code").val());

            if (!username || !password || !code) {
                swal({
                    title: "Error!",
                    text: "Here's my error message!",
                    type: "error",
                    confirmButtonText: "Cool"
                });
                return false;
            }
            setData.push({name: "username", value: username});
            setData.push({name: "password", value: password});
            setData.push({name: "captcha", value: code});

            var ajaxOption = {};
            ajaxOption.url = "/admin/login/checkLogin";
            ajaxOption.type = "POST";
            ajaxOption.dataType = "JSON";
            ajaxOption.data = setData;
            ajaxOption.success = function (res) {
                if (res.state == 1) {
                    layer.msg(res.info);
                    setTimeout(function () {
                        window.location.href = res.url;
                    },1000)
                } else {
                    layer.msg(res.info);
                }
            };
            ajaxOption.error = function () {
            };
            $.ajax(ajaxOption);
        });
    });


</script>
</body></html>