<?php if (!defined('THINK_PATH')) exit();?>
<form class="form-horizontal" name="form" id="form" data-toggle="validator">
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">权限名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" name="name" placeholder="权限名称" required value="<?php echo ($item["name"]); ?>">
        </div>
    </div>
    <?php if(!empty($item['id'])): ?><input type="hidden" name="id" value="<?php echo ($item["id"]); ?>"><?php endif; ?>
    <div class="form-group">
        <label for="inputDescription" class="col-sm-2 control-label">权限描述</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="inputDescription" name="description" maxlength="200" placeholder="描述"><?php echo ($item["description"]); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">类</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" name="class_name" placeholder="类" required value="<?php echo ($item["class_name"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">方法</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" name="function_name" placeholder="方法" required value="<?php echo ($item["function_name"]); ?>">
        </div>
    </div>
</form>