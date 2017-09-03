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
        function openNew(){
            var options = {
                contentUrl:'<?php echo U("Book/detail");?>',
                confirmUrl:'<?php echo U("Book/addBook");?>',
                title:'添加图书',
                formName:'form'
            };
            TPA.dialog(options);
        }
        function edit( id ){
            var options = {
                contentUrl:'<?php echo U("Book/detail");?>',
                contentData:{id:id},
                confirmUrl:'<?php echo U("Book/updateBook");?>',
                confirmData:{id:id},
                title:'修改图书',
                formName:'form'
            };
            TPA.dialog(options);
        }
        function enabledSwitch( id, status ){
            var options = {
                idValue:id,
                switchValue:status,
                confirmUrl:'<?php echo U("role/serviceEnabledSwitch");?>'
            };
            TPA.enabledSwitch(options);
        }
        function deleteBook(id)
        {
            if(confirm('确定删除吗？'))
            {
                var url = '/Book/deleteBook/id/'+id;
                window.location.href = url;
            }
        }
    </script>
    <style type="text/css">
    .row a,.current{margin-left:5px;}
    .danger,.table th{text-align:center;}
    </style>

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
            <a id="left_role_role_id" class="navbar-none" href="/Permissions/roleList">
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
        <li><a href="/">首页</a></li>
        <li class="active"><a href="<?php echo U('Book/bookList');?>">图书列表</a></li>
    </ol>
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-6">
            <button class="btn btn-success" title="增加" onclick="openNew()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
        </div>
        <div class="col-md-6 text-right">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <!--标题-->
            <thead>
                <tr>
                    <th> <label class="checkbox-inline">ID</label></th>
                    <th><label class="checkbox-inline">图书编号</label></th>
                    <th><label class="checkbox-inline">图书名称</label></th>
                    <th><label class="checkbox-inline">图书类别</label></th>
                    <th><label class="checkbox-inline">作者</label></th>
                    <th><label class="checkbox-inline">出版社</label></th>
                    <th><label class="checkbox-inline">出版日期</label></th>
                    <th><label class="checkbox-inline">价格</label></th>
                    <th><label class="checkbox-inline">馆藏总数</label></th>
                    <th><label class="checkbox-inline">操作</label></th>
                </tr>
                </thead>
            <!--标题 end-->
            <tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr class="<?php if(empty($item["enabled"])): ?>danger<?php endif; ?>">
                    <td>
                        <label class="checkbox-inline"> <?php echo ($item["id"]); ?> </label>
                    </td>
                    <td><?php echo ($item["number"]); ?></td>
                    <td><?php echo ($item["book_name"]); ?></td>
                    <td><?php echo ($item["category"]); ?></td>
                    <td><?php echo ($item["author"]); ?></td>
                    <td><?php echo ($item["press"]); ?></td>
                    <td><?php echo ($item["public_time"]); ?></td>
                    <td><?php echo ($item["price"]); ?></td>
                    <td><?php echo ($item["total_num"]); ?></td>
                    <td>
                        <a href="javascript:edit(<?php echo ($item["id"]); ?>)" title="编辑"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                        <a href="javascript:;" title="删除" onclick="deleteBook(<?php echo ($item["id"]); ?>)"><span class="glyphicon glyphicon-off text-danger" aria-hidden="true"></span></a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php if(empty($list)): ?><tr>
                    <td colspan="10" style="text-align:center;height:200px;line-height:200px;">暂无数据！</td>
                </tr><?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="row"><?php echo ($page); ?></div>

        </div>
        
        <div style="text-align: center;margin-top: 30px">
    <span><?php echo getSignValue('WEBSITE_BRAND');?></span>
</div>
    </div>
</div>

</body>
</html>
<!--admin_base-->