<?php echo validation_errors();?>
<?php echo $this->session->flashdata('update_post');?>
<?php if(isset($the_post)):?>
<?php echo form_open('administrator/blog/update_post');?>
   <?php foreach($the_post as $row):?>
<p><span style="float: left; width:120px">Blog Title:</span><input type="text" name="blog_title" value="<?php echo $row->blog_title;?>"/></p>
<p><span style="float: left; width:120px">Blog Post:</span><textarea name="blog_content" rows="8"><?php echo $row->blog_content;?></textarea></p>
<input type="hidden" name="hidden_blog_id" value="<?php echo $row->blog_id;?>"/>
<button name="update_post">Post</button>
    <?php endforeach;?>
<?php echo form_close();?>
<?php else:?>
  <p>No post found!</p>
<?php endif;?>
<?php echo anchor('administrator/blog/view_blogs','<-back');?>