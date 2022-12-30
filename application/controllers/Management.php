<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('Menu_model', 'menu');
	}

	public function index()
	{
		$data['title'] = 'Pelanggan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['pelanggan'] = $this->db->get('pelanggan')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/index', $data);
		$this->load->view('templates/footer');
	}

	public function inputPelanggan(){
		$data = [
			'nama' => $this->input->post('nama'),
			'no_hp' => $this->input->post('no_hp'),
			'email' => $this->input->post('email'),
			'alamat' => $this->input->post('alamat'),
		];
		$this->db->insert('pelanggan', $data);
	}

	public function getPelangganModal()
	{
		$data = $this->db->get_where('pelanggan', ['cid' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function editPelangganModal()
	{
		$data['title'] = 'Pelanggan';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['pelanggan'] = $this->db->get('pelanggan')->result_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('management/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
			];
			$this->menu->editPelangganById($_POST['id'], $data);
			$this->session->set_flashdata(
				'message_pelanggan',
				'<div class="alert alert-success" role="alert">
					Success Edit Pelanggan!
				</div>'
			);
			redirect('management');
		}
	}

	public function deletePelangganModal()
	{
		$this->menu->deletePelangganById($this->input->post('id_s'));

		$this->session->set_flashdata(
			'message_pelanggan',
			'<div class="alert alert-success" role="alert">
				Success Delete Pelanggan!
			</div>'
		);
		redirect('management');
	}

	public function kriteria()
	{
		$data['title'] = 'Kriteria';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/kriteria', $data);
		$this->load->view('templates/footer');
	}

	public function cdKriteria()
    {
		$kodeKriteria = $this->menu->kodeKriteria();

		$urutan = substr($kodeKriteria['kodeTerbesar'], 1, 4);
		$urutan++;
		$huruf = "K";
		$kodeKriteria = $huruf.sprintf("%03s", $urutan);
		$data['pengurutanK'] = $kodeKriteria;
		echo json_encode($data);
	}

	public function tableKriteria(){
		$output['data'] = $this->db->get('kriteria')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updateKriteria(){
		$vld = $this->input->post('validasi');
		if ($this->input->post('is_active') == null) {
			$is_active = '0';
		} else {
			$is_active = $this->input->post('is_active');
		}
		$data = [
			'kd_kriteria' => $this->input->post('kd_kriteria'),
			'kriteria' => $this->input->post('kriteria'),
			'atribut' => $this->input->post('atribut'),
			'status' => $is_active,
		];
		if($vld == "new"){
			$result = $this->db->insert('kriteria', $data);
		}else if($vld == "update"){
			$result = $this->menu->editKriteriaById($_POST['kd_kriteria'], $data);
		}
		echo json_decode($result);
	}

	public function getKriteriaModal()
	{
		$data = $this->db->get_where('kriteria', ['kd_kriteria' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deleteKriteriaModal()
	{
		$result = $this->menu->deleteKriteriaById($this->input->post('id'));
		echo json_decode($result);
	}
}
