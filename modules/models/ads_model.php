<?php
class Ads_model extends CI_Model {
    
    /*this will create new ads entry*/
    public function create_ads()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('ads_title','Ads Title','trim|required|is_unique[ads.ads_title]');
        $this->form_validation->set_rules('ads_description','Description','trim|required');
        //$this->form_validation->set_rules('ads_contact_email','Contact Email','trim|required|valid_email');
        $this->form_validation->set_message('is_unique','%s already exists');
        
        if($this->form_validation->run() == FALSE){
            $this->load->view('form_ads');
        }
        else{
            $data_ads = array('ads_title'=>$this->input->post('ads_title'),
                              'ads_description'=>$this->input->post('ads_description'),
                              'ads_contact_email'=>$this->input->post('ads_contact_email'));
            
            /*INSERT INTO ADS TABLE AFTER CHECKING*/
            
            $this->db->insert('ads',$data_ads);
        }
        
    }
}
