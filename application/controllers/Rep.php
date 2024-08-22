<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rep extends CI_Controller {

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
//		session_start();
        $session_data = sessionData();
        $data['session_data'] = $session_data;
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url(), 'refresh');
        } else if ($this->session->userdata('role') != "REP") {
            redirect(base_url(), 'refresh');
        }
    }

    public function location_table() {
        $this->load->view('real_estate/location_table');
    }

    public function get_location_table(){ 
        $postData = $this->input->post();
        $data = $this->masters_model->get_location_table_rep($postData,'locations');
        echo json_encode($data); 
    }

    public function edit_location(){
        $id = $this->input->post('id');
       
        $locations = $this->masters_model->get_location($id,'id','locations');
        $states = $this->masters_model->get_location($locations[0]->state_id,'id','states');
        $state = $states[0]->name;
        $cities = $this->masters_model->get_location( $locations[0]->city_id,'id','cities');
        $city = $cities[0]->name;
        $towns = $this->masters_model->get_location($locations[0]->town_id,'id','towns');
        $town = $towns[0]->name;
        echo json_encode(array("res"=>'success','loc'=>$locations,'city'=>$city,'town'=>$town,'state'=>$state));
    }

    public function update_location(){
        $id = $this->input->post('edit_id');
       
        $save_data['morning'] = $this->input->post('morning');
        $save_data['afternoon'] = $this->input->post('afternoon');
        $save_data['evening'] = $this->input->post('evening');
        $save_data['updated_at'] = date("Y-m-d H:i:s");
        $save_data['review_date'] = date("Y-m-d H:i:s");

        if($save_data['afternoon'] !=""){
            if($save_data['evening'] !="" ){
                if( ($save_data['afternoon'] <= $save_data['evening']) && ($save_data['morning'] <= $save_data['afternoon'])){
                    $this->masters_model->update_locations('locations','id',$id,$save_data);
                    $response ='success';
        
                }else{
                    $response ='error1';
                }
            }elseif($save_data['afternoon'] >= $save_data['morning']){
                $this->masters_model->update_locations('locations','id',$id,$save_data);
                $response ='success';
            }else{
                $response ='error2';
            }
        }else{
            $this->masters_model->update_locations('locations','id',$id,$save_data);
            $response ='success';

        }
        // doc 1
        if(!empty($_FILES['morn_review_image']['name'])){
            
            $upload_path = APPPATH . '../uploads/place_review_image';
            if(!is_dir($upload_path)){
                mkdir($upload_path, 0777, true);
            }
            $config['upload_path'] =  "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = time();
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('morn_review_image')){
                $uploadData = $this->upload->data();
                $path1 = $_FILES['morn_review_image']['name'];
                $ext = pathinfo($path1, PATHINFO_EXTENSION);
                $picture = time().'.'.$ext;
            }
            $save_morn['morn_review_image'] = $picture;
            $this->masters_model->update_locations('locations','id',$id,$save_morn);
        }

        if(!empty($_FILES['after_review_image']['name'])){
            $upload_path = APPPATH . '../uploads/place_review_image';
            if(!is_dir($upload_path)){
                mkdir($upload_path, 0777, true);
            }
            $config['upload_path'] =  "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = time();
             
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('after_review_image')){
                $uploadData = $this->upload->data();
                $path1 = $_FILES['after_review_image']['name'];
                $ext = pathinfo($path1, PATHINFO_EXTENSION);
                $picture = time().'.'.$ext;
            }
            $save_after['after_review_image'] = $picture;
            $this->masters_model->update_locations('locations','id',$id,$save_after);

        }

        if(!empty($_FILES['even_review_image']['name'])){
            $upload_path = APPPATH . '../uploads/place_review_image';
            if(!is_dir($upload_path)){
                mkdir($upload_path, 0777, true);
            }
            $config['upload_path'] =  "$upload_path";
            $config['allowed_types'] = '*';
            $config['max_size']     = '20000';
            $config['file_name'] = time();
            
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('even_review_image')){
                $uploadData = $this->upload->data();
                $path1 = $_FILES['even_review_image']['name'];
                $ext = pathinfo($path1, PATHINFO_EXTENSION);
                $picture = time().'.'.$ext;
            }
            $save_even['even_review_image'] = $picture;
            $this->masters_model->update_locations('locations','id',$id,$save_even);

        }
        echo json_encode(array("res"=>$response));
    }

   
   
    public function get_image(){
        $id =  $this->input->post('id');
        $image = $this->masters_model->get_image($id,'id','locations');
        $imgs="";
        foreach($image as $img){
            $imgs.='<a target="blank" href="../../uploads/place_review_image/'.$img->place_review_image.'"><img src="../../uploads/place_review_image/'.$img->place_review_image.'" width="400" class="img-thumbnail" height="120"/>';
        }
        $data = array('res' => "success",'img'=>$imgs);
        echo json_encode($data);
    }
   
    public function completed_table() {
        $this->load->view('real_estate/completed_table');
    }

    public function get_completed_location(){
        $postData = $this->input->post();
        $user = $this->session->userdata('emp_no');
        $data = $this->masters_model->get_completed_location($postData,'locations' ,'allocated_person',$user);
        echo json_encode($data); 
    } 

    
    ///////////////////



    public function get_location_count(){

        $user = $this->session->userdata('emp_no');
        $app_location['allocated_person'] = $user;
        $app_location['status'] = "Active";
        $location_rep = $this->masters_model->total_count_rep($app_location ,'locations','om_doc');

        $com_location['allocated_person'] = $user;
        $completed_location_rep = $this->masters_model->total_count_rep2($com_location ,'locations');

        $data = array(
            "location_rep" => $location_rep,
            "completed_location_rep" => $completed_location_rep,
        );

        echo json_encode($data);

    }


   
}
