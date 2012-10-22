<?php if(isset($the_post)):?>
    <?php foreach($the_post as $row):?>
         <?php 
            $this->load->helper('date');
            $date_posted = $row->blog_date;
            $now = time();
            echo "Date Posted: ".timespan($date_posted,$now);
         ?>
        <p><?php echo humanize($row->blog_title);?></p>
        <p><?php echo $row->blog_content;?></p>
     <?php endforeach;?>
     <?php echo form_open('administrator/blog/post_comment')?>
     <p><span style="float:left;width:120px;">Name:</span><input type="text" name="comment_user"></p>
     <p><span style="float:left;width:120px;">Email:</span><input type="text" name="comment_email"></p>
     <p><span style="float:left;width:120px;">Website:</span><input type="text" name="comment_website"></p>
     <span style="float:left;width:120px;">Comment:</span><textarea name="comment_post" rows="8"></textarea><br>
     <input type="hidden" name="hidden_blog_id" value="<?php echo $row->blog_id?>">
     <input type="hidden" name="hidden_blog_uri" value="<?php echo $row->blog_uri?>">
     <button name="post_comment">Post Comment</button>
     <?php echo form_close();?>
     
     <!--start comments--->
     <?php 
     $comments = $this->comments->display_comments($row->blog_id);
     if(isset($comments)):?>
         <?php foreach($comments as $row_comment):?>
            <p><span style="float:left;width:120px;">Comment by:</span> <?php echo humanize($row_comment->comment_user);?></p>
            <p><span style="float:left;width:120px;">Email:</span> <?php echo $row_comment->comment_email;?></p>
            <p><span style="float:left;width:120px;">Website: </span><?php echo $row_comment->comment_website;?></p>
            <p><?php echo $row_comment->comment_post;?></p>
            <hr>
         <?php endforeach;?>
         <?php else:?>
             <p>Be the first to post!</p>
     <?php endif;?>
     <!--end comments--->
<?php else:?>
    <p>Page Not Found</p>    
<?php endif;?>
<?php echo anchor('administrator/blog/view_blogs','<-back');?>
