<?php
if(isset($get_category))
{
    foreach($get_category as $row)
    {
       
        echo anchor('administrator/category/view_categories/',"Back<br>");
        
        
    }
    echo validation_errors();
    echo $this->session->flashdata('update_category');
    echo $this->session->flashdata('create_category');
    echo form_open('administrator/category/process_update')."\n";
    echo "<br>";
    $cat_input = array('name'=>'cat_name',
                       'id'=>'cat_name',
                       'value'=>$row->cat_name);
    $cat_desc = array('name'=>'cat_description',
                       'id'=>'cat_description',
                       'value'=>$row->cat_description);
    $cat_btn =   array('name'=>'update_category',
                       'id'=>'update_category',
                       'value'=>'Update Category');
     
    
                       
    echo form_input($cat_input)."<br>";
    echo form_textarea($cat_desc)."<br>";
   ?>
   <input type="hidden" name="hidden_cat_id" value="<?php echo $row->cat_id?>">
   <?php
    echo form_submit($cat_btn);
    echo form_close();
}
else {
	echo "Does not exists or not valid entry";
}
