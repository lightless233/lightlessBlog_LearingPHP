<h2>Creaet a news item</h2>
<?php echo validation_errors(); ?> <!-- 报告表单验证中出现的错误信息 -->

<?php echo form_open('news/create') ?> <!-- 表单辅助函数   -->

<label for="title">Title</label>
<input type="input" name="title" /><br />

<label for="text">Text</label>
<textarea name="text"></textarea><br />

<input type="submit" name="submit" value="Create news item" />

</form>