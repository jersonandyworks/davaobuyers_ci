<?php
class Admin_controller extends CI_Controller{
    public function index()
    {
        $this->load->view('form_ads');
    }
    public function create_new_ads()
    {
        $this->load->model('ads_model');
        if(isset($_POST['submit'])):            
           $this->ads_model->create_ads();
             $this->session->set_flashdata('success','Already Added!');
             redirect('administrator/admin_controller/index');
           
        else:
            
             redirect('administrator/admin_controller/index');
        endif;        
    }
}
