<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		    $this->load->view('dashboard');
		}
		else {
		    redirect('user');
		}
	}
}
