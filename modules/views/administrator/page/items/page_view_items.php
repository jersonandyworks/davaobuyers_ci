<?php echo $this->session->flashdata('featured_exists');?>
<?php if(isset($categories)):?>
    <?php echo $this->session->flashdata('delete_item');?>
    <?php echo $this->session->flashdata('success_delete');?>
    <?php echo $this->session->flashdata('failed_delete');?>
    <?php echo form_open('administrator/items/delete_items');?>
    <?php foreach($categories as $row):?>
        <p><?php echo humanize($row->cat_name)?></p>
         <?php $items = $this->product_item->display_product_items('asc',$row->cat_id);?>
          <?php if(isset($items)):?>
              
            <ul>
                <?php foreach($items as $row):?>
                   
                    <li>
                        <input type="checkbox" name="items[]" value="<?php echo $row->item_id;?>">
                        <?php echo anchor('administrator/items/view_item/'.$row->item_uri,humanize($row->item_name))?> |    
                         <?php echo anchor('administrator/featured/add_this_product/'.$row->item_id,'(add featured product)');?> |
                        <?php echo anchor('administrator/items/edit_item/'.$row->item_uri,'(edit)');?> |
                        <?php echo anchor('administrator/items/delete_item/'.$row->item_uri,'(delete)');?>
                    </li>
                <?php endforeach;?>
            </ul>
            
            <?php else:?>
                <strong>No Products</strong>
                
            <?php endif;?>
     <?php endforeach;?>
     <br>
     <button name="delete_items">Delete</button>
<?php elseif(isset($get_items)):?>
    <?php foreach($get_items as $row):?>
        <?php if($row->img_raw_name !="" or $row->img_raw_name !=NULL):?>
        <p><img src="<?php echo base_url().'uploads/products/'.$row->img_raw_name.$row->img_file_ext;?>"></p>
        <?php endif;?>
        <p><span style="float: left; width:120px">Item Name:</span><?php echo humanize($row->item_name);?></p>
        <p><span style="float: left; width:120px">Item Price:</span><?php echo number_format($row->item_price,2);?></p>
       <p><span style="float: left; width:120px">Item Qty:</span><?php echo $row->item_qty?></p>
       <p><span style="float: left; width:120px">Description:</span><?php echo $row->item_description?></p>
       
    <?php endforeach;?>
    
   <?php echo form_close();?>
<?php else:?>
    <strong>No Records available or not a valid entry</strong>


<?php endif;?>
    <p>
    <?php echo anchor('administrator/items/create_product_item','Add New Product');?> |
     <?php echo anchor('administrator/items/view_product_items','View Products');?>
     
</p>


