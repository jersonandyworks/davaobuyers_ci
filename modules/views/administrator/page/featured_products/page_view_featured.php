<?php echo  $this->session->flashdata('the_featured');?>
<?php echo  $this->session->flashdata('featured_added');?>
<?php echo  $this->session->flashdata('remove_no_select');?>

<?php if(isset($the_featured)):?>
    <?php echo form_open('administrator/featured/remove_products')?>
    <?php foreach($the_featured as $row):?>
        
        <img src="<?php echo base_url().'uploads/products/'.$row->img_raw_name.$row->img_file_ext?>" width="150" height="150"/>
        <p><?php echo humanize($row->item_name)?></p>
        <p>
            <input type="checkbox" name="featured_product[]" value="<?php echo $row->fp_id?>"/>
            <?php echo number_format($row->item_price,2)?></p>
        <hr>
    <?php endforeach;?>
    <button name="remove_products">Remove</button>
    <?php echo form_close();?>
<?php else:?>
    <p>No Featured products yet!</p>    
<?php endif;?>