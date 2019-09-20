<?php

class DashboardModel extends CI_Model {
  
    public function insertMenu($menu)
    {
        $data = array(
        'menu_name' => $menu,
        'status'  => '1',
       );

        //$sql = $this->db->set($data)->get_compiled_insert('menu');
       // echo $sql;
        
        $this->db->insert('menu', $data);
        if($this->db->affected_rows() > 0)
            return 1;
    }
    
    public function getMenu()
    {
       return $query = $this->db->select('id, menu_name')
                        ->where('menu_name !=','')
                        ->group_by('menu_name')
                        ->order_by('menu_name', 'ASC')
                        ->get('menu')->result_array();
    }
    
    public function getMenuByID($MenuID)
    {
       return $query = $this->db->select('id, menu_name')
                        ->where('id=',$MenuID)
                        ->group_by('menu_name')
                        ->order_by('menu_name', 'ASC')
                        ->get('menu')->result_array();
    }
    
    public function updateMenuByID($MenuID, $menuName)
    {
       $data = array(
                'menu_name' => $menuName,
                );

        $this->db->where('id', $MenuID);
        return $this->db->update('menu', $data);
        
        //$this->db->update('mytable', $data, array('id' => $id));
        //$this->db->update('mytable', $data, "id = 4");
    }
    
    public function deleteMenuByID($MenuID)
    {
        $this->db->delete('menu', array('id' => $MenuID));
        return $this->db->delete('menu_item_mapping', array('menu_id' => $MenuID));
        
        //$this->db->update('mytable', $data, array('id' => $id));
        //$this->db->update('mytable', $data, "id = 4");
    }
    
     public function getMenuItemByDate()
    {
//       return $query = $this->db->select('id, menu_name')
//                        ->where('menu_name !=','')
//                        ->group_by('menu_name')
//                        ->order_by('menu_name', 'ASC')
//                        ->get('menu')->result_array();
//       
       
      // echo "diveshModel";
//"select a.`date`, b.menu_name, GROUP_CONCAT(c.item_name) as item from menu_item_mapping a
//inner join menu b
//on
//a.menu_id = b.id
//inner join item c
//on
//a.item_id = c.id
//group by b.menu_name, a.`date`";
       
        $this->db->select('a.`date`, b.menu_name, GROUP_CONCAT(c.item_name) as `item`');
        $this->db->from('menu_item_mapping as a');
        $this->db->join('menu as b', 'a.menu_id = b.id');
        $this->db->join('item as c', 'a.item_id = c.id');
        $this->db->group_by(array("b.menu_name", "a.`date`"));
       return $query = $this->db->get()->result_array();


//$this->db->group_by(array("title", "date"));  // Produces: GROUP BY title, date

//$this->db->order_by('title DESC, name ASC');

       
    }


    
}

?>