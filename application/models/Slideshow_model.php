<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slideshow_model extends CI_Model{
	public $img_url;
	public $position;
	public $link;
	public $title;
	public $create_date;
     public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }
    public function props()
    {
    		return get_object_vars($this);
    }
	 public function get($id)
	{
	        $this->db->where('id',$id);
	        $q = $this->db->get('slideshow');
	        $result = null;
	        foreach($q->result_array() as $row){
	        	$result = $row;
	        	break;
	        }
	        return $result;
	}
    public function insert_entry($filename ='')
    {
    		$this->db->trans_start();
            if(!empty($filename)){
	            $this->img_url    = $filename; // please read the below note
	        }
            $this->position = $this->input->post('position');
            $this->link  = $this->input->post('link');
            $this->title = $this->input->post('title');
            $this->create_date  = date('Y-m-d');

            $this->db->insert('slideshow', $this);
            $this->db->trans_complete();
           	$id = $this->db->insert_id();
           	return array("id" => $id,'status'=>$this->db->trans_status());
    }
 
     public function update_entry($filename='')
    {

            $this->db->trans_start();
            $update_object = new stdClass();
            if(!empty($filename)){
                $update_object->img_url = $filename; // please read the below note
            } // please read the below note
            
            $update_object->position = $this->input->post('position');
            $update_object->link  = $this->input->post('link');
            $update_object->title = $this->input->post('title');
          
            $this->db->update('slideshow', $update_object, array('id' => $this->input->post('id')));
            $this->db->trans_complete();
            return $this->db->trans_status();
    }
    public function delete_entry($id='')
    {
    		$this->db->trans_start();
    		$this->db->delete('slideshow',array('id'=>$id));
    		$this->db->trans_complete();
    		return $this->db->trans_status();
    }


}