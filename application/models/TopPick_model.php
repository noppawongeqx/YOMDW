<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TopPick_model extends CI_Model{
	public $dw_id;
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
	        $q = $this->db->get('toppick');
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
            $dw_Id = $this->input->post('dw_Id');
            $this->db->where('1=1');
            $this->db->delete('toppick');
            if(isset($dw_Id)){
                foreach ($dw_Id as $id) {          
                     $this->db->insert('toppick', array('dw_Id'=>$id));
                }
            }
            $this->db->trans_complete();
           	return array('status'=>$this->db->trans_status());
    }


}