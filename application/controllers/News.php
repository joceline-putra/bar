<?php 
/*
    @AUTHOR: Joe Witaya
*/ 
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller{

    public $folder_upload            = 'upload/news/'; // 1
    public $folder_upload_project    = 'upload/project/'; // 5   
    public $folder_upload_gallery    = 'upload/gallery/'; // 6
    public $folder_upload_portofolio = 'upload/portofolio/'; // 7
    public $folder_upload_team       = 'upload/team/'; // 8

    public $allowed_types = 'jpg|png|jpeg|mp4';
    public $image_width = 480;
    public $image_height = 480;

    public $portofolio_width = 200;
    public $portofolio_height = 80;    
    
    public $allowed_file_size = 1024; // 5 MB -> 5000 KB

    var $blog_route         = 'blog';
    var $project_route      = 'project'; 
    var $gallery_route      = 'gallery';
    var $portofolio_route   = 'portofolio'; 
    var $team_route         = 'team';                

    function __construct(){
        parent::__construct();
        if(!$this->is_logged_in()){
            redirect(base_url("login"));
        }
        $this->load->model('User_model');
        $this->load->model('File_model');        
        $this->load->model('News_model');
        $this->load->model('Kategori_model');
        $this->load->model('Aktivitas_model');

        $this->load->helper('form');
        $this->load->library('form_validation');

        // $this->folder_upload = 'upload/news/';
        // $this->allowed_types = 'jpg|png|jpeg|mp4';
        // $this->image_width   = 480;
        // $this->image_height  = 480;
        // $this->allowed_file_size     = 1024; // 5 MB -> 5000 KB
    }
    function pages($identity){
        $data['session'] = $this->session->userdata();     
        $data['theme'] = $this->User_model->get_user($data['session']['user_data']['user_id']);

        $data['allowed_file_type'] = $this->allowed_types;
        $data['allowed_file_size'] = $this->allowed_file_size;

        if($identity == 1){ //Blog / News
            $data['_route'] = $this->blog_route;            
            $data['identity'] = 1;            
            $data['title'] = 'Blog';
            $data['_view'] = 'layouts/admin/menu/webpage/article';
            $file_js = 'layouts/admin/menu/webpage/article_js.php';
        }

        if($identity == 2){ //Template Promo
            $data['identity'] = 2;
            $data['title'] = 'Template';
            $data['_view'] = 'layouts/admin/menu/message/template';
            $file_js = 'layouts/admin/menu/message/template_js.php';
        }        

        if($identity == 5){ //Project

            $data['_route'] = $this->project_route;            
            $data['identity'] = 5;            
            $data['title'] = 'Project';
            $data['_view'] = 'layouts/admin/menu/webpage/project';
            $file_js = 'layouts/admin/menu/webpage/project_js.php';
        }

        if($identity == 6){ //Gallery

            $data['_route'] = $this->project_route;            
            $data['identity'] = 6;            
            $data['title'] = 'Gallery';
            $data['_view'] = 'layouts/admin/menu/webpage/gallery';
            $file_js = 'layouts/admin/menu/webpage/gallery_js.php';
        }
        
        if($identity == 7){ //Portofolio

            $data['_route'] = $this->portofolio_route;            
            $data['identity'] = 7;            
            $data['title'] = 'Portofolio';
            $data['_view'] = 'layouts/admin/menu/webpage/portofolio';
            $file_js = 'layouts/admin/menu/webpage/portofolio_js.php';

            $data['portofolio_width'] = intval($this->portofolio_width);
            $data['portofolio_height'] = intval($this->portofolio_height);
        }
        
        if($identity == 8){ //Team

            $data['_route'] = $this->team_route;            
            $data['identity'] = 8;            
            $data['title'] = 'Team';
            $data['_view'] = 'layouts/admin/menu/webpage/team';
            $file_js = 'layouts/admin/menu/webpage/team_js.php';

            $data['portofolio_width'] = intval($this->image_width);
            $data['portofolio_height'] = intval($this->image_height);
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
        // die;
        $session = $this->session->userdata();
        $session_branch_id = $session['user_data']['branch']['id'];
        $session_user_id = $session['user_data']['user_id'];
                
        $return = new \stdClass();
        $return->status = 0;
        $return->message = '';
        $return->result = '';

        $action = $this->input->post('action');
        $post_data = $this->input->post('data');
        $post = $this->input->post();
        $data = json_decode($post_data, TRUE);
        
        if($this->input->post('action')){
            $action = $this->input->post('action');
            switch($action){
                case "load":
                    $columns = array(
                        '0' => 'news_title',
                        '1' => 'category_name',
                        '2' => 'news_id'
                    );
                    $limit = $this->input->post('length');
                    $start = $this->input->post('start');
                    $order = $columns[$this->input->post('order')[0]['column']];
                    $dir = $this->input->post('order')[0]['dir'];
                    $category = $this->input->post('category');
                    $flag = $this->input->post('flag');                
                    $search = [];
                    if ($this->input->post('search')['value']) {
                        $s = $this->input->post('search')['value'];
                        foreach ($columns as $v) {
                            $search[$v] = $s;
                        }
                    }

                    $params = array();
                    if($session_user_id){
                        $params['news_branch_id'] = $session_branch_id;
                    }
                    $params['news_type'] = !empty($this->input->post('tipe')) ? intval($this->input->post('tipe')) : 0;                
                    if($category > 0){
                        // $params_datatable = array(
                        //     'news.news_category_id' => $category,
                        //     // 'news.news_flag <' => 4
                        //     // 'news.news_branch_id' => $session_branch_id        
                        // );               
                        $params['news_category_id'] = $category;             
                    }

                    // $params = (intval($flag) < 3) ? $params_datatable['news.news_flag']=$flag : $params_datatable;            
                    if($post['flag'] !== "All") {
                        $params['news_flag'] = $post['flag'];
                    }else{
                        $params['news_flag <'] = 5;
                    }
                    /*
                    if($this->input->post('other_column') && $this->input->post('other_column') > 0) {
                        $params['other_column'] = $this->input->post('other_column');
                    }
                    */
                    
                    $datas = $this->News_model->get_all_newss($params, $search, $limit, $start, $order, $dir);
                    $datas_count = $this->News_model->get_all_newss_count($params, $search);                
                    if(isset($datas)){ //Data exist
                        $data_source=$datas; $total=$datas_count;
                        $return->status=1; $return->message='Loaded'; $return->total_records=$total;
                        $return->result=$datas;        
                    }else{ 
                        $data_source=0; $total=0; 
                        $return->status=0; $return->message='No data'; $return->total_records=$total;
                        $return->result=0;    
                    }
                    $return->recordsTotal = $total;
                    $return->recordsFiltered = $total;
                    $return->params = $params;
                    break;
                case "create_update":
                    $this->form_validation->set_rules('news_title', 'Judul', 'required');
                    // $this->form_validation->set_rules('news_category_id', 'Kategori', 'required');
                    $this->form_validation->set_rules('news_content', 'Deskripsi', 'required');
                    $this->form_validation->set_rules('news_tags', 'Tagar', 'required'); 
                    $this->form_validation->set_rules('news_flag', 'Status', 'required');                                                    
                    $this->form_validation->set_message('required', '{field} wajib diisi');               
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{                
                        $next = true;
                        $title = !empty($this->input->post('news_title')) ? $this->safe($this->input->post('news_title')) : '';
                        $url = $this->generate_seo_link($title);                

                        if( (!empty($post['news_id'])) && (strlen($post['news_id']) > 0) ){ /* Update if Exist */ // if( (!empty($post['order_session'])) && (strlen($post['order_session']) > 10) ){ /* Update if Exist */      
                            $news_id = $post['news_id'];
                            $where_not = [
                                'news_id' => intval($post['news_id']),                   
                            ];                            
                            $where_new = [
                                'news_url' => !empty($post['news_url']) ? $post['news_url'] : null,
                                'news_category_id' => !empty($post['news_category_id']) ? $post['news_category_id'] : null, 
                            ];
                            $check_exists = $this->News_model->check_data_exist_two_condition($where_not,$where_new);

                            /* Continue Update if not exist */
                            if(!$check_exists){
                                
                                $get_news = $this->News_model->get_news($news_id);

                                //Croppie Upload Image
                                $post_upload = !empty($this->input->post('upload1')) ? $this->input->post('upload1') : "";
                                if(strlen($post_upload) > 10){
                                    $upload_process = $this->file_upload_image($this->folder_upload,$post_upload);
                                    if($upload_process->status == 1){
                                        if ($get_news && $get_news['news_id']) {
                                            $params_image = array(
                                                'news_image' => $upload_process['result']['file_location']
                                            );
                                            if (!empty($get_news['news_image'])) {
                                                if (file_exists(FCPATH . $get_news['news_image'])) {
                                                    unlink(FCPATH . $get_news['news_image']);
                                                }
                                            }
                                            $stat = $this->News_model->update_news($news_id, $params_image);
                                        }
                                    }else{
                                        $return->message = 'Fungsi Gambar gagal';
                                        $next = false;
                                    }
                                }
                                //End of Croppie 

                                if($next){
                                    $params = array(
                                        'news_type' => !empty($this->input->post('news_type')) ? intval($this->input->post('news_type')) : 1,
                                        'news_category_id' => !empty($this->input->post('news_category_id')) ? $this->input->post('news_category_id') : null,
                                        'news_title' => $title,
                                        'news_url' => $url,
                                        'news_short' => !empty($this->input->post('news_short')) ? $this->input->post('news_short') : null,
                                        'news_content' => !empty($this->input->post('news_content')) ? $this->input->post('news_content') : null,
                                        'news_tags' => !empty($this->input->post('news_tags')) ? $this->input->post('news_tags') : null,
                                        'news_keywords' => !empty($this->input->post('news_keywords')) ? $this->input->post('news_keywords') : null,
                                        'news_date_created' => date("YmdHis"),
                                        'news_date_updated' => date("YmdHis"),
                                        'news_user_id' => $session_user_id,    
                                        'news_branch_id' => $session_branch_id,              
                                        'news_flag' => !empty($this->input->post('news_flag')) ? $this->input->post('news_flag') : 0,
                                        'news_position' => !empty($this->input->post('news_position')) ? $this->input->post('news_position') : null
                                    );
                                    $update = $this->News_model->update_news($news_id,$params);   

                                    if($update){
                                        $get_news = $this->News_model->get_news($news_id);

                                        // /* Start Activity */
                                        $params = array(
                                            'activity_user_id' => $session['user_data']['user_id'],
                                            'activity_action' => 4,
                                            'activity_table' => 'news',
                                            'activity_table_id' => $news_id,                            
                                            'activity_text_1' => strtoupper($post['news_title']),
                                            'activity_text_2' => ucwords(strtolower($post['news_title'])),                        
                                            'activity_date_created' => date('YmdHis'),
                                            'activity_flag' => 1
                                        );
                                        $this->save_activity($params);
                                        // /* End Activity */         

                                        $return->status  = 1;
                                        $return->message = 'Berhasil memperbarui '.$post['news_title'];
                                        $return->result= array(
                                            'news_id' => $news_id,
                                            'news_title' => $get_news['news_title']
                                        );                
                                    }else{
                                        $return->message = 'Gagal memperbarui '.$post['order_name'];
                                    }
                                }
                            }else{
                                $return->message = 'Judul sudah digunakan';
                            }
                        }else{ /* Save New Data */
                            $next = true; $message = '';
                            if($next){
                                /* Check Existing Data */
                                $params_check = [
                                    'news_url' => !empty($post['news_url']) ? $post['news_url'] : null,
                                    'news_category_id' => !empty($post['news_category_id']) ? $post['news_category_id'] : null,                      
                                ];
                                $check_exists = $this->News_model->check_data_exist($params_check);

                                /* Continue Save if not exist */
                                if(!$check_exists){
                                    $params = array(
                                        'news_type' => !empty($this->input->post('news_type')) ? intval($this->input->post('news_type')) : 1,
                                        'news_category_id' => !empty($this->input->post('news_category_id')) ? $this->input->post('news_category_id') : null,
                                        'news_title' => $title,
                                        'news_url' => $url,
                                        'news_short' => !empty($this->input->post('news_short')) ? $this->input->post('news_short') : null,
                                        'news_content' => !empty($this->input->post('news_content')) ? $this->input->post('news_content') : null,
                                        'news_tags' => !empty($this->input->post('news_tags')) ? $this->input->post('news_tags') : null,
                                        'news_keywords' => !empty($this->input->post('news_keywords')) ? $this->input->post('news_keywords') : null,
                                        'news_date_created' => date("YmdHis"),
                                        'news_date_updated' => date("YmdHis"),
                                        'news_user_id' => $session_user_id,    
                                        'news_branch_id' => $session_branch_id,              
                                        'news_flag' => !empty($this->input->post('news_flag')) ? $this->input->post('news_flag') : 0,
                                        'news_position' => !empty($this->input->post('news_position')) ? $this->input->post('news_position') : null
                                    );
                                    
                                    $create = $this->News_model->add_news($params);  
                                    if($create){
                                        $get_news = $this->News_model->get_news($create);
                                        $news_id = $create;

                                        //Croppie Upload Image
                                        $post_upload = !empty($this->input->post('upload1')) ? $this->input->post('upload1') : "";
                                        if(strlen($post_upload) > 10){
                                            $upload_process = $this->file_upload_image($this->folder_upload,$post_upload);
                                            if($upload_process->status == 1){
                                                if ($get_news && $get_news['news_id']) {
                                                    $params_image = array(
                                                        'news_image' => $upload_process->result['file_location']
                                                    );
                                                    if (!empty($get_news['news_image'])) {
                                                        if (file_exists(FCPATH . $get_news['news_image'])) {
                                                            unlink(FCPATH . $get_news['news_image']);
                                                        }
                                                    }
                                                    $stat = $this->News_model->update_news($news_id, $params_image);
                                                }
                                            }else{
                                                $return->message = 'Fungsi Gambar gagal';
                                                $next = false;
                                            }
                                        }
                                        //End of Croppie     

                                        // /* Start Activity */
                                        $params = array(
                                            'activity_user_id' => $session['user_data']['user_id'],
                                            'activity_action' => 2,
                                            'activity_table' => 'news',
                                            'activity_table_id' => $create,                            
                                            'activity_text_1' => strtoupper($post['news_title']),
                                            'activity_text_2' => ucwords(strtolower($post['news_title'])),                        
                                            'activity_date_created' => date('YmdHis'),
                                            'activity_flag' => 1
                                        );
                                        $this->save_activity($params);
                                        // /* End Activity */
                                                                            
                                        $return->status  = 1;
                                        $return->message = 'Berhasil menambahkan '.$title;
                                        $return->result= array(
                                            'news_id' => $create,
                                            'news_title' => $get_news['news_title']
                                        );                                
                                    }else{
                                        $return->message = 'Gagal menambahkan '.$post['news_title'];
                                    }
                                }else{
                                    $return->message = 'Data sudah ada';
                                }  
                            }else{
                                $return->message = $message;
                            }                       
                        }                    
                    }
                    break;
                case "create":
                    $next = true;
                    $post_data = $this->input->post('data');
                    // $data = base64_decode($post_data);
                    $data = json_decode($post_data, TRUE);

                    $title = !empty($this->input->post('title')) ? $this->safe($this->input->post('title')) : '';
                    $url = $this->generate_seo_link($title);                
                    
                    if(strlen($title) > 0){
                        $params = array(
                            'news_type' => !empty($this->input->post('tipe')) ? intval($this->input->post('tipe')) : 1,
                            'news_category_id' => !empty($this->input->post('categories')) ? $this->input->post('categories') : null,
                            'news_title' => $title,
                            'news_url' => $url,
                            'news_short' => !empty($this->input->post('short')) ? $this->input->post('short') : null,
                            'news_content' => !empty($this->input->post('content')) ? $this->input->post('content') : null,
                            'news_tags' => !empty($this->input->post('tags')) ? $this->input->post('tags') : null,
                            'news_keywords' => !empty($this->input->post('keywords')) ? $this->input->post('keywords') : null,
                            'news_date_created' => date("YmdHis"),
                            'news_date_updated' => date("YmdHis"),
                            'news_user_id' => $session_user_id,    
                            'news_branch_id' => $session_branch_id,              
                            'news_flag' => !empty($this->input->post('status')) ? $this->input->post('status') : 0,
                            'news_position' => !empty($this->input->post('posisi')) ? $this->input->post('posisi') : null
                        );

                        //Check Data Exist
                        $params_check = array(
                            'news_title' => $title,
                            'news_url' => $url
                        );
                        $check_exists = $this->News_model->check_data_exist($params_check);
                        if($check_exists==false){

                            if($next){

                                // Call Helper for Upload
                                if(!empty($_FILES['upload1'])){
                                    if(intval($_FILES['upload1']['size']) > $this->allowed_file_size){

                                        //Process for Upload
                                        $image_config=array(
                                            'compress' => 1,
                                            'width'=>$this->image_width,
                                            'height'=>$this->image_height
                                        );
                                        $upload_helper = upload_file_upload1($this->folder_upload, $_FILES['upload1'],$image_config);
                                        if ($upload_helper['status'] == 1) {

                                            //Add Image for params before update
                                            $params['news_image'] = $upload_helper['result']['file_location'];

                                            //Delete old files
                                            /*
                                                if (!empty($datas['news_image'])) {
                                                    if (file_exists(FCPATH . $datas['news_image'])) {
                                                        unlink(FCPATH . $datas['news_image']);
                                                    }
                                                }
                                            */
                                            $set_msg = 'Berhasil menyimpan dengan Gambar'; $next = true;
                                        }else{
                                            $set_msg = 'Error: '.$upload_helper['message']; $next = false;
                                        }
                                    }else{
                                        $set_msg = 'Gagal, ukuran melebihi '.($this->allowed_file_size / 1024).' Mb'; $next = false;
                                    }
                                } else{
                                    $set_msg = 'Menyimpan tanpa gambar';
                                }   
                                // End Call Helper for Upload 

                                if($next){
                                    $set_data=$this->News_model->add_news($params);
                                    $data = $this->News_model->get_news($set_data);

                                    $return->status=1;
                                    $return->message='Berhasil menambahkan';
                                    $return->result= array(
                                        'id' => $set_data,
                                        'title' => $data['news_title']
                                    );                                        
                                }else{
                                    $return->status=0;
                                    $return->message = $set_msg;
                                }

                                /* Start Activity */
                                $params = array(
                                    'activity_user_id' => $session['user_data']['user_id'],
                                    'activity_action' => 2,
                                    'activity_table' => 'news',
                                    'activity_table_id' => $set_data,                            
                                    'activity_text_1' => strtoupper($data['news_title']),
                                    'activity_text_2' => ucwords(strtolower($data['news_title'])),                        
                                    'activity_date_created' => date('YmdHis'),
                                    'activity_flag' => 1
                                );
                                $this->save_activity($params);
                                /* End Activity */
                            }
                        }else{
                            $return->message='Title sudah digunakan';                    
                        }
                    }else{
                        $return->message = 'Title harus diisi';
                    }
                    break;
                case "create_project_or_gallery":
                    $next = true;

                    // Cek if any Files
                    if(!empty($_FILES['files'])){
                        $files_count = count($_FILES['files']['name']);
                        if($files_count > 0){
                            for($i=0; $i<$files_count; $i++){
                                if(intval($_FILES['files']['size'][$i] / 1024) > ($this->allowed_file_size)){
                                    $next = false;
                                    $set_msg = 'Gagal, ukuran melebihi '.($this->allowed_file_size / 1024).' Mb'; $next = false;
                                    $return->message = $set_msg;
                                    echo json_encode($return); die;
                                }else{
                                    $next = true;
                                }
                            }
                        }
                    }

                    if($next){
                        $title = !empty($this->input->post('title')) ? $this->safe($this->input->post('title')) : '';
                        $url = $this->generate_seo_link($title);                
                        
                        if(strlen($title) > 0){
                            $params_save = array(
                                'news_type' => !empty($this->input->post('tipe')) ? intval($this->input->post('tipe')) : 5,
                                'news_category_id' => !empty($this->input->post('categories')) ? $this->input->post('categories') : null,
                                'news_title' => $title,
                                'news_url' => $url,
                                'news_short' => !empty($this->input->post('short')) ? $this->input->post('short') : null,
                                'news_content' => !empty($this->input->post('content')) ? $this->input->post('content') : null,
                                'news_tags' => !empty($this->input->post('tags')) ? $this->input->post('tags') : null,
                                'news_keywords' => !empty($this->input->post('keywords')) ? $this->input->post('keywords') : null,
                                'news_date_created' => date("YmdHis"),
                                'news_date_updated' => date("YmdHis"),
                                'news_user_id' => $session_user_id,    
                                'news_branch_id' => $session_branch_id,              
                                'news_flag' => !empty($this->input->post('status')) ? $this->input->post('status') : 0,
                                'news_position' => !empty($this->input->post('posisi')) ? $this->input->post('posisi') : null
                            );

                            $params_update = array(
                                'news_category_id' => !empty($this->input->post('categories')) ? $this->input->post('categories') : null,
                                'news_title' => $title,
                                'news_url' => $url,
                                'news_short' => !empty($this->input->post('short')) ? $this->input->post('short') : null,
                                'news_content' => !empty($this->input->post('content')) ? $this->input->post('content') : null,
                                'news_tags' => !empty($this->input->post('tags')) ? $this->input->post('tags') : null,
                                'news_keywords' => !empty($this->input->post('keywords')) ? $this->input->post('keywords') : null,
                                'news_date_updated' => date("YmdHis"),
                                // 'news_user_id' => $session_user_id,    
                                // 'news_branch_id' => $session_branch_id,              
                                'news_flag' => !empty($this->input->post('status')) ? $this->input->post('status') : 0,
                                'news_position' => !empty($this->input->post('posisi')) ? $this->input->post('posisi') : null
                            );

                            //Check Data Exist UPDATE
                            if(!empty($this->input->post('id')) && ($this->input->post('id') > 0)){
                                $operator = 2; $mes = 'memperbarui';
                                $where_not = array('news_id'=>$this->input->post('id'));
                                $params_check = array(
                                    'news_title' => $title,
                                    'news_url' => $url,
                                    'news_type' => $post['tipe']
                                );
                                $check_exists = $this->News_model->check_data_exist_two_condition($where_not,$params_check);                                
                            }else{ // SAVE
                                $operator = 1; $mes = 'menyimpan';
                                $params_check = array(
                                    'news_title' => $title,
                                    'news_url' => $url,
                                    'news_type' => $post['tipe']
                                );
                                $check_exists = $this->News_model->check_data_exist($params_check);
                            }
                            
                            if($check_exists==false){
                                // if($next){

                                    if($operator == 1){
                                        $set_data=$this->News_model->add_news($params_save);
                                        $data = $this->News_model->get_news($set_data);
                                    }else{
                                        $update_data = $this->News_model->update_news($this->input->post('id'),$params_update);
                                        $set_data = $this->input->post('id');
                                    }

                                    // Call Helper for Upload
                                    if(!empty($_FILES['files'])){
                                        //Process for Upload
                                        $image_config=array(
                                            'compress' => 1,
                                            'width'=>$this->image_width,
                                            'height'=>$this->image_height
                                        );
                                        if($post['tipe'] == 5){ //Project
                                            $folder = $this->folder_upload_project;
                                        }else if($post['tipe'] == 6){ //Gallery
                                            $folder = $this->folder_upload_gallery;
                                        }

                                        $upload_helper = upload_file_array($folder, $_FILES['files'],$image_config);
                                        if ($upload_helper['status'] == 1) {

                                            foreach($upload_helper['result'] as $v){
                                                $file_session = $this->random_session(20);
                                                $params = array(
                                                    'file_from_table' => 'news',
                                                    'file_from_id' => $set_data,
                                                    'file_session' => $file_session,
                                                    'file_date_created' => date("YmdHis"),
                                                    'file_user_id' => $session_user_id,
                                                    'file_type' => 1,
                                                    'file_name' => $v['file_old_name'],
                                                    'file_format' => $v['file_ext'],
                                                    'file_url' => $v['file_location'],
                                                    'file_size' => $v['file_size']                                                                        
                                                );
                                                $save_data = $this->File_model->add_file($params);
                                            }
                                            //Add Image for params before update
                                            // $params['news_image'] = $this->folder_upload_project.$upload_helper['file'];
                                            $set_msg = 'Berhasil menyimpan dengan Gambar';
                                        }else{
                                            $set_msg = 'Error: '.$upload_helper['message'];
                                        }  
                                    } else{
                                        $set_msg = 'Menyimpan tanpa gambar';
                                    }   
                                    // End Call Helper for Upload 
                                    
                                    $return->status=1;
                                    $return->message='Berhasil '.$mes;
                                    $return->result= array(
                                        'id' => $set_data,
                                        'title' => $data['news_title']
                                    );  

                                    /* Start Activity */
                                    $params = array(
                                        'activity_user_id' => $session['user_data']['user_id'],
                                        'activity_action' => ($operator==1) ? 2 : 4,
                                        'activity_table' => 'news',
                                        'activity_table_id' => $set_data,                            
                                        'activity_text_1' => strtoupper($data['news_title']),
                                        'activity_text_2' => ucwords(strtolower($data['news_title'])),                        
                                        'activity_date_created' => date('YmdHis'),
                                        'activity_flag' => 1
                                    );
                                    $this->save_activity($params);
                                    /* End Activity */
                                // }
                            }else{
                                $return->message='Title sudah digunakan';                    
                            }
                        }else{
                            $return->message = 'Title harus diisi';
                        }
                    }                   
                    break;  
                case "create_portofolio_or_team":
                    $params_check = array(
                        'news_type' => $data['tipe'],
                        'news_title' => ucwords($data['nama']),
                        'news_url' => $data['url']
                    );
                    $check_exists = $this->News_model->check_data_exist($params_check);                    
                    if($check_exists==false){

                        $title = !empty($data['nama']) ? $this->safe(ucwords($data['nama'])) : '';
                        $url = $this->generate_seo_link($title);  

                        $params = array(
                            'news_type' => $data['tipe'],
                            // 'news_category_id' => !empty($this->input->post('categories')) ? $this->input->post('categories') : null,
                            'news_title' => $title,
                            'news_url' => $url,
                            // 'news_short' => !empty($this->input->post('short')) ? $this->input->post('short') : null,
                            // 'news_content' => !empty($this->input->post('content')) ? $this->input->post('content') : null,
                            // 'news_tags' => !empty($this->input->post('tags')) ? $this->input->post('tags') : null,
                            // 'news_keywords' => !empty($this->input->post('keywords')) ? $this->input->post('keywords') : null,
                            'news_date_created' => date("YmdHis"),
                            // 'news_date_updated' => date("YmdHis"),
                            'news_user_id' => $session_user_id,    
                            'news_branch_id' => $session_branch_id,              
                            'news_flag' => $data['status'],
                            // 'news_position' => !empty($this->input->post('posisi')) ? $this->input->post('posisi') : null
                        );                        
                        $set_data=$this->News_model->add_news($params);
                        if($set_data==true){

                            if($data['tipe'] == 7){ //Portofolio
                                $folder = $this->folder_upload_portofolio;
                            }else if($data['tipe'] == 8){ //Team
                                $folder = $this->folder_upload_team;
                            }

                            //Croppie Upload Image
                            $post_upload = !empty($data['upload1']) ? $data['upload1'] : "";
                            if(strlen($post_upload) > 10){
                                $upload_process = upload_file_base64($folder,$post_upload,null);
                                if($upload_process['status'] == 1){
                                        $get_cat = $this->News_model->get_news($set_data);
                                        $params_image = array(
                                            'news_image' => $upload_process['result']['file_location']
                                        );
                                        if (!empty($get_cat['news_image'])) {
                                            if (file_exists(FCPATH . $get_cat['news_image'])) {
                                                unlink(FCPATH . $get_cat['news_image']);
                                            }
                                        }
                                        $this->News_model->update_news($set_data,$params_image);
                                }else{
                                    $return->message = 'Fungsi Gambar gagal';
                                }
                            }
                            //End of Croppie              

                            //Aktivitas
                            $params = array(
                                'activity_user_id' => $session['user_data']['user_id'],
                                'activity_action' => 2,
                                'activity_table' => 'news',
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
                    $data['id'] = $this->input->post('id');           
                    $datas = $this->News_model->get_news($data['id']);
                    if($datas==true){
                        /* Activity */
                        /*
                        $params = array(
                            'activity_user_id' => $session['user_data']['user_id'],
                            'activity_action' => 3,
                            'activity_table' => 'news',
                            'activity_table_id' => $datas['id'],
                            'activity_text_1' => strtoupper($datas['kode']),
                            'activity_text_2' => ucwords(strtolower($datas['username'])),
                            'activity_date_created' => date('YmdHis'),
                            'activity_flag' => 0
                        );
                        $this->save_activity($params);                    
                        /* End Activity */
                        $return->status=1;
                        $return->message='Success';
                        $return->result=$datas;
                    }                
                    break;
                case "read_files":   
                        $data['id'] = $this->input->post('id');    
                        $get_files = $this->File_model->get_all_file(['file_from_table'=>'news','file_from_id'=>$data['id']],null,null,null,'file_id','id');
                        $return->status=1;
                        $return->message='Success';
                        $return->result=$get_files;   
                    break;                    
                case "update":
                    $id = $this->input->post('id');
                    $title = !empty($this->input->post('title')) ? $this->safe($this->input->post('title')) : '';            
                    $url = $this->generate_seo_link($title);                
                    $next = true;

                    if(strlen($title) > 0){
                        $params = array(
                            'news_category_id' => !empty($this->input->post('categories')) ? $this->input->post('categories') : null,
                            'news_title' => $title,
                            'news_url' => $url,
                            'news_short' => !empty($this->input->post('short')) ? $this->input->post('short') : null,
                            'news_content' => !empty($this->input->post('content')) ? $this->input->post('content') : null,
                            'news_tags' => !empty($this->input->post('tags')) ? $this->input->post('tags') : null,
                            'news_keywords' => !empty($this->input->post('keywords')) ? $this->input->post('keywords') : null,
                            'news_date_updated' => date("YmdHis"),
                            'news_flag' => !empty($this->input->post('status')) ? $this->input->post('status') : 0,
                            'news_position' => !empty($this->input->post('posisi')) ? $this->input->post('posisi') : null
                        );

                        //Check Data Exist
                        $where_not = array(
                            'news_category_id' => $this->input->post('categories'),
                            'news_url' => $this->input->post('url')
                        );
                        $where_new = array(
                            // 'news_title' => $title,
                            'news_url' => $this->input->post('url')
                        );                        
                        $check_exists = $this->News_model->check_data_exist_two_condition($where_not,$where_new);
                        if($check_exists==false){

                            $datas = $this->News_model->get_news($id);

                            // Call Helper for Upload
                            if(!empty($_FILES['upload1'])){
                                if(intval($_FILES['upload1']['size']) > $this->allowed_file_size){

                                    //Process for Upload
                                    $image_config=array(
                                        'compress' => 1,
                                        'width'=>$this->image_width,
                                        'height'=>$this->image_height
                                    );
                                    $upload_helper = upload_file_upload1($this->folder_upload, $_FILES['upload1'],$image_config);
                                    if ($upload_helper['status'] == 1) {

                                        //Add Image for params before update
                                        $params['news_image'] = $upload_helper['result']['file_location'];

                                        //Delete old files
                                        if (!empty($datas['news_image'])) {
                                            if (file_exists(FCPATH . $datas['news_image'])) {
                                                unlink(FCPATH . $datas['news_image']);
                                            }
                                        }
                                        $set_msg = 'Berhasil memperbarui dengan Gambar'; $next = true;
                                    }else{
                                        $set_msg = 'Error: '.$upload_helper['message']; $next = false;
                                    }
                                }else{
                                    $set_msg = 'Gagal, ukuran melebihi '.($this->allowed_file_size / 1024).' Mb'; $next = false;
                                }
                            } else{
                                $set_msg = 'Memperbarui tanpa gambar';
                            }   
                            // End Call Helper for Upload 

                            if($next){
                                $set_update=$this->News_model->update_news($id,$params);
                                $return->status=1;
                                $return->message = $set_msg;
                            }else{
                                $return->status=0;
                                $return->message = $set_msg;
                            }

                            /* Activity */
                            $params = array(
                                'activity_user_id' => $session['user_data']['user_id'],
                                'activity_action' => 4,
                                'activity_table' => 'news',
                                'activity_table_id' => $id,
                                'activity_text_1' => strtoupper($datas['news_title']),
                                'activity_text_2' => ucwords(strtolower($datas['news_title'])),
                                'activity_date_created' => date('YmdHis'),
                                'activity_flag' => 0
                            );
                            $this->save_activity($params);
                            /* End Activity */                 
                        }else{
                            $return->message='Title sudah digunakan';                    
                        }
                    }else{
                        $return->message = 'Title harus diisi';
                    }
                    break;
                case "update_portofolio_or_team":
                    $where = array(
                        'news_type' => $data['tipe'],
                        'news_id' => $data['id'],
                    );
                    $params_check = array(
                        'news_type' => $data['tipe'],
                        'news_title' => ucwords($data['nama']),
                        'news_url' => $data['url']
                    );
                    $check_exists = $this->News_model->check_data_exist_two_condition($where,$params_check);                    
                    if($check_exists==false){

                        $title = !empty($data['nama']) ? $this->safe(ucwords($data['nama'])) : '';
                        $url = $this->generate_seo_link($title);  

                        $params = array(
                            // 'news_category_id' => !empty($this->input->post('categories')) ? $this->input->post('categories') : null,
                            'news_title' => $title,
                            'news_url' => $url,
                            // 'news_short' => !empty($this->input->post('short')) ? $this->input->post('short') : null,
                            // 'news_content' => !empty($this->input->post('content')) ? $this->input->post('content') : null,
                            // 'news_tags' => !empty($this->input->post('tags')) ? $this->input->post('tags') : null,
                            // 'news_keywords' => !empty($this->input->post('keywords')) ? $this->input->post('keywords') : null,
                            'news_date_updated' => date("YmdHis"),
                            // 'news_user_id' => $session_user_id,    
                            // 'news_branch_id' => $session_branch_id,              
                            'news_flag' => $data['status'],
                            // 'news_position' => !empty($this->input->post('posisi')) ? $this->input->post('posisi') : null
                        );                        
                        $this->News_model->update_news($data['id'],$params);
                        $set_data = $data['id'];

                        if($set_data==true){
                            
                            if($data['tipe'] == 7){ //Portofolio
                                $folder = $this->folder_upload_portofolio;
                            }else if($data['tipe'] == 8){ //Team
                                $folder = $this->folder_upload_team;
                            }

                            //Croppie Upload Image
                            $post_upload = !empty($data['upload1']) ? $data['upload1'] : "";
                            if(strlen($post_upload) > 10){
                                $upload_process = upload_file_base64($folder,$post_upload,null);
                                if($upload_process['status'] == 1){
                                        $get_cat = $this->News_model->get_news($set_data);
                                        $params_image = array(
                                            'news_image' => $upload_process['result']['file_location']
                                        );
                                        if (!empty($get_cat['news_image'])) {
                                            if (file_exists(FCPATH . $get_cat['news_image'])) {
                                                unlink(FCPATH . $get_cat['news_image']);
                                            }
                                        }
                                        $this->News_model->update_news($set_data,$params_image);
                                }else{
                                    $return->message = 'Fungsi Gambar gagal';
                                }
                            }
                            //End of Croppie              

                            //Aktivitas
                            $params = array(
                                'activity_user_id' => $session['user_data']['user_id'],
                                'activity_action' => 2,
                                'activity_table' => 'news',
                                'activity_table_id' => $set_data,                            
                                'activity_text_1' => strtoupper($data['nama']),
                                'activity_text_2' => ucwords(strtolower($data['nama'])),                        
                                'activity_date_created' => date('YmdHis'),
                                'activity_flag' => 1
                            );
                            $this->save_activity($params);                
                            $return->status=1;
                            $return->message='Berhasil memperbarui '.$data['nama'];
                            $return->result= array(
                                'id' => $set_data,
                                'nama' => $data['nama']
                            );                         
                        }
                    }else{
                        $return->message='Data sudah ada';
                    }
                    break;                    
                case "remove":
                    $data['id'] = $this->input->post('id');           
                    $datas = $this->News_model->get_news($data['id']);
                    if($datas==true){
                        //Delete old files
                        if (!empty($datas['news_image'])) {
                            if (file_exists(FCPATH . $datas['news_image'])) {
                                unlink(FCPATH . $datas['news_image']);
                            }
                        }
                        $this->News_model->delete_news($datas['news_id']);
                        /* Activity */
                        /*
                        $params = array(
                            'activity_user_id' => $session['user_data']['user_id'],
                            'activity_action' => 4,
                            'activity_table' => 'news',
                            'activity_table_id' => $datas['id'],
                            'activity_text_1' => strtoupper($datas['kode']),
                            'activity_text_2' => ucwords(strtolower($datas['username'])),
                            'activity_date_created' => date('YmdHis'),
                            'activity_flag' => 0
                        );
                        $this->save_activity($params);                    
                        /* End Activity */
                        $return->status=1;
                        $return->message='Menghapus '.$datas['news_title'];
                        $return->result=$datas;
                    }                         
                    break;                
                case "remove_with_files":
                    $data['id'] = $this->input->post('id');           
                    $datas = $this->File_model->get_all_file(['file_from_table'=>'news','file_from_id'=>$data['id']],null,null,null,'file_id','asc');
                    // if($datas==true){
                        //Delete old files
                        foreach($datas as $v){
                            if (!empty($v['file_url'])) {
                                if (file_exists(FCPATH . $v['file_url'])) {
                                    unlink(FCPATH . $v['file_url']);
                                }
                            }
                        }
                        $this->News_model->delete_news($data['id']);
                        /* Activity */
                        /*
                        $params = array(
                            'activity_user_id' => $session['user_data']['user_id'],
                            'activity_action' => 4,
                            'activity_table' => 'news',
                            'activity_table_id' => $datas['id'],
                            'activity_text_1' => strtoupper($datas['kode']),
                            'activity_text_2' => ucwords(strtolower($datas['username'])),
                            'activity_date_created' => date('YmdHis'),
                            'activity_flag' => 0
                        );
                        $this->save_activity($params);                    
                        /* End Activity */
                        $return->status=1;
                        $return->message='Berhasil menghapus';
                        $return->result=$datas;
                    // }                         
                    break; 
                case "remove_file":
                    $data['id'] = $this->input->post('id');           
                    $ge = $this->File_model->get_file($data['id']);
                    if (!empty($ge['file_url'])) {
                        if (file_exists(FCPATH . $ge['file_url'])) {
                            unlink(FCPATH . $ge['file_url']);
                        }
                    }
                        $this->File_model->delete_file($data['id']);
                        /* Activity */
                        /*
                        $params = array(
                            'activity_user_id' => $session['user_data']['user_id'],
                            'activity_action' => 4,
                            'activity_table' => 'news',
                            'activity_table_id' => $datas['id'],
                            'activity_text_1' => strtoupper($datas['kode']),
                            'activity_text_2' => ucwords(strtolower($datas['username'])),
                            'activity_date_created' => date('YmdHis'),
                            'activity_flag' => 0
                        );
                        $this->save_activity($params);                    
                        /* End Activity */
                        $return->status=1;
                        $return->message='Berhasil menghapus';
                        // $return->result=;
                    // }                         
                    break;                                    
                case "set-active":
                    $id = $this->input->post('id');
                    $kode = $this->input->post('kode');        
                    $nama = $this->input->post('nama');                                
                    $flag = $this->input->post('flag');

                    if($flag==1){
                        $msg='menaktifkan news '.$nama;
                        $act=7;
                    }else{
                        $msg='menonaktifkan news '.$nama;
                        $act=8;
                    }

                    $set_data=$this->News_model->update_news($id,array('news_flag'=>$flag));
                    if($set_data==true){
                        /* Activity */
                        /*
                        $params = array(
                            'activity_user_id' => $session['user_data']['user_id'],
                            'activity_action' => $act,
                            'activity_table' => 'news',
                            'activity_table_id' => $id,
                            'activity_text_1' => strtoupper($kode),
                            'activity_text_2' => ucwords(strtolower($nama)),
                            'activity_date_created' => date('YmdHis'),
                            'activity_flag' => 0
                        );
                        */
                        // $this->save_activity($params);                               
                        /* End Activity */
                        $return->status=1;
                        $return->message='Berhasil '.$msg;
                    }                
                    break;             
                case "update_flag":
                    $this->form_validation->set_rules('news_id', 'news_id', 'required');
                    $this->form_validation->set_rules('news_flag', 'news_flag', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $news_id = !empty($post['news_id']) ? $post['news_id'] : 0;
                        if(intval($news_id) > 0){
                            
                            $params = array(
                                'news_flag' => !empty($post['news_flag']) ? intval($post['news_flag']) : 0,
                            );
                            
                            $where = array(
                                'news_id' => !empty($post['news_id']) ? intval($post['news_id']) : 0,
                            );
                            
                            if($post['news_flag']== 0){
                                $set_msg = 'nonaktifkan';
                            }else if($post['news_flag']== 1){
                                $set_msg = 'mengaktifkan';
                            }else if($post['news_flag']== 4){
                                $set_msg = 'menghapus';
                            }else{
                                $set_msg = 'mendapatkan data';
                            }
                            if($post['news_flag'] == 4){
                                // $params['news_url'] = null;
                            }

                            $get_data = $this->News_model->get_news_custom($where);
                            if($get_data){
                                $set_update=$this->News_model->update_news_custom($where,$params);
                                if($set_update){
                                    // if($post['news_flag'] == 4){
                                    //     $file = FCPATH . $get_data['news_image'];
                                    //     if (file_exists($file)) {
                                    //         unlink($file);
                                    //     }
                                    // }
                                    $return->status  = 1;
                                    $return->message = 'Berhasil '.$set_msg.' '.$get_data['news_title'];
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
            }
        }
        $return->action=$action;
        echo json_encode($return);
    }     
}
?>