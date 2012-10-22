<?php echo $this->session->flashdata('delete_comment');?>
<?php if(isset($comments)):?>
    <?php echo form_open('administrator/blog_comments/delete_comments')?>
    <?php foreach($comments as $row):?>
        <p><input type="checkbox" name="the_comments[]" value="<?php echo $row->comment_id?>" /><?php echo word_limiter($row->comment_post,10).'...'?></p>
        <p><?php echo anchor('administrator/blog_comments/view_comment/'.$row->comment_id,'(view)')?></p>
    <?php endforeach;?>
    <button name="delete_comment">Delete</button>
    <?php echo form_close()?>
<?php else:?>
    <p>There is no comments</p>    
<?php endif;?>
<?php echo anchor('administrator/blog/view_blogs','Read Blogs')?>
<p></p>