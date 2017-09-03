/**
 * Created By DMP Dev.
 * User: gege
 * Date: 12-9-7
 * Time: 下午9:43
 * Description:
 */
(function($){
    var defaults = {
        nameInputId:null,
        codeInputId:null
    };
    var locLinkTemplate = '<li><a id="{id}" code="{code}" selectable="{selectable}" href="javascript:void 0">{name}</a></li>';
    $.locationSelector = function(webRoot, o) {
        if($.fn.popupBox == undefined) {alert("缺少组件dmp.popupbox"); return;}
        if(webRoot == undefined) webRoot = "";
        this.locationUrl = webRoot + '/admin/area/';
        this.lastSelected = null;//最近一次选中的省份节点
        this.options = $.extend({}, defaults,  o);
        this.box = new $.popupBox("正在加载数据...", {title:"选择居住地", url:this.locationUrl + 'show/', ajaxCallback:this.init, ajaxOpt:this});
        //this.init();
    }

    var $ls = $.locationSelector;
    $ls.fn = $ls.prototype = {locationSelector:"1.0"};
    $ls.fn.extend = $ls.extend = $.extend;
    $ls.fn.extend({
        init:function(self){
            $(".tags_area li").click(function(){
                $(this).parent().find(".now").removeClass("now");
                $(this).addClass("now");
            });
            $('#tag_hot_city').click(function(){self.requestLocations('hot', 1);});
            $('#tag_province').click(function(){self.requestLocations('china', 1);});
            $('#tag_oversea').click(function(){self.requestLocations('zone', 1);});
            self.requestLocations('hot', 1);
        },
        requestLocations:function(type, level) {
            var reqUrl = this.locationUrl + type + '/';
            var self = this;
            this.beforeRequest(level);
            $.getJSON(reqUrl, function(json){
                self.afterRequest(json, level);
            });
        },
        beforeRequest:function(level) {
            if(level == 1) $('#locationPanel2').hide();
            else $('#locationPanel2').show();
            $('#locationPanel' + level).html("正在加载数据...");
        },
        afterRequest:function(arr, level) {
            var ulEl = $("<ul></ul>");
            for(var i = 0; i < arr.length; i++) {
                var locItem = locLinkTemplate.replace(/{id}/, arr[i].id).replace(/{code}/, arr[i].code).replace(/{name}/, arr[i].name).replace(/{selectable}/, arr[i].selectable);
                var self = this;
                var item = $(locItem).appendTo(ulEl);
                item.find("a").click(function(e){self.selectLocation(e.currentTarget);})

            }
            $('#locationPanel' + level).html(ulEl);
            this.box.resetBoxPos();
        },
        selectLocation:function(target) {
            var selectable = $(target).attr("selectable");
            if(selectable == "0") {
                if(this.lastSelected != null) this.lastSelected.removeClass("now");
                this.lastSelected = $(target).parent().addClass("now");
                this.requestLocations($(target).attr("code"), 2);
            }
            else {
                if(this.options.nameInputId) $('#'+ this.options.nameInputId).val($(target).html());
                if(this.options.codeInputId) $('#'+ this.options.codeInputId).val($(target).attr("id"));
                this.box.closeBox('direct');;
            }

            return false;
        }
    });

})(jQuery);