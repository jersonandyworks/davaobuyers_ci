<?php
if(isset($categories))
{
   echo $this->session->flashdata('delete_message');
   echo "<br>";
    
    foreach ($categories as $row) {
        
        echo anchor('administrator/category/edit_category/'.$row->cat_id,humanize($row->cat_name))."-".$row->cat_uri;
        echo anchor('administrator/category/delete_category/'.$row->cat_id,'[delete]')."<br>";
    }
}
else {
	echo "No Records to pull<br>";
}
echo anchor('administrator/category/create_category','Add New Category');