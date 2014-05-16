<?php echo validation_errors(); ?>
<?php echo form_open('blog/submitArt'); ?>

<div style="color:blue"><h1 align=center>Create a new article</h1></div>

<h2 align=center>Article Title:</h2>
<div align=center>
<input type="input" name="title" autocomplete=off style="width:40%;height:30px" /><br><br>
<h2 align=center >content</h2>
<textarea type="input" name="content" autocomplete=off style="width:40%;height:150px;resize:none"></textarea><br><br>

<input type="submit" name="submit" value="submit"><br><br> 


</div>