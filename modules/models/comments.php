<?php
/**
 * 
 */
class Comments extends CI_Model {
	
	/*function __construct($argument) {
		
	}*/
	
	//this will post a comment
	public function post_comment()
	{
	    $this->form_validation->set_rules('comment_user','Name','required|trim|xss_clean');
        $this->form_validation->set_rules('comment_email','Email','required|trim|xss_clean');
        $this->form_validation->set_rules('comment_post','Post','required|trim|xss_clean');
        
        if($this->form_validation->run() == FALSE)
        {
            //$this->load->view();
        }
        else {
            
            $this->load->helper('date');
            $this->load->helper('text');
            $post_date = date('U');
            
            $data =array('comment_user'=>$this->input->post('comment_user'),
                         'comment_email'=>$this->input->post('comment_email'),
                         'comment_website'=>$this->input->post('comment_website'),
                         'comment_post'=>$this->input->post('comment_post'),
                         'comment_date'=>$post_date,
                         'blog_id'=>$this->input->post('hidden_blog_id'));
            $this->db->insert('comments',$data);
            $uri = $this->input->post('hidden_blog_uri');
            redirect('administrator/blog/view_post/'.$uri);
        }
		
	}
    
    //this will display comments that is linked by a post
    
    public function display_comments($id)
    {
        $this->db->select('*');
        $this->db->from('comments');
        $this->db->join('blog_post','blog_post.blog_id = comments.blog_id');
        $this->db->where('blog_post.blog_id',$id);
        $this->db->order_by('comments.comment_id');
        $query = $this->db->get();
        
        if($query->num_rows() >= 1)
        {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        
        
    }
    /*
     * this will display all comments
     * */
    public function display_all_comments()
    {
        $this->db->select('*');
        $this->db->from('comments');
        $this->db->join('blog_post','blog_post.blog_id = comments.blog_id');
        $this->db->order_by('comments.comment_id','desc');
        $query = $this->db->get();
        
        if($query->num_rows() >= 1)
        {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        
        
    }
    //view single comment
    public function get_comment($uri)
    {
        $this->db->select('*');
        $this->db->from('comments');
        $this->db->join('blog_post','blog_post.blog_id = comments.blog_id');
        $this->db->where('comments.comment_id',$this->uri->segment($uri));
        $query = $this->db->get();
        
        if($query->num_rows() >= 1)
        {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } 
    }
    
    //this will delete a single comment
   public function delete_comment($uri)
   {
        $this->db->where('comment_id',$this->uri->segment($uri));
        $this->db->delete('comments');
        $this->session->set_flashdata('delete_comment','Successfully Deleted');
        redirect('administrator/blog_comments'); 
   }
   
   //this will delete multiple comments
   public function delete_comments()
   {
       $data = $this->input->post('the_comments');
       foreach($data as $input)
       {
           $this->db->where('comment_id',$input);
           $this->db->delete('comments');
       }
       redirect('administrator/blog_comments/');
   }
    
    
}
