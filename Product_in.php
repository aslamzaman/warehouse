<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Product_in extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_in_model');
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['product_ins']     = $this->product_in_model->select_all();
		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('product_in/index',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}




	public function add()
	{
		$data['product']     	= $this->product_in_model->drop_down_option('product',1);
		$data['chart']     		= $this->product_in_model->drop_down_option('account_chart',1);
		$data['employee']     	= $this->product_in_model->drop_down_option('employee',1);
		$data['location']     	= $this->product_in_model->drop_down_option(' location',1);
		
		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('product_in/add',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}


	public function save()
	{
		$this->form_validation->set_rules('dt', 'Date', 'required|max_length[10]');
		$this->form_validation->set_rules('qty', 'Quantity', 'required|max_length[5]');
		$this->form_validation->set_rules('unit_value', 'Rate', 'required|max_length[11]');
		$this->form_validation->set_rules('sales_value', 'Sale Value', 'required|max_length[11]');
		$this->form_validation->set_rules('description', 'Description', 'required|max_length[50]');
		$this->form_validation->set_error_delimiters('<span class="small text-danger"><i> *', '</i></span>'); 

		if ($this->form_validation->run())
		{
			$data['dt']            			= $this->input->post('dt');	
			$data['product_id']            	= $this->input->post('product_id');	
			$data['qty']            		= $this->input->post('qty');	
			$data['unit_value']            	= $this->input->post('unit_value');	
			$data['sales_value']            = $this->input->post('sales_value');	
			$data['description']            = $this->input->post('description');	
			$data['account_chart_id']       = $this->input->post('account_chart_id');	
			$data['employee_id']            = $this->input->post('employee_id');	
			$data['location_id']            = $this->input->post('location_id');	
			$ret = $this->product_in_model->add($data);
			if($ret)
			{
				$_SESSION['msg'] = 'Record saved successfully';
			}
			else
			{
				$_SESSION['msg'] = 'Record failed to save!';
			}
			redirect('product_in');
		}
		else
		{
			$this->add();
		}
	}


	public function edit($id,$id1,$id2,$id3,$id4)
	{
		$data['product_in']     = $this->product_in_model->select_one($id);		
		$data['product']     	= $this->product_in_model->drop_down_option('product',$id1);
		$data['chart']     		= $this->product_in_model->drop_down_option('account_chart',$id2);
		$data['employee']     	= $this->product_in_model->drop_down_option('employee',$id3);
		$data['location']     	= $this->product_in_model->drop_down_option(' location',$id4);		

		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('product_in/edit',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}


	public function update()
	{
		$this->form_validation->set_rules('dt', 'Date', 'required|max_length[10]');
		$this->form_validation->set_rules('qty', 'Quantity', 'required|max_length[5]');
		$this->form_validation->set_rules('unit_value', 'Rate', 'required|max_length[11]');
		$this->form_validation->set_rules('sales_value', 'Sale Value', 'required|max_length[11]');
		$this->form_validation->set_rules('description', 'Description', 'required|max_length[50]');
		$this->form_validation->set_error_delimiters('<span class="small text-danger"><i> *', '</i></span>'); 
		if ($this->form_validation->run())
		{
			$data['dt']            			= $this->input->post('dt');	
			$data['product_id']            	= $this->input->post('product_id');	
			$data['qty']            		= $this->input->post('qty');	
			$data['unit_value']            	= $this->input->post('unit_value');	
			$data['sales_value']            = $this->input->post('sales_value');	
			$data['description']            = $this->input->post('description');	
			$data['account_chart_id']       = $this->input->post('account_chart_id');	
			$data['employee_id']            = $this->input->post('employee_id');	
			$data['location_id']            = $this->input->post('location_id');		
			$ret = $this->product_in_model->edit($data, $this->input->post('id'));
			if($ret)
			{
				$_SESSION['msg'] = 'Record updated successfully';
			}
			else
			{
				$_SESSION['msg'] = 'Record failed to update!';
			}
			redirect('product_in');
		}
		else
		{
			$this->edit($this->input->post('id'),$this->input->post('product_id'),$this->input->post('account_chart_id'),$this->input->post('employee_id'),$this->input->post('location_id'));
		}
	}


	public function remove($id)
	{
		$ret 				= $this->product_in_model->remove($id);
		if($ret)
		{
			$_SESSION['msg'] = 'Record deleted successfully';
		}
		else
		{
			$_SESSION['msg'] = 'Record failed to delete!';
		}
		redirect('product_in');
	}


	public function view($id)
	{
		$data['product_in']     = $this->product_in_model->select_one($id);
		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('product_in/view',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}

	

	

}	





