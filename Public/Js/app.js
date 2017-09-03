/**
 * Created by gege on 16/1/6.
 */
TPA = {
    httpGet:function(url, params, callback) {
        url = TPA.apiHost + url;
        $.get(url, params, callback);
    },
    /**
     *
    TPA.httpPost('{-:U("goods/statusSwitch")-}',{id:id, status:status},function(data){
        if(data.success) {
            window.location.reload();
        } else {
            TPA.alert('错误提示',data.errorDesc);
        }
    });
     * */
    httpPost:function(url, params, callback) {
        url = TPA.apiHost + url;
        $.post(url, params, callback);
    },
    apiHost:window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port: ''),
    /**
    TPA.confirm('确认xx吗?',function(result){
        if(result){

        }
    });
     * */
    confirm:function(message, callback) {
        bootbox.confirm({title:'提示', message:message, callback:callback, locale:'zh_CN'});
    },
    alert:function(title, message, callback) {
        bootbox.alert({title:title, message:message, callback:callback, locale:'zh_CN'});
    },
    overlayUpdateSuccess:function(overlay, onhide) {
        if(typeof onhide == 'undefined')
            onhide = function() {};
        overlay.update({
//            icon: "/Public/Images/check.png",
            icon: "",
            text: "操作成功"
        });
        window.setTimeout(function() {
            overlay.hide();
            onhide();
        }, 500);

    },
    overlayUpdateError:function(overlay,errorMessage) {
        if(typeof errorMessage == 'undefined')
            errorMessage = '操作失败';
        var icon = '';
        /*if( errorMessage.length <= 12 ){
            icon = '/Public/Images/cross.png';
        }else if(errorMessage.length <= 24){
            icon = '/Public/Images/cross_sm.png';
        }*/
        overlay.update({
            icon: icon,
            text: errorMessage
        });
        window.setTimeout(function() {
            overlay.hide();
        }, 1500);
    },
    overlayLoading:function() {
        var opts = {
            lines: 13, // The number of lines to draw
            length: 11, // The length of each line
            width: 5, // The line thickness
            radius: 17, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 0, // The rotation offset
            color: '#FFF', // #rgb or #rrggbb
            speed: 1, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: true, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 'auto', // Top position relative to parent in px
            left: 'auto' // Left position relative to parent in px
        };
        var target = document.createElement("div");
        document.body.appendChild(target);
        var spinner = new Spinner(opts).spin(target);
        return iosOverlay({
            text: "处理中",
            spinner: spinner
        });
    },
    /**
     * options:
     * title 对话框的标题 必填
     * contentUrl 加载的页面URL 必填
     * confirmUrl 点击确定时调用的URL 必填
     * formName 加载页面上的form名称 必填
     * contentData   在获取页面时跟随URL提交的数据 选填
     * confirmData   在点击确定按钮提交时一起提交的数据 选填
     * buttons 如果想自己构建按钮可以自己设定按钮及点击时间 选填
     * closeForceRefresh true
     * modalSize default 缺省大小 large 大
     * confirmReload true 点击确定按钮后重新加载对话框内容
     * onClose 关闭时候调用的函数
     * 示例
    var options = {
        contentUrl:'{-:U("role/detail")-}',
        contentData:{id:id},
        confirmUrl:'{-:U("role/serviceEditSave")-}',
        confirmData:{id:id},
        title:'修改角色',
        formName:'form'
    };
    TPA.dialog(options);
     * @param options
     */

    dialog:function(options) {
        if(typeof options.contentUrl == 'undefined') {
            alert("请填写内容地址");
            return;
        }
        var popupDialog;
        var isPostConfirm = typeof options.confirmUrl != 'undefined';
        var buttons = {};
        var requestParams = {};

        if(isPostConfirm) {
            buttons = {
                confirm: {
                    label: "确定",
                    className: "btn-primary",
                    callback: function() {
                        if(isPostConfirm) {
                            var $form = $('#' + options.formName);
                            var validator = $form.validator('validate').data('bs.validator');
                                if (!validator.hasErrors()) {
                                    var params = $form.serializeObject();
                                    if(typeof options.confirmData != 'undefined')
                                        params = $.extend({}, params, options.confirmData);
                                    var overlay = TPA.overlayLoading();
                                    TPA.httpPost(options.confirmUrl, params, function(data){
                                        if(data.success) {
                                            if( typeof data.item != 'undefined' ){
                                                popupDialog.modal('hide');
                                                TPA.overlayUpdateSuccess(overlay,function(){
                                                    TPA.alert('提示:',data.item,function(){
                                                        window.location.reload();
                                                    });
                                                });

                                            }else{
                                                if(options.confirmReload) {
                                                    TPA.overlayUpdateSuccess(overlay);
                                                } else
                                                    TPA.overlayUpdateSuccess(overlay, function(){
                                                        if(typeof options.onClose == 'function') {
                                                            options.onClose();
                                                        } else
                                                            window.location.reload();
                                                    });
                                                if(options.confirmReload) {
                                                    YH.httpGet(options.contentUrl, requestParams, function(data) {
                                                        var body = popupDialog.find(".modal-body");
                                                        body.find(".bootbox-body").html(data);
                                                    });
                                                } else { //当前页面不关闭同时刷新当前页面内容
                                                    popupDialog.modal('hide');
                                                }
                                            }
                                        } else {
                                            TPA.overlayUpdateError(overlay, data.errorDesc);
                                        }
                                    });
                                }
                            //})

                            return false;
                        }

                    }
                },
                cancel: {
                    label: "取消",
                    className: "btn-default",
                    callback: function() {

                    }
                }
            }
        }
        else {
            buttons = {
                cancel: {
                    label: "关闭",
                    className: "btn-default",
                    callback: function() {
                        if(typeof options.closeForceRefresh != 'undefined' && options.closeForceRefresh) {
                            window.location.reload();
                        }
                    }
                }
            }
        }

        if(typeof options.buttons != 'undefined') {
            buttons = $.extend({}, buttons, options.buttons);
        }

        if(typeof options.contentData != 'undefined')
            requestParams = $.extend({}, requestParams, options.contentData);
        TPA.httpGet(options.contentUrl, requestParams, function(data) {
            if( typeof data.success != 'undefined' && data.success == false ){
                var overlay = TPA.overlayLoading();
                TPA.overlayUpdateError(overlay, data.errorDesc);
                return false;
            }
            var o = {
                message: data,
                title: options.title,
                buttons:buttons
            };
            if(typeof options.modalSize != 'undefined' && options.modalSize == 'large') {
                o['size'] = 'large';
            }
            popupDialog = bootbox.dialog(o);
        });
    },
    /**
     * 单个或批量解锁，锁定功能
     * @param options
     * idValue : 必填,-单个-锁定解锁的数据ID;-批量-全选的input id和数据input的class
     * switchValue : 必填,0=>要锁定,1=>要解锁
     * confirmUrl : 必填,请求链接
     * @returns {boolean}
     */
    enabledSwitch:function(options){
        if( typeof options.idValue == 'undefined' || typeof options.switchValue == 'undefined' || typeof options.confirmUrl == 'undefined' ){
            TPA.alert('提示', '请求数据错误！');
            return false;
        }
        var rg = /^[0-9]*[1-9][0-9]*$/;
        if( rg.test( options.idValue) ){ //是正整数
            var id = options.idValue;
        }else{ //不是数字
            if( typeof $("#" + options.idValue).attr('type') == 'undefined' || $("#" + options.idValue).attr('type') != 'checkbox' ){  // 不是input[type=checkbox]
                TPA.alert('提示', '请求数据错误！');
                return false;
            }
            var ids = [];
            $("." + options.idValue + ":checked").each(function(){
                ids.push(this.value);
            });
            var id = ids.join(',');
            if( id == '' ){
                TPA.alert('提示','未选中数据!');
                return false;
            }
        }
        var text = options.switchValue == 1 ? '确认要解锁?' : '确认要锁定?';
        if( confirm(text) ){
            TPA.httpPost(options.confirmUrl,{id:id, status: options.switchValue },function(data){
                if(data.success) {
                    window.location.reload();
                } else {
                    TPA.alert('错误提示',data.errorDesc);
                    return false;
                }
            });
        }
        return true;
    },
    /**
     * 列表排序
     * /www/tp/Public/Js/global-function.js
     * @param field
     * @param orderByType
     * @returns {boolean}
     */
    reHttpGet:function(field, orderByType){
        if( typeof field == "undefined" || typeof orderByType == "undefined"){
            TPA.alert('提示', '请求数据错误！');
            return false;
        }
        var url = window.location.href;
        var urlArr = url.split("?");
        var paramArr = [];
        if(typeof urlArr[1] == "undefined"){
            paramArr[0] = "obn=" + field;
            paramArr[1] = "obt=" + orderByType;
        }else{
            var isChangeField = false;
            var isChangeType = false;
            paramArr = urlArr[1].split("&");
            $.each(paramArr,function(i,val){
                if( val != '' ){
                    if( val == "obn=" + field ){
                        isChangeField = true;
                        return true;
                    }
                    if( val == "obt=" + orderByType ){
                        isChangeType = true;
                        return true;
                    }
                    var params = val.split("=");
                    if( params[0] == "obn" ){
                        paramArr[i] = "obn=" + field;
                        isChangeField = true;
                        return true;
                    }
                    if( params[0] == "obt" ){
                        paramArr[i] = "obt=" + orderByType;
                        isChangeType = true;
                        return true;
                    }
                }
            });
            if( !isChangeField )
                paramArr.push("obn=" + field);
            if( !isChangeType )
                paramArr.push("obt=" + orderByType);
        }
        window.location.href = urlArr[0] + '?' + paramArr.join("&");
    },
    /**
     * 把form内表单转成name=>key
     * options.formName  加载页面上的form名称 必填
     * options.confirmUrl 处理地址 必填
     * options.confirmData 在点击确定按钮提交时一起提交的数据 选填
     * options.confirmReload false|true 点击确定按钮后重新加载
     * options.locationUrl 点击确定按钮后加载
     * options.locationData 点击确定按钮后加载参数
     * onClose 关闭时候调用的函数
     * 示例

     <form class="form-horizontal" id="userForm" data-toggle="validator" onsubmit="return false;" role="form">
         <div class="form-group">
         <label>名称</label>
         <input class="form-control" type="text" name="name" required value="{-$item.name-}">
         <div class="help-block with-errors"></div>
         </div>
         <div class="form-group">
         <label class="col-sm-2 control-label">点击量</label>
         <div class="col-sm-5">
         <input type="number" class="form-control" name="clickRate" placeholder="点击量" value="{-$item.clickRate-}">
         </div>
         <div class="help-block with-errors col-sm-5"></div>
         </div>
     </form>
     var options = {
            confirmUrl:'{-:U("module/detail")-}',
            confirmData:{key:value},
            confirmReload:true,
            locationUrl:'',
            locationData:{id:''},  // 一维json,if(value==''){value==data.item.id}
            formName:'userForm',
            onClose:function(){
               fun();
            }
        };
     TPA.formValues(options);
     */
    formValues:function( options ){
        var requestParamsString = '';
        var $form = $('#' + options.formName);
        var validator = $form.validator('validate').data('bs.validator');
        if (!validator.hasErrors()) {
            var params = $form.serializeObject();
            if(typeof options.confirmData != 'undefined')
                params = $.extend({}, params, options.confirmData);
            var overlay = TPA.overlayLoading();
            TPA.httpPost(options.confirmUrl, params, function(data){
                if(data.success) {
                    if( typeof data.item == 'string' ){
                        TPA.overlayUpdateSuccess(overlay,function(){
                            TPA.alert('提示:',data.item,function(){
                                window.location.reload();
                            });
                        });

                    }else{
                        TPA.overlayUpdateSuccess(overlay, function(){
                            if( options.confirmReload ){
                                if(typeof options.locationUrl != 'undefined') {
                                    if(typeof options.locationData != 'undefined'){
                                        requestParams = JSON.stringify(options.locationData);
                                        $.each(options.locationData,function(key,ele){
                                            if( ele == '' || ele == '0')
                                                requestParamsString += '?'+key+'='+data.item[key];
                                            else
                                                requestParamsString += '?'+key+'='+ele;
                                        });
                                    }
                                    window.location.href = TPA.apiHost + options.locationUrl + requestParamsString;
                                } else{
                                    window.location.reload();
                                }
                            }
                            if(typeof options.onClose == 'function') {
                                options.onClose();
                            }
                        });
                    }
                } else {
                    TPA.overlayUpdateError(overlay, data.errorDesc);
                }
            });
        }
    }
}