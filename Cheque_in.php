<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Cheque_in extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cheque_in_model');
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('form', 'url'));
	}


	public function create_array()
	{
		$banks     			= $this->cheque_in_model->select_bank();
		$data 				= array();
		$n 					= 0;

			foreach($banks as $row)
			{
				$id = $row['id'];
				$c_in     				= $this->cheque_in_model->cheque_in($id);
				$c_out     				= $this->cheque_in_model->cheque_out($id);
				$data[$n]['id']			= $id;
				$data[$n]['name']		= $row['name'];
				$data[$n]['ac_no']		= $row['ac_no'];
				$data[$n]['balance']	= $c_in['in_total'] - $c_out['out_total'];
				$n++;
			}
			return $data;
	}

	public function index()
	{
		$data['banks']     			= $this->create_array();
		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('cheque_in/index',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}


	public function add($id)
	{
		$data['bank'] 		= $this->cheque_in_model->select_one_bank($id);
		$data['ac_charts'] 	= $this->cheque_in_model->drop_down_option('account_chart',1);
		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('cheque_in/add',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}


	public function save()
	{

		$this->form_validation->set_rules('dt', 'Date', 'required|max_length[50]');
		$this->form_validation->set_rules('bank_account_id', 'Bank Account Id', 'required|max_length[15]');
		$this->form_validation->set_rules('cheque_no', 'Cheque No', 'required|max_length[15]');
		$this->form_validation->set_rules('cheque_dt', 'Cheque Date', 'required|max_length[10]');
		$this->form_validation->set_rules('amount', 'Amount', 'required|max_length[11]');
		$this->form_validation->set_rules('cause', 'Cause', 'required|max_length[50]');
		$this->form_validation->set_error_delimiters('<span class="small text-danger"><i> *', '</i></span>'); 

		if ($this->form_validation->run())
		{
			$data['dt']           				= $this->input->post('dt');	
			$data['bank_account_id']            = $this->input->post('bank_account_id');	
			$data['account_chart_id']           = $this->input->post('account_chart_id');	
			$data['cheque_no']            		= $this->input->post('cheque_no');	
			$data['cheque_dt']            		= $this->input->post('cheque_dt');	
			$data['amount']            			= $this->input->post('amount');	
			$data['cause']            			= $this->input->post('cause');	
			$data['entry_dt']            		= date("Y-m-d h:i:sa");        
			$ret = $this->cheque_in_model->add($data);
			if($ret)
			{
				$_SESSION['msg'] = 'Record saved successfully';
			}
			else
			{
				$_SESSION['msg'] = 'Record failed to save!';
			}
			redirect('cheque_in');
		}
		else
		{
			$this->add($this->input->post('bank_account_id'));
		}
	}

/** -------------------------------------   */

	public function bank_info($id)
	{
		$data['bank_info'] = $this->cheque_in_model->select_one_bank($id);
		$data['banks']     			= $this->cheque_in_model->select_bank_info($id);
		$this->load->view('layout/header');
		$this->load->view('layout/header_closing');
		$this->load->view('layout/navbar');
		$this->load->view('cheque_in/view',$data);
		$this->load->view('layout/footer');
		$this->load->view('layout/footer_closing');
	}






	public function remove($id)
	{
		$ret = $this->cheque_in_model->remove($id);
		if($ret)
		{
			$_SESSION['msg'] = 'Record deleted successfully';
		}
		else
		{
			$_SESSION['msg'] = 'Record failed to delete!';
		}
		redirect('cheque_in');
	}


	

}	





