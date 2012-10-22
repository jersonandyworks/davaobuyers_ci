<?php
class Sliders extends CI_Model
{
    //this will add slider on sliders' table
    public function create_slider($data)
    {
        $this->form_validation->set_rules('slider_title','Slider Title','trim|xss_clean');
        $this->form_validation->set_rules('slider_desc','Slider Description','trim|xss_clean');
        
        if($this->form_validation->run() == FALSE)
        {
            //$this->load->view();
        }
        else {
            $this->db->insert('sliders',$data);
        }
    }
    
    //this will display all sliders
    public function display_sliders()
    {
        $query = $this->db->get('sliders');
        
        if($query->num_rows() >=1)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    //edit selected slider will be ready for update
    public function edit_slider($uri)
    {
        $this->db->where('slider_id',$this->uri->segment($uri));
        $query = $query = $this->db->get('sliders');
        if($query->num_rows() >=1)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
        
    }
    
    //this will update the selected slider
    public function update_slider($id,$data)
    {
        $this->db->where('slider_id',$id);
        $this->db->update('sliders',$data);
    }
    //this will delete single slider
    public function delete_slider($uri)
    {
        $this->db->where('slider_id',$this->uri->segment($uri));
        $this->db->delete('sliders');
    }
    
    //this will delete multiple sliders
    public function delete_sliders($data)
    {
        foreach($data as $input)
        {
            $this->db->where('slider_id',$this->input->post($input));
            $this->db->delete('sliders');
        }
    }
    
}
