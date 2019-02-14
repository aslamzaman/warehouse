<?php 
    class Cash_in_model extends  CI_Model{

        public function __construct()
        {
            parent::__construct();
            $this->db = $this->load->database("default",TRUE);
        }
    
    
    
    
    /**
    --------------------------------------------------------
    ========================================================
    --------------------------------------------------------
    */
    
    
        public function add($data=array())
        {
			return $this->db->insert('cash_in', $data);
        } 



    
    /**
    --------------------------------------------------------
    ========================================================
    --------------------------------------------------------
    */
    
        public function edit($data=array(), $id)
        {    
			$this->db->where('id', $id);
			return $this->db->update('cash_in', $data);
        } 

    
    
    
    
    /**
    --------------------------------------------------------
    ========================================================
    --------------------------------------------------------
    */
    
    

        public function remove($id)
        {
            $this->db->where('id', $id);
            return $this->db->delete('cash_in');
        }
    
    
    
    
    /**
    --------------------------------------------------------
    ========================================================
    --------------------------------------------------------
    */
    
    

      public function select_all()
        {
            $this->db->select('`cash_in`.`id`, `cash_in`.`dt`, `cash_in`.`cause`, `cash_in`.`amount`');
            $this->db->select('`account_chart`.`id` as `chart_id`,`account_chart`.`name` as `chart`');
			$this->db->from('cash_in');
            $this->db->join('`account_chart`', '`cash_in`.`account_chart_id` = `account_chart`.`id`', 'left');
            $this->db->order_by('`cash_in`.`id`','DESC');
			$this->db->limit(20);
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->result_array();
            }else{
                return FALSE;
            }
        }  
    
    
  
    
    
    /**
    --------------------------------------------------------
    ========================================================
    --------------------------------------------------------
    */
    
    


       public function select_one($id)
        {
            $this->db->select('`cash_in`.`id`, `cash_in`.`dt`, `cash_in`.`cause`, `cash_in`.`amount`');
			$this->db->select('`account_chart`.`name` `chart`');
			$this->db->where('`cash_in`.`id`',$id);
			$this->db->from('`cash_in`');
			$this->db->join('`account_chart`','`cash_in`.`account_chart_id` = `account_chart`.`id`','left');
            $query = $this->db->get();
            if($query->num_rows() > 0){
                return $query->row_array();
            }else{
                return FALSE;
            }
        }  
    
   

   
  
    
        
        /**
        --------------------------------------------------------
        ========================================================
        --------------------------------------------------------
        */        
        
 
 

        public function drop_down_option($table,$selected_id)
        {
            $dropdown	= '';
            $this->db->select('`id`,`name`');
            $this->db->order_by('name','ASC');
            $query 		= $this->db->get($table);
            $result 	= $query->result_array();
            $dropdown .="\n";			
            foreach($result as $row)
            {
                if($selected_id == $row['id'])
                {
                    $dropdown .= "<option value=".$row['id']." selected>".$row['name']."</option>\n";
                }
                else
                {
                    $dropdown .= "<option value=".$row['id'].">".$row['name']."</option>\n";
                }
            }			
            return $dropdown;
        } 


/* ---------------------------------------------   */
        public function cash_in_total()
        {
            $this->db->select('sum(`amount`) as `in_total`'); 
            $query = $this->db->get('cash_in');			
            return $query->row_array();
        } 

        public function cash_out_total()
        {
            $this->db->select('sum(`amount`) as `out_total`'); 
            $query = $this->db->get('cash_out');
			//echo $this->db->last_query();exit();
            return $query->row_array();
        } 


}

?>
 



