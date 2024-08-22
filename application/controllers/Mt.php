<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Mt extends CI_Controller { 
 
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
        } else if ($this->session->userdata('role') != "MT") {
            redirect(base_url(), 'refresh');
        }
    }

    public function approved_form(){
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;

        $this->load->view('mt/approved_form' ,$data);
    } 

    public function uploaded_view(){
        $rsm_name = $this->masters_model->DISTINCT_table('RSM_name', 'masters');
        $data['rsm_name'] = $rsm_name;
        $this->load->view('mt/uploaded_form' , $data);
    }
 
    public function get_approved_form(){
        $postData = $this->input->post();
        $data = $this->masters_model->get_mt_approve_form($postData,'user_information');
        echo json_encode($data);   
    }  

    // public function get_uploaded_form(){
    //     $pdata = $this->input->post();
    //     $data = $this->masters_model->get_mt_uploaded_form($pdata ,'user_information');
    //     echo json_encode($data);
    // }

    //  form_approval
    public function form_approval(){
        $id = $this->input->post('id', TRUE);
        $mt_doc = $this->input->post('mt_doc', TRUE);

        // image
        if ($_FILES['mt_doc']['name'] != '') {

            $this->load->library('upload');
            $image = array();
            $ImageCount = count($_FILES['mt_doc']['name']);


            //mkdir(APPPATH. '../uploads/'.$last_id.'/');
            for ($i = 0; $i < $ImageCount; $i++) {
                $_FILES['file']['name'] = $_FILES['mt_doc']['name'][$i];
                $_FILES['file']['type'] = $_FILES['mt_doc']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['mt_doc']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['mt_doc']['error'][$i];
                $_FILES['file']['size'] = $_FILES['mt_doc']['size'][$i];

                // File upload configuration

                $config['upload_path'] = APPPATH . '../uploads/Mt_Uploaded_Img';
                $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|pdf|xlsx';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadImgData[$i]['multi_images'] = $imageData['file_name'];
                    $uploadImgData[$i]['user_info_id'] = $id;
                    $uploadImgData[$i]['status'] = 1;
                }
            }
            if (!empty($uploadImgData)) {
                // Insert files data into the database
                $this->masters_model->importImageData('mt_upload_img', $uploadImgData);
            }
        }

        if ($_FILES['mt_vdo']['name'] != '') {

            $this->load->library('upload');
            $image = array();
            $ImageCount = count($_FILES['mt_vdo']['name']);


            //mkdir(APPPATH. '../uploads/'.$last_id.'/');
            for ($i = 0; $i < $ImageCount; $i++) {
                $_FILES['file']['name'] = $_FILES['mt_vdo']['name'][$i];
                $_FILES['file']['type'] = $_FILES['mt_vdo']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['mt_vdo']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['mt_vdo']['error'][$i];
                $_FILES['file']['size'] = $_FILES['mt_vdo']['size'][$i];

                // File upload configuration

                $config['upload_path'] = APPPATH . '../uploads/Approved_Vdo';
                $config['allowed_types'] = 'mp4|mpg|mpeg|avi|mov|wmv|rm|ogg|webm';

                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                // Upload file to server
                if ($this->upload->do_upload('file')) {
                    // Uploaded file data
                    $imageData = $this->upload->data();
                    $uploadVdo[$i]['user_info_id'] = $id;
                    $uploadVdo[$i]['video'] = $imageData['file_name'];
                    $uploadVdo[$i]['status'] = 1;
                }
            }
            if (!empty($uploadVdo)) {
                // Insert files data into the database
                $this->masters_model->importImageData('video_upload', $uploadVdo);
            }

            $res = 'success';
        }else{
            $res = 'error';
        }


        if ($_FILES['uploadFile']['name'] != '') {
            $path = 'uploads/Mt_Excel_Upload/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);

            $new_name = time();
            $config['file_name'] = $new_name;
            $this->upload->initialize($config);

            // $this->load->library('upload', $config);
            // $this->upload->initialize($config);

            // Upload Excel file to server
            if ($this->upload->do_upload('uploadFile')) {
                $uploadData = $this->upload->data();
                $uploadExcelData['user_info_id'] = $id;
                $uploadExcelData['excel_file'] = $uploadData['file_name'];
                $uploadExcelData['status'] = 1;
            } 

            if (!empty($uploadExcelData)) {
                // Insert files data into the database
                $this->masters_model->importData('excel_upload', $uploadExcelData);
            }
            $res = 'success';
            // print_r($res);
        }else{
            $res = 'error';
        }

        if($res == "success"){
            $data['mt_upload'] = "uploaded";
            $update=$this->masters_model->updates('user_information', $data, 'id', $id);
        }

        $result = array(
            "response" => "$res",
        );
        echo json_encode($result);
    }
 


    //total count //

    public function get_details_count(){
        $mt_upload['mt_upload'] = "";
        $mt_upload_details = $this->masters_model->total_count2($mt_upload ,'user_information','distributor_code');
        
        $upload_mt['mt_upload'] = "uploaded";
        $mt_uploaded_details = $this->masters_model->total_count($upload_mt ,'user_information');
        $data = array(
            "mt_upload_details" => $mt_upload_details,
            "mt_uploaded_details" => $mt_uploaded_details,
        );

        echo json_encode($data);
    }
    
}

