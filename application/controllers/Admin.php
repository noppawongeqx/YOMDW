<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function ulsearch()
	{
		
		//$this->load->view('welcome_message');
	}
	public function index()
	{

       if ($this->ion_auth->is_admin())
		{
			$content = array();
			$this->template->load('templateadmin', 'admin/home',$content);
		}else{
			show_404();
		}
	}
	public function slideshows()
	{
		if ($this->ion_auth->is_admin())
		{
			$sql = array("SELECT * FROM slideshow");
			$query_slide = $this->db->query(implode("",$sql));
			$content['slideshows']= $query_slide;
			$this->template->load('templateadmin','admin/slide_list',$content);
		}else{
			show_404();
		}
	}
	public function newslist()
	{
		if ($this->ion_auth->is_admin())
		{
			$sql = array("SELECT * FROM news");
			$query_news = $this->db->query(implode("",$sql));
			$content['newslist']= $query_news;
			$this->template->load('templateadmin','admin/news_list',$content);
		}else{
			show_404();	
		}
	}
	public function dwTopPick(){
		if ($this->ion_auth->is_admin())
		{
			$query = $this->db->query("SELECT * FROM toppick");
			$query2 = $this->db->query("SELECT * FROM dw where last_trading_date >= now()");
			$content = array();

			$content['list'] = $query2->result_array();
			$choose = array();
			foreach ( $query->result_array() as $row) {
				$choose[]=$row['dw_id'];
			}
			$content['choose'] = $choose;
			$this->template->load('templateadmin','admin/toppick',$content);

		}else{
			show_404();
		}	
	}
	public function saveTopPick(){
		$dw_Id = $this->input->post('dw_Id');
		if($this->ion_auth->is_admin()){
			$this->load->model('toppick_model');	
			$this->toppick_model->insert_entry();	
			redirect(base_url().'admin/dwTopPick');	
		}else{
			show_404();
		}
	}	
	public function do_upload($upload ='./uploads/')
    {
            $config['upload_path']          = $upload;
            $config['allowed_types']        = 'gif|jpg|png';
            // $config['max_size']             = 500;
            // $config['max_width']            = 1300;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('img_url'))
            {
                    $error = array('error' => $this->upload->display_errors());

                 	return $error;
            }
            else
            {
                    $data = array('upload_data' => $this->upload->data());

                    return $data;
            }
    
    }
	public function slideshow($id="")
	{
		if ($this->ion_auth->is_admin())
		{
			$content = array();
			$this->load->model('slideshow_model');
			if(!empty($id)){
				$slideshow = $this->slideshow_model->get($id);
				if(isset($slideshow))
				{
					$content = array_merge($content,$slideshow);
				}
			}else{
				$slideshow =  $this->slideshow_model->props();
				$content = array_merge($content,$slideshow);
			}

			$this->template->load('templateadmin','admin/slide_edit',$content);
		}else{
        	show_404();
        }
	}
	public function news($id="")
	{
		if ($this->ion_auth->is_admin())
		{
			$content = array();
			$this->load->model('news_model');
			if(!empty($id)){
				$news = $this->news_model->get($id);
				if(isset($news))
				{
					$content = array_merge($content,$news);
				}
			}else{
				$news =  $this->news_model->props();
				$content = array_merge($content,$news);
			}
				$this->template->load('templateadmin','admin/news_edit',$content);
		}else{
        	show_404();
        }

	
	}
	
	public function saveNews($id ='')
	{
		if ($this->ion_auth->is_admin())
		{
			$id = $this->input->post('id');
			$this->load->model('news_model');
			$result = $this->do_upload('./uploads/news/');
			$file_name = '';
			if(array_key_exists("error",$result))
			{
				$this->form_validation->set_message('img_url', $result['error']);
				$this->news($this->input->post('id'));
			}
			else
			{
				$file_name = $result['upload_data']['file_name'];
				if(isset($id) && !empty($id))
				{	
					$this->news_model->update_entry($file_name);
				}
				else
				{
					$this->news_model->insert_entry($file_name);
				}
				redirect(base_url().'admin/newslist');
			}
	        
			
		}else{
        	show_404();
        }
	}
	public function deleteNews($id = '')
	{	if ($this->ion_auth->is_admin())
		{
			if(isset($id))
			{
				$this->load->model('news_model');
				$this->news_model->delete_entry($id);

			}
			redirect(base_url().'admin/newslist');
		}else{
        	show_404();
        }
	}
	public function saveSlideshow()
	{
		if ($this->ion_auth->is_admin())
		{
			$id = $this->input->post('id');
			$this->load->model('slideshow_model');
			$result = $this->do_upload('./uploads/slideshow/');
			$file_name = '';
			$id= $this->input->post('id');
			if(array_key_exists("error",$result) && empty($id))
			{
				$this->form_validation->set_message('img_url', $result['error']);
				$this->slideshow($this->input->post('id'));
				return;
			}
			else
			{
				if(!empty($result['upload_data'])){
					$file_name = $result['upload_data']['file_name'];
				}
				if(isset($id) && !empty($id))
				{	
					$this->slideshow_model->update_entry($file_name);
				}
				else
				{
					$this->slideshow_model->insert_entry($file_name);
				}
			}
			redirect(base_url().'admin/slideshows');
		}else{
        	show_404();
        }
	}
	public function deleteSlideshow($id = '')
	{	if ($this->ion_auth->is_admin())
		{
			if(isset($id))
			{
				$this->load->model('slideshow_model');
				$this->slideshow_model->delete_entry($id);

			}
			redirect(base_url().'admin/slideshows');
		}else{
        	show_404();
        }
	}
	public function viewchat()
	{
		if ($this->ion_auth->is_admin())
		{
			$content = array();
			// $message_session  = $this->db->query('select * From message_session where is_active ="Y"');
			// // $message_log = $this->db->query('select * from message_log inner join message_session order by datetime group by session_id');
			// // $messages =array();
			// // foreach ($message_log->result_array() as $log) {
			// // 	$messages[$log['session_id']] = $row;
			// // }
			// $content['sessions'] = $message_session;
			$this->template->load('templateadmin','admin/view_message',$content);
		}else{
			show_404();
		}
	}
	public function logchat($last_chat_id ='')
	{
		if($this->ion_auth->is_admin())
		{
			$message_log = '';
			if(empty($last_chat_id)){
				$message_log = $this->db->query("select *,DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%e %b %Y %h:%i:%s') AS date_formatted from message_log message_log inner join users on message_log.from_id = users.id where DATE(FROM_UNIXTIME(timestamp)) = DATE(NOW())  order by timestamp  asc");
			}else{
				$message_log = $this->db->query("select *,DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%e %b %Y %h:%i:%s') AS date_formatted from message_log message_log inner join users on message_log.from_id = users.id where message_id > ".$last_chat_id." DATE(`timestamp`) > date_sub(now(), interval 15 minute)  order by timestamp  asc");
			}
			$messages = array();
			foreach ($message_log->result_array() as $row) {

				$messages[] = $row;
			}
			 header('Content-Type: application/json');
   			 echo json_encode( $messages );
		}else{
			show_404();
		}
	}

}
