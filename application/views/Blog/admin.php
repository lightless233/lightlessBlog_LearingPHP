<br /><br/ >

<?php echo validation_errors(); ?>


<?php echo form_open('blog/admin_login'); ?>
<div align=center style="color:red">
	Hello lightless, Please login:<br><br>
	<label for="username">Username:</label>
	<input type="input" name="username" style="width:200px" />
	<br><br>
	<label for="password">Password:</label>
	<input type="password" name="password" style="width:200px" /><br />
	<br>
	<input type="submit" name="submit" value="login" />
</div>

<br /><br />