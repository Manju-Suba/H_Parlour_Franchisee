<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {
  
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
        } 
    }

    function getcities() { 
        $json = array();
        $stateID = $this->input->post('stateID', TRUE);
        $json = $this->masters_model->getCities($stateID);
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    function gettowns() {
        $json = array();
        $cityID = $this->input->post('cityID', TRUE);
        $json = $this->masters_model->getTowns($cityID);
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    function getzip() {
        $json = array();
        $townID = $this->input->post('townID', TRUE);
        $json = $this->masters_model->getZip_code($townID);
        echo json_encode($json);
    }

    function get_population() {
        $json = array();
        $townID = $this->input->post('townID', TRUE);
        $json = $this->masters_model->get_population($townID);
        echo json_encode($json);
    }

    public function change_password() {
		$this->load->view('change_password');
	}
	
	public function change_pass() {
		$this->form_validation->set_rules('new_pass', 'New Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('common/change_password');
        } else {
			
			 $id=$this->session->userdata('id');
			 $new_pass = $this->input->post('new_pass', TRUE);
			 $confirm_pass = $this->input->post('confirm_pass', TRUE);
			 if(!strcmp($new_pass, $confirm_pass))
			 {
				 $data['password'] = md5($new_pass);
				 $this->masters_model->updates('users', $data, 'id' , $id);
				 $this->session->set_flashdata('message', ('Password has been Changed!'));
				 
			 }
			 else { 
			 $this->session->set_flashdata('error', ('Password Mismatch!'));
			 }
			
            
            redirect(base_url('index.php/common/change_password'));

            $this->load->view('index.php/common/change_password');
        }
    }

    public function view_sh_img()
    {
        $d_id = $this->input->post('id',TRUE);
        $get_images = $this->masters_model->get_images('sh_report_img','d_id',$d_id); 

        $counter = 0; 
        $img_div="";
        $img_div.='<div class="carousel-inner">';

        if (is_array($get_images) && count($get_images) > 0) {
        foreach($get_images as $img) {
           
            if($counter == 0){
                $style="active";
            }
            else{
                $style="";
            }
            $img_div.='<div class="carousel-item '.$style.'">';
            $img_div.='<img class="d-block w-100" src="'.base_url().'approved_doc_uploads/'.$img->image.'">';
            $img_div.='</div>';
            $counter++;
        }
        }
        else{
            $img_div.='No Image Found..!';
        }
        $img_div.='<a class="carousel-control-prev" href="#carouselExampleControls" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> </a>
        ';
        $img_div.='<a class="carousel-control-next" href="#carouselExampleControls" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>';

        $img_div.='</div>';

        $result = array(
			"response" => $img_div,
		);
		echo json_encode($result);
        
    } 

    function view_ct_upload_images(){
        $d_id = $this->input->post('id',TRUE);
        $get_images = $this->masters_model->get_images('ct_upload_img','user_info_id',$d_id); 

        $counter = 0; 
        $img_div="";
        $img_div.='<div class="carousel-inner">';

        if (is_array($get_images) && count($get_images) > 0) {
            foreach($get_images as $img) {
            
                if($counter == 0){
                    $style="active";
                }
                else{
                    $style="";
                }
                $img_div.='<div class="carousel-item '.$style.'">';
                $img_div.='<img class="d-block w-100" src="'.base_url().'uploads/Ct_Uploaded_Img/'.$img->upload_images.'">';
                $img_div.='</div>';
                $counter++;
            }
        }
        else{
            $img_div.='No Image Found..!';
        }
        $img_div.='<a class="carousel-control-prev" href="#carouselExampleControls" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> </a>
        ';
        $img_div.='<a class="carousel-control-next" href="#carouselExampleControls" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>';

        $img_div.='</div>';

        $result = array(
			"response" => $img_div,
		);
		echo json_encode($result);
        
    }

    public function view_business_img()
    {
        $d_id = $this->input->post('id',TRUE);
        $get_images = $this->masters_model->get_images('image_proof','d_id',$d_id); 

        $counter = 0; 
        $img_div="";
        $img_div.='<div class="carousel-inner">';

        if (is_array($get_images) && count($get_images) > 0) {
            foreach($get_images as $img) {
            
                if($counter == 0){
                    $style="active";
                }
                else{
                    $style="";
                }
                $img_div.='<div class="carousel-item '.$style.'">';
                $img_div.='<img class="d-block w-100" src="'.base_url().'uploads/'.$img->image_proof.'">';
                $img_div.='</div>';
                $counter++;
            }
        }
        else{
            $img_div.='No Image Found..!';
        }
        $img_div.='<a class="carousel-control-prev" href="#carouselExampleControls" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> </a>
        ';
        $img_div.='<a class="carousel-control-next" href="#carouselExampleControls" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>';

        $img_div.='</div>';

        $result = array(
			"response" => $img_div,
		);
		echo json_encode($result);
        
    }
 
    public function view_detail()
    {
        $d_id = $this->input->post('id',TRUE);

        $val = $this->masters_model->get_table_row_condition('user_information','id',$d_id);
        
        $get_area = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Should be in the same area','points',$val[0]['area']);
        $get_age = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Age criteria 30 to 35 yrs','points',$val[0]['age']);
        
        $get_busi = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Should not do any other Employeement & milk & other business','points',$val[0]['business']);
        $get_family_busi = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Should consider as a first income and family business','points',$val[0]['family_business']);
        $get_time = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Willing to work 24/7, 365days . Business timing : 5am to 10pm','points',$val[0]['business_time']);
        $get_manage = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Previous experience in milk & related products distribution & management','points',$val[0]['management']);
      									
        $result = array(
			"val" => $val,
			// "creator_row" => $creator_row,
			"get_area" => $get_area,
			"get_age" => $get_age,
			"get_busi" => $get_busi,
			"get_family_busi" => $get_family_busi,
			"get_time" => $get_time,
			"get_manage" => $get_manage,
		);
		echo json_encode($result);
        
    }


    public function view_doc_detail()
    {
        $d_id = $this->input->post('id',TRUE);

        $val = $this->masters_model->get_table_row_condition('user_information','id',$d_id);
        $doc = $this->masters_model->get_table_row_condition('pre_documents','user_info_id',$d_id);
        $post_doc = $this->masters_model->get_table_row_condition('post_documents','user_info_id',$d_id);
        // $creator_row = $this->masters_model->get_table_row_condition('users','mobile',$val[0]['created_by']);
        
        $get_area = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Should be in the same area','points',$val[0]['area']);
        $get_age = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Age criteria 30 to 35 yrs','points',$val[0]['age']);
        
        $get_busi = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Should not do any other Employeement & milk & other business','points',$val[0]['business']);
        $get_family_busi = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Should consider as a first income and family business','points',$val[0]['family_business']);
        $get_time = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Willing to work 24/7, 365days . Business timing : 5am to 10pm','points',$val[0]['business_time']);
        $get_manage = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Previous experience in milk & related products distribution & management','points',$val[0]['management']);
        										
        $result = array(
			"val" => $val,
			"doc" => $doc,
			"post_doc" => $post_doc,
			// "creator_row" => $creator_row,
			"get_area" => $get_area,
			"get_age" => $get_age,
			"get_busi" => $get_busi,
			"get_family_busi" => $get_family_busi,
			"get_time" => $get_time,
			"get_manage" => $get_manage,
		);
		echo json_encode($result);
        
    }



    
    public function view_uploaded_vdo(){
        $id = $this->input->post('id',true);

        $get_vdo = $this->masters_model->get_approved_list_sh_log('video_upload','user_info_id' ,$id);

        $get_mt_images = $this->masters_model->get_images('mt_upload_img','user_info_id' ,$id);
    
        $counter = 0;
        $mt_img = "";
        $mt_img.='<div class="carousel-inner">';


        if(is_array($get_mt_images) && count($get_mt_images)>0){
            foreach($get_mt_images as $img){

                if($counter == 0){
                    $style ="active";
                }else{
                    $style="";
                }

                $mt_img.='<div class="carousel-item '.$style.'">';
                $mt_img.='<img class="d-block w-100" src="'.base_url().'uploads/Mt_Uploaded_Img/'.$img->multi_images.'">';
                $mt_img.='</div>';
                $counter++;
            }
        }else{
            $mt_img.='No Image Found..!';
        }

        $mt_img.='<a class="carousel-control-prev" href="#img_div" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> </a>
        ';
        $mt_img.='<a class="carousel-control-next" href="#img_div" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>';

        $mt_img.='</div>';

        $result = array(
			"response" => $mt_img,
            "get_vdo" => $get_vdo,
		);
		echo json_encode($result); 
    
    }

    public function get_uploaded_form(){
        $pdata = $this->input->post();
        $data = $this->masters_model->get_mt_uploaded_form($pdata ,'user_information');
        echo json_encode($data);
    }
    

    public function sa_rejected_form(){
        $this->load->view('common/sa_rejected_form');
    }
    
    public function sa_rejected_form_list()    
    { 
        $postData = $this->input->post();
        $data = $this->masters_model->get_sa_rejected_list($postData,'user_information');
        echo json_encode($data);   
    }

    public function get_bdm_b_b()
    {
        $rsm = $this->input->post('rsm');
        $bdm = $this->masters_model->get_bdm('BDM_name', $rsm, 'masters');
        $data['bdm'] = $bdm;
        echo json_encode($data);   
    }

    public function get_image(){
        $id =  $this->input->post('id');
        $image = $this->masters_model->get_image($id,'id','locations');
        $morn_imgs="";
        $after_imgs="";
        $even_imgs="";
        foreach($image as $img){
            $morn_imgs.='<a target="blank" href="../../uploads/place_review_image/'.$img->morn_review_image.'"><img src="../../uploads/place_review_image/'.$img->morn_review_image.'" width="190" class="img-thumbnail" height="100"/>';
            $after_imgs.='<a target="blank" href="../../uploads/place_review_image/'.$img->after_review_image.'"><img src="../../uploads/place_review_image/'.$img->after_review_image.'" width="190" class="img-thumbnail" height="100"/>';
            $even_imgs.='<a target="blank" href="../../uploads/place_review_image/'.$img->even_review_image.'"><img src="../../uploads/place_review_image/'.$img->even_review_image.'" width="190" class="img-thumbnail" height="100"/>';
        }
        $data = array('res' => "success",'morn_imgs'=>$morn_imgs ,'after_imgs'=> $after_imgs,'even_imgs'=> $even_imgs);
        echo json_encode($data); 
    } 

    public function get_sa_doc_image(){
        $id =  $this->input->post('id');
        $l_check = $this->masters_model->get_location_data($id);
        $val = $l_check[0]['location_id'];
        if($val !=""){
            $result ='success';
        }else{
            $result ='error';
        }
        echo json_encode(array("res"=>$result,'l_check'=>$l_check ,'id'=>$id));
    }

    public function get_final_locations(){
        $postData = $this->input->post();
        $data['approval_locations'] = "Approved";
        $data = $this->masters_model->get_final_locations($postData,'locations',$data);
        echo json_encode($data); 
    }

    public function do_logo()
	{
		if(($this->session->userdata('role') == 'CC') && ($this->session->userdata('status') == '1')){
			redirect(base_url('index.php/cc/franchisee_form'));
		}
        else if(($this->session->userdata('role') == 'RSM') && ($this->session->userdata('status') == '1')){
            redirect(base_url('index.php/rsm/login_type'));
        }
        else if(($this->session->userdata('role') == 'OM') && ($this->session->userdata('status') == '1')){
            redirect(base_url('index.php/opm/login_type'));
        }
        else if(($this->session->userdata('role') == 'IDHAYA') && ($this->session->userdata('status') == '1')){
            redirect(base_url('index.php/cidhaya/login_type'));
        }
        else if(($this->session->userdata('role') == 'CT') && ($this->session->userdata('status') == '1')){
			redirect(base_url('index.php/ct/entered_form'));
		}
        else if(($this->session->userdata('role') == 'SH') && ($this->session->userdata('status') == '1')){
			redirect(base_url('index.php/sh/login_type'));
		}
        else if(($this->session->userdata('role') == 'TT') && ($this->session->userdata('status') == '1')){
            redirect(base_url('index.php/tt/approved_form'));
        }
        else if(($this->session->userdata('role') == 'SA') && ($this->session->userdata('status') == '1')){
            redirect(base_url('index.php/sa/login_type'));
        }
        else if(($this->session->userdata('role') == 'MT') && ($this->session->userdata('status') == '1')){
            redirect(base_url('index.php/mt/approved_form'));
        }
        else if(($this->session->userdata('role') == 'REP') && ($this->session->userdata('status') == '1')){
            redirect(base_url('index.php/rep/location_table'));
        }
        else if(($this->session->userdata('role') == 'MP') && ($this->session->userdata('status') == '1')){
            redirect(base_url('index.php/mp/franchise_form'));
        }
		else {
			$this->session->set_flashdata('msg', 'You Are Not Allowed');
			redirect(base_url()); 
		}
	}

    ///////////////////
}
