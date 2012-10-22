<?php
class Product_category extends CI_Model{
   //this will add product category
   public function create_product_category($data)
   {
       $cat_name = $this->input->post('cat_name');
       $this->form_validation->set_rules('cat_name','category name','is_unique[products_category.cat_name]|required|trim|xss_clean');
       $this->form_validation->set_rules('cat_description','Category Description','required|trim|xss_clean');
       $this->form_validation->set_message('is_unique','%s: '.$cat_name.' is already exists');
       if($this->form_validation->run() == FALSE)
       {
           $data['categories'] = $this->view_product_category();
           $this->load->view('administrator/templates/category/template_add_category',$data);
          //redirect('administrator/category/create_category');
       }
       else{
           
           $this->db->insert('products_category',$data);
           $this->session->set_flashdata('create_category','Category,Successfully Added');
           redirect('administrator/category/create_category');
       }
           
   }
   //this will get the category and ready for editing
   public function edit_product_category($uri)
   {
       $this->db->where('cat_id',$uri);
       $this->db->or_where('cat_uri',$uri);
       $query = $this->db->get('products_category');
       
       if($query->num_rows() == 1)
       {
           foreach ($query->result() as $row) {
               $data[] = $row;
           }
           return $data;
       }
       
   }
   
   //this will update the category selected
   public function update_product_category()
   {
       $data = array('cat_name'=>$this->input->post('cat_name'),
                              'cat_description'=>$this->input->post('cat_description'),
                              'cat_uri'=>underscore($this->input->post('cat_name')));
                              
       $this->db->where('cat_id',$this->input->post('hidden_cat_id'));
       $this->db->update('products_category',$data);
   }
   
   //this will delete the product category
   public function delete_product_category($value)
   {
       $this->db->where('cat_id',$this->uri->segment($value));
       $this->db->delete('products_category');
   }
   
   //this will delete the product category through INPUT with multiple selection
   public function delete_product_categories($data)
   {
       foreach($data as $input_category)
       {
           $this->db->where('cat_id',$this->input->post($input_category));
       $this->db->delete('products_category');
       }
       
   }
   
   //this will view all category
   public function view_product_category()
   {
       $this->db->order_by('cat_name');
       $query = $this->db->get('products_category');
       
       //check if there are rows returned
       if($query->num_rows() > 0)
       {
           foreach($query->result() as $row)
           {
               $data[] = $row;
           }
           return $data;
       }
   }
   //check if there is an id that exists
   public function check_category_id($id)
   {
       $this->db->where('cat_id',$id);
       $query = $this->db->get('products_category');
       if($query->num_rows() == 1)
       {
           return TRUE;
       }
       else {
           return FALSE;
       }
   }
   
}
