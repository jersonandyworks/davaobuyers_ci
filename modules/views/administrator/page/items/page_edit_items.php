<!--check if the item exists---->
<?php if(isset($get_item)):?>
    
<p><?php echo validation_errors();?></p>
<?php echo $this->session->flashdata('update_item');?>
<p><?php echo $this->session->flashdata('item_add');?></p>
<?php echo form_open_multipart('administrator/items/process_update_item')."\n";?>
<?php foreach($get_item as $row):?>
<?php if($row->img_raw_name !="" or $row->img_raw_name !=NULL):?>
        <p><img src="<?php echo base_url().'uploads/products/'.$row->img_raw_name.$row->img_file_ext;?>"></p>
        <?php endif;?>
<strong>Select Category:</strong>

<?php if(isset($categories)):?>
<select name="cat_id">
    <?php foreach($categories as $row_cat):?>
    <option value="<?php echo $row_cat->cat_id;?>" <?php if($row->cat_id == $row_cat->cat_id):?>selected="selected"<?php endif;?>><?php echo humanize($row_cat->cat_name)?></option>
    <?php endforeach;?>
</select>
    
<br>
<?php endif;?>

<span style="float: left; width:120px">Product Name:</span><input name="item_name" value="<?php echo $row->item_name;?>" /><br>
<span style="float: left; width:120px">Price:</span> <input name="item_price" value="<?php echo $row->item_price;?>" /><br>
<span style="float: left; width:120px">Quantity:</span> <input name="item_qty" value="<?php echo $row->item_qty;?>" /><br>
<span style="float: left; width:120px">Discount:</span> <input name="item_discount" value="<?php echo $row->item_discount;?>" /><br>
<span style="float: left; width:120px">Description:</span> <textarea cols="21" rows="10" name="item_description"><?php echo $row->item_description;?></textarea><br>
<?php if($row->img_raw_name !=""  or $row->img_raw_name !=NULL):?>
<span style="float: left; width:120px">Change Image?:</span>Yes<input type="radio" name="change_image" value="yes" id="yes">No<input type="radio" name="change_image" value="no" id="no"><br>
<p id="hidden" style="display:none">
    Upload File: <input type="file" name="userfile"/>
</p>
<?php endif;?>
<input type="hidden"  name="hidden_item_id" value="<?php echo $row->item_id?>"/>
<input type="hidden"  name="hidden_item_uri" value="<?php echo $row->item_uri?>"/>
    <?php endforeach;?>
<input type="submit" name="update_product" value="Update Product">

<?php echo form_close();?>
<?php else:?>
    <strong>There is no item like this! please try again</strong>
<!--end checking if item exists---->
<?php endif;?>
<p>
    <?php echo anchor('administrator/items/view_product_items','View Items');?>
</p>