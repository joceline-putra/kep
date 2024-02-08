<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

    var $folder_upload = 'upload/dashboard/';
    var $image_width   = 250;
    var $image_height  = 250;

    function __construct(){
        parent::__construct();
        /*
        if(!$this->is_logged_in()){

            //Will Return to Last URL Where session is empty
            $this->session->set_userdata('url_before',base_url(uri_string()));
            redirect(base_url("login/return_url"));
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('User_model');
        $this->load->model('Dashboard_model');
        */
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
                        '0' => 'dashboard_id',
                        '1' => 'dashboard_name'
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
                    !empty($post['date_start']) ? $params['dashboard_date >'] = date('Y-m-d H:i:s', strtotime($post['date_start'].' 23:59:59')) : $params;
                    !empty($post['date_end']) ? $params['dashboard_date <'] = date('Y-m-d H:i:s', strtotime($post['date_end'].' 23:59:59')) : $params;
                    */

                    //Default Params for Master CRUD Form
                    $params['dashboard_id']   = !empty($post['dashboard_id']) ? $post['dashboard_id'] : $params;
                    $params['dashboard_name'] = !empty($post['dashboard_name']) ? $post['dashboard_name'] : $params;

                    /*
                        if($post['other_column'] && $post['other_column'] > 0) {
                            $params['other_column'] = $post['other_column'];
                        }
                        if($post['filter_type'] !== "All") {
                            $params['dashboard_type'] = $post['filter_type'];
                        }
                    */
                    
                    $get_count = $this->Dashboard_model->get_all_dashboard_count($params, $search);
                    if($get_count > 0){
                        $get_data = $this->Dashboard_model->get_all_dashboard($params, $search, $limit, $start, $order, $dir);
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
                    $this->form_validation->set_rules('dashboard_id', 'dashboard_id', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{

                        if(intval($post['dashboard_id']) > 0){ /* Update if Exist */ // if( (!empty($post['dashboard_session'])) && (strlen($post['dashboard_session']) > 10) ){ /* Update if Exist */

                            /* Check Existing Data */
                            $where_not = [
                                'dashboard_id' => intval($post['dashboard_id']),
                            ];
                            $where_new = [
                                'dashboard_name' => $dashboard_name
                            ];
                            $check_exists = $this->Dashboard_model->check_data_exist_two_condition($where_not,$where_new);

                            /* Continue Update if not exist */
                            if(!$check_exists){
                                $where = array(
                                    'dashboard_id' => intval($post['dashboard_id']),
                                );
                                $params = array(
                                    'dashboard_name' => $dashboard_name,
                                    'dashboard_flag' => !empty($post['dashboard_flag']) ? $post['dashboard_flag'] : 0
                                );
                                $update = $this->Dashboard_model->update_dashboard_custom($where,$params);
                                if($update){
                                    $get_dashboard = $this->Dashboard_model->get_dashboard_custom($where);
                                    $return->status  = 1;
                                    $return->message = 'Berhasil memperbarui '.$dashboard_name;
                                    $return->result= array(
                                        'dashboard_id' => $update,
                                        'dashboard_name' => $get_dashboard['dashboard_name'],
                                        'dashboard_session' => $get_dashboard['dashboard_session']
                                    );
                                }else{
                                    $return->message = 'Gagal memperbarui '.$dashboard_name;
                                }
                            }else{
                                $return->message = 'Data sudah digunakan';
                            }
                        }else{ /* Save New Data */

                            /* Check Existing Data */
                            $params_check = [
                                'dashboard_name' => $dashboard_name
                            ];
                            $check_exists = $this->Dashboard_model->check_data_exist($params_check);

                            /* Continue Save if not exist */
                            if(!$check_exists){
                                $dashboard_session = strtoupper(substr(hash('sha256', date_timestamp_get(date_create())),0,20));
                                $params = array(
                                    'dashboard_session' => $dashboard_session,
                                    'dashboard_name' => $dashboard_name,
                                    'dashboard_flag' => !empty($post['dashboard_flag']) ? $post['dashboard_flag'] : 0
                                );
                                $create = $this->Dashboard_model->add_dashboard($params);
                                if($create){
                                    $get_dashboard = $this->Dashboard_model->get_dashboard($create);
                                    $return->status  = 1;
                                    $return->message = 'Berhasil menambahkan '.$dashboard_name;
                                    $return->result= array(
                                        'dashboard_id' => $create,
                                        'dashboard_name' => $get_dashboard['dashboard_name'],
                                        'dashboard_session' => $get_dashboard['dashboard_session']
                                    );
                                }else{
                                    $return->message = 'Gagal menambahkan '.$dashboard_name;
                                }
                            }else{
                                $return->message = 'Data sudah ada';
                            }
                        }
                    }
                    break;
                case "create":
                    // $data = base64_decode($post); $data = json_decode($post, TRUE);
                    $this->form_validation->set_rules('dashboard_name', 'dashboard_name', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{

                        $dashboard_name = !empty($post['dashboard_name']) ? $post['dashboard_name'] : null;
                        $dashboard_flag = !empty($post['dashboard_flag']) ? $post['dashboard_flag'] : 0;
                        $dashboard_session = strtoupper(substr(hash('sha256', date_timestamp_get(date_create())),0,20));

                        $params = array(
                            'dashboard_name' => $dashboard_name,
                            'dashboard_flag' => $dashboard_flag
                        );

                        //Check Data Exist
                        $params_check = array(
                            'dashboard_name' => $dashboard_name
                        );
                        $check_exists = $this->Dashboard_model->check_data_exist($params_check);
                        if(!$check_exists){

                            $set_data=$this->Dashboard_model->add_dashboard($params);
                            if($set_data){

                                $dashboard_id = $set_data;
                                $data = $this->Dashboard_model->get_dashboard($dashboard_id);

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

                                            if ($data && $data['dashboard_id']) {
                                                $params_image = array(
                                                    'dashboard_image' => $upload_directory . $raw_photo
                                                );
                                                if (!empty($data['dashboard_image'])) {
                                                    if (file_exists($upload_path_directory . $data['dashboard_image'])) {
                                                        unlink($upload_path_directory . $data['dashboard_image']);
                                                    }
                                                }
                                                $stat = $this->Dashboard_model->update_dashboard_custom(array('dashboard_id' => $set_data), $params_image);
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
                                        if ($data && $data['dashboard_id']) {
                                            $params_image = array(
                                                'dashboard_url' => $upload_process->result['file_location']
                                            );
                                            if (!empty($data['dashboard_url'])) {
                                                if (file_exists($upload_path_directory . $data['dashboard_url'])) {
                                                    unlink($upload_path_directory . $data['dashboard_url']);
                                                }
                                            }
                                            $stat = $this->Dashboard_model->update_dashboard_custom(array('dashboard_id' => $set_data), $params_image);
                                        }
                                    }else{
                                        $return->message = 'Fungsi Gambar gagal';
                                    }
                                }
                                //End of Croppie

                                $return->status=1;
                                $return->message='Berhasil menambahkan '.$post['dashboard_name'];
                                $return->result= array(
                                    'id' => $set_data,
                                    'name' => $post['dashboard_name'],
                                    'session' => $dashboard_session
                                ); 
                            }else{
                                $return->message='Gagal menambahkan '.$post['dashboard_name'];
                            }
                        }else{
                            $return->message='Data sudah ada';
                        }
                    }
                    break;
                case "read":
                    $this->form_validation->set_rules('dashboard_id', 'dashboard_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{                
                        $dashboard_id   = !empty($post['dashboard_id']) ? $post['dashboard_id'] : 0;
                        if(intval(strlen($dashboard_id)) > 0){        
                            $datas = $this->Dashboard_model->get_dashboard($dashboard_id);
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
                    $this->form_validation->set_rules('dashboard_id', 'dashboard_id', 'required');
                    $this->form_validation->set_message('required', '{field} tidak ditemukan');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $dashboard_id = !empty($post['dashboard_id']) ? $post['dashboard_id'] : $post['dashboard_id'];
                        $dashboard_name = !empty($post['dashboard_name']) ? $post['dashboard_name'] : $post['dashboard_name'];
                        $dashboard_flag = !empty($post['dashboard_flag']) ? $post['dashboard_flag'] : $post['dashboard_flag'];

                        if(strlen($dashboard_id) > 1){
                            $params = array(
                                'dashboard_name' => $dashboard_name,
                                'dashboard_date_updated' => date("YmdHis"),
                                'dashboard_flag' => $dashboard_flag
                            );

                            /*
                            if(!empty($data['password'])){
                                $params['password'] = md5($data['password']);
                            }
                            */
                           
                            $set_update=$this->Dashboard_model->update_dashboard($dashboard_id,$params);
                            if($set_update){
                                
                                $get_data = $this->Dashboard_model->get_dashboard($dashboard_id);
                                    
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
                                                    'dashboard_image' => base_url($upload_directory) . $raw_photo
                                                );
                                                if (!empty($get_data['dashboard_image'])) {
                                                    $file = FCPATH.$this->folder_upload.$get_data['dashboard_image'];
                                                    if (file_exists($file)) {
                                                        unlink($file);
                                                    }
                                                }
                                                $stat = $this->Dashboard_model->update_dashboard_custom(array('dashboard_id' => $dashboard_id), $params_image);
                                            }
                                        }
                                    }
                                }
                                //End of Save Image

                                $return->status  = 1;
                                $return->message = 'Berhasil memperbarui '.$dashboard_name;
                            }else{
                                $return->message='Gagal memperbarui '.$dashboard_name;
                            }   
                        }else{
                            $return->message = "Gagal memperbarui";
                        } 
                    }
                    break;
                case "delete":
                    $this->form_validation->set_rules('dashboard_id', 'dashboard_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $dashboard_id   = !empty($post['dashboard_id']) ? $post['dashboard_id'] : 0;
                        $dashboard_name = !empty($post['dashboard_name']) ? $post['dashboard_name'] : null;

                        if(strlen($dashboard_id) > 0){
                            $get_data=$this->Dashboard_model->get_dashboard($dashboard_id);
                            // $set_data=$this->Dashboard_model->delete_dashboard($dashboard_id);
                            $set_data = $this->Dashboard_model->update_dashboard_custom(array('dashboard_id'=>$dashboard_id),array('dashboard_flag'=>4));                
                            if($set_data){
                                /*
                                $file = FCPATH.$this->folder_upload.$get_data['dashboard_image'];
                                if (file_exists($file)) {
                                    unlink($file);
                                }
                                */
                                $return->status=1;
                                $return->message='Berhasil menghapus '.$dashboard_name;
                            }else{
                                $return->message='Gagal menghapus '.$dashboard_name;
                            } 
                        }else{
                            $return->message='Data tidak ditemukan';
                        }
                    }
                    break;
                case "update_flag":
                    $this->form_validation->set_rules('dashboard_id', 'dashboard_id', 'required');
                    $this->form_validation->set_rules('dashboard_flag', 'dashboard_flag', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $dashboard_id = !empty($post['dashboard_id']) ? $post['dashboard_id'] : 0;
                        if(strlen(intval($dashboard_id)) > 1){
                            
                            $params = array(
                                'dashboard_flag' => !empty($post['dashboard_flag']) ? intval($post['dashboard_flag']) : 0,
                            );
                            
                            $where = array(
                                'dashboard_id' => !empty($post['dashboard_id']) ? intval($post['dashboard_id']) : 0,
                            );
                            
                            if($post['dashboard_flag']== 0){
                                $set_msg = 'nonaktifkan';
                            }else if($post['dashboard_flag']== 1){
                                $set_msg = 'mengaktifkan';
                            }else if($post['dashboard_flag']== 4){
                                $set_msg = 'menghapus';
                            }else{
                                $set_msg = 'mendapatkan data';
                            }

                            if($post['dashboard_flag'] == 4){
                                $params['dashboard_url'] = null;
                            }

                            $get_data = $this->Dashboard_model->get_dashboard_custom($where);
                            if($get_data){
                                $set_update=$this->Dashboard_model->update_dashboard_custom($where,$params);
                                if($set_update){
                                    if($post['dashboard_flag'] == 4){
                                        /*
                                        $file = FCPATH.$this->folder_upload.$get_data['dashboard_image'];
                                        if (file_exists($file)) {
                                            unlink($file);
                                        }
                                        */
                                    }
                                    $return->status  = 1;
                                    $return->message = 'Berhasil '.$set_msg.' '.$get_data['dashboard_name'];
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
                case "create_dashboard_item":
                    // $data = base64_decode($post);
                    // $data = json_decode($post, TRUE);

                    $this->form_validation->set_rules('dashboard_item_name', 'dashboard_item_name', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{

                        $dashboard_item_name = !empty($post['dashboard_item_name']) ? $post['dashboard_item_name'] : null;
                        $dashboard_item_flag = !empty($post['dashboard_item_flag']) ? $post['dashboard_item_flag'] : 0;
                        $dashboard_item_session = strtoupper(substr(hash('sha256', date_timestamp_get(date_create())),0,20));

                        $params = array(
                            'dashboard_item_name' => $dashboard_item_name,
                            'dashboard_item_flag' => $dashboard_item_flag
                        );

                        //Check Data Exist
                        $params_check = array(
                            'dashboard_item_name' => $dashboard_item_name
                        );
                        $check_exists = $this->Dashboard_model->check_data_exist_dashboard_item($params_check);
                        if(!$check_exists){

                            $set_data=$this->Dashboard_model->add_dashboard_item($params);
                            if($set_data){

                                $dashboard_item_id = $set_data;
                                $data = $this->Dashboard_model->get_dashboard_item($dashboard_item_id);
                                $return->status=1;
                                $return->message='Berhasil menambahkan '.$post['dashboard_item_name'];
                                $return->result= array(
                                    'id' => $set_data,
                                    'name' => $post['dashboard_item_name'],
                                    'session' => $dashboard_item_session
                                ); 
                            }else{
                                $return->message='Gagal menambahkan '.$post['dashboard_item_name'];
                            }
                        }else{
                            $return->message='Data sudah ada';
                        }
                    }
                    break;
                case "read_dashboard_item":
                    $this->form_validation->set_rules('dashboard_item_id', 'dashboard_item_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{                
                        $dashboard_item_id   = !empty($post['dashboard_item_id']) ? $post['dashboard_item_id'] : 0;
                        if(intval(strlen($dashboard_item_id)) > 0){        
                            $datas = $this->Dashboard_model->get_dashboard_item($dashboard_item_id);
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
                case "update_dashboard_item":
                    $this->form_validation->set_rules('dashboard_item_id', 'dashboard_item_id', 'required');
                    $this->form_validation->set_message('required', '{field} tidak ditemukan');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $dashboard_item_id = !empty($post['dashboard_item_id']) ? $post['dashboard_item_id'] : $post['dashboard_item_id'];
                        $dashboard_item_name = !empty($post['dashboard_item_name']) ? $post['dashboard_item_name'] : $post['dashboard_item_name'];
                        $dashboard_item_flag = !empty($post['dashboard_item_flag']) ? $post['dashboard_item_flag'] : $post['dashboard_item_flag'];

                        if(strlen($dashboard_item_id) > 0){
                            $params = array(
                                'dashboard_item_name' => $dashboard_item_name,
                                'dashboard_item_date_updated' => date("YmdHis"),
                                'dashboard_item_flag' => $dashboard_item_flag
                            );
                           
                            $set_update=$this->Dashboard_model->update_dashboard_item($dashboard_item_id,$params);
                            if($set_update){
                                $get_data = $this->Dashboard_model->get_dashboard_item($dashboard_item_id);
                                $return->status  = 1;
                                $return->message = 'Berhasil memperbarui '.$dashboard_item_name;
                            }else{
                                $return->message='Gagal memperbarui '.$dashboard_item_name;
                            }   
                        }else{
                            $return->message = "Gagal memperbarui";
                        } 
                    }
                    break;
                case "update_dashboard_item_flag":
                    $this->form_validation->set_rules('dashboard_item_id', 'dashboard_item_id', 'required');
                    $this->form_validation->set_rules('dashboard_item_flag', 'dashboard_item_flag', 'required');
                    $this->form_validation->set_message('required', '{field} wajib diisi');
                    if($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $dashboard_item_id = !empty($post['dashboard_item_id']) ? $post['dashboard_item_id'] : 0;
                        if(strlen(intval($dashboard_item_id)) > 0){
                            
                            $params = array(
                                'dashboard_item_flag' => !empty($post['dashboard_item_flag']) ? intval($post['dashboard_item_flag']) : 0,
                            );
                            
                            $where = array(
                                'dashboard_item_id' => !empty($post['dashboard_item_id']) ? intval($post['dashboard_item_id']) : 0,
                            );
                            
                            if($post['dashboard_item_flag']== 0){
                                $set_msg = 'nonaktifkan';
                            }else if($post['dashboard_item_flag']== 1){
                                $set_msg = 'mengaktifkan';
                            }else if($post['dashboard_item_flag']== 4){
                                $set_msg = 'menghapus';
                            }else{
                                $set_msg = 'mendapatkan data';
                            }

                            $set_update=$this->Dashboard_model->update_dashboard_item_custom($where,$params);
                            if($set_update){
                                $get_data = $this->Dashboard_model->get_dashboard_item_custom($where);
                                $return->status  = 1;
                                $return->message = 'Berhasil '.$set_msg.' '.$get_data['dashboard_item_name'];
                            }else{
                                $return->message='Gagal '.$set_msg;
                            }   
                        }else{
                            $return->message = 'Gagal mendapatkan data';
                        } 
                    }
                    break;
                case "delete_dashboard_item":
                    $this->form_validation->set_rules('dashboard_item_id', 'dashboard_item_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $dashboard_item_id   = !empty($post['dashboard_item_id']) ? $post['dashboard_item_id'] : 0;
                        $dashboard_item_name = !empty($post['dashboard_item_name']) ? $post['dashboard_item_name'] : null;                                

                        if(strlen($dashboard_item_id) > 0){
                            $get_data=$this->Dashboard_model->get_dashboard_item($dashboard_item_id);
                            // $set_data=$this->Dashboard_model->delete_dashboard_item($dashboard_item_id);
                            $set_data = $this->Dashboard_model->update_dashboard_item_custom(array('dashboard_item_id'=>$dashboard_item_id),array('dashboard_item_flag'=>4));                
                            if($set_data){
                                /*
                                if (file_exists($get_data['dashboard_item_image'])) {
                                    unlink($get_data['dashboard_item_image']);
                                } 
                                */
                                $return->status=1;
                                $return->message='Berhasil menghapus '.$dashboard_item_name;
                            }else{
                                $return->message='Gagal menghapus '.$dashboard_item_name;
                            } 
                        }else{
                            $return->message='Data tidak ditemukan';
                        }
                    }
                    break;
                case "load_dashboard_item":
                    $columns = array(
                        '0' => 'dashboard_item_id',
                        '1' => 'dashboard_item_name'
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
                    $params['dashboard_item_id']   = !empty($post['dashboard_item_id']) ? $post['dashboard_item_id'] : $params;
                    $params['dashboard_item_name'] = !empty($post['dashboard_item_name']) ? $post['dashboard_item_name'] : $params;

                    /*
                    if($post['other_item_column'] && $post['other_item_column'] > 0) {
                        $params['other_item_column'] = $post['other_item_column'];
                    }
                    */
                    
                    $get_count = $this->Dashboard_model->get_all_dashboard_item_count($params, $search);
                    if($get_count > 0){
                        $get_data = $this->Dashboard_model->get_all_dashboard_item($params, $search, $limit, $start, $order, $dir);
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
                case "load_dashboard_item_2":
                    $params = array(); $total  = 0;
                    $this->form_validation->set_rules('dashboard_item_dashboard_id', 'dashboard_item_dashboard_id', 'required');
                    if ($this->form_validation->run() == FALSE){
                        $return->message = validation_errors();
                    }else{
                        $dashboard_item_dashboard_id   = !empty($post['dashboard_item_dashboard_id']) ? $post['dashboard_item_dashboard_id'] : 0;
                        if(intval(strlen($dashboard_item_dashboard_id)) > 0){
                            $params = array(
                                'dashboard_item_dashboard_id' => $dashboard_item_dashboard_id
                            );
                            $search = null;
                            $start  = null;
                            $limit  = null;
                            $order  = "dashboard_item_id";
                            $dir    = "asc";
                            $get_data = $this->Dashboard_model->get_all_dashboard_item($params, $search, $limit, $start, $order, $dir);
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
            // $firstdate = new DateTime('first day of this month');
            // $firstdateofmonth = $firstdate->format('d-m-Y');

            // $data['session'] = $this->session->userdata();  
            // $session_user_id = !empty($data['session']['user_data']['user_id']) ? $data['session']['user_data']['user_id'] : null;

            // $data['first_date'] = $firstdateofmonth;
            // $data['end_date'] = date("d-m-Y");
            // $data['hour'] = date("H:i");
            // $data['theme'] = $this->User_model->get_user($data['session']['user_data']['user_id']);

            // $data['image_width'] = intval($this->image_width);
            // $data['image_height'] = intval($this->image_height);
            /*
            // Reference Model
            $this->load->model('Reference_model');
            $data['reference'] = $this->Reference_model->get_all_reference();
            */

            $data['title'] = 'Dashboard';
            $data['_view'] = 'layouts/admin/content';
            $this->load->view('layouts/admin/index',$data);
            // $this->load->view('layouts/admin/menu/folder/dashboard_js.php',$data);
        }
    }
}

?>