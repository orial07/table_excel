<?php
class Table_model extends CI_Model {

  

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }



public function get_user($pass,$email){
	
		$query = $this->db->query("SELECT * FROM users WHERE password ='$pass' AND email ='$email' ");
		if ($query->num_rows()>0) 
		 {  
		 	 return $query->row_array();
		 } 
		   else 
				{return false;}
	
	
}



function insert_user($a){
 if($this->db->insert('users',$a))
  return true;

return false;


}


function insert_table($a){
 if($this->db->insert('tables',$a))
  return true;

return false;


}



public function get_tables($id){
	
		$query = $this->db->query("SELECT * FROM tables where id_user='$id'  ORDER BY updated desc ");
		if ($query->num_rows()>0) 
		 {  
		 	return $query->result();
		 } 
		   else 
				{return false;}
	
	
}


public function get_table($id,$table_id){
	
		$query = $this->db->query("SELECT * FROM tables where id_user='$id' and table_id='$table_id'   ");
		if ($query->num_rows()>0) 
		 {  
		 	return $query->row_array();
		 } 
		   else 
				{return false;}
	
	
}



public function update($data,$id){
$this->db->where('table_id', $id);
if($this->db->update('tables', $data))
	return True;
else
	return false;

}


public function delete($id){
	
		$query = $this->db->query("DELETE FROM tables where table_id='$id'  ");
		if ($query) 
		 {  
		 	return true;
		 } 
		   else 
				{return false;}
	
	
}


        }