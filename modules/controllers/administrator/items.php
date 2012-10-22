<?php
class Items extends CI_Controller
{
    public function index($value='')
    {
        $this->load->view('administrator/templates/items/template_upload_items');
    }
    public function upload()
    {
        if(isset($_POST['upload']))
        {
            $error = $this->image_upload->process_upload();
            if($error)
            {
                echo $error;
            }
        }
        else {
            redirect('administrator/items/');
        }
    }
    //this will add new product
    public function create_product_item()
    {
        if(isset($_POST['add_product']))
        {
            $data = array('item_name'=>$this->input->post('item_name'),
                          'item_uri'=>underscore($this->input->post('item_name')),
                          'item_description'=>$this->input->post('item_description'),
                          'item_price'=>$this->input->post('item_price'),
                          'item_discount'=>$this->input->post('item_discount'),
                          'item_qty'=>$this->input->post('item_qty'),
                          'item_status'=>1,
                          'cat_id'=>$this->input->post('cat_id'));
            
            $this->product_item->create_product_item($data);
                                
        }
        else {
            $data['categories'] = $this->product_category->view_product_category();
            $this->load->view('administrator/templates/items/template_add_items',$data);
            
        }
    }
    //this will view all categories and it will let you select a cateogry to view all items
    public function view_product_items($uri='')
    {
        
            $data['view_items_in_category'] = $this->product_item->display_URL_product_items_by_category($uri);
            $data['categories'] = $this->product_category->view_product_category();
            $this->load->view('administrator/templates/items/template_view_items',$data);
   
    }
    //this will view single product
    public function view_item($uri='')
    {
        $uri = $this->uri->segment(4);
        if(! empty($uri))
        {
            $data['get_items'] = $this->product_item->get_product_item($uri);
            $this->load->view('administrator/templates/items/template_view_items',$data);
        }
        else {
            redirect('administrator/items/view_product_items');
        }
    }
    //the product will be ready for editing
    public function edit_item($uri='')
    {
      $uri = $this->uri->segment(4);
        if(! empty($uri))
        {
            $data['get_item'] = $this->product_item->get_product_item($uri);
            $data['categories'] = $this->product_category->view_product_category();
            $this->load->view('administrator/templates/items/template_edit_items',$data);
        }
        else {
            redirect('administrator/items/view_product_items');
        }  
    }
    //this will update an item
    public function process_update_item()
    {
        if(isset($_POST['update_product']))
        {
            $change_image = $this->input->post('change_image');
            /*check if the user wants to change the current image of the product or not*/
            if($change_image == "yes")
            {
               $check_image = $this->image_upload->process_update($this->input->post('hidden_item_id'));
               /*if there is an error it will not proceed on updating if there is an error that exists*/
               
               if($check_image)
               {
                   echo $check_image;
               }
               else {
                    $this->product_item->update_product_item();
                    $this->image_upload->process_update($this->input->post('hidden_item_id'));
                    $this->session->set_flashdata('update_item','Successfully Updated');
                    redirect('administrator/items/edit_item/'.underscore($this->input->post('item_name')));  
               } 
            }
            else {
                    $this->product_item->update_product_item();
                    $this->session->set_flashdata('update_item','Successfully Updated');
                    redirect('administrator/items/edit_item/'.underscore($this->input->post('item_name')));  
            }
               
            
               
            
            
        }
        else {
            redirect('administrator/items/view_product_items');
        }
           
    }
    //this will delete an item
    public function delete_item($uri='')
    {
        if(! empty($uri))
        {
            $this->product_item->delete_URL_product_item(4);
            $this->session->set_flashdata('delete_item','Successfully Deleted');
            redirect('administrator/items/view_product_items');
        }
        else {
            redirect('administrator/items/view_product_items');
        }
    }
    
    //this will delete multiple items
    public function delete_items()
    {
        if(isset($_POST['delete_items']))
        {
            $this->product_item->delete_multiple_items();
        }
    }
    
    //this will process your search
    public function process_search()
    {
        if(isset($_POST['search']))
        {
            $data['search_results'] = $this->product_item->search_items($this->input->post('keyword'));
            $this->load->view('administrator/templates/items/template_upload_items',$data);
           
        }
        else {
            $this->index();
        }
    }
    
}
