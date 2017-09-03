<?php if (!defined('THINK_PATH')) exit();?>
<form class="form-horizontal" name="form" id="form" data-toggle="validator">
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">图书编号</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" name="number" placeholder="图书编号" required value="<?php echo ($item["number"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">图书名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="book_name" placeholder="图书名称" required value="<?php echo ($item["book_name"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">图书类别</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="category" placeholder="图书类别" required value="<?php echo ($item["category"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">作者</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="author" placeholder="作者" required value="<?php echo ($item["author"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">出版社</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="press" placeholder="出版社" required value="<?php echo ($item["press"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">出版日期</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="public_time" placeholder="出版日期" required value="<?php echo ($item["public_time"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">价格</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="price" placeholder="价格" required value="<?php echo ($item["price"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">馆藏总数</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="total_num" placeholder="馆藏总数" required value="<?php echo ($item["total_num"]); ?>">
        </div>
    </div>
    <?php if(!empty($item['id'])): ?><input type="hidden" name="id" value="<?php echo ($item["id"]); ?>"><?php endif; ?>
    <!-- <div class="form-group">
        <label for="inputDescription" class="col-sm-2 control-label">权限描述</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="inputDescription" name="description" maxlength="200" placeholder="描述,小于200字"><?php echo ($item["description"]); ?></textarea>
        </div>
    </div> -->
</form>