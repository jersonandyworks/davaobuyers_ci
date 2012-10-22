<?php if(isset($blog_posts)):?>
    <?php echo form_open('administrator/blog/delete_posts');?>
    <?php foreach($blog_posts as $row):?>
    <?php 
        $this->load->helper('date');
        $date_posted = $row->blog_date;
        $now = time();
        echo "Date Posted: ".timespan($date_posted,$now);
    ?>
 
    <p><?php echo anchor('administrator/blog/view_post/'.$row->blog_uri,humanize($row->blog_title))?></p>
    <p><?php echo $row->blog_excerpt;?></p>
    <p>
        <input type="checkbox"  name="the_post[]" value="<?php echo $row->blog_id;?>"/>
        <?php echo anchor('administrator/blog/edit_post/'.$row->blog_uri,'(edit)')?> |
        <?php echo anchor('administrator/blog/delete_post/'.$row->blog_uri,'(delete)');?>
    </p>
    <hr>
    <?php endforeach;?>
    <button name="delete_post"/>Delete Posts</button>
    <?php echo form_close();?>
<?php else:?>
    <strong>No posts available</strong>
<?php endif;?>
<?php echo anchor('administrator/blog/create_blog_post','Post Blog');?>