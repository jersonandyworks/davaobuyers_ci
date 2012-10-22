<?php echo form_open_multipart('administrator/items/process_search')?>
<span style="float: left; width:120px">Upload Image:</span> <input type="file" name="userfile" size="15"/><br>
<input type="submit" name="upload" value="Add Product">
<br>
<input type="text" name="keyword" value="<?php echo set_value('keyword')?>" size="25"/>
<input type="submit" name="search" value="Search">
<?php echo form_close();?>

<?php if(isset($_POST['search'])):?>
    <?php if(isset($search_results)):?>
        <?php foreach($search_results as $row):?>
            <p><?php echo anchor('administrator/items/edit_item/'.$row->item_uri,$row->item_name);?> - <?php echo number_format($row->item_price,2)?></p>
            <?php endforeach;?>
    <?php else:?>
        <p>I can't Find It! Sorry, please try again</p>
    <?php endif;?>
<?php endif;?>