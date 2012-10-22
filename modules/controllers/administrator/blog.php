<?php
/**
 * this class is for blogging
 */
class Blog extends CI_Controller{
    
	public function index()
	{
		$this->view_blogs();
		
	}
    /*
     * it will create a new blog post
     * */
	public function create_blog_post()
	{
		if(isset($_POST['post_blog']))
        {
           $this->blog_post->create_post();
        }
        else {
            
           $this->load->view('administrator/templates/blog/template_add_blog'); 
        }
	}
    /*
     * display blogs according to date
     * */
    public function view_blogs($value='')
    {
        $data['blog_posts'] = $this->blog_post->display_all_posts();
        $this->load->view('administrator/templates/blog/template_view_blog',$data);
    }
    /*
     * display single post
     * */
    public function view_post($uri='')
    {
        if(! empty($uri))
        {
            $data['the_post'] = $this->blog_post->display_URI_single_post(4);
            $this->load->view('administrator/templates/blog/template_single_blog',$data);
        }
        else {
            redirect('administrator/blog/view_blogs');
        }
    }
    
    /*
     * edits and update a selected post
     * */
     
     public function edit_post($uri='')
     {
         if(! empty($uri))
         {
             if(isset($_POST['update_post']))
             {
                 $this->blog_post->update_post();

             }
             else {
            	 $data['the_post'] = $this->blog_post->display_URI_single_post(4);
                 $this->load->view('administrator/templates/blog/template_edit_blog',$data);
             }
             
         }
         else {
            redirect('administrator/blog/view_blogs'); 
         }
         
     }
     /*
      * updates a ost
      * */
      public function update_post()
      {
          if(isset($_POST['update_post']))
          {
              $this->blog_post->update_post();
          }
         else {
        	redirect('administrator/blog/view_blogs');
          }
      }
     /*
      * deletes a single post
      * */
    public function delete_post()
    {
        $this->blog_post->delete_post(4); 
    }
    /*
     * deletes multiple posts
     * */
    public function delete_posts()
    {
        if(isset($_POST['delete_post']))
        {
            $this->blog_post->delete_posts();
        }
    }
    /*
     *post a comment
     * */
     public function post_comment()
     {
         if(isset($_POST['post_comment']))
         {
           $this->comments->post_comment();  
         }
        else {
        	redirect('administrator/blog/view_post');
        }
     }    
}
