<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct(){

        parent::__construct();
        if($this->session->userdata('logged_in')) {
        	$this->session->set_flashdata(array('error_msg' => 'You are already logged in what are you looking for in :(' ));
        	redirect('landing');
		}
		$this->load->library('user_agent');
		if ($this->agent->is_referral()){
		    $this->session->set_userdata('referred_from', $this->agent->referrer());
		}
    }

	public function index(){

		if( $_POST ){
			$this->form_validation->set_rules('email','Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('password','Password', 'trim|required');

			if( $this->form_validation->run() == FALSE ){
				$this->session->set_flashdata(array('error_msg' => validation_errors() ));
				redirect('account');
			}
			// check the login
			$json = file_get_contents('./acct.json');
			$array_data = json_decode($json, TRUE);
			if( !empty($array_data) ) {
				foreach( $array_data as $acc ){
					if( ($acc['email'] == $_POST['email']) && ($acc['password'] == md5(md5($_POST['password']))) ) {
						$session_data = array('email' => $_POST['email'], 'phone' => $acc['phone'], 'logged_in' => TRUE );
						$this->session->set_userdata($session_data);
						$this->session->set_flashdata(array('success_msg' => 'Logged in successully...' ));

						if( $this->session->userdata('referred_from') ){
							redirect($this->session->userdata('referred_from'));
						}else{
							redirect('landing');
						}
					}
					break;
				}
			}

			$this->session->set_flashdata(array('error_msg' => 'Sorry the account details is incorrect...' ));
			redirect('account');

		}else{
			$this->load->view('landing/login');
		}
	}

	public function signup(){

		if( $_POST ){
			$this->form_validation->set_rules('name','Full name', 'trim|required');
			$this->form_validation->set_rules('phone','Phone number', 'trim|required');
			$this->form_validation->set_rules('email','Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('password','Password', 'trim|required');
			$this->form_validation->set_rules('rpassword','Repeat Paswword', 'trim|required|min_length[3]|matches[password]');

			if( $this->form_validation->run() == FALSE ) {
				$this->session->set_flashdata(array('error_msg' => validation_errors() ));
				redirect('account/signup');
			}
			$email = cleanit($_POST['email']);

			// check if account is already existing
			$accounts = array();
			$json = file_get_contents('./acct.json');
			$array_data = json_decode($json, TRUE);
			if( !empty($array_data) ) {
				foreach( $array_data as $acc ){
					if( $acc['email'] == $email) {
						$this->session->set_flashdata(array('error_msg' => 'Email already existing...' ));
						redirect('account/signup');
					}
					break;
				}
			}
			// md5(md5(password)).salt(16);

			$data = array(
				'name' => cleanit($_POST['name']),
				'email' => cleanit($_POST['email']),
				'phone' => cleanit($_POST['phone']),
				'password' => md5(md5($_POST['password']))
			);	
			// array_push($accounts, $data);
			$array_data[] = $data;
			$jsonData = json_encode($array_data, JSON_PRETTY_PRINT);
			// var_dump($jsonData);
			// exit;
			if( file_put_contents('./acct.json', $jsonData) ){
				$session_data = array('email' => $_POST['email'], 'phone' => $_POST['phone'] );
				$this->session->set_userdata($session_data);
				$this->session->set_flashdata(array('success_msg' => 'Congrats your account has been created successully, you can login before making order.' ));
				unset( $session_data ); unset($data); // memory leaching
				redirect('account');
			}else{
				$this->session->set_flashdata(array('error_msg' => 'Sorry! There was an error creating your account.' ));
				redirect('account/signup');
			}



		}else {
			$this->load->view('landing/signup');						
		}
	}
}
