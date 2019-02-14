<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Cash_out extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cash_out_model');
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$in     			= $this->cash_out_model->cash_in_total();
		$out     			= $this->cash_out_model->cash_out_total();
		$data['balance']	= $in['in_total'] - $out['out_total'];
		$data['cash_outs']	= $this->cash_out_model->select_all();
		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('cash_out/index',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}




	public function add()
	{
		$data['chart']     = $this->cash_out_model->drop_down_option('account_chart',1);
		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('cash_out/add',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}


	public function save()
	{
		$this->form_validation->set_rules('dt', 'Date', 'required|max_length[10]');
		$this->form_validation->set_rules('cause', 'Cause', 'required|max_length[50]');
		$this->form_validation->set_rules('amount', 'Amount', 'required|max_length[11]');
		$this->form_validation->set_error_delimiters('<span class="small text-danger"><i> *', '</i></span>'); 

		if ($this->form_validation->run())
		{
			$data['dt']            		= $this->input->post('dt');	
			$data['account_chart_id']   = $this->input->post('account_chart_id');	
			$data['cause']            	= $this->input->post('cause');	
			$data['amount']            	= $this->input->post('amount');	
			$ret = $this->cash_out_model->add($data);
			if($ret)
			{
				$_SESSION['msg'] = 'Record saved successfully';
			}
			else
			{
				$_SESSION['msg'] = 'Record failed to save!';
			}
			redirect('cash_out');
		}
		else
		{
			$this->add();
		}
	}


	public function edit($id,$id1)
	{
		$data['cash_in']	= $this->cash_out_model->select_one($id);
		$data['chart']		= $this->cash_out_model->drop_down_option('account_chart',$id1);
		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('cash_out/edit',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}


	public function update()
	{
		
		$this->form_validation->set_rules('dt', 'Date', 'required|max_length[10]');
		$this->form_validation->set_rules('cause', 'Cause', 'required|max_length[50]');
		$this->form_validation->set_rules('amount', 'Amount', 'required|max_length[11]');
		$this->form_validation->set_error_delimiters('<span class="small text-danger"><i> *', '</i></span>'); 
		if ($this->form_validation->run())
		{
			$data['dt']            		= $this->input->post('dt');	
			$data['account_chart_id']	= $this->input->post('account_chart_id');	
			$data['cause']				= $this->input->post('cause');	
			$data['amount']				= $this->input->post('amount');	
			$ret = $this->cash_out_model->edit($data, $this->input->post('id'));
			if($ret)
			{
				$_SESSION['msg'] = 'Record updated successfully';
			}
			else
			{
				$_SESSION['msg'] = 'Record failed to update!';
			}
			redirect('cash_out');
		}
		else
		{
			$i1 = $this->input->post('id');
			$i2 = $this->input->post('account_chart_id');
			$this->edit($i1,$i2);
		}
	}


	public function remove($id)
	{
		$ret = $this->cash_out_model->remove($id);
		if($ret)
		{
			$_SESSION['msg'] = 'Record deleted successfully';
		}
		else
		{
			$_SESSION['msg'] = 'Record failed to delete!';
		}
		redirect('cash_out');
	}


	public function view($id)
	{
		$data['cash_out']     = $this->cash_out_model->select_one($id);
		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('cash_out/view',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}

	
	
/** ------------   Cash_in route  ---------    
$route['add-cash_in']							= 'cash_in/add_cash_in';
$route['save-cash_in']							= 'cash_in/save_cash_in';
$route['edit-cash_in/(:any)']					= 'cash_in/edit_cash_in/$1';
$route['update-cash_in']							= 'cash_in/update_cash_in';
$route['view-cash_in/(:any)']					= 'cash_in/view_cash_in/$1';
$route['delete-cash_in/(:any)']					= 'cash_in/delete_cash_in/$1';

 ------------  /.Cash_in route  ---------    */		
	

}	





