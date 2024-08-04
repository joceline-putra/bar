<?php 
/* 
    @Author: Yoceline Witaya 
*/ 
class Faq_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    function set_params($params){
        if ($params) {
            foreach ($params as $k => $v) {
                $this->db->where($k, $v);
            }
        }
    }

    function set_search($search){
        if ($search) {
            $n = 0;
            $this->db->group_start();
            foreach ($search as $key => $val) {
                if ($n == 0) {
                    $this->db->like($key, $val);
                } else {
                    $this->db->or_like($key, $val);
                }
                $n++;
            }
            $this->db->group_end();
        }
    }

    function set_join(){
        /* $this->db->join('','','left'); */
    }

    function set_select(){
        $this->db->select("*");
    }

    function get_all_faq($params = null, $search = null, $limit = null, $start = null, $order = null, $dir = null) {
        $this->set_select();
        $this->set_params($params);
        $this->set_search($search);
        $this->set_join();

        if ($order) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('faq_id', "asc");
        }

        if ($limit) {
            $this->db->limit($limit, $start);
        }
        
        return $this->db->get('faqs')->result_array();
    }  
    function get_all_faq_count($params,$search){
        $this->db->from('faqs');
        $this->set_params($params);
        $this->set_search($search);
        return $this->db->count_all_results();
    }

    /* 
        ================
        CRUD Faq
        ================
    */        
    
    /* function to add new faq */
    function add_faq($params){
        $this->db->insert('faqs',$params);
        return $this->db->insert_id();
    }
    
    /* function to get faq by id */
    function get_faq($id){
        $this->set_select();
        $this->set_join();
        return $this->db->get_where('faqs',array('faq_id'=>$id))->row_array();
    }
    function get_faq_custom($where){
        $this->set_select();
        $this->set_join();
        return $this->db->get_where('faqs',$where)->row_array();
    }
    function get_faq_custom_result($where){
        $this->set_select();
        $this->set_join();
        return $this->db->get_where('faqs',$where)->result_array();
    }

    /* function to update faq */
    function update_faq($id,$params){
        $this->db->where('faq_id',$id);
        return $this->db->update('faqs',$params);
    }
    function update_faq_custom($where,$params){
        $this->db->where($where);
        return $this->db->update('faqs',$params);
    }

    /* function to delete faq */
    function delete_faq($id){
        return $this->db->delete('faqs',array('faq_id'=>$id));
    }
    function delete_faq_custom($where){
        return $this->db->delete('faqs',$where);
    }

    /* function to check data exists faq */
    function check_data_exist($params){
        $this->db->where($params);
        $query = $this->db->get('faqs');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    /* function to check data exists faq of two condition */
    function check_data_exist_two_condition($where_not_in,$where_exist){
        if ($where_not_in) {
            foreach ($where_not_in as $k => $v) {
                $this->db->where($k.' !=', $v);
            }
        }
        if ($where_exist) {
            $n = 0;
            $this->db->group_start();
            foreach($where_exist as $key => $val) {
                if ($n == 0) {
                    $this->db->where($key, $val);
                } else {
                    $this->db->where($key, $val);
                }
                $n++;
            }
            $this->db->group_end();
        }
        $this->db->limit(1,0);
        $query = $this->db->get('faqs');
        if ($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    
}
?>