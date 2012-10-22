<p><?php echo validation_errors();?></p>
<p><?php echo $this->session->flashdata('item_add');?></p>
<?php if(isset($error_upload)) echo $error_upload;?>
<?php echo form_open_multipart('administrator/items/create_product_item')."\n";?>
<strong>Select Category:</strong>
<?php if(isset($categories)):?>
<select name="cat_id">
    <?php foreach($categories as $row):?>
    <option value="<?php echo $row->cat_id?>"><?php echo humanize($row->cat_name)?></option>
    <?php endforeach;?>
</select>
<br>
<?php endif;?>
<span style="float: left; width:120px">Product Name:</span><input name="item_name" value="<?php set_value('item_name');?>"/><br>
<span style="float: left; width:120px">Price:</span> <input name="item_price" value="<?php set_value('item_price');?>" /><br>
<span style="float: left; width:120px">Quantity:</span> <input name="item_qty" value="<?php set_value('item_qty');?>" /><br>
<span style="float: left; width:120px">Discount:</span> <input name="item_discount" value="<?php set_value('item_discount');?>" /><br>
<span style="float: left; width:120px">Description:</span> <textarea cols="21" rows="10" name="item_description"></textarea><br>
<span style="float: left; width:120px">Upload Image:</span> <input type="file" name="userfile" size="15"/><br>
<input type="submit" name="add_product" value="Add Product">

<?php echo form_close();?>
<p>
    <?php echo anchor('administrator/items/view_product_items','View Items');?>
</p>