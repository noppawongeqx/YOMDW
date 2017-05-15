<?php
class Pages extends CI_Controller {

        public function view($page = 'home')
        {

	        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
	        {
	                // Whoops, we don't have a page for that!
	            // echo 'not FOUND';
	                show_404();
	        }
	          $content = array();
			$this->template->load('template', 'pages/'.$page,$content);
        }
}