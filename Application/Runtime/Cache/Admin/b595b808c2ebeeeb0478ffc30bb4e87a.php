<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo ((isset($title) && ($title !== ""))?($title):getSignValue('WEBSITE_NAME')); ?></title>
    <meta name="keywords" content="[keywords]" />
    <meta name="description" content="[description]" />
    <link rel="icon" href="../../favicon.ico">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="/Public/Lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Lib/overlay/css/prettify.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/Public/Js/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap -->
    <script type="text/javascript" src="/Public/Lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Public/Lib/bootstrap/js/bootbox.min.js"></script>
    <!-- Bootstrap -->
    <!--过渡代码-->
    <link rel="stylesheet" type="text/css" href="/Public/Lib/overlay/css/iosOverlay.css" />
    <script type="text/javascript" src="/Public/Lib/overlay/js/iosOverlay.js"></script>
    <!--过渡代码-->
    <script type="text/javascript" src="/Public/Lib/overlay/js/modernizr-2.0.6.min.js"></script>
    <script type="text/javascript" src="/Public/Lib/overlay/js/prettify.js"></script>
    <script type="text/javascript" src="/Public/Lib/overlay/js/spin.min.js"></script>
    <script type="text/javascript" src="/Public/Js/jquery.serializeObject.min.js"></script>
    <script type="text/javascript" src="/Public/Js/validator.min.js"></script>
    <script type="text/javascript" src="/Public/Js/app.js"></script>
    <!--回到顶部-->
    <link rel="stylesheet" type="text/css" href="/Public/Css/back-top.css" />
    <script type="text/javascript" src="/Public/Js/back-top.js"></script>
    <!--回到顶部-->
    <!--固定页面元素-->
    <script type="text/javascript" src="/Public/Lib/pin-pages/jquery.pin.min.js"></script>
    <!--固定页面元素end-->
    <!--font-awesome图标-->
    <link rel="stylesheet" type="text/css" href="/Public/Lib/font-awesome/css/font-awesome.min.css" />
    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="/Public/Lib/font-awesome/css/font-awesome-ie7.min.css" />
    <![endif]-->
    <!--全选-->
    <script type="text/javascript" src="/Public/Js/global-function.js"></script>
    <!--全选 end-->
    <!--上传图片-->
    <script type="text/javascript" src="/Public/Js/dropzone.js"></script>
    <!--上传图片-end-->


    <script type="text/javascript">
        function save(){
            TPA.httpPost('admin/user/save/',
                    {password:$('#inputPassword').val(), name:$('#inputName').val(), email:$('#inputEmail').val(), mobile: $('#inputMobile').val()},
                    function(data){
                        if( data.success ){
                            bootbox.alert('修改成功');
                        }else{
                            bootbox.alert(data.errorDesc);
                        }
                    }
            );
        }
    </script>

</head>
<body>
<div class="bottom_tools">
    <!--<a id="feedback" href="http://sc.chinaz.com" title="意见反馈">意见反馈</a>-->
    <a id="scrollUp" href="javascript:;" title="飞回顶部"></a>
</div>
    <nav class="navbar navbar-inverse navbar-fixed-top" id="header">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">IDP教育集团图书仓库管理系统</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?=U('user/info')?>" title="账户">你好！<span class="glyphicon glyphicon-user" aria-hidden="true"> <?php echo ($_SESSION['USER']['username']); ?></span></a></li>
                <li><a href="<?=U('Login/loginOut')?>" title="退出"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
            </ul>
            <!--<form class="navbar-form navbar-right">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="搜索...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </form>-->
        </div>
    </div>
</nav>


<div class="container-fluid" style="margin-top: 60px;">
    <div class="row">
        <style type="text/css">
    .nav-pills > li > a
    {
        padding: 5px 15px
    }
    .nav-stacked .navbar-header{
        cursor:pointer;
        height:30px;
        line-height: 30px;
        padding:2px;
        border-radius: 4px;
    }
    .nav-stacked .navbar-header:hover{
        background-color: #dddddd;
    }
    .nav-stacked .navbar-none{
        display: none;
    }

