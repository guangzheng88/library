<?php if (!defined('THINK_PATH')) exit();?>
<form class="form-horizontal" name="form" id="form" data-toggle="validator">
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">角色名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" name="name" placeholder="角色名称" required value="<?php echo ($item["name"]); ?>">
        </div>
    </div>
    <?php if(!empty($item['id'])): ?><input type="hidden" name="id" value="<?php echo ($item["id"]); ?>"><?php endif; ?>
    <div class="form-group">
        <label for="inputDescription" class="col-sm-2 control-label">角色描述</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="inputDescription" name="description" maxlength="200" placeholder="描述"><?php echo ($item["description"]); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="inputDescription" class="col-sm-2 control-label">选择权限</label>
        <div class="col-sm-10">
            <label class="checkbox-inline">
                <input type="checkbox" name="role[]" class="batch" value="<?php echo ($item["id"]); ?>"> <?php echo ($item["id"]); ?>
            </label>
        </div>
    </div>
</form>