<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sa extends CI_Controller {
 
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('masters_model');
        $this->load->helper(array('form', 'html', 'file', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('javascript');
        $this->load->library('email');
		// session_start();
        $session_data = sessionData();
        $data['session_data'] = $session_data;
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url(), 'refresh');
        } else if ($this->session->userdata('role') != "SA") {
            redirect(base_url(), 'refresh');
        }
    }

    // public function code_pending_form_index()    
    // {
    //    $this->load->view('sa/code_pending_form');
 
    // } 

    public function code_pending_form() {
        $user_information = $this->masters_model->get_approved_list_sh_log('user_information', 'sh_approval', 'Approved');
        $data['user_information'] = $user_information;
        $this->load->view('sa/code_pending_form', $data);
    }
 
    public function code_created_form()
    { 
        $this->load->view('sa/code_created_form');
    }

    public function sa_rejected_form(){
        $this->load->view('sa/sa_rejected_form');
    }
 
    public function update_franchise_code()
    {
        $id = $this->input->post('user_id', TRUE);
        // $data['sale_admin_app'] = $this->input->post('type', TRUE);
        $type = $this->input->post('type', TRUE);

        if($type == "Approved"){
            $data['sa_app'] = "Approved" ;
            $data['distributor_code'] = $this->input->post('user_code', TRUE);
            $data['sa_remark'] = $this->input->post('remarks', TRUE);
            $update=$this->masters_model->updates('user_information', $data, 'id', $id);
            $res = "approved";

        }else if($type == "Rejected"){
            $data['sa_app'] = "Rejected" ;
            $data['distributor_code'] = '';
            $data['sa_remark'] = $this->input->post('remarks', TRUE);
            $update=$this->masters_model->updates('user_information', $data, 'id', $id);
            $res = "rejected";
        }
        $result = array(
			"response" => "$res",
		);
		echo json_encode($result);
    } 
 
    public function code_created_list()    
    {
        $postData = $this->input->post();
        $data = $this->masters_model->get_sa_code_created_list($postData,'user_information');
        echo json_encode($data);   
    } 

    public function cod_pending_form()    
    { 
        $postData = $this->input->post();
        $data = $this->masters_model->get_sa_pending_list($postData,'user_information');
        echo json_encode($data);   
    }

    public function sa_rejected_form_list()    
    { 
        $postData = $this->input->post();
        $data = $this->masters_model->get_sa_rejected_list($postData,'user_information');
        echo json_encode($data);   
    }
    

