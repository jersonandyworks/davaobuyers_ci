<?php
/**
 * 
 */
class Featured_products extends CI_Model{
	
    /*
     * this will add featured product
     * */
    public function add_single_product($uri)
    {
        /*check if there is an existing product if there is then return false*/
       $check_uri = $this->check_product($uri);
       if(! $check_uri)
       {
            $item_id = $this->uri->segment($uri);
            $data = array('item_id'=>$item_id);
            $this->db->insert('featured_products',$data);
            $this->session->set_flashdata('featured_added','Successfully added!');
            redirect('administrator/featured/');
       }
       else
           {
              $this->session->set_flashdata('featured_exists','The product is already on your featured product');
              redirect('administrator/items/view_product_items');
           }
    }
    /*
     * it lets you add more products
     * */
    public function add_mulitple_products()
    {
        $data = array('item_id'=>$this->input->post('hidden_item_id'));
        foreach ($data as $input) {
            $this->db->insert('featured_products',$data);
        }
    }
    /*
     * view all featured products
     * */
     public function the_products()
     {
         $this->db->select('*');
         $this->db->from('featured_products');
         $this->db->join('product_item','product_item.item_id = featured_products.item_id','left');
         $this->db->join('product_image','product_image.item_id = product_item.item_id','left');
         $this->db->order_by('product_item.item_name');
         $query = $this->db->get();
         
         if($query->num_rows() > 0)
         {
            foreach ($query->result() as $row) {
             $data[] = $row;
            }
            return $data; 
         }
         
     }
    /*
     * deletes single product
     * */
    public function remove_single_product($uri)
    {
        $this->db->where('fp_id',$this->uri->segment($uri));
        $this->db->delete('featured_products');
    }
    /*
     * deletes mulitple products
     * */
    public function remove_multiple_products()
    {
         $data = $this->input->post('featured_product');
       
        if($data)
        {
           foreach ($data as $input) {
            $this->db->where('fp_id',$input);
            $this->db->delete('featured_products');
            } 
             $this->session->set_flashdata('the_featured','Successfully Deleted');
             redirect('administrator/featured');
        }
        else {
            $this->session->set_flashdata('remove_no_select','No items selected');
            redirect('administrator/featured');
        }
         
       
           
    }
    
    private function check_product($uri)
    {
        $this->db->where('item_id',$this->uri->segment($uri));
        $query = $this->db->get('featured_products');
        
        if($query->num_rows() == 1)
        {
              return TRUE;  
        }
        else {
            return FALSE;
        }
        
    }
}
