<?php
/**
 * 
 */
class Model_Test extends CI_Model{
	
	function __construct($argument) {
		
	}
    
    public function show_users()
    {
        $this->db->select('*');
        $this->db->from('users_group');
        $this->db->join('groups','groups.id = users_group.group_id');
        $this->db->join('users','users.id = users_group.user_id');
        $query = $this->db->get();
        
        if($query->num_rows > 0)
        {
            foreach ($$query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        
    }
}
