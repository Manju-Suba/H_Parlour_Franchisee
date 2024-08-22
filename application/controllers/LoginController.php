<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    public function __construct()
	{
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
		
	}
	
	public function index()
	{
		$this->load->view('login');
	}
	
	public function welcome()
	{
		$this->load->view('welcome');
	}
	
	public function register_page()
	{
		$sates = $this->masters_model->get_state('towns_details');
        $data['sates'] = $sates;

		$this->load->view('index',$data);
	}

    public function doLogin()
	{
		$session_data = sessionData();
		$data['session_data'] = $session_data;
		$this->form_validation->set_rules('emp_no', 'emp_no', 'required');
		$this->form_validation->set_rules('pass', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg', 'Enter user id and password');
			redirect('', 'refresh');
			//$this->load->view('login');
		}
		else { 
			$array['emp_no'] = $this->input->post('emp_no');
			$array['password'] = md5($this->input->post('pass'));
			$result = $this->masters_model->verifyUser($array,'users');
			//echo "<pre>"; print_r($array); exit;
			
			if ($result) {
				//echo "<pre>"; print_r($result); exit;
					
				$this->session->set_userdata('result', $result);
				$this->session->set_userdata('logged_in', TRUE);
				$this->session->set_userdata('role', $result['role']);
				$this->session->set_userdata('emp_no', $result['emp_no']);
				$this->session->set_userdata('username', $result['username']);
				$this->session->set_userdata('status', $result['status']);
				$this->session->set_userdata('mobile', $result['mobile']);
				$this->session->set_userdata('id', $result['id']);
				$this->session->set_userdata('business', $result['business']);
				//redirect('employee/employee_list', 'refresh');

				if(($this->session->userdata('role') == 'CC') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/cc/franchisee_form'));
					$res = "CC";
				}
				else if(($this->session->userdata('role') == 'CT') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/ct/entered_form'));
					$res = "CT";
				} 
				else if(($this->session->userdata('role') == 'RSM') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/rsm/login_type'));
					$res = "RSM";
				}
				else if(($this->session->userdata('role') == 'OM') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/opm/login_type'));
					$res = "OM";

				}
				else if(($this->session->userdata('role') == 'IDHAYA') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/cidhaya/login_type'));
					$res = "IDHAYA";

				}
				else if(($this->session->userdata('role') == 'SH') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/sh/login_type'));
					$res = "SH";

				}
				else if(($this->session->userdata('role') == 'TT') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/tt/approve_form'));
					$res = "TT";

				}
				else if(($this->session->userdata('role') == 'SA') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/sa/login_type'));
					$res = "SA";

				}
				else if(($this->session->userdata('role') == 'MT') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/mt/approved_form'));
					$res = "MT";
					

				}
				else if(($this->session->userdata('role') == 'REP') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/rep/location_table'));
					$res = "REP";

				}
				else if(($this->session->userdata('role') == 'MP') && ($this->session->userdata('status') == '1')){
					// redirect(base_url('index.php/rep/location_table'));
					$res = "MP";

				}
				else {
					// $this->session->set_flashdata('msg', 'You Are Not Allowed');
					// redirect(base_url()); 
					$res = "not found";
				}

			}
			else {
				// $this->session->set_flashdata('msg', 'Username / Password Invalid');
				// redirect(base_url());  
				$res = "error";
			}
		}

		$result = array(
			"response" => "$res",
		);

	echo json_encode($result);

	}
	

    public function logout() {
        //unset the logged_in session and redirect to login page
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
		$this->session->unset_userdata('status');
		$this->session->unset_userdata('mobile');
		$this->session->unset_userdata('id');
		
		$this->session->sess_destroy();
		$this->load->view('login'); 
        // redirect(base_url());
    }
 
	
}