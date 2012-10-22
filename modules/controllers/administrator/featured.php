<?php
/**
 * 
 */
class Featured extends CI_Controller{
	
    public function index()
    {
        $data['the_featured'] = $this->featured_products->the_products();
        $this->load->view('administrator/templates/featured_products/template_view_featured',$data);
    }
	public function add_this_product($uri = '')
	{
	    if(! empty($uri))
        {
           $this->load->model('featured_products');
           $this->featured_products->add_single_product(4); 
        }
        else {
           redirect('administrator/items/view_product_items'); 
        }
		
	}
    public function remove_products()
    {
        if(isset($_POST['remove_products']))
        {
            $this->featured_products->remove_multiple_products();
           
            redirect('administrator/featured');
            
        }
    }
}
