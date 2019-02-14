<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));		
	}


	public function index()
	{

		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');		
		$this->load->view('layout/navbar');
		$this->load->view('dashboard/index');
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');		
	}
	



	public function about()
	{

		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');		
		$this->load->view('layout/navbar');
		// $this->load->view('layout/slide');
		$this->load->view('about/index');
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');		
	}
	



	public function service()
	{

		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');		
		$this->load->view('layout/navbar');
		// $this->load->view('layout/slide');
		$this->load->view('service/index');
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');		
	}




	public function contact()
	{

		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');		
		$this->load->view('layout/navbar');
		// $this->load->view('layout/slide');
		$this->load->view('contact/index');
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');		
	}
		
	
}
