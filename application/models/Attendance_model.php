<?php 
/* 
    @Author: Yoceline Witaya 
*/ 
class Attendance_model extends CI_Model{
    
    public $table = '_attendances';

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
        $this->db->join('locationss','att_location_id=location_id','left');
        $this->db->join('users','att_user_id=user_id','left');        
    }

    function set_select(){
        $this->db->select("*");
    }


    function get_all_attendance($params = null, $search = null, $limit = null, $start = null, $order = null, $dir = null) {
        $this->set_select();
        $this->set_params($params);
        $this->set_search($search);
        $this->set_join();

        if ($order) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('att_id', "asc");
        }

        if ($limit) {
            $this->db->limit($limit, $start);
        }
        
        return $this->db->get($this->table)->result_array();
    }  
    function get_all_attendance_activity($att_type,$limit_start,$limit_end){
        if($att_type > 0){
            $where = "WHERE att_type = ".$att_type;
        }else{
            $where = "WHERE att_type > 0";
        }

        $query = $this->db->query("
            SELECT a.*, u.user_username, u.user_fullname, fn_time_ago(a.att_date_created) AS time_ago,
            l.location_name
            FROM _attendances AS a
            LEFT JOIN locations AS l ON (a.att_location_id=l.location_id)
            LEFT JOIN users AS u ON (a.att_user_id=u.user_id)
            $where
            ORDER BY a.att_date_created DESC 
            LIMIT $limit_start, $limit_end
        ");        
        return $query->result_array();
    }     
    function get_all_attendance_count($params,$search){
        $this->db->from($this->table);
        $this->set_params($params);
        $this->set_search($search);
        return $this->db->count_all_results();
    }

    /* 
        ================
        CRUD Attendance
        ================
    */        
    
    /* function to add new attendance */
    function add_attendance($params){
        $this->db->insert($this->table,$params);
        return $this->db->insert_id();
    }
    
    /* function to get attendance by id */
    function get_attendance($id){
        $this->set_select();
        $this->set_join();
        return $this->db->get_where($this->table,array('att_id'=>$id))->row_array();
    }
    function get_attendance_custom($where){
        $this->set_select();
        $this->set_join();
        return $this->db->get_where($this->table,$where)->row_array();
    }
    function get_attendance_custom_result($where){
        $this->set_select();
        $this->set_join();
        return $this->db->get_where($this->table,$where)->result_array();
    }

    /* function to update attendance */
    function update_attendance($id,$params){
        $this->db->where('att_id',$id);
        return $this->db->update($this->table,$params);
    }
    function update_attendance_custom($where,$params){
        $this->db->where($where);
        return $this->db->update($this->table,$params);
    }

    /* function to delete attendance */
    function delete_attendance($id){
        return $this->db->delete($this->table,array('att_id'=>$id));
    }
    function delete_attendance_custom($where){
        return $this->db->delete($this->table,$where);
    }

    /* function to check data exists attendance */
    function check_data_exist($params){
        $this->db->where($params);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    /* function to check data exists attendance of two condition */
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
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}
?>