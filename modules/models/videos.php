<?php
class Videos extends CI_Model
{
    //this will create video post
    public function create_video_post($data)
    {
        $this->form_validation->set_rules('vs_title','Video Title','required|xss_clean|trim');
        $this->form_validation->set_rules('vs_description','Video Description','required|xss_clean|trim');
        
        if($this->form_validation->run() == FALSE)
        {
            //$this->load->view()
            
        }
        else {
            $this->db->insert($data);
        }
        
    }
    //this will display single video
    public function display_video($uri)
    {
        $this->db->where('video_uri',$this->uri->segment($uri));
        $query = $this->db->get('videos');
        
        if($query->num_rows() >=1)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        
    }
    //this will display all videos
    public function display_videos()
    {
        $query = $this->db->get('videos');
        
        if($query->num_rows() >=1)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    //this will ready the video item for editing
    public function edit_video($uri)
    {
         $this->db->where('video_uri',$this->uri->segment($uri));
        $query = $this->db->get('videos');
        
        if($query->num_rows() >=1)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        
    }
    
    //this will update the edited video item
    public function update_video($id,$data)
    {
         $this->db->where('video_id',$this->input->post($id));
         $this->db->update('videos');
    }
    
    //this will delete single item
    public function delete_video($uri)
    {
         $this->db->where('video_id',$this->uri->segment($uri));
         $this->db->delete('videos');
    }
    
    //this will delete multiple videos
    public function delete_videos($data)
    {
       
       
            foreach($data as $input)
            {
                 $this->db->where('video_id',$this->input->post($input));
                 $this->db->delete('videos');
            }
         
    }
}
