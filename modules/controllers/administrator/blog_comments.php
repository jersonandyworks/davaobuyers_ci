<?php
/**
 * 
 */
class Blog_comments extends CI_Controller {
	
	public function index()
	{
		$data['comments'] = $this->comments->display_all_comments();
        $this->load->view('administrator/templates/comments/template_view_comments',$data);
	}
    
    public function delete_comments()
    {
        if(isset($_POST['delete_comment']))
        {
            $this->comments->delete_comments();
        }
        else {
            redirect('administrator/blog_comments');
        }
    }
    public function delete_comment($uri ='')
    {
        if(! empty($uri))
        {
            $this->comments->delete_comment(4);
            
        }
        else {
            redirect('administrator/blog_comments');
        }
    }
    public function view_comment($uri='')
    {
        if(! empty($uri))
        {
            $data['single_comment'] = $this->comments->get_comment(4);
            $this->load->view('administrator/templates/comments/template_single_comment',$data);
        }
        else {
            redirect('administrator/blog_comments');
        }
    }
}
