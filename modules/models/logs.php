<?php
class Logs extends CI_Model
{
    //this will create log if user logs on or modify settings
    public function create_log($data)
    {
        $this->db->insert($data);
    }
    
    //this will display all logs
    public function display_log()
    {
        $this->db->order_by('log_date','desc');
        $query = $this->db->get('logs');
        
        if($query->num_rows() >= 1)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
            
        }
        
    }
    
    //this will delete single log
    public function delete_log($uri)
    {
        $this->db->where('log_id',$uri);
        $this->db->delete('logs');
    }
    
    //this will delete multiple logs
    
    public function delete_logs($id,$data)
    {
        foreach($data as $input)
        {
            $this->db->where('log_id',$id);
            $this->db->delete('logs');
        }
    }
    
    
}
