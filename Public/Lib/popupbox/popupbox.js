/**
 * 弹出层插件
 */
/**
 * 使用说明
 配置参数:
 {
 boxWidth:550,         //弹出box的宽度
 boxHeight:600,        //弹出box的高度，如果autoHeight为true则无效
 boxId:"pupupBox",   //弹出box的元素ID
 title:null,                 //标题栏标题 如果为null则没有标题栏，如果为""则有标题栏但是无显示文字
 closable:true,          //true现实关闭按钮，false则不显示
 draggable:false,      //能否被拖动 暂时没做后续需要再做
 border:10,              //边框宽度 现在固定为10暂不要动
 url:null,                  //如果url不为空则启动ajax请求向后台请求数据渲染
 method:"get",        //暂时只支持get方式
 autoHeight:true,    //设置为true就根据内容自动设置高度
 position:null          //暂时无用，后期可用于设定box的位置格式为{top:xxx, left:xxx}
 }

 使用方法
 1. 直接填充内容法
 页面没有可以利用的数据直接进行填充
 $.popupBox(内容,配置);
 例子
 $.popupBox("内容",{title:"提示", boxWidth:400});

 2. 页面内容填充法
 想直接显示页面某个元素内的内容可以用此方法
 $(elem).popupBox(配置)
 例子
 在页面上有一个元素<div id="testContent">xxxxxxxx</div>
 $('#testContent').popupBox({title:'提示', boxWidth:300});
 就会将xxxxxxx放在box里显示

 3. ajax法 （省略不介绍）

 注：内容不仅仅可以是普通文本也可以是html
 */

/**
 * 进行clip动画，对象元素在使用动画前必须要有clip属性设置
 */
(function($){
    $.fx.step.clip = function(fx){

        if ( fx.state == 0 || fx.state == undefined) {

            var cRE = /rect\(([0-9.]{1,})(px|em)[,]?[ ]?([0-9.]{1,})(px|em)[,]?[ ]?([0-9.]{1,})(px|em)[,]?[ ]?([0-9.]{1,})(px|em)\)/;

            fx.start = cRE.exec( fx.elem.style.clip.replace(/,/g, '') );
            fx.end = cRE.exec( fx.end.replace(/,/g, '') );

            fx.state = 1;
        }
        var sarr = new Array(), earr = new Array(), spos = fx.start.length, epos = fx.end.length,
            emOffset = fx.start[ss+1] == 'em' ? ( parseInt($(fx.elem).css('fontSize')) * 1.333 * parseInt(fx.start[ss]) ) : 1;
        for ( var ss = 1; ss < spos; ss+=2 ) { sarr.push( parseInt( emOffset * fx.start[ss] ) ); }
        for ( var es = 1; es < epos; es+=2 ) { earr.push( parseInt( emOffset * fx.end[es] ) ); }

        fx.elem.style.clip = 'rect(' +
            parseInt( ( fx.pos * ( earr[0] - sarr[0] ) ) + sarr[0] ) + 'px ' +
            parseInt( ( fx.pos * ( earr[1] - sarr[1] ) ) + sarr[1] ) + 'px ' +
            parseInt( ( fx.pos * ( earr[2] - sarr[2] ) ) + sarr[2] ) + 'px ' +
            parseInt( ( fx.pos * ( earr[3] - sarr[3] ) ) + sarr[3] ) + 'px)';
    }
})(jQuery);
/**
 * 将元素放至浏览器中央
 * @param position: center | rightBottom | leftBottom | {x:100, y:100}
 * @param elem
 */
function placeElement(position, elem) {
    var winObj = $(window);
    var browserWidth = winObj.width(); //浏览器的宽
    var browserHieght = winObj.height(); //浏览器的高
    var scrollLeft = winObj.scrollLeft(); //滚动条的横位置
    var scrollTop = winObj.scrollTop(); //滚动条的竖位置
    var selfWidth = elem.outerWidth(true); //这个元素的宽包括magin,padding
    var selfHeight = elem.outerHeight(true); //这个元素的高包括magin,padding

    var left;
    var top;
    //中间的窗口
    if (position == "center") {
        left = scrollLeft + (browserWidth - selfWidth) / 2; //获取左边的距离
        top = scrollTop + (browserHieght - selfHeight) / 2; //获取上边的距离
    } else if (position == "rigthBottom") {
        //右下角窗口
        left = scrollLeft + browserWidth - selfWidth;
        top = scrollTop + browserHieght - selfHeight;
    } else if ("leftBottom") {
        left = scrollLeft + 0;
        top = scrollTop + browserHieght - selfHeight;
    }
    else if (position && position instanceof Object) {
        left = position.left;
        top = position.top;
    }
    elem.css("position", "absolute").css("left", left).css("top", top);

}

