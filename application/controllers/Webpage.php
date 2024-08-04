<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Webpage extends MY_Controller{

    public $folder_upload = 'upload/news/';
    public $allowed_types = 'jpg|png|jpeg|mp4';
    public $image_width   = 250;
    public $image_height  = 250;
    public $allowed_file_size     = 5000; // 5 MB -> 5000 KB
    
    function __construct(){
        parent::__construct();
        if(!$this->is_logged_in()){
            redirect(base_url("login"));
        }
        /*
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('User_model');
        $this->load->model('Webpage_model');
        */
        $this->load->model('Branch_model');
        $this->load->model('User_model');
        $this->load->model('News_model');
        $this->load->model('Kategori_model');  
        $this->load->model('Faq_model');                

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->folder_upload = 'upload/branch/';
        $this->allowed_types = 'jpg|png|jpeg|mp4';
        $this->image_width   = 480;
        $this->image_height  = 120;
        $this->allowed_file_size     = 1024; // 5 MB -> 5000 KB        
    }
    function index(){
        if ($this->input->post()) {    
            $return = new \stdClass();
            $return->status = 0;
            $return->message = '';
            $return->result = '';

            $upload_directory = $this->folder_upload;     
            $upload_path_directory = $upload_directory;

            $data['session'] = $this->session->userdata();  
            $session_user_id = !empty($data['session']['user_data']['user_id']) ? $data['session']['user_data']['user_id'] : null;

            $post = $this->input->post();
            $get  = $this->input->get();
            $action = !empty($this->input->post('action')) ? $this->input->post('action') : false;
            
            switch($action){
                case "load":
                    $columns = array(
                        '0' => 'name_id',
                        '1' => 'name_name'
                    );

                    $limit     = !empty($post['length']) ? $post['length'] : 10;
                    $start     = !empty($post['start']) ? $post['start'] : 0;
                    $order     = !empty($post['order']) ? $columns[$post['order'][0]['column']] : $columns[0];
                    $dir       = !empty($post['order'][0]['dir']) ? $post['order'][0]['dir'] : "asc";
                    
                    $search    = [];
                    if(!empty($post['search']['value'])) {
                        $s = $post['search']['value'];
                        foreach ($columns as $v) {
                            $search[$v] = $s;
                        }
                    }

                    $params = array();
                    
                    /* If Form Mode Transaction CRUD not Master CRUD
                    !empty($post['date_start']) ? $params['name_date >'] = date('Y-m-d H:i:s', strtotime($post['date_start'].' 23:59:59')) : $params;
                    !empty($post['date_end']) ? $params['name_date <'] = date('Y-m-d H:i:s', strtotime($post['date_end'].' 23:59:59')) : $params;
                    */

                    //Default Params for Master CRUD Form
                    $params['name_id']   = !empty($post['name_id']) ? $post['name_id'] : $params;
                    $params['name_name'] = !empty($post['name_name']) ? $post['name_name'] : $params;

                    /*
                        if($post['other_column'] && $post['other_column'] > 0) {
                            $params['other_column'] = $post['other_column'];
                        }
                        if($post['filter_type'] !== "All") {
                            $params['name_type'] = $post['filter_type'];
                        }
                    */
                    
                    $get_count = $this->Webpage_model->get_all_name_count($params, $search);
                    if($get_count > 0){
                        $get_data = $this->Webpage_model->get_all_name($params, $search, $limit, $start, $order, $dir);
                        $return->total_records   = $get_count;
                        $return->status          = 1; 
                        $return->result          = $get_data;
                    }else{
                        $return->total_records   = 0;
                        $return->result          = [];
                    }
                    $return->message             = 'Load '.$return->total_records.' data';
                    $return->recordsTotal        = $return->total_records;
                    $return->recordsFiltered     = $return->total_records;
                    break;
                case "create_update":
                    $this->form_validation->set_rules('name_id', 'name_id', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{

                        if(intval($post['name_id']) > 0){ /* Update if Exist */ // if( (!empty($post['name_session'])) && (strlen($post['name_session']) > 10) ){ /* Update if Exist */

                            /* Check Existing Data */
                            $where_not = [
                                'name_id' => intval($post['name_id']),
                            ];
                            $where_new = [
                                'name_name' => $name_name
                            ];
                            $check_exists = $this->Webpage_model->check_data_exist_two_condition($where_not,$where_new);

                            /* Continue Update if not exist */
                            if(!$check_exists){
                                $where = array(
                                    'name_id' => intval($post['name_id']),
                                );
                                $params = array(
                                    'name_name' => $name_name,
                                    'name_flag' => !empty($post['name_flag']) ? $post['name_flag'] : 0
                                );
                                $update = $this->Webpage_model->update_name_custom($where,$params);
                                if($update){
                                    $get_name = $this->Webpage_model->get_name_custom($where);
                                    $return->status  = 1;
                                    $return->message = 'Berhasil memperbarui '.$name_name;
                                    $return->result= array(
                                        'name_id' => $update,
                                        'name_name' => $get_name['name_name'],
                                        'name_session' => $get_name['name_session']
                                    );
                                }else{
                                    $return->message = 'Gagal memperbarui '.$name_name;
                                }
                            }else{
                                $return->message = 'Data sudah digunakan';
                            }
                        }else{ /* Save New Data */

                            /* Check Existing Data */
                            $params_check = [
                                'name_name' => $name_name
                            ];
                            $check_exists = $this->Webpage_model->check_data_exist($params_check);

                            /* Continue Save if not exist */
                            if(!$check_exists){
                                $name_session = strtoupper(substr(hash('sha256', date_timestamp_get(date_create())),0,20));
                                $params = array(
                                    'name_session' => $name_session,
                                    'name_name' => $name_name,
                                    'name_flag' => !empty($post['name_flag']) ? $post['name_flag'] : 0
                                );
                                $create = $this->Webpage_model->add_name($params);
                                if($create){
                                    $get_name = $this->Webpage_model->get_name($create);
                                    $return->status  = 1;
                                    $return->message = 'Berhasil menambahkan '.$name_name;
                                    $return->result= array(
                                        'name_id' => $create,
                                        'name_name' => $get_name['name_name'],
                                        'name_session' => $get_name['name_session']
                                    );
                                }else{
                                    $return->message = 'Gagal menambahkan '.$name_name;
                                }
                            }else{
                                $return->message = 'Data sudah ada';
                            }
                        }
                    }
                    break;
                case "create":
                    // $data = base64_decode($post); $data = json_decode($post, TRUE);
                    $this->form_validation->set_rules('name_name', 'name_name', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{

                        $name_name = !empty($post['name_name']) ? $post['name_name'] : null;
                        $name_flag = !empty($post['name_flag']) ? $post['name_flag'] : 0;
                        $name_session = strtoupper(substr(hash('sha256', date_timestamp_get(date_create())),0,20));

                        $params = array(
                            'name_name' => $name_name,
                            'name_flag' => $name_flag
                        );

                        //Check Data Exist
                        $params_check = array(
                            'name_name' => $name_name
                        );
                        $check_exists = $this->Webpage_model->check_data_exist($params_check);
                        if(!$check_exists){

                            $set_data=$this->Webpage_model->add_name($params);
                            if($set_data){

                                $name_id = $set_data;
                                $data = $this->Webpage_model->get_name($name_id);

                                // Image Save Upload
                                $post_files = !empty($_FILES) ? $_FILES['files'] : "";
                                if(!empty($post_files)){
                                    //Save Image if Exist
                                    $config['image_library'] = 'gd2';
                                    $config['upload_path'] = $upload_path_directory;
                                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                                    $this->upload->initialize($config);
                                    if ($this->upload->do_upload('files')) {
                                        $upload = $this->upload->data();
                                        $raw_photo = time() . $upload['file_ext'];
                                        $old_name = $upload['full_path'];
                                        $new_name = $upload_path_directory . $raw_photo;
                                        if (rename($old_name, $new_name)) {
                                            $compress['image_library'] = 'gd2';
                                            $compress['source_image'] = $upload_path_directory . $raw_photo;
                                            $compress['create_thumb'] = FALSE;
                                            $compress['maintain_ratio'] = TRUE;
                                            $compress['width'] = $this->image_width;
                                            $compress['height'] = $this->image_height;
                                            $compress['new_image'] = $upload_path_directory . $raw_photo;
                                            $this->load->library('image_lib', $compress);
                                            $this->image_lib->resize();

                                            if ($data && $data['name_id']) {
                                                $params_image = array(
                                                    'name_image' => $upload_directory . $raw_photo
                                                );
                                                if (!empty($data['name_image'])) {
                                                    if (file_exists($upload_path_directory . $data['name_image'])) {
                                                        unlink($upload_path_directory . $data['name_image']);
                                                    }
                                                }
                                                $stat = $this->Webpage_model->update_name_custom(array('name_id' => $set_data), $params_image);
                                            }
                                        }
                                    }
                                }
                                //End of Save Image

                                //Croppie Upload Image
                                $post_upload = !empty($this->input->post('upload1')) ? $this->input->post('upload1') : "";
                                if(!empty($post_upload)){
                                    $upload_process = $this->file_upload_image($this->folder_upload,$post_upload);
                                    if($upload_process->status == 1){
                                        if ($data && $data['name_id']) {
                                            $params_image = array(
                                                'name_url' => $upload_process->result['file_location']
                                            );
                                            if (!empty($data['name_url'])) {
                                                if (file_exists($upload_path_directory . $data['name_url'])) {
                                                    unlink($upload_path_directory . $data['name_url']);
                                                }
                                            }
                                            $stat = $this->Webpage_model->update_name_custom(array('name_id' => $set_data), $params_image);
                                        }
                                    }else{
                                        $return->message = 'Fungsi Gambar gagal';
                                    }
                                }
                                //End of Croppie

                                $return->status=1;
                                $return->message='Berhasil menambahkan '.$post['name_name'];
                                $return->result= array(
                                    'id' => $set_data,
                                    'name' => $post['name_name'],
                                    'session' => $name_session
                                ); 
                            }else{
                                $return->message='Gagal menambahkan '.$post['name_name'];
                            }
                        }else{
                            $return->message='Data sudah ada';
                        }
                    }
                    break;
                case "read":
                    $this->form_validation->set_rules('name_id', 'name_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{                
                        $name_id   = !empty($post['name_id']) ? $post['name_id'] : 0;
                        if(intval(strlen($name_id)) > 0){        
                            $datas = $this->Webpage_model->get_name($name_id);
                            if($datas){
                                $return->status=1;
                                $return->message='Berhasil mendapatkan data';
                                $return->result=$datas;
                            }else{
                                $return->message = 'Data tidak ditemukan';
                            }
                        }else{
                            $return->message='Data tidak ada';
                        }
                    }
                    break;
                case "update":
                    $this->form_validation->set_rules('name_id', 'name_id', 'required');
                    $this->form_validation->set_message('required', '{field} tidak ditemukan');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $name_id = !empty($post['name_id']) ? $post['name_id'] : $post['name_id'];
                        $name_name = !empty($post['name_name']) ? $post['name_name'] : $post['name_name'];
                        $name_flag = !empty($post['name_flag']) ? $post['name_flag'] : $post['name_flag'];

                        if(strlen($name_id) > 1){
                            $params = array(
                                'name_name' => $name_name,
                                'name_date_updated' => date("YmdHis"),
                                'name_flag' => $name_flag
                            );

                            /*
                            if(!empty($data['password'])){
                                $params['password'] = md5($data['password']);
                            }
                            */
                           
                            $set_update=$this->Webpage_model->update_name($name_id,$params);
                            if($set_update){
                                
                                $get_data = $this->Webpage_model->get_name($name_id);
                                    
                                //Update Image if Exist
                                $post_files = !empty($_FILES) ? $_FILES['files'] : "";
                                if(!empty($post_files)){
                                    $config['image_library'] = 'gd2';
                                    $config['upload_path'] = $upload_path_directory;
                                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                                    $this->upload->initialize($config);
                                    if ($this->upload->do_upload('files')) {
                                        $upload = $this->upload->data();
                                        $raw_photo = time() . $upload['file_ext'];
                                        $old_name = $upload['full_path'];
                                        $new_name = $upload_path_directory . $raw_photo;
                                        if (rename($old_name, $new_name)) {
                                            $compress['image_library'] = 'gd2';
                                            $compress['source_image'] = $upload_path_directory . $raw_photo;
                                            $compress['create_thumb'] = FALSE;
                                            $compress['maintain_ratio'] = TRUE;
                                            $compress['width'] = $this->image_width;
                                            $compress['height'] = $this->image_height;
                                            $compress['new_image'] = $upload_path_directory . $raw_photo;
                                            $this->load->library('image_lib', $compress);
                                            $this->image_lib->resize();
                                            if ($get_data) {
                                                $params_image = array(
                                                    'name_image' => base_url($upload_directory) . $raw_photo
                                                );
                                                if (!empty($get_data['name_image'])) {
                                                    $file = FCPATH.$this->folder_upload.$get_data['name_image'];
                                                    if (file_exists($file)) {
                                                        unlink($file);
                                                    }
                                                }
                                                $stat = $this->Webpage_model->update_name_custom(array('name_id' => $name_id), $params_image);
                                            }
                                        }
                                    }
                                }
                                //End of Save Image

                                $return->status  = 1;
                                $return->message = 'Berhasil memperbarui '.$name_name;
                            }else{
                                $return->message='Gagal memperbarui '.$name_name;
                            }   
                        }else{
                            $return->message = "Gagal memperbarui";
                        } 
                    }
                    break;
                case "delete":
                    $this->form_validation->set_rules('name_id', 'name_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $name_id   = !empty($post['name_id']) ? $post['name_id'] : 0;
                        $name_name = !empty($post['name_name']) ? $post['name_name'] : null;

                        if(strlen($name_id) > 0){
                            $get_data=$this->Webpage_model->get_name($name_id);
                            // $set_data=$this->Webpage_model->delete_name($name_id);
                            $set_data = $this->Webpage_model->update_name_custom(array('name_id'=>$name_id),array('name_flag'=>4));                
                            if($set_data){
                                /*
                                $file = FCPATH.$this->folder_upload.$get_data['name_image'];
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                                */
                                $return->status=1;
                                $return->message='Berhasil menghapus '.$name_name;
                            }else{
                                $return->message='Gagal menghapus '.$name_name;
                            } 
                        }else{
                            $return->message='Data tidak ditemukan';
                        }
                    }
                    break;
                case "update_flag":
                    $this->form_validation->set_rules('name_id', 'name_id', 'required');
                    $this->form_validation->set_rules('name_flag', 'name_flag', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $name_id = !empty($post['name_id']) ? $post['name_id'] : 0;
                        if(strlen(intval($name_id)) > 1){
                            
                            $params = array(
                                'name_flag' => !empty($post['name_flag']) ? intval($post['name_flag']) : 0,
                            );
                            
                            $where = array(
                                'name_id' => !empty($post['name_id']) ? intval($post['name_id']) : 0,
                            );
                            
                            if($post['name_flag']== 0){
                                $set_msg = 'nonaktifkan';
                            }else if($post['name_flag']== 1){
                                $set_msg = 'mengaktifkan';
                            }else if($post['name_flag']== 4){
                                $set_msg = 'menghapus';
                            }else{
                                $set_msg = 'mendapatkan data';
                            }

                            if($post['name_flag'] == 4){
                                $params['name_url'] = null;
                            }

                            $get_data = $this->Webpage_model->get_name_custom($where);
                            if($get_data){
                                $set_update=$this->Webpage_model->update_name_custom($where,$params);
                                if($set_update){
                                    if($post['name_flag'] == 4){
                                        /*
                                        $file = FCPATH.$this->folder_upload.$get_data['name_image'];
                                        if (file_exists($file)) {
                                            unlink($file);
                                        }
                                        */
                                    }
                                    $return->status  = 1;
                                    $return->message = 'Berhasil '.$set_msg.' '.$get_data['name_name'];
                                }else{
                                    $return->message='Gagal '.$set_msg;
                                }
                            }else{
                                $return->message='Gagal mendapatkan data';
                            }   
                        }else{
                            $return->message = 'Tidak ada data';
                        } 
                    }
                    break;
                case "create_name_item":
                    // $data = base64_decode($post);
                    // $data = json_decode($post, TRUE);

                    $this->form_validation->set_rules('name_item_name', 'name_item_name', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{

                        $name_item_name = !empty($post['name_item_name']) ? $post['name_item_name'] : null;
                        $name_item_flag = !empty($post['name_item_flag']) ? $post['name_item_flag'] : 0;
                        $name_item_session = strtoupper(substr(hash('sha256', date_timestamp_get(date_create())),0,20));

                        $params = array(
                            'name_item_name' => $name_item_name,
                            'name_item_flag' => $name_item_flag
                        );

                        //Check Data Exist
                        $params_check = array(
                            'name_item_name' => $name_item_name
                        );
                        $check_exists = $this->Webpage_model->check_data_exist_name_item($params_check);
                        if(!$check_exists){

                            $set_data=$this->Webpage_model->add_name_item($params);
                            if($set_data){

                                $name_item_id = $set_data;
                                $data = $this->Webpage_model->get_name_item($name_item_id);
                                $return->status=1;
                                $return->message='Berhasil menambahkan '.$post['name_item_name'];
                                $return->result= array(
                                    'id' => $set_data,
                                    'name' => $post['name_item_name'],
                                    'session' => $name_item_session
                                ); 
                            }else{
                                $return->message='Gagal menambahkan '.$post['name_item_name'];
                            }
                        }else{
                            $return->message='Data sudah ada';
                        }
                    }
                    break;
                case "read_name_item":
                    $this->form_validation->set_rules('name_item_id', 'name_item_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{                
                        $name_item_id   = !empty($post['name_item_id']) ? $post['name_item_id'] : 0;
                        if(intval(strlen($name_item_id)) > 0){        
                            $datas = $this->Webpage_model->get_name_item($name_item_id);
                            if($datas){
                                $return->status=1;
                                $return->message='Berhasil mendapatkan data';
                                $return->result=$datas;
                            }else{
                                $return->message = 'Data tidak ditemukan';
                            }
                        }else{
                            $return->message='Data tidak ada';
                        }
                    }
                    break;
                case "update_name_item":
                    $this->form_validation->set_rules('name_item_id', 'name_item_id', 'required');
                    $this->form_validation->set_message('required', '{field} tidak ditemukan');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $name_item_id = !empty($post['name_item_id']) ? $post['name_item_id'] : $post['name_item_id'];
                        $name_item_name = !empty($post['name_item_name']) ? $post['name_item_name'] : $post['name_item_name'];
                        $name_item_flag = !empty($post['name_item_flag']) ? $post['name_item_flag'] : $post['name_item_flag'];

                        if(strlen($name_item_id) > 0){
                            $params = array(
                                'name_item_name' => $name_item_name,
                                'name_item_date_updated' => date("YmdHis"),
                                'name_item_flag' => $name_item_flag
                            );
                           
                            $set_update=$this->Webpage_model->update_name_item($name_item_id,$params);
                            if($set_update){
                                $get_data = $this->Webpage_model->get_name_item($name_item_id);
                                $return->status  = 1;
                                $return->message = 'Berhasil memperbarui '.$name_item_name;
                            }else{
                                $return->message='Gagal memperbarui '.$name_item_name;
                            }   
                        }else{
                            $return->message = "Gagal memperbarui";
                        } 
                    }
                    break;
                case "update_name_item_flag":
                    $this->form_validation->set_rules('name_item_id', 'name_item_id', 'required');
                    $this->form_validation->set_rules('name_item_flag', 'name_item_flag', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $name_item_id = !empty($post['name_item_id']) ? $post['name_item_id'] : 0;
                        if(strlen(intval($name_item_id)) > 0){
                            
                            $params = array(
                                'name_item_flag' => !empty($post['name_item_flag']) ? intval($post['name_item_flag']) : 0,
                            );
                            
                            $where = array(
                                'name_item_id' => !empty($post['name_item_id']) ? intval($post['name_item_id']) : 0,
                            );
                            
                            if($post['name_item_flag']== 0){
                                $set_msg = 'nonaktifkan';
                            }else if($post['name_item_flag']== 1){
                                $set_msg = 'mengaktifkan';
                            }else if($post['name_item_flag']== 4){
                                $set_msg = 'menghapus';
                            }else{
                                $set_msg = 'mendapatkan data';
                            }

                            $set_update=$this->Webpage_model->update_name_item_custom($where,$params);
                            if($set_update){
                                $get_data = $this->Webpage_model->get_name_item_custom($where);
                                $return->status  = 1;
                                $return->message = 'Berhasil '.$set_msg.' '.$get_data['name_item_name'];
                            }else{
                                $return->message='Gagal '.$set_msg;
                            }   
                        }else{
                            $return->message = 'Gagal mendapatkan data';
                        } 
                    }
                    break;
                case "delete_name_item":
                    $this->form_validation->set_rules('name_item_id', 'name_item_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $name_item_id   = !empty($post['name_item_id']) ? $post['name_item_id'] : 0;
                        $name_item_name = !empty($post['name_item_name']) ? $post['name_item_name'] : null;                                

                        if(strlen($name_item_id) > 0){
                            $get_data=$this->Webpage_model->get_name_item($name_item_id);
                            // $set_data=$this->Webpage_model->delete_name_item($name_item_id);
                            $set_data = $this->Webpage_model->update_name_item_custom(array('name_item_id'=>$name_item_id),array('name_item_flag'=>4));                
                            if($set_data){
                                /*
                                if (file_exists($get_data['name_item_image'])) {
                                    unlink($get_data['name_item_image']);
                                } 
                                */
                                $return->status=1;
                                $return->message='Berhasil menghapus '.$name_item_name;
                            }else{
                                $return->message='Gagal menghapus '.$name_item_name;
                            } 
                        }else{
                            $return->message='Data tidak ditemukan';
                        }
                    }
                    break;
                case "load_name_item":
                    $columns = array(
                        '0' => 'name_item_id',
                        '1' => 'name_item_name'
                    );

                    $limit     = !empty($post['length']) ? $post['length'] : 10;
                    $start     = !empty($post['start']) ? $post['start'] : 0;
                    $order     = !empty($post['order']) ? $columns[$post['order'][0]['column']] : $columns[0];
                    $dir       = !empty($post['order'][0]['dir']) ? $post['order'][0]['dir'] : "asc";
                    
                    $search    = [];
                    if(!empty($post['search']['value'])) {
                        $s = $post['search']['value'];
                        foreach ($columns as $v) {
                            $search[$v] = $s;
                        }
                    }

                    $params = array();

                    //Default Params for Master CRUD Form
                    $params['name_item_id']   = !empty($post['name_item_id']) ? $post['name_item_id'] : $params;
                    $params['name_item_name'] = !empty($post['name_item_name']) ? $post['name_item_name'] : $params;

                    /*
                    if($post['other_item_column'] && $post['other_item_column'] > 0) {
                        $params['other_item_column'] = $post['other_item_column'];
                    }
                    */
                    
                    $get_count = $this->Webpage_model->get_all_name_item_count($params, $search);
                    if($get_count > 0){
                        $get_data = $this->Webpage_model->get_all_name_item($params, $search, $limit, $start, $order, $dir);
                        $return->total_records   = $get_count;
                        $return->status          = 1; 
                        $return->result          = $get_data;
                    }else{
                        $return->total_records   = 0;
                        $return->result          = [];
                    }
                    $return->message             = 'Load '.$return->total_records.' data';
                    $return->recordsTotal        = $return->total_records;
                    $return->recordsFiltered     = $return->total_records;
                    break;
                case "load_name_item_2":
                    $params = array(); $total  = 0;
                    $this->form_validation->set_rules('name_item_name_id', 'name_item_name_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $name_item_name_id   = !empty($post['name_item_name_id']) ? $post['name_item_name_id'] : 0;
                        if(intval(strlen($name_item_name_id)) > 0){
                            $params = array(
                                'name_item_name_id' => $name_item_name_id
                            );
                            $search = null;
                            $start  = null;
                            $limit  = null;
                            $order  = "name_item_id";
                            $dir    = "asc";
                            $get_data = $this->Webpage_model->get_all_name_item($params, $search, $limit, $start, $order, $dir);
                            if($get_data){
                                $total = count($get_data);
                                $return->status=1;
                                $return->message='Berhasil mendapatkan data';
                                $return->result=$get_data;
                            }else{
                                $return->message = 'Data tidak ditemukan';
                            }
                        }else{
                            $return->message='Data tidak ada';
                        }
                    }
                    $return->params          =$params;
                    $return->total_records   = $total;
                    $return->recordsTotal    = $total;
                    $return->recordsFiltered = $total;
                    break;
                default:
                    $return->message='No Action';
                    break; 
            }
            echo json_encode($return);
        }else{
            // Default First Date & End Date of Current Month
            $firstdate = new DateTime('first day of this month');
            $firstdateofmonth = $firstdate->format('d-m-Y');

            $data['session'] = $this->session->userdata();  
            $session_user_id = !empty($data['session']['user_data']['user_id']) ? $data['session']['user_data']['user_id'] : null;

            $data['first_date'] = $firstdateofmonth;
            $data['end_date'] = date("d-m-Y");
            $data['hour'] = date("H:i");
            $data['theme'] = $this->User_model->get_user($data['session']['user_data']['user_id']);

            $data['image_width'] = intval($this->image_width);
            $data['image_height'] = intval($this->image_height);
            /*
            // Reference Model
            $this->load->model('Reference_model');
            $data['reference'] = $this->Reference_model->get_all_reference();
            */

            $data['title'] = 'Webpage';
            $data['_view'] = 'layouts/admin/menu/folder/name';
            $this->load->view('layouts/admin/index',$data);
            $this->load->view('layouts/admin/menu/folder/name_js.php',$data);
        }
    }
    function menu(){
        $data['session'] = $this->session->userdata();     
        $data['theme'] = $this->User_model->get_user($data['session']['user_data']['user_id']);

        $data['allowed_file_type'] = $this->allowed_types;
        $data['allowed_file_size'] = $this->allowed_file_size;

            $data['title'] = 'Menu';
            $data['_view'] = 'layouts/admin/menu/webpage/menu';
            $file_js = 'layouts/admin/menu/webpage/menu_js.php';
        
        $data['image_width'] = intval($this->image_width);
        $data['image_height'] = intval($this->image_height);

        //Date First of the month
        $firstdate = new DateTime('first day of this month');
        $firstdateofmonth = $firstdate->format('Y-m-d');

        //Date Now
        $datenow =date("Y-m-d"); 
        $data['first_date'] = $firstdateofmonth;
        $data['end_date'] = $datenow;
        
        $this->load->view('layouts/admin/index',$data);
        $this->load->view($file_js,$data);
    }
    function contact(){
        if ($this->input->post()) {    

            $return = new \stdClass();
            $return->status = 0;
            $return->message = '';
            $return->result = '';

            $post = $this->input->post();
            $action = !empty($this->input->post('action')) ? $this->input->post('action') : false;
            
            switch($action){
                case "read":
                    $return->result = $this->Branch_model->get_branch($post['id']);
                    $return->status = 1;
                    $return->message = 'Mengambil data';                
                    break;    
                case "update":
                    $set_json = [
                        'header_title' => !empty($post['header_title']) ? $post['header_title'] : null, 
                        'working_hour' => !empty($post['working_hour']) ? $post['working_hour'] : null,
                        'social_media' => [
                            ['name' => 'facebook', 'link' => !empty($post['facebook']) ? $post['facebook'] : null],
                            ['name' => 'instagram', 'link' => !empty($post['instagram']) ? $post['instagram'] : null],
                            ['name' => 'youtube', 'link' => !empty($post['youtube']) ? $post['youtube'] : null],
                            ['name' => 'twitter', 'link' => !empty($post['twitter']) ? $post['twitter'] : null],
                            ['name' => 'tiktok', 'link' => !empty($post['tiktok']) ? $post['tiktok'] : null],
                        ],
                        'map' => [
                            'longitude' => !empty($post['longitude']) ? $post['longitude'] : null,
                            'latitude' => !empty($post['latitude']) ? $post['latitude'] : null,
                            'link' => !empty($post['link']) ? $post['link'] : null
                        ]                                                                                                                        
                    ];
                    $params = [
                        'branch_name' => $post['nama'],
                        'branch_phone_1' => $post['telepon_1'],
                        'branch_email_1' => $post['email_1'],
                        'branch_phone_2' => $post['telepon_2'],
                        'branch_email_2' => $post['email_2'],                        
                        'branch_address' => $post['alamat'],
                        'branch_province_id' => $post['provinsi'],
                        'branch_city_id' => $post['kota'],
                        // 'branch_village_id' => $post['kecamatan'],
                        'branch_note' => json_encode($set_json)                        
                    ];
                    // var_dump($params);die;
                    $get_data = $this->Branch_model->get_branch($post['id']);
                    
                    //Croppie Upload Image
                    $post_upload = !empty($this->input->post('upload1')) ? $this->input->post('upload1') : "";
                    if(strlen($post_upload) > 10){
                        $upload_process = $this->file_upload_image($this->folder_upload,$post_upload);
                        if($upload_process->status == 1){
                            $params['branch_logo'] = $upload_process->result['file_location'];
                            $params['branch_logo_sidebar'] = $upload_process->result['file_location']; 

                            if($get_data['branch_logo'] !== 'upload/branch/default_logo.png'){
                                if (!empty($get_data['branch_logo'])) {
                                    if (file_exists(FCPATH . $get_data['branch_logo'])) {
                                        unlink(FCPATH . $get_data['branch_logo']);
                                    }
                                }
                            }
                        }else{
                            $return->message = 'Fungsi Gambar gagal';
                        }
                    }
                    //End of Croppie          
                                        
                    $this->Branch_model->update_branch($post['id'],$params);
                    $return->status = 1;
                    $return->message = 'Berhasil memperbarui';
                    break;
            }
            $return->action = $action;
            echo json_encode($return);
        }else{
            $return = new \stdClass();
            $return->status = 0;
            $return->message = '';
            $return->result = '';        
            $data['session'] = $this->session->userdata();     
            $data['theme'] = $this->User_model->get_user($data['session']['user_data']['user_id']);

            $data['allowed_file_type'] = $this->allowed_types;
            $data['allowed_file_size'] = $this->allowed_file_size;

                $data['title'] = 'Contact Info';
                $data['_view'] = 'layouts/admin/menu/webpage/web_contact';
                $file_js = 'layouts/admin/menu/webpage/web_contact_js.php';
            
            $data['image_width'] = intval($this->image_width);
            $data['image_height'] = intval($this->image_height);

            //Date First of the month
            $firstdate = new DateTime('first day of this month');
            $firstdateofmonth = $firstdate->format('Y-m-d');

            //Date Now
            $datenow =date("Y-m-d"); 
            $data['first_date'] = $firstdateofmonth;
            $data['end_date'] = $datenow;
            
            $this->load->view('layouts/admin/index',$data);
            $this->load->view($file_js,$data);
        }
    }    
    function faq(){
        if ($this->input->post()) {    
            $return = new \stdClass();
            $return->status = 0;
            $return->message = '';
            $return->result = '';

            $upload_directory = $this->folder_upload;     
            $upload_path_directory = $upload_directory;

            $data['session'] = $this->session->userdata();  
            $session_user_id = !empty($data['session']['user_data']['user_id']) ? $data['session']['user_data']['user_id'] : null;

            $post = $this->input->post();
            $get  = $this->input->get();
            $action = !empty($this->input->post('action')) ? $this->input->post('action') : false;
            
            switch($action){
                case "load":
                    $columns = array(
                        '0' => 'faq_id',
                        '1' => 'faq_question',
                        '2' => 'faq_answer'
                    );

                    $limit     = !empty($post['length']) ? $post['length'] : 10;
                    $start     = !empty($post['start']) ? $post['start'] : 0;
                    $order     = !empty($post['order']) ? $columns[$post['order'][0]['column']] : $columns[0];
                    $dir       = !empty($post['order'][0]['dir']) ? $post['order'][0]['dir'] : "asc";
                    
                    $search    = [];
                    if(!empty($post['search']['value'])) {
                        $s = $post['search']['value'];
                        foreach ($columns as $v) {
                            $search[$v] = $s;
                        }
                    }

                    $params = array();
                    
                    /* If Form Mode Transaction CRUD not Master CRUD
                    !empty($post['date_start']) ? $params['faq_date >'] = date('Y-m-d H:i:s', strtotime($post['date_start'].' 23:59:59')) : $params;
                    !empty($post['date_end']) ? $params['faq_date <'] = date('Y-m-d H:i:s', strtotime($post['date_end'].' 23:59:59')) : $params;
                    */

                    //Default Params for Master CRUD Form
                    // $params['faq_id']   = !empty($post['faq_id']) ? $post['faq_id'] : $params;
                    // $params['faq_name'] = !empty($post['faq_name']) ? $post['faq_name'] : $params;

                    /*
                        if($post['other_column'] && $post['other_column'] > 0) {
                            $params['other_column'] = $post['other_column'];
                        }
                        if($post['filter_type'] !== "All") {
                            $params['faq_type'] = $post['filter_type'];
                        }
                    */
                    
                    $get_count = $this->Faq_model->get_all_faq_count($params, $search);
                    if($get_count > 0){
                        $get_data = $this->Faq_model->get_all_faq($params, $search, $limit, $start, $order, $dir);
                        $return->total_records   = $get_count;
                        $return->status          = 1; 
                        $return->result          = $get_data;
                    }else{
                        $return->total_records   = 0;
                        $return->result          = [];
                    }
                    $return->message             = 'Load '.$return->total_records.' data';
                    $return->recordsTotal        = $return->total_records;
                    $return->recordsFiltered     = $return->total_records;
                    break;
                case "create_update":
                    $this->form_validation->set_rules('faq_question', 'faq_question', 'required');
                    $this->form_validation->set_rules('faq_answer', 'faq_answer', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{

                        if(intval($post['faq_id']) > 0){ /* Update if Exist */ // if( (!empty($post['faq_session'])) && (strlen($post['faq_session']) > 10) ){ /* Update if Exist */

                            /* Check Existing Data */
                            $where_not = [
                                'faq_id' => intval($post['faq_id']),
                            ];
                            $where_new = [
                                'faq_question' => $post['faq_question']
                            ];
                            $check_exists = $this->Faq_model->check_data_exist_two_condition($where_not,$where_new);

                            /* Continue Update if not exist */
                            if(!$check_exists){
                                $where = array(
                                    'faq_id' => intval($post['faq_id']),
                                );
                                $params = array(
                                    'faq_question' => $post['faq_question'],
                                    'faq_answer' => $post['faq_answer'],                                    
                                    'faq_flag' => !empty($post['faq_flag']) ? $post['faq_flag'] : 0
                                );
                                $update = $this->Faq_model->update_faq_custom($where,$params);
                                if($update){
                                    $get_faq = $this->Faq_model->get_faq_custom($where);
                                    $return->status  = 1;
                                    $return->message = 'Berhasil memperbarui '.$post['faq_question'];
                                    $return->result= array(
                                        'faq_id' => $update,
                                        'faq_name' => $get_faq['faq_question']
                                    );
                                }else{
                                    $return->message = 'Gagal memperbarui ';
                                }
                            }else{
                                $return->message = 'Data sudah digunakan';
                            }
                        }else{ /* Save New Data */

                            /* Check Existing Data */
                            $params_check = [
                                'faq_question' => $post['faq_question']
                            ];
                            $check_exists = $this->Faq_model->check_data_exist($params_check);

                            /* Continue Save if not exist */
                            if(!$check_exists){
                                // $faq_session = strtoupper(substr(hash('sha256', date_timestamp_get(date_create())),0,20));
                                $params = array(
                                    'faq_question' => $post['faq_question'],
                                    'faq_answer' => $post['faq_answer'],                                    
                                    'faq_flag' => !empty($post['faq_flag']) ? $post['faq_flag'] : 0
                                );
                                $create = $this->Faq_model->add_faq($params);
                                if($create){
                                    $get_faq = $this->Faq_model->get_faq($create);
                                    $return->status  = 1;
                                    $return->message = 'Berhasil menambahkan '.$post['faq_question'];
                                    $return->result= array(
                                        'faq_id' => $create,
                                        'faq_name' => $get_faq['faq_question']
                                    );
                                }else{
                                    $return->message = 'Gagal menambahkan';
                                }
                            }else{
                                $return->message = 'Data sudah ada';
                            }
                        }
                    }
                    break;
                case "read":
                    $this->form_validation->set_rules('faq_id', 'faq_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{                
                        $faq_id   = !empty($post['faq_id']) ? $post['faq_id'] : 0;
                        if(intval(strlen($faq_id)) > 0){        
                            $datas = $this->Faq_model->get_faq($faq_id);
                            if($datas){
                                $return->status=1;
                                $return->message='Berhasil mendapatkan data';
                                $return->result=$datas;
                            }else{
                                $return->message = 'Data tidak ditemukan';
                            }
                        }else{
                            $return->message='Data tidak ada';
                        }
                    }
                    break;
                case "delete":
                    $this->form_validation->set_rules('faq_id', 'faq_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $faq_id   = !empty($post['faq_id']) ? $post['faq_id'] : 0;
                        $faq_name = !empty($post['faq_name']) ? $post['faq_name'] : null;

                        if(strlen($faq_id) > 0){
                            $get_data=$this->Faq_model->get_faq($faq_id);
                            // $set_data=$this->Faq_model->delete_faq($faq_id);
                            $set_data = $this->Faq_model->update_faq_custom(array('faq_id'=>$faq_id),array('faq_flag'=>4));                
                            if($set_data){
                                /*
                                $file = FCPATH.$this->folder_upload.$get_data['faq_image'];
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                                */
                                $return->status=1;
                                $return->message='Berhasil menghapus '.$faq_name;
                            }else{
                                $return->message='Gagal menghapus '.$faq_name;
                            } 
                        }else{
                            $return->message='Data tidak ditemukan';
                        }
                    }
                    break;
                case "update_flag":
                    $this->form_validation->set_rules('faq_id', 'faq_id', 'required');
                    $this->form_validation->set_rules('faq_flag', 'faq_flag', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $faq_id = !empty($post['faq_id']) ? $post['faq_id'] : 0;
                        if(intval($faq_id) > 0){
                            
                            $params = array(
                                'faq_flag' => !empty($post['faq_flag']) ? intval($post['faq_flag']) : 0,
                            );
                            
                            $where = array(
                                'faq_id' => !empty($post['faq_id']) ? intval($post['faq_id']) : 0,
                            );
                            
                            if($post['faq_flag']== 0){
                                $set_msg = 'nonaktifkan';
                            }else if($post['faq_flag']== 1){
                                $set_msg = 'mengaktifkan';
                            }else if($post['faq_flag']== 4){
                                $set_msg = 'menghapus';
                            }else{
                                $set_msg = 'mendapatkan data';
                            }

                            $get_data = $this->Faq_model->get_faq_custom($where);
                            if($get_data){
                                $set_update=$this->Faq_model->update_faq_custom($where,$params);
                                if($set_update){
                                    if($post['faq_flag'] == 4){
                                        /*
                                        $file = FCPATH.$this->folder_upload.$get_data['faq_image'];
                                        if (file_exists($file)) {
                                            unlink($file);
                                        }
                                        */
                                    }
                                    $return->status  = 1;
                                    $return->message = 'Berhasil '.$set_msg;
                                }else{
                                    $return->message='Gagal '.$set_msg;
                                }
                            }else{
                                $return->message='Gagal mendapatkan data';
                            }   
                        }else{
                            $return->message = 'Tidak ada data';
                        } 
                    }
                    break;
                default:
                    $return->message='No Action';
                    break; 
            }
            echo json_encode($return);
        }else{
            // Default First Date & End Date of Current Month
            $firstdate = new DateTime('first day of this month');
            $firstdateofmonth = $firstdate->format('d-m-Y');

            $data['session'] = $this->session->userdata();  
            $session_user_id = !empty($data['session']['user_data']['user_id']) ? $data['session']['user_data']['user_id'] : null;

            $data['first_date'] = $firstdateofmonth;
            $data['end_date'] = date("d-m-Y");
            $data['hour'] = date("H:i");
            $data['theme'] = $this->User_model->get_user($data['session']['user_data']['user_id']);

            $data['image_width'] = intval($this->image_width);
            $data['image_height'] = intval($this->image_height);
            /*
            // Reference Model
            $this->load->model('Reference_model');
            $data['reference'] = $this->Reference_model->get_all_reference();
            */

            $data['title'] = 'Faq';
            $data['_view'] = 'layouts/admin/menu/webpage/faq';
            $this->load->view('layouts/admin/index',$data);
            $this->load->view('layouts/admin/menu/webpage/faq_js.php',$data);
        }
    }    
}
?>