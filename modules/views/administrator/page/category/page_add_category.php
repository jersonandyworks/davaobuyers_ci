<?php
/*
 * this is a add category page template
 * 
 * */
if(isset($categories))
{
    foreach($categories as $row)
    {
        echo anchor('administrator/category/edit_category/'.$row->cat_uri,$row->cat_name)."<br>";
    }
}
else {
	echo "no records to pull";
}

echo validation_errors();
echo $this->session->flashdata('create_category');
echo form_open('administrator/category/create_category')."\n";
echo "<br>";
$cat_input = array('name'=>'cat_name',
                   'id'=>'cat_name',
                   'value'=>set_value('cat_name'));
$cat_desc = array('name'=>'cat_description',
                   'id'=>'cat_description',
                   'value'=>set_value('cat_description'));
$cat_btn =   array('name'=>'add_category',
                   'id'=>'add_category',
                   'value'=>'Add Category');                                  
echo form_input($cat_input)."<br>";
echo form_textarea($cat_desc)."<br>";
echo form_submit($cat_btn);
echo form_close();
echo anchor('administrator/category/view_categories','View Categories');