(function($) {
    var boxTemplate = '<div id="{id}" style="left: 610px; top: 190px; z-index: 99999" class="popup_all"> \
                        <div id="panel-{id}" style="width: 220px; height: 100px; display: block;" class="popup"> \
                             {header} \
                            <div class="popup_content">{content}</div> \
                        </div> \
                    </div>';
    var titleTemplate = '<div class="popup_hd">\
                            {closeButton}\
                                <h2>{title}</h2>\
                         </div>';
    var closeButtonTemplate = '<a id="btnPopupClose" class="popup_close" href="javascript:void(0)"></a>';
    var overlayTemplate = '<div style="display: block;width:{width}px;height:{height}px" class="overlay"></div>';
    var defaults = {
        boxWidth:550,
        boxHeight:600,
        boxId:"pupupBox",
        title:null,
        closable:true,
        draggable:false,
        border:10,
        url:null,
        method:"get",
        autoHeight:true,
        position:null,
        ajaxCallback:null,
        ajaxOpt:null
    };
    $.fn.popupBox = function(o) {
        return new $.popupBox(this, o);
    }
    $.popupBox = function(e, o) {

        if(o == null || o == undefined) o = {};
        this.options = $.extend({}, defaults, o);
        if(document.getElementById(this.options.boxId)) return;

        if(typeof e == 'string') {
            this.content = e;
        } else {
            this.content = $(e).html();
        }

        this.box = null;
        this.boxPanel = null;
        this.overlay = null;
        this.init();
    }
    var $pb = $.popupBox;
    $pb.fn = $pb.prototype = {popupBox:"1.0"};
    $pb.fn.extend = $pb.extend = $.extend;
    $pb.fn.extend({
        init:function() {
            if(this.options.url != null) {
                this.loadContent();
            } else {
                this.openBox();
            }
        },
        loadContent:function() {
            //todo:only support get method now
            var self = this;
            var loadingHtml = boxTemplate.replace(/{id}/g, "popupLoading").replace(/{header}/, "").replace(/{content}/, "<p style='text-align: center'>正在加载数据...</p>");
            var loadingBox = $(loadingHtml).appendTo('body');
            $('#popupLoading').css('width', '240px').css('height', '100px');
            $('#panel-popupLoading').css('width', '220px').css('height', '80px');
            placeElement("center", loadingBox);
            $.get(this.options.url, function(data) {self.content = data; loadingBox.remove(); self.openBox();if(self.options.ajaxCallback){self.options.ajaxCallback(self.options.ajaxOpt);}});

        },
        openBox:function() {
            var titleHtml = "";
            if( this.options.title != null)
                titleHtml = titleTemplate.replace(/{title}/, this.options.title);
            if (this.options.closable)
                titleHtml = titleHtml.replace(/{closeButton}/, closeButtonTemplate);
            var boxHtml = boxTemplate.replace(/{id}/g, this.options.boxId).replace(/{header}/, titleHtml).replace(/{content}/, this.content);
            this.box = $(boxHtml).appendTo('body');
            if(document.getElementById("btnPopupClose")) {
                var self = this;
                $('#btnPopupClose').click(function(){self.closeBox();});
            }
            var boxId = "#" + this.options.boxId;
            var boxPanelId = "#panel-" + this.options.boxId;
            this.boxPanel = $(boxPanelId);
            this.box.css("width", this.options.boxWidth + this.options.border*2 + "px");
            $(boxPanelId).css("width", this.options.boxWidth + "px");
            if(this.options.autoHeight) {
                this.boxPanel.css("height", "auto");
                this.box.css("height", $(boxPanelId).height() + this.options.border*2 + "px");
            } else {
                this.box.css("height", this.options.boxHeight + this.options.border*2 + "px");
                this.boxPanel.css("height", this.options.boxHeight + "px");
            }
            this.overlay = $(overlayTemplate.replace(/{width}/, this.box.width()).replace(/{height}/, this.box.height())).appendTo(this.box);
            placeElement("center", this.box);
//            this.resetBoxPos();
            this.box.css("clip", "rect(0px " + this.box.css("width") + " " + this.box.css("height")   + " 0px)");

        },
        closeBox:function(effect) {
            if(this.box != null) {
                switch(effect) {
                    case "direct":
                        this.box.remove();
                        break;
                    default:
                        this.clipClose();

                }
            }
        },
        clipClose:function() {
            var self = this;
            var middleX = this.box.width() + "px";
            var middleY = this.box.height()/2 + "px";
            var rectTemplate = 'rect({middleY} {middleX} {middleY} 0px)';
            var rectStr = rectTemplate.replace(/{middleX}/g, middleX).replace(/{middleY}/g, middleY);
            this.box.animate({'clip':rectStr}, 300, function(){self.box.remove();})
        },
        resetBoxPos:function() {
            if(this.options.autoHeight) {
                this.box.css("height", this.boxPanel.height() + this.options.border*2 + "px")
                        .css("clip", "rect(0px " + this.box.css("width") + " " + this.box.css("height")   + " 0px)");
                this.overlay.css("height", this.box.css("height"))
                placeElement("center", this.box);
            } else {
                alert("box的高度已经被设定不能自动调节。")
            }

        }

    });
})(jQuery);