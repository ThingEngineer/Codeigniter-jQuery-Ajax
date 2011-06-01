<?php
class Test extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

	}

	function index()
	{
		$this->load->view('test/ajax_test_view');
	}

	function get_something()
	{
		$this->load->library('ajax');

		$arr['something'] = 'Something Good';

		if ($this->input->post('something_id') == '2')
		{
			$arr['something'] = 'Something Better';
		}

		$this->ajax->output_ajax($arr);
	}
}