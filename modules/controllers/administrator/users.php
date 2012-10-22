<?php
/**
 * 
 */
class Users extends CI_Controller{
	
    public function index()
    {
        $this->load->model('model_test');
        
        $query = $this->model_test->show_users();
        
        if($query)
        {
            foreach($query as $row)
            {
                echo "Username:".$row->username;
            }
        }
        
        
    }
}
