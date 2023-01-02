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

	public function inputPelanggan()
	{
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

	// ##################################################################################################################################
	// Kriteria
	public function kriteria()
	{
		$data['title'] = 'Kriteria';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/kriteria');
		$this->load->view('templates/footer');
	}

	public function cdKriteria()
	{
		$kode = $this->menu->kodeKriteria();

		$urutan = substr($kode['kodeTerbesar'], 1, 4);
		$urutan++;
		$huruf = "K";
		$kode = $huruf . sprintf("%03s", $urutan);
		$data['pengurutanK'] = $kode;
		echo json_encode($data);
	}

	public function tableKriteria()
	{
		$output['data'] = $this->db->get('kriteria')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updateKriteria()
	{
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
		if ($vld == "new") {
			$vl = [
				'pesan' => 'new',
				'url' => '/Management/cdKriteria',
				'kd_input' => '#kd_kriteria',
				'status' => 200,
			];
			$this->db->insert('kriteria', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => 'update',
				'status' => 200,
			];
			$this->menu->editKriteriaById($_POST['kd_kriteria'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
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

	//##################################################################################################################################
	// Bobot
	public function bobot()
	{
		$data['title'] = 'Bobot';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/bobot');
		$this->load->view('templates/footer');
	}

	public function cdBobot()
	{
		$kode = $this->menu->kodeBobot();

		$urutan = substr($kode['kodeTerbesar'], 1, 4);
		$urutan++;
		$huruf = "B";
		$kode = $huruf . sprintf("%03s", $urutan);
		$data['pengurutanK'] = $kode;
		echo json_encode($data);
	}

	public function tableBobot()
	{
		$output['data'] = $this->db->get('bobot')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updateBobot()
	{
		$vld = $this->input->post('validasi');
		if ($this->input->post('is_active') == null) {
			$is_active = '0';
		} else {
			$is_active = $this->input->post('is_active');
		}
		$data = [
			'kd_bobot' => $this->input->post('kd_bobot'),
			'nilai_bobot' => $this->input->post('nilai_bobot'),
			'bobot' => $this->input->post('bobot'),
			'status' => $is_active,
		];
		if ($vld == "new") {
			$vl = [
				'pesan' => 'new',
				'url' => '/Management/cdBobot',
				'kd_input' => '#kd_bobot',
				'status' => 200,
			];
			$this->db->insert('bobot', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => 'update',
				'status' => 200,
			];
			$this->menu->editBobotById($_POST['kd_bobot'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function getBobotModal()
	{
		$data = $this->db->get_where('bobot', ['kd_bobot' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deleteBobotModal()
	{
		$result = $this->menu->deleteBobotById($this->input->post('id'));
		echo json_decode($result);
	}

	//##################################################################################################################################
	// Paket
	public function paket()
	{
		$data['title'] = 'Paket Wedding';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/paket');
		$this->load->view('templates/footer');
	}

	public function cdPaket()
	{
		$kode = $this->menu->kodePaket();

		$urutan = substr($kode['kodeTerbesar'], 1, 4);
		$urutan++;
		$huruf = "T";
		$kode = $huruf . sprintf("%03s", $urutan);
		$data['pengurutanK'] = $kode;
		echo json_encode($data);
	}

	public function tablePaket()
	{
		$output['data'] = $this->db->get('paket')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updatePaket()
	{
		$vld = $this->input->post('validasi');
		if ($this->input->post('is_active') == null) {
			$is_active = '0';
		} else {
			$is_active = $this->input->post('is_active');
		}
		$data = [
			'kd_paket' => $this->input->post('kd_p'),
			'paket' => $this->input->post('paket'),
			'harga' => $this->input->post('harga'),
			'dekorasi' => $this->input->post('dekorasi'),
			'harga_dekorasi' => $this->input->post('harga_dekorasi'),
			'brp' => $this->input->post('brp'),
			'harga_brp' => $this->input->post('harga_brp'),
			'catering' => $this->input->post('catering'),
			'harga_catering' => $this->input->post('harga_catering'),
			'dokumentasi' => $this->input->post('dokumentasi'),
			'harga_dokumentasi' => $this->input->post('harga_dokumentasi'),
			'ah' => $this->input->post('ah'),
			'harga_ah' => $this->input->post('harga_ah'),
			'jumlah_tamu' => $this->input->post('jumlah_tamu'),
			'status' => $is_active
		];
		if ($vld == "new") {
			$vl = [
				'pesan' => 'new',
				'url' => '/Management/cdPaket',
				'kd_input' => '#kd_tes',
				'status' => 200,
			];
			$this->db->insert('paket', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => 'update',
				'status' => 200,
			];
			$this->menu->editPaketById($_POST['kd_paket'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function getPaketModal()
	{
		$data = $this->db->get_where('paket', ['kd_paket' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deletePaketModal()
	{
		$result = $this->menu->deletePaketById($this->input->post('id'));
		echo json_decode($result);
	}

	//##################################################################################################################################
	// Tes Minat
	public function tesMinat()
	{
		$data['title'] = 'Tes Minat';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/tesMinat');
		$this->load->view('templates/footer');
	}

	public function cdTesMinat()
	{
		$kode = $this->menu->kodeTesMinat();

		$urutan = substr($kode['kodeTerbesar'], 1, 4);
		$urutan++;
		$huruf = "T";
		$kode = $huruf . sprintf("%03s", $urutan);
		$data['pengurutanK'] = $kode;
		echo json_encode($data);
	}

	public function tableTesMinat()
	{
		$output['data'] = $this->db->get('tes_minat')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updateTesMinat()
	{
		$vld = $this->input->post('validasi');
		if ($this->input->post('is_active') == null) {
			$is_active = '0';
		} else {
			$is_active = $this->input->post('is_active');
		}
		$data = [
			'kd_tes' => $this->input->post('kd_tes'),
			'kriteria' => $this->input->post('kriteria'),
			'status' => $is_active,
		];
		if ($vld == "new") {
			$vl = [
				'pesan' => 'new',
				'url' => '/Management/cdTesMinat',
				'kd_input' => '#kd_tes',
				'status' => 200,
			];
			$this->db->insert('tes_minat', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => 'update',
				'status' => 200,
			];
			$this->menu->editTesMinatById($_POST['kd_tes'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function getTesMinatModal()
	{
		$data = $this->db->get_where('tes_minat', ['kd_tes' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deleteTesMinatModal()
	{
		$result = $this->menu->deleteTesMinatById($this->input->post('id'));
		echo json_decode($result);
	}

	//##################################################################################################################################
	// Soal Tes
	public function showSoalTes()
	{
		$data['title'] = 'Soal Tes Minat';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('management/soalTes');
		$this->load->view('templates/footer');
	}

	public function tableSoalTes()
	{
		$output['data'] = $this->db->get('soal_tes')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function updateSoalTes()
	{
		$vld = $this->input->post('validasi');
		if ($this->input->post('is_active') == null) {
			$is_active = '0';
		} else {
			$is_active = $this->input->post('is_active');
		}
		$data = [
			'kd_soal' => $this->input->post('kd_soal'),
			'kriteria' => $this->input->post('kriteria'),
			'status' => $is_active,
		];
		if ($vld == "new") {
			$vl = [
				'pesan' => 'new',
				'url' => '/Management/cdTesMinat',
				'kd_input' => '#kd_tes',
				'status' => 200,
			];
			$this->db->insert('soal_tes', $data);
		} else if ($vld == "update") {
			$vl = [
				'pesan' => 'update',
				'status' => 200,
			];
			$this->menu->editSoalTesById($_POST['kd_soal'], $data);
		}
		echo json_encode($vl, JSON_UNESCAPED_SLASHES);
	}

	public function getSoalTesModal()
	{
		$data = $this->db->get_where('soal_tes', ['kd_soal' => $_POST['id']])->row_array();
		echo json_encode($data);
	}

	public function deleteSoalTesModal()
	{
		$result = $this->menu->deleteSoalTesById($this->input->post('id'));
		echo json_decode($result);
	}
}
