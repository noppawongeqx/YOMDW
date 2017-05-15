<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News_model extends CI_Model{
	public $img_url;
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
	        $q = $this->db->get('news');
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
            $this->title = $this->input->post('title');
            $this->create_date  = date('Y-m-d H:i:s');

            $this->db->insert('news', $this);
            $this->db->trans_complete();
           	$id = $this->db->insert_id();
           	return array("id" => $id,'status'=>$this->db->trans_status());
    }
     public function update_entry($filename='')
    {

    		$this->db->trans_start();
    	    if(!empty($filename)){
	            $this->img_url = $filename; // please read the below note
	        } // please read the below note
	        else
	        {
	        	$this->img_url = $this->input->post('img_url_default');
	        }
            $this->title = $this->input->post('title');
            $this->create_date = $this->input->post('create_date');
            $this->db->update('news', $this, array('id' => $this->input->post('id')));
            $this->db->trans_complete();
            return $this->db->trans_status();
    }
    public function delete_entry($id='')
    {
    		$this->db->trans_start();
    		$this->db->delete('news',array('id'=>$id));
    		$this->db->trans_complete();
    		return $this->db->trans_status();
    }
    public function upload_dw13($array_map_dw)
    {

            $this->db->trans_start();
           $this->db->where('dwId !=', 'NULL');
            $this->db->delete('dw13');
            foreach ($array_map_dw as $key => $value) {
                $data = array('dw_Id'=>$key,'html'=>$value);
                $this->db->insert('dw13',$data);
            }
            $this->db->trans_complete();
            return $this->db->trans_status();
    }


}