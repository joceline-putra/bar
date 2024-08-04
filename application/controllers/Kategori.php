<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends MY_Controller{
    var $folder_upload = 'upload/category/';
    var $image_width   = 240;
    var $image_height  = 240;    
    var $blog_route = 'blog';
    var $project_route = 'project';    

    function __construct(){
        parent::__construct();
        if(!$this->is_logged_in()){
            redirect(base_url("login"));
        }
        $this->load->model('User_model');           
        $this->load->model('Kategori_model');                   
        // $this->load->model('Satuan_model');
        // $this->load->model('Referensi_model');        
    } 
    function pages($identity){


        $data['session'] = $this->session->userdata();     
        $data['theme'] = $this->User_model->get_user($data['session']['user_data']['user_id']);

        if($identity == 1){ //Kategori Produk

            $params = array(
                'category_parent_id' => 0,
                'category_type' => 1
            );
            $order = 'category_name';
            $search = null;
            $data['parent_category'] = $this->Kategori_model->get_all_categoriess($params,$search,10,0,$order,'ASC');
            $data['identity'] = $identity;
            $data['title'] = 'Kategori Produk';
            $data['_view'] = 'layouts/admin/menu/product/category_product';
            $file_js = 'layouts/admin/menu/product/category_product_js.php';
        }

        if($identity == 2){ //Kategori Artikel
            $data['_route'] = $this->blog_route;
            $params = array(
                'category_parent_id' => 0,
                'category_type' => 2
            );
            $order = 'category_name';
            $search = null;
            $data['parent_category'] = $this->Kategori_model->get_all_categoriess($params,$search,10,0,$order,'ASC');
            $data['identity'] = $identity;
            $data['title'] = 'Kategori Blog';
            $data['_view'] = 'layouts/admin/menu/webpage/category_article';
            $file_js = 'layouts/admin/menu/webpage/category_article_js.php';
        }        
        /* 
            3. Message WhatsApp
        */
        if($identity == 4){ //Kategori Kontak / Group Kontak

            $params = array(
                'category_parent_id' => 0,
                'category_type' => 1
            );
            $order = 'category_name';
            $search = null;
            $data['parent_category'] = $this->Kategori_model->get_all_categoriess($params,$search,10,0,$order,'ASC');
            $data['identity'] = $identity;
            $data['title'] = 'Group Kontak';
            $data['_view'] = 'layouts/admin/menu/contact/category_contact';
            $file_js = 'layouts/admin/menu/contact/category_contact_js.php';
        }

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
    function manage(){
        $session = $this->session->userdata();
        $return = new \stdClass();
        $return->status = 0;
        $return->message = '';
        $return->result = '';
        $user_id = $session['user_data']['user_id'];
        $branch_id = $session['user_data']['branch']['id'];

        if($this->input->post('action')){
            $post = $this->input->post();            
            $action = $this->input->post('action');
            $post_data = $this->input->post('data');
            $data = json_decode($post_data, TRUE);
            $identity = !empty($this->input->post('tipe')) ? $this->input->post('tipe') : $data['tipe'];

            $table = 'categories';

            //Tipe
            if($identity == 1){ //Kategori Produk
                $set_tipe = 1;
                $params = array(
                    // 'category_parent_id' => $data['parent'],
                    'category_type' => $set_tipe,                    
                    'category_name' => !empty($data['nama']) ? $data['nama'] : null,
                    // 'category_parent_id' => $data['parent'],
                    'category_url' => !empty($data['url']) ? $data['url'] : null,  
                    'category_icon' => !empty($data['icon']) ? $data['icon'] : null, 
                    'category_date_created' => date("YmdHis"),
                    'category_date_updated' => date("YmdHis"),
                    'category_flag' => !empty($data['status']) ? $data['status'] : null,
                    'category_user_id' => $user_id,
                    'category_branch_id' => $branch_id
                );
                $params_update = array(
                    'category_name' => !empty($data['nama']) ? $data['nama'] : null,
                    // 'category_parent_id' => $data['parent'],
                    'category_url' => !empty($data['url']) ? $data['url'] : null,   
                    'category_icon' => !empty($data['icon']) ? $data['icon'] : null,
                    'category_date_updated' => date("YmdHis"),
                    'category_flag' => !empty($data['status']) ? $data['status'] : null,
                );                                 
                $columns = array(
                    '0' => 'category_name'
                );
            }
            else if($identity == 2){ //Kategori Artikel
                $set_tipe = 2;
                $params = array(
                    // 'category_parent_id' => $data['parent'],
                    'category_type' => $set_tipe,                    
                    // 'category_code' => $data['kode'],
                    'category_name' => !empty($data['nama']) ? $data['nama'] : null,
                    // 'category_parent_id' => $data['parent'],
                    'category_url' => !empty($data['url']) ? $data['url'] : null,   
                    'category_icon' => !empty($data['icon']) ? $data['icon'] : null,       
                    'category_date_created' => date("YmdHis"),
                    'category_date_updated' => date("YmdHis"),
                    'category_flag' => !empty($data['status']) ? $data['status'] : null,
                    'category_user_id' => $user_id,
                    'category_branch_id' => $branch_id
                );
                $params_update = array(
                    // 'category_code' => $data['kode'],
                    'category_name' => !empty($data['nama']) ? $data['nama'] : null,
                    // 'category_parent_id' => $data['parent'],
                    'category_url' => !empty($data['url']) ? $data['url'] : null,   
                    'category_icon' => !empty($data['icon']) ? $data['icon'] : null,
                    'category_date_updated' => date("YmdHis"),
                    'category_flag' => !empty($data['status']) ? $data['status'] : null
                );                                 
                $columns = array(
                    '0' => 'category_name',
                    '1' => 'category_url'
                );
            }            
            else if($identity == 4){ //Kategori Kontak / Group Kontak
                $set_tipe = 4;
                $params = array(
                    // 'category_parent_id' => $data['parent'],
                    'category_type' => $set_tipe,                    
                    'category_name' => !empty($data['nama']) ? $data['nama'] : null,
                    // 'category_parent_id' => $data['parent'],
                    'category_url' => !empty($data['url']) ? $data['url'] : null,  
                    'category_icon' => !empty($data['icon']) ? $data['icon'] : null, 
                    'category_date_created' => date("YmdHis"),
                    'category_date_updated' => date("YmdHis"),
                    'category_flag' => !empty($data['status']) ? $data['status'] : null,
                    'category_user_id' => $user_id,
                    'category_branch_id' => $branch_id
                );
                $params_update = array(
                    'category_name' => !empty($data['nama']) ? $data['nama'] : null,
                    // 'category_parent_id' => $data['parent'],
                    'category_url' => !empty($data['url']) ? $data['url'] : null,   
                    'category_icon' => !empty($data['icon']) ? $data['icon'] : null,
                    'category_date_updated' => date("YmdHis"),
                    'category_flag' => !empty($data['status']) ? $data['status'] : null,
                );                                 
                $columns = array(
                    '0' => 'category_name'
                );
            }

            switch($action){
                case "create":
                    //Check Data Exist
                    if($identity == 1){ //Produk
                        $params_check = array(
                            'category_branch_id' => $branch_id,                        
                            'category_url' => $data['url'],
                            'category_name' => $data['nama'],
                            'category_type' => $identity
                        );
                    }
                    if(($identity == 2) or ($identity == 5)){ //News / Project
                        $params_check = array(
                            'category_url' => $data['url'],
                            'category_name' => $data['nama'],
                            'category_type' => $identity
                        );
                    }                
                    $check_exists = $this->Kategori_model->check_data_exist($params_check);
                    if($check_exists==false){
                        $set_data=$this->Kategori_model->add_categories($params);

                        
                        if($set_data==true){
                            //Aktivitas
                            $params = array(
                                'activity_user_id' => $session['user_data']['user_id'],
                                'activity_action' => 2,
                                'activity_table' => $table,
                                'activity_table_id' => $set_data,                            
                                'activity_text_1' => strtoupper($data['nama']),
                                'activity_text_2' => ucwords(strtolower($data['nama'])),                        
                                'activity_date_created' => date('YmdHis'),
                                'activity_flag' => 1
                            );
                            $this->save_activity($params);                
                            $return->status=1;
                            $return->message='Berhasil menambahkan '.$data['nama'];
                            $return->result= array(
                                'id' => $set_data,
                                'nama' => $data['nama']
                            );                         
                        }
                    }else{
                        $return->message='Data sudah ada';
                    }
                    break;
                case "read":
                    // $post_data = $this->input->post('data');
                    // $data = json_decode($post_data, TRUE);     
                    $data['id'] = $this->input->post('id');        
                        $datas = $this->Kategori_model->get_categories($data['id']);
                    if($datas==true){
                        //Aktivitas
                        $params = array(
                            'activity_user_id' => $session['user_data']['user_id'],
                            'activity_action' => 3,
                            'activity_table' => $table,
                            'activity_table_id' => $datas['category_id'],
                            'activity_text_1' => strtoupper($datas['category_name']),
                            'activity_text_2' => ucwords(strtolower($datas['category_name'])),
                            'activity_date_created' => date('YmdHis'),
                            'activity_flag' => 0
                        );
                        $this->save_activity($params);              
                        $return->status=1;
                        $return->message='Success';
                        $return->result=$datas;
                    }                
                    break;
                case "update":
                    $post_data = $this->input->post('data');
                    $data = json_decode($post_data, TRUE);
                    $id = $data['id'];
                    $set_update=$this->Kategori_model->update_categories($id,$params_update);
                    if($set_update==true){
                        //Croppie Upload Image
                        $post_upload = !empty($data['upload1']) ? $data['upload1'] : "";
                        if(strlen($post_upload) > 10){
                            // var_dump($post_upload);die;
                            $upload_process = $this->file_upload_image($this->folder_upload,$post_upload);
                            // var_dump($upload_process);die;
                            if($upload_process->status == 1){
                                if ($id > 0) {
                                    $get_cat = $this->Kategori_model->get_categories($id);
                                    $params_image = array(
                                        'category_image' => $upload_process->result['file_location']
                                    );
                                    if (!empty($get_cat['category_image'])) {
                                        if (file_exists(FCPATH . $get_cat['category_image'])) {
                                            unlink(FCPATH . $get_cat['category_image']);
                                        }
                                    }
                                    $stat = $this->Kategori_model->update_categories($id,$params_image);
                                }
                            }else{
                                $return->message = 'Fungsi Gambar gagal';
                            }
                        }
                        //End of Croppie                        
                        
                        //Aktivitas
                        $params = array(
                            'activity_user_id' => $session['user_data']['user_id'],
                            'activity_action' => 4,
                            'activity_table' => $table,
                            'activity_table_id' => $id,
                            'activity_text_1' => strtoupper($data['nama']),
                            'activity_text_2' => ucwords(strtolower($data['nama'])),
                            'activity_date_created' => date('YmdHis'),
                            'activity_flag' => 0
                        );
                        $this->save_activity($params);
                        $return->status=1;
                        $return->message='Berhasil memperbarui '.$data['nama'];
                    }                
                    break;
                case "remove":
                    $id   = !empty($post['id']) ? $post['id'] : 0;

                    if(intval($id) > 0){
                        $get_data=$this->Kategori_model->get_categories($id);     
                        if(intval($get_data['category_count_data']) < 1){         
                            if($get_data){
                                $file = FCPATH . $get_data['category_image'];
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                                $this->Kategori_model->delete_categories($id);              
                                $return->status=1;
                                $return->message='Berhasil menghapus ';
                            }else{
                                $return->message='Gagal menghapus ';
                            } 
                        }else{
                            $return->message = 'Tidak dapat dihapus';
                        }
                    }else{
                        $return->message='Data tidak ditemukan';
                    }                 
                    break;
                case "set-active":
                    $id = $this->input->post('id');
                    // $kode = $this->input->post('kode');        
                    $nama = $this->input->post('nama');                                
                    $flag = $this->input->post('flag');

                    if($flag==1){
                        $msg='aktifkan '.$nama;
                        $act=7;
                    }else{
                        $msg='nonaktifkan  '.$nama;
                        $act=8;
                    }

                    $set_data=$this->Kategori_model->update_categories($id,array('category_flag'=>$flag));
                    if($set_data==true){    
                        //Aktivitas
                        $params = array(
                            'activity_user_id' => $session['user_data']['user_id'],
                            'activity_action' => $act,
                            'activity_table' => $table,
                            'activity_table_id' => $id,
                            'activity_text_1' => strtoupper($nama),
                            'activity_text_2' => ucwords(strtolower($nama)),
                            'activity_date_created' => date('YmdHis'),
                            'activity_flag' => 0
                        );
                        $this->save_activity($params);                                          
                        $return->status=1;
                        $return->message='Berhasil '.$msg;
                    }                
                    break;
                case "load":

                    $limit = $this->input->post('length');
                    $start = $this->input->post('start');
                    $order = $columns[$this->input->post('order')[0]['column']];
                    $dir = $this->input->post('order')[0]['dir'];
                    
                    $filter_flag = !empty($this->input->post('filter_flag')) ? $this->input->post('filter_flag') : 0;

                    $search = [];
                    if ($this->input->post('search')['value']) {
                        $s = $this->input->post('search')['value'];
                        foreach ($columns as $v) {
                            $search[$v] = $s;
                        }
                    }

                    $params = array(
                        'category_branch_id' => $branch_id,
                        'category_type' => $identity
                    );
                    // var_dump($params);die;
                    if($filter_flag < 100){
                        $params['category_flag']=$filter_flag;
                    }

                    $datas_count = $this->Kategori_model->get_all_categoriess_count($params,$search);
                    if(intval($datas_count) > 0){ //Data exist
                        $datas = $this->Kategori_model->get_all_categoriess($params, $search, $limit, $start, $order, $dir);                
                        $return->status=1; 
                        $return->message='Loaded'; 
                        $return->total_records=$datas_count;
                        $return->result=$datas;        
                    }else{
                        $return->message='No data'; 
                        $return->total_records=$datas_count;
                        $return->result=array();    
                    }
                    $return->recordsTotal = $return->total_records;
                    $return->recordsFiltered = $return->total_records;
                    $return->params = $params;
                    break;
            }
        }
        $return->action=$action;
        echo json_encode($return);
        
    }               
}
