<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Image_upload 
{
    public function process_upload()
    {
        $CI =& get_instance();
        $CI->config->load('upload_conf');
        $CI->load->library('upload');
        $CI->load->helper('form');
        //$CI->load->library('database');
      
        $config['upload_path'] = $CI->config->item('upload_path');
        $config['allowed_types'] = $CI->config->item('allowed_types');
        $config['max_size'] = $CI->config->item('max_size');
        $config['max_height'] = $CI->config->item('max_height');
                        
        $CI->load->library('upload',$config);
        $CI->upload->initialize($config);
        
        
        if(! $CI->upload->do_upload())
        {
            $error = array('error'=>$CI->upload->display_errors());
           foreach ($error as $errors => $value) {
             return $value;  
           } 
        }
        else {
            $image = $CI->upload->data();
            
            $userfile = array($CI->input->post('userfile'));
            
            
            $data = array('item_id'=>$CI->db->insert_id(),
                          'img_src'=>$config['upload_path'],
                          'img_raw_name'=>$image['raw_name'],
                          'img_file_ext'=>$image['file_ext'],
                          'img_size'=>$image['image_size_str']);
    
            $CI->load->model('img_upload');
            $CI->img_upload->upload_image_db($data);
            
            
            
        }                        
 
    }
    
    public function process_update($id)
    {
       $CI =& get_instance();
        $CI->config->load('upload_conf');
        $CI->load->library('upload');
        //$CI->load->library('database');
      
        $config['upload_path'] = $CI->config->item('upload_path');
        $config['allowed_types'] = $CI->config->item('allowed_types');
        $config['max_size'] = $CI->config->item('max_size');
        $config['max_height'] = $CI->config->item('max_height');
                        
        $CI->load->library('upload',$config);
        $CI->upload->initialize($config);
        
        
        if(! $CI->upload->do_upload())
        {
            $error = array('error'=>$CI->upload->display_errors());
           foreach ($error as $errors => $value) {
             return $value;  
           } 
        }
        else {
            $image = $CI->upload->data();
            
            $data = array(
                          'img_src'=>$image['file_path'],
                          'img_raw_name'=>$image['raw_name'],
                          'img_file_ext'=>$image['file_ext'],
                          'img_size'=>$image['image_size_str']);
            
            //load the model for uploading image
            $CI->load->model('img_upload');
            $CI->img_upload->update_image_db($id,$data);
            
            
            
        }  
    }
}
