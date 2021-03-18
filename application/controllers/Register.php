<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('register');
	}

	public function register()
	{
		$captcha_response = trim($this->input->post('g-recaptcha-response'));
		if($captcha_response != '')
		{
			$keySecret = $this->config->item('recaptcha_secret_key');

			$check = array(
				'secret'		=>	$keySecret,
				'response'		=>	$this->input->post('g-recaptcha-response')
			);

			$startProcess = curl_init();

			curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");

			curl_setopt($startProcess, CURLOPT_POST, true);

			curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));

			curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);

			curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);

			$receiveData = curl_exec($startProcess);

			$finalResponse = json_decode($receiveData, true);

			if($finalResponse['success'])
			{
				$this->load->model('user_model');
				$username = $this->input->post('username');
				$email = $this->input->post('email');

				$this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email|is_unique[users.emailAddress]');
				$this->form_validation->set_rules('username', 'Name', 'trim|required|is_unique[users.username]');

				if ($this->form_validation->run() == false) {
					$this->load->view('register');
				} else {
					$api = $this->config->item('kickbox_api_key');
					$json = json_decode($this->kickbox_api_call($email, $api), true);
					$result = $json['reason'];
					if ($result == "accepted_email") {
						$data = array(
			       			'username' => $username,
			       			'emailAddress' => $email
						);
						$newUserID = $this->user_model->addNewUser($data);
						session_start();
						$_SESSION['username'] = $username;
						$_SESSION['email'] = $email;
						$_SESSION['loggedin'] = true;
						redirect('dashboard');
					} else {
						$this->session->set_flashdata('message', 'Invalid Address');
						redirect('register');
					}
				}
			}
			else
			{
				$this->session->set_flashdata('message', 'Validation Fail Try Again');
				redirect('register');
			}
		}
		else
		{
			$this->session->set_flashdata('message', 'Validation Fail Try Again');
			redirect('register');
		}
	}

	public function kickbox_api_call($email, $api) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, 'https://api.kickbox.com/v2/verify?email='.$email.'&apikey='.$api);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       
	    $data = curl_exec($ch);
	    curl_close($ch);
	    return $data;
	}
}
