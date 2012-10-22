<?php
class Category extends CI_Controller
{
    public function index()
    {
        $this->view_categories();
    }
    //this page is for creating categories
    public function create_category()
    {
              
        if(isset($_POST['add_category']))
        {
            $category_data['categories'] = $this->product_category->view_product_category();
            $data = array('cat_name'=>$this->input->post('cat_name'),
                          'cat_description'=>$this->input->post('cat_description'),
                          'cat_uri'=>underscore($this->input->post('cat_name'))
                          );
            $this->product_category->create_product_category($data);
           // redirect('administrator/category/create_category');
         
        }
        else {
            $data['categories'] = $this->product_category->view_product_category();
            $this->load->view('administrator/templates/category/template_add_category',$data);   
        }
    }
    public function view_categories()
    {
       $data['categories'] = $this->product_category->view_product_category();
       $this->load->view('administrator/templates/category/template_view_category',$data); 
    }
    //this will ready a category for editing
    public function edit_category($uri="",$process_update="")
    {
        $uri = $this->uri->segment(4);
        if(!empty($uri))
        {
            $data['get_category'] = $this->product_category->edit_product_category($uri);
            $this->load->view('administrator/templates/category/template_edit_category',$data);
        }
        else {
        	redirect('administrator/category/view_categories');
        }
        
       
    }
    //this will update the product
    public function process_update()
    {
        if(isset($_POST['update_category']))
        {
            
            $this->product_category->update_product_category();
            $this->session->set_flashdata('update_category','Successfuly Updated the category');
            redirect('administrator/category/edit_category/'.$this->input->post('hidden_cat_id')); 
            
        }
        else {
            redirect('administrator/category/view_categories');
        }
           
        
        
    }
    //this will delete the category selected
    public function delete_category($uri="")
    {
        if(!empty($uri))
        {
            echo $this->uri->segment(4);
            $this->product_category->delete_product_category(4);
            $this->session->set_flashdata('delete_message','Deleted Successfully');
            redirect('administrator/category/view_categories');
        }
        else {
            redirect('administrator/category/view_categories');
        }
    }
}
