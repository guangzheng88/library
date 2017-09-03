$(function(){
    //列表全选
    $("#batch").click(function(){
        if(this.checked){
            $(".batch").prop('checked',true);
            this.title = '全不选';
        }else{
            $(".batch").prop ('checked',false);
            this.title = '全选';
        }
    });
    //列表排序
    $(".orderBy").click(function(){
        var fieldArr = $(this).attr("id").split("_");
        var orderByType = "asc";
        if( typeof $("#" + $(this).attr("id") + " span").attr("class") != 'undefined' )
            orderByType =  $.inArray( "glyphicon-sort-by-attributes-alt", $("#" + $(this).attr("id") + " span").attr("class").split(" ") ) > 0 ? "asc" : "desc";
        TPA.reHttpGet( fieldArr[1], orderByType);
    });
    //时间搜索清空
    $(".date-remove").click(function(){
        $(this).prev().val('');
    });
    //鼠标经过显示编辑
    $(".fieldEdit").parent("td").mouseover(function(){
        $(this).find(".fieldEdit").css("display","inline-block");
    });
    //鼠标经过隐藏编辑
    $(".fieldEdit").parent("td").mouseleave(function(){
        $(this).find(".fieldEdit").css("display","none");
    });
});
