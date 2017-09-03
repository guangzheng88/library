<?php if (!defined('THINK_PATH')) exit();?>
<form class="form-horizontal" name="form" id="form" data-toggle="validator">
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">账号</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" name="username" placeholder="账号" required value="<?php echo ($item["username"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" placeholder="姓名" required value="<?php echo ($item["name"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">电话</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="mobile" placeholder="电话" required value="<?php echo ($item["mobile"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="email" placeholder="邮箱" required value="<?php echo ($item["email"]); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="inputName" class="col-sm-2 control-label">角色</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="permissions_id" placeholder="角色" required value="<?php echo ($item["permissions_id"]); ?>">
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