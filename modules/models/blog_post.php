<?php
/**
 * 
 */
class Blog_post extends CI_Model {
	
	/*function __construct($argument) {
		
	}
    */
    
    public function create_post()
    {
        $this->form_validation->set_rules('blog_title','Blog Title','trim|xss_clean');
        $this->form_validation->set_rules('blog_content','Blog Content','trim|xss_clean');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('administrator/templates/blog/template_add_blog');
        }
        else {
            $this->load->helper('date');
            $this->load->helper('text');
            $post_date = date('U');
            $now = time();
            $data = array('blog_title'=>$this->input->post('blog_title'),
                          'blog_content'=>$this->input->post('blog_content'),
                          'blog_uri'=>underscore($this->input->post('blog_title')),
                          'blog_date'=>$post_date,
                          'blog_excerpt'=>word_limiter($this->input->post('blog_content'),120));
                                      
            $this->db->insert('blog_post',$data);
            $this->session->set_flashdata('post_blog','Successfully posted');
            redirect('administrator/blog/create_blog_post');
        }
    }
    //this will display all posts in order by date
    public function display_all_posts()
    {
        $this->db->order_by('blog_date');
        $query = $this->db->get('blog_post');
        
        if($query->num_rows())
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    //this will display single post
    public function display_URI_single_post($uri)
    {
        $this->db->where('blog_uri',$this->uri->segment($uri));
        $this->db->or_where('blog_id',$this->uri->segment($uri));
        $query = $this->db->get('blog_post');
        
        if($query->num_rows() == 1)
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
 
    //this will update the set post
    public function update_post()
    {
        $this->form_validation->set_rules('blog_title','Title','required|xss_clean');
        $this->form_validation->set_rules('blog_content','Post','xss_clean');
        
        $data = array('blog_title'=>$this->input->post('blog_title'),
                      'blog_content'=>$this->input->post('blog_content'),
                      'blog_uri'=>underscore($this->input->post('blog_title')),
                      'blog_excerpt'=>word_limiter($this->input->post('blog_content'),150));
                      
        $id = $this->input->post('hidden_blog_id');
        $uri = $this->input->post('blog_uri');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('administrator/templates/blog/template_edit_blog');
        }
        else {
            $this->db->where('blog_id',$id);
            $this->db->update('blog_post',$data);
            $this->session->set_flashdata('update_post','Successfully Updated!');
            redirect('administrator/blog/edit_post/'.$id);
        }
        
    }
    
    //this will delete a single post
    public function delete_post($uri)
    {
        $this->db->where('blog_uri',$this->uri->segment($uri));
        $this->db->delete('blog_post');
        redirect('administrator/blog/view_blogs');
    }
    
    //this will delete multiple posts
    public function delete_posts()
    {
        $data = $this->input->post('the_post');
        foreach($data as $input)
        {
            $this->db->where('blog_id',$input);
            $this->db->delete('blog_post');
        }
         redirect('administrator/blog/view_blogs');
    }
    
    
}

