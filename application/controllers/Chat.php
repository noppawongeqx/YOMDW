<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
	}
	public function viewchat()
	{
		
			$content = array();
			// $message_session  = $this->db->query('select * From message_session where is_active ="Y"');
			// // $message_log = $this->db->query('select * from message_log inner join message_session order by datetime group by session_id');
			// // $messages =array();
			// // foreach ($message_log->result_array() as $log) {
			// // 	$messages[$log['session_id']] = $row;
			// // }
			// $content['sessions'] = $message_session;
			//if($this->ion_auth->logged_in()){
				$this->template->load('template','chat/view_message',$content);
			// }else{

   // 				redirect('auth/login');
			// }	
	}
	public function logchat()
	{
			$message_log = '';
			if(empty($last_chat_id)){
				$message_log = $this->db->query("select *,DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%e %b %Y %h:%i:%s') AS date_formatted from message_log message_log inner join users on message_log.from_id = users.id  where DATE(FROM_UNIXTIME(timestamp)) = DATE(NOW())  order by timestamp  asc");
			}else{
				$message_log = $this->db->query("select *,DATE_FORMAT(FROM_UNIXTIME(`timestamp`), '%e %b %Y %h:%i:%s') AS date_formatted from message_log message_log inner join users on message_log.from_id = users.id where message_id > ".$last_chat_id." Login_time > date_sub(now(), interval 15 minute)  order by timestamp  asc");
			}
			$messages = array();
			foreach ($message_log->result_array() as $row) {

				$messages[] = $row;
			}
			 header('Content-Type: application/json');
   			 echo json_encode( $messages );
   		
	
	}
}