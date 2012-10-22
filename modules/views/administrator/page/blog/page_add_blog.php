<?php echo validation_errors();?>
<?php echo $this->session->flashdata('post_blog');?>
<?php echo form_open('administrator/blog/create_blog_post');?>
<p><span style="float: left; width:120px">Blog Title:</span><input type="text" name="blog_title" value="<?php echo set_value('blog_title');?>"/></p>
<p><span style="float: left; width:120px">Blog Post:</span><textarea name="blog_content" rows="8"></textarea></p>
<button name="post_blog">Post</button>
<?php echo form_close();?>
<?php echo anchor('administrator/blog/view_blogs','<-back');?>