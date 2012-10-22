<?php
class Product_item extends CI_Model
{
    //this will insert product to the product_item table
    public function create_product_item($data)
    {
        $this->form_validation->set_rules('item_name','Product Name','required|trim|xss_clean');
        $this->form_validation->set_rules('item_description','Description','trim|xss_clean');
        $this->form_validation->set_rules('item_price','Item Price','trim|xss_clean');
        $this->form_validation->set_rules('item_discount','Description','trim|xss_clean');
        $this->form_validation->set_rules('item_qty','Quantity','trim|xss_clean');
        $this->form_validation->set_rules('item_status','Status','trim|xss_clean');
        
        //check if there are errors while submitting the form 
        if($this->form_validation->run() == FALSE)
        {
            //this will prompt an error
            //$data['items'] = $this->display_product_items();
            $this->load->view('administrator/templates/items/template_add_items');
        }
        else
            {
                
                $this->db->insert('product_item',$data);
                $this->image_upload->process_upload();                   
                $this->session->set_flashdata('item_add','Item Successfully Added');
                redirect('administrator/items/create_product_item');
                
            }
    }
    
    //this will view all product items in the database, by default it sorts by name on ascending order
    public function display_product_items($sort='asc',$id)
    {
        $this->db->select('*');
        $this->db->from('product_item');
        $this->db->join('featured_products','featured_products.item_id = product_item.item_id','left');
        $this->db->join('product_image','product_image.item_id = product_item.item_id','left');
        $this->db->join('products_category','products_category.cat_id = product_item.cat_id','left');
        $this->db->where('products_category.cat_id',$id);
        $this->db->order_by('product_item.item_name');
        $query = $this->db->get();
        
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;   
            }
            return $data;
        }
         
    }
    
    //this will view all products on as certain set category by URI
    public function display_URL_product_items_by_category($uri)
    {
        $this->db->select('*');
        $this->db->from('product_item');
        $this->db->join('products_category','products_category.cat_id = product_item.cat_id');
        $this->db->join('product_image','product_image.item_id = product_item.item_id','left');
        $this->db->where('products_category.cat_uri',$this->uri->segment($uri));
        $this->db->order_by('product_item.item_name');
        $query = $this->db->get();
        
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    
    //this will view all products on as certain set category by INPUT
    public function display_INPUT_product_items_by_category($input)
    {
        $this->db->select('*');
        $this->db->from('product_item');
        $this->db->join('product_category','product_category.cat_id = product_item.cat_id');
        $this->db->join('product_image','product_image.item_id = product_item.item_id','left');
        $this->db->where('product_category.cat_uri',$input);
        $this->db->order_by('product_item.item_name');
        $query = $this->db->get();
        
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    //this will ready an item  for editing
    public function get_product_item($uri)
    {
        
        $this->db->select('*');
        $this->db->from('product_item');
        $this->db->join('product_image','product_image.item_id = product_item.item_id','left');
        $this->db->where('product_item.item_id',$uri);         
        $this->db->or_where('product_item.item_uri',$uri);
        
        $query = $this->db->get();
        
        //check if there is a row returned
        if($query->num_rows() == 1)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    //this will search an item
    public function search_items($keyword)
    {
        $this->db->select('*');
        $this->db->from('product_item');
        $this->db->join('product_image','product_image.item_id = product_item.item_id','left');
        $this->db->like('product_item.item_name',$keyword);
        $this->db->or_like('product_item.item_description',$keyword);
        $this->db->or_like('product_item.item_uri',$keyword);
        $this->db->or_like('product_item.item_price',$keyword);
        $query = $this->db->get();
        
         if($query->num_rows() >= 1)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    //this will update an item 
    public function update_product_item()
    {
        //check if there is no error
        $this->form_validation->set_rules('item_name','Product Name','required|trim|xss_clean');
        $this->form_validation->set_rules('item_description','Description','trim|xss_clean');
        $this->form_validation->set_rules('item_price','Item Price','trim|xss_clean');
        $this->form_validation->set_rules('item_discount','Description','trim|xss_clean');
        $this->form_validation->set_rules('item_qty','Quantity','trim|xss_clean');
        $this->form_validation->set_rules('item_status','Status','trim|xss_clean');
        
        //check if there are errors while submitting the form 
        if($this->form_validation->run() == FALSE)
        {
            //this will prompt an error
            //$this->load->view('');
        }
        else
            {
                $data = array('item_name'=>$this->input->post('item_name'),
                              'item_price'=>$this->input->post('item_price'),
                              'item_discount'=>$this->input->post('item_discount'),
                              'item_description'=>$this->input->post('item_description'),
                              'item_qty'=>$this->input->post('item_qty'),
                              'cat_id'=>$this->input->post('cat_id'),
                              'item_uri'=>underscore($this->input->post('item_name')));
                              
                $this->db->where('item_id',$this->input->post('hidden_item_id'));
                $this->db->or_where('item_uri',$this->input->post('hidden_item_uri'));
                $this->db->update('product_item',$data);
                
                $change_img = $this->input->post('change_image');
   
            }
        
        
    }
    
    //this will delete an item throuch URI
    public function delete_URL_product_item($uri)
    {
        $this->db->where('item_uri',$this->uri->segment($uri));
        $this->db->delete('product_item');
    }
    
    //this will delete an item through INPUT with multiple selection
    public function delete_multiple_items()
    {
        $data = $this->input->post('items');
        if($data)
        {
            foreach($data as $input_selection)
            {
            $this->db->where('item_id',$input_selection);
            $this->db->delete('product_item');
            }
            $this->session->set_flashdata('success_delete','Successfully Deleted!');
            redirect('administrator/items/view_product_items');
        }
        else {
            $this->session->set_flashdata('failed_delete','Failed on Deletion!');
            redirect('administrator/items/view_product_items');
        }
        
    }
}