</style>
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-pills nav-stacked">
        <!-- <li class="navbar-header" id="menu_menu_id">
            menu.name&nbsp;&nbsp;
            <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
        </li>
        <li>
            <a id="left_menu_menu_id_childMenu_id" class="navbar-none"  href="childMenu['cUrl'])">
                childMenu.name
            </a>
        </li> -->

        <li class="navbar-header" id="role">
            权限管理&nbsp;&nbsp;
            <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
        </li>
        <li>
            <a id="left_role_role_id" class="navbar-none" href="/Role/rolesList">
                角色列表
            </a>
        </li>
        <li>
            <a id="left_role_childMenu_id" class="navbar-none" href="/Role/roleList">
                权限列表
            </a>
        </li>

        <li class="navbar-header" id="admin">
            管理员管理&nbsp;&nbsp;
            <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
        </li>
        <li>
            <a id="left_admin_childMenu_id" class="navbar-none" href="/Admin/adminList">
                管理员列表
            </a>
        </li>

        <li class="navbar-header" id="book">
            图书管理&nbsp;&nbsp;
            <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>
        </li>
        <li>
            <a id="left_book_childMenu_id" class="navbar-none" href="/Book/bookList">
                图书列表
            </a>
        </li>
    </ul>
    <script type="text/javascript">
        $(".sidebar #left_menu_<?php echo ($c_index); ?>_<?php echo ($m_index); ?>").parent().addClass("active");
        $(".sidebar a[id^=left_menu_<?php echo ($c_index); ?>_]").removeClass("navbar-none");
        $(".sidebar #menu_<?php echo ($c_index); ?> span").addClass('glyphicon-triangle-bottom');
        $(function(){
            $(".navbar-header").click(function(){
                var element=$(".sidebar li a[id^=left_"+this.id+"_]");

                if(element.is(":visible")){
                    element.addClass("navbar-none");
                    //element.hide();
                    $(".sidebar #"+this.id+" span").removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-right');
                }else{
                    element.removeClass("navbar-none");
                    //element.show();
                    $(".sidebar #"+this.id+" span").removeClass('glyphicon-triangle-right').addClass('glyphicon-triangle-bottom');
                }

            });
        })
        // 固定菜单位置
        $(".sidebar .nav").pin({
            //containerSelector: ".container", //将某元素“钉”在容器内
            padding: {top: 60, bottom: 10},
            minWidth: 800  //在小尺寸的屏幕上禁用Pin效果
        })
    </script>

</div>

        <div class="col-sm-9 col-md-10 main">
            
    <ol class="breadcrumb">
        <li><a href="">首页</a></li>
        <!-- <li class="active"><a href="<?php echo U('user/info');?>">个人信息</a></li> -->
    </ol>
    <form class="form-horizontal" action="/Index/updateAdmin" method="post">
        <div class="form-group">
            <label for="inputUsername" class="col-sm-2 control-label">账号</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputUsername" name="username" placeholder="账号" required value="<?php echo ($item["username"]); ?>" <?php if(!empty($item["username"])): ?>disabled<?php endif; ?> >
            </div>
        </div>
        <div class="form-group" style="margin-bottom: 50px;">
            <label for="inputPassword" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input type="password"  style="display:none"/>
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="若修改密码，请输入新密码!" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" name="name" placeholder="姓名" required value="<?php echo ($item["name"]); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="邮箱" value="<?php echo ($item["email"]); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputMobile" class="col-sm-2 control-label">电话</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputMobile" name="mobile" pattern="^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$" placeholder="手机号" value="<?php echo ($item["mobile"]); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
        <<input type="hidden" name="id" value="<?php echo ($item["id"]); ?>">
    </form>


        </div>
        
        <div style="text-align: center;margin-top: 30px">
    <span><?php echo getSignValue('WEBSITE_BRAND');?></span>
</div>
    </div>
</div>

</body>
</html>
<!--admin_base-->