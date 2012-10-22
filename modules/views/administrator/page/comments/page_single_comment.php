<?php if(isset($single_comment)):?>
    <?php foreach($single_comment as $row):?>
        <?php 
        $this->load->helper('date');
        $date_posted = $row->comment_date;
        $now = time();
        $view_date = timespan($date_posted,$now);
        ?>
        <p><?php echo "Posted last ".$view_date." ago";?></p>
        <p>Commented on: <?php echo anchor('administrator/blog/view_post/'.$row->blog_uri,humanize($row->blog_title))?></p>
        <p><?php echo $row->comment_user?></p>
        <p><?php echo $row->comment_email?></p>
        <p><?php echo $row->comment_post?></p>
    <?php endforeach;?>
    <?php echo anchor('administrator/blog_comments/delete_comment/'.$row->comment_id,'Delete');?>   
<?php else:?>
    <p>Comment not found!</p> 
<?php endif;?>
<p><?php echo anchor('administrator/blog_comments','Back');?></p>