//location work 

    public function login_type() {
        $this->load->view('sa/login_type');
    }

    public function allocate_location() {
        $this->load->view('sa/allocate_location');
    }

    public function completed_location() {
        $this->load->view('sa/completed_location');
    }

    public function add_location() {
        $states = $this->masters_model->get_states();
        $data['states'] = $states;
        $this->load->view('sa/add_location', $data);
    }

    public function location_table() {
        $states = $this->masters_model->get_states();
        $data['states'] = $states;
        $this->load->view('sa/location_table', $data);
    }

    public function change_state(){
       $state_id = $this->input->post('state');
       $cities = $this->masters_model->get_location($state_id,'state_id','cities');
       $city = "<option value='' selected  >Choose City</option>";
       foreach($cities as $row){
           $city.='<option value='.$row->id.' >'.$row->name.'</option>';
       }
		echo json_encode(array("res"=>'success','city'=>$city));
    }

    public function change_city(){
        $city_id = $this->input->post('city');
        $towns = $this->masters_model->get_location($city_id,'city_id','towns');
        $town = "<option value='' selected  >Choose Town</option>";
        foreach($towns as $row){
            $town.='<option value='.$row->id.' >'.$row->name.'</option>';
        }
        echo json_encode(array("res"=>'success','town'=>$town));
    }

    public function save_locations(){
        $save_data['state_id'] = $this->input->post('state');
        $save_data['city_id'] = $this->input->post('city');
        $save_data['town_id'] = $this->input->post('town');
        $save_data['area'] = $this->input->post('area');
        $save_data['c_shopname'] = $this->input->post('c_shopname');
        $save_data['address'] = $this->input->post('address');
        $save_data['created_at'] = date("Y-m-d H:i:s");
        $save_data['updated_at'] = date("Y-m-d H:i:s");
        $save_data['status'] = "Active";

        $data['state_id'] = $this->input->post('state');
        $data['city_id'] = $this->input->post('city');
        $data['town_id'] = $this->input->post('town');
        $data['area'] = $this->input->post('area');
        $data['c_shopname'] = $this->input->post('c_shopname');
        $res = $this->masters_model->verify_data($data ,'locations');
        $val = $res[0]->state_id;
       
        if($val !=""){
            $result = "error";
        }else{
            $this->masters_model->insert_locations($save_data,'locations');
            $result ="success";
        }
        echo json_encode(array("res"=> $result));
    }

    public function edit_location(){
        $id = $this->input->post('id');
        $locations = $this->masters_model->get_location($id,'id','locations');
        $cities = $this->masters_model->get_location( $locations[0]->state_id,'state_id','cities');
        $city = "<option value='' selected  >Choose City</option>";
        foreach($cities as $row){
            $city.='<option value='.$row->id.' >'.$row->name.'</option>';
        }
        $towns = $this->masters_model->get_location($locations[0]->city_id,'city_id','towns');
        $town = "<option value='' selected  >Choose Town</option>";
        foreach($towns as $row){
            $town.='<option value='.$row->id.' >'.$row->name.'</option>';
        }
        echo json_encode(array("res"=>'success','loc'=>$locations,'city'=>$city,'town'=>$town));
    }

    public function update_location(){
        $id = $this->input->post('edit_id');
        $save_data['state_id'] = $this->input->post('state');
        $save_data['city_id'] = $this->input->post('city');
        $save_data['town_id'] = $this->input->post('town');
        $save_data['area'] = $this->input->post('area');
        $save_data['c_shopname'] = $this->input->post('c_shopname');
        $save_data['address'] = $this->input->post('address');
        $save_data['updated_at'] = date("Y-m-d H:i:s");

        $data['state_id'] = $this->input->post('state');
        $data['city_id'] = $this->input->post('city');
        $data['town_id'] = $this->input->post('town');
        $data['area'] = $this->input->post('area');
        $data['c_shopname'] = $this->input->post('c_shopname');
        $res = $this->masters_model->verify_data2($data ,'locations' ,'id' ,$id);
        $val = $res[0]->state_id;
        
        if($val !=""){
            $result = "error";
        }else{
            $this->masters_model->update_locations('locations','id',$id,$save_data);
            $result ="success";
        }
        
        echo json_encode(array("res"=>$result));
    }

    public function delete_location(){
        $id = $this->input->post('id'); 
        $save_data['status'] = "Deleted";
        $this->masters_model->update_locations('locations','id',$id,$save_data);
        echo json_encode(array("res"=>'success'));
    }

    public function get_location_table(){
        $postData = $this->input->post();
        $data = $this->masters_model->get_location_table($postData,'locations');
        echo json_encode($data); 
    }

    public function get_free_locations() {
        $postData = $this->input->post();
        $val = "";
        $data = $this->masters_model->get_allocate_locations($postData,'locations' ,'allocated_person' ,$val);
        echo json_encode($data);
    }

    public function rep_allocation_action(){
        $id = $this->input->post('allocate_location_id');
        $data['allocated_person'] =  $this->input->post('rep_choosen');
        
        $this->masters_model->update_locations('locations','id',$id,$data);
        $data = array('res' => "success" );
        echo json_encode($data);
    } 

    public function get_allocated_locations() {
        $postData = $this->input->post();
        $data = $this->masters_model->get_allocated_locations($postData,'locations');
        echo json_encode($data);
    }

    public function final_locations() {
        $this->load->view('sa/final_locations');
    }

    public function get_final_locations(){
        $postData = $this->input->post();
        $data['approval_locations'] = "Approved";
        $val ="";
        $data = $this->masters_model->get__approved_location($postData,'locations' ,'sa_doc_status', $val ,$data);
        echo json_encode($data); 
    }

    public function sa_final_locations() {
        $this->load->view('sa/sa_final_locations');
    }

    public function get_sa_doc_final_locations(){
        $postData = $this->input->post();
        $data = $this->masters_model->get_completed_location($postData,'locations' ,'sa_doc_status', 'uploaded');
        echo json_encode($data); 
    }


    // public function get_future_prospects(){
    //     $postData = $this->input->post();
    //     $data = $this->masters_model->get_future_prospects($postData,'locations');
    //     echo json_encode($data); 
    // }

    public function get_completed_location(){
        $postData = $this->input->post();
        $data = $this->masters_model->get_completed_location($postData,'locations','idhaya_approval','Approved');
        echo json_encode($data); 
    }

    public function approval_locations(){
        $id =  $this->input->post('app_reg_id');
        $data['approval_locations'] =  $this->input->post('type');
        $data['updated_at'] = date("Y-m-d H:i:s");
        $data['remark'] =  $this->input->post('remarks');
        $this->masters_model->update_locations('locations','id',$id,$data);
        $data = array('res' => "success" );
        echo json_encode($data);
    }

    public function upload_doc_form(){
        $id = $this->input->post('doc_id');

        $l_check = $this->masters_model->get_location_data($id);
        $val = $l_check[0]['location_id'];

        if($val == ""){
            if(!empty($_FILES['doc_1']['name'])){
            
                $upload_path = APPPATH . '../uploads/SA_upload_document';
                if(!is_dir($upload_path)){
                    mkdir($upload_path, 0777, true);
                }
                $config['upload_path'] =  "$upload_path";
                $config['allowed_types'] = '*';
                $config['max_size']     = '20000';
                $config['file_name'] = time();
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('doc_1')){
                    $uploadData = $this->upload->data();
                    $path1 = $_FILES['doc_1']['name'];
                    $ext = pathinfo($path1, PATHINFO_EXTENSION);
                    $picture = time().'.'.$ext;
                }else{
                    $picture = "Nil";
                }
                $doc_1 = $picture;
            }else{
                $doc_1 = "Nil";
            }
    
            // doc 2
            if(!empty($_FILES['doc_2']['name'])){
                
                $upload_path = APPPATH . '../uploads/SA_upload_document';
                if(!is_dir($upload_path)){
                    mkdir($upload_path, 0777, true);
                }
                $config['upload_path'] =  "$upload_path";
                $config['allowed_types'] = '*';
                $config['max_size']     = '20000';
                $config['file_name'] = time();
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('doc_2')){
                    $uploadData = $this->upload->data();
                    $path1 = $_FILES['doc_2']['name'];
                    $ext = pathinfo($path1, PATHINFO_EXTENSION);
                    $picture = time().'.'.$ext;
                }else{
                    $picture = "Nil";
                }
                $doc_2 = $picture;
            }else{
                $doc_2 = "Nil";
            }
    
            // doc 3
            if(!empty($_FILES['doc_3']['name'])){
                
                $upload_path = APPPATH . '../uploads/SA_upload_document';
                if(!is_dir($upload_path)){
                    mkdir($upload_path, 0777, true);
                }
                $config['upload_path'] =  "$upload_path";
                $config['allowed_types'] = '*';
                $config['max_size']     = '20000';
                $config['file_name'] = time();
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('doc_3')){
                    $uploadData = $this->upload->data();
                    $path1 = $_FILES['doc_3']['name'];
                    $ext = pathinfo($path1, PATHINFO_EXTENSION);
                    $picture = time().'.'.$ext;
                }else{
                    $picture ="Nil";
                }
               
                $doc_3= $picture;
            }else{
                $doc_3 = "Nil";
            }
    
            $upload_img['doc_1'] = $doc_1;
            $upload_img['doc_2'] = $doc_2;
            $upload_img['doc_3'] = $doc_3;
            $upload_img['location_id']= $id;
            $upload_img['uploaded_by']= $this->session->userdata('emp_no');
            $insert = $this->masters_model->importData('sa_doc_upload',$upload_img);

            if( $doc_1 !="Nil" && $doc_2 != "Nil" && $doc_3 != "Nil"  ){
                $dat['sa_doc_status'] = "uploaded";
                $this->masters_model->update_locations('locations','id',$id,$dat);
            }

        }else{

            if(!empty($_FILES['doc_1']['name'])){
            
                $upload_path = APPPATH . '../uploads/SA_upload_document';
                if(!is_dir($upload_path)){
                    mkdir($upload_path, 0777, true);
                }
                $config['upload_path'] =  "$upload_path";
                $config['allowed_types'] = '*';
                $config['max_size']     = '20000';
                $config['file_name'] = time();
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('doc_1')){
                    $uploadData = $this->upload->data();
                    $path1 = $_FILES['doc_1']['name'];
                    $ext = pathinfo($path1, PATHINFO_EXTENSION);
                    $picture = time().'.'.$ext;
                }else{
                    $picture = "";
                }
                $doc_1_1 = $picture;
            }else{
                $doc_1_1 = "";
            }
    
            // doc 2
            if(!empty($_FILES['doc_2']['name'])){
                
                $upload_path = APPPATH . '../uploads/SA_upload_document';
                if(!is_dir($upload_path)){
                    mkdir($upload_path, 0777, true);
                }
                $config['upload_path'] =  "$upload_path";
                $config['allowed_types'] = '*';
                $config['max_size']     = '20000';
                $config['file_name'] = time();
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('doc_2')){
                    $uploadData = $this->upload->data();
                    $path1 = $_FILES['doc_2']['name'];
                    $ext = pathinfo($path1, PATHINFO_EXTENSION);
                    $picture = time().'.'.$ext;
                }else{
                    $picture = "";
                }
                $doc_2_2 = $picture;
            }else{
                $doc_2_2 = "";
            }
    
            // doc 3
            if(!empty($_FILES['doc_3']['name'])){
                
                $upload_path = APPPATH . '../uploads/SA_upload_document';
                if(!is_dir($upload_path)){
                    mkdir($upload_path, 0777, true);
                }
                $config['upload_path'] =  "$upload_path";
                $config['allowed_types'] = '*';
                $config['max_size']     = '20000';
                $config['file_name'] = time();
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('doc_3')){
                    $uploadData = $this->upload->data();
                    $path1 = $_FILES['doc_3']['name'];
                    $ext = pathinfo($path1, PATHINFO_EXTENSION);
                    $picture = time().'.'.$ext;
                }else{
                    $picture ="";
                }
               
                $doc_3_3 = $picture;
                // $update = $this->masters_model->updates('post_documents', $uploadpostData ,'user_info_id' ,$id);
            }else{
                $doc_3_3 = "";
            }
    
            if($doc_1_1 !=""){
                $upload_Uimg['doc_1'] = $doc_1_1;
                $update = $this->masters_model->updates('sa_doc_upload', $upload_Uimg ,'location_id' ,$id);
            }

            if($doc_2_2 !=""){
                $upload_Uimg['doc_2'] = $doc_2_2;
                $update = $this->masters_model->updates('sa_doc_upload', $upload_Uimg ,'location_id' ,$id);
            }

            if($doc_3_3 !=""){
                $upload_Uimg['doc_3'] = $doc_3_3;
                $update = $this->masters_model->updates('sa_doc_upload', $upload_Uimg ,'location_id' ,$id);
            }

            if( $doc_1_1 !="" && $doc_2_2 != "" && $doc_3_3 != ""){
                $dat['sa_doc_status'] = "uploaded";
                $this->masters_model->update_locations('locations','id',$id,$dat);
            }
        }

       if($val!=""){
            $doc_11 = $l_check[0]['doc_1'];
            $doc_22 = $l_check[0]['doc_2'];
            $doc_33 = $l_check[0]['doc_3'];

            if( $doc_11 !="Nil" && $doc_22 != "Nil" && $doc_33 != "Nil"){
                $dat['sa_doc_status'] = "uploaded";
                $this->masters_model->update_locations('locations','id',$id,$dat);
            }
        }

        if ($insert || $update) {
            $data = array('responce' => "success" ,'id' => "$id");
        } else {
            $data = array('responce' => "error");
        } 

        echo json_encode($data);

    }

    public function update_sa(){
        $id = $this->input->post('id');
        $l_check = $this->masters_model->get_location_data($id);
        $val = $l_check[0]['location_id'];

        if($val!=""){
            $doc_11 = $l_check[0]['doc_1'];
            $doc_22 = $l_check[0]['doc_2'];
            $doc_33 = $l_check[0]['doc_3'];

            if( $doc_11 !="Nil" && $doc_22 != "Nil" && $doc_33 != "Nil"){
                $dat['sa_doc_status'] = "uploaded";
                $this->masters_model->update_locations('locations','id',$id,$dat);
            }
        }
    }

    public function get_location_count(){

        $add_location_sa['status'] = "Active";
        $sa_lt_count = $this->masters_model->total_count($add_location_sa ,'locations');

        $allocate_location['status'] = "Active";
        $allocate_location_count = $this->masters_model->total_count($allocate_location ,'locations');

        $final_location['status'] = "Active";
        $final_location['approval_locations'] = "Approved";
        $final_location['sa_doc_status'] = "";
        $final_location_sa = $this->masters_model->completed_location_count($final_location ,'locations');

        $sa_final_location['status'] = "Active";
        $sa_final_location['sa_doc_status'] = "uploaded";
        $sa_final_location_count = $this->masters_model->completed_location_count($sa_final_location ,'locations');

        $data = array(
            "sa_lt_count" => $sa_lt_count,
            "allocate_location_count" => $allocate_location_count,
            "final_location_sa" => $final_location_sa,
            "sa_final_location_count" => $sa_final_location_count,
        );

        echo json_encode($data);

    }



    public function get_details_count(){
        $emp_no = $this->session->userdata('emp_no');

        $approve_tt['sh_ct_doc_approve']="Approved";
        $approve_tt['distributor_code']="";
        $approve_tt['sa_app']="";
        $sa_code_pending = $this->masters_model->total_count2($approve_tt,'user_information' ,'parlour_name');

        $code_created['sh_ct_doc_approve']="Approved";
        $code_created['sa_app']="Approved";
        $sa_code_created = $this->masters_model->total_count2($code_created,'user_information','distributor_code');

        $approve_tt['distributor_code']="";
        $rejected_code['sa_app']="Rejected";
        $sa_rejected_count = $this->masters_model->total_count2($rejected_code,'user_information','parlour_name');

        $data = array(
            "sa_code_pending" => $sa_code_pending,
            "sa_code_created" => $sa_code_created,
            "sa_rejected_count" => $sa_rejected_count
        );

        echo json_encode($data);

    }



}
