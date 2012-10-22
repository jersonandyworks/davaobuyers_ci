<?php
/**
 * 
 */
class Img_upload extends CI_Model
{

    public function upload_image_db($data)
    {
    	$this->db->insert('product_image',$data);
        
    }
    public function update_image_db($id,$data)
    {
        $this->db->where('item_id',$id);
        $this->db->update('product_image',$data);
    }	
}
