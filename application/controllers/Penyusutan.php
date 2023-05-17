<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyusutan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged")<>1) {
	      redirect(site_url('login'));
	    }
		
		$this->load->model('ModelPenyusutan','mp');
		$this->load->model('ModelKategori','mk');
		$this->load->model('ModelLokasi','ml');
	}

	public function index()
	{
		$data = array(
			'title' => 'Penyusutan',
			'active_menu_pys' => 'active',
			'lokasi' => $this->ml->getLokasi(),
		);

		if (isset($_POST['filter'])) {
			$id_lokasi = $this->input->post('id_lokasi');
			$tahun_perolehan = $this->input->post('tahun_perolehan');

			$data['pys'] = $this->mp->getFilterAsetWujud($id_lokasi,$tahun_perolehan);

			$data['id_lokasi'] = $id_lokasi;
			$data['tahun_perolehan'] = $tahun_perolehan;
		} else {
			$data['pys'] = $this->mp->getAsetWujud();
		}

		$this->load->view('layouts/header',$data);
		$this->load->view('penyusutan/v_penyusutan');
		$this->load->view('layouts/footer');
	}

	public function detailPenyusutan($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$data = array(
			'title' => 'Penyusutan',
			'active_menu_pys' => 'active',
			'd' => $this->mp->getDetailAsetWujud($id_aset),
			'item' => $this->mp->getDetailAsetWujud1($id_aset) 
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('penyusutan/d_penyusutan',$data);
		$this->load->view('layouts/footer');
	}


	public function penghapusanAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$data['status_aset'] = 'Dihapuskan'; 
		unset($data['id_aset']);
		$result = $this->mp->updateAset($id_aset,$data);
		if($result>=1){
			$this->session->set_flashdata('sukses', 'Dihapuskan');
			redirect('penyusutan');
		}else{
			$this->session->set_flashdata('gagal', 'Dihapuskan');
			redirect('penyusutan');
		}
	}

	public function print_data()
	{
		$data = array(
			'title' => 'Penyusutan',
			'aset' => $this->mp->getAsetWujud()
		);
		$this->load->view('report/header',$data);
		$this->load->view('penyusutan/print');
		$this->load->view('report/footer');
	}

	public function print_filter_data($id_lokasi, $tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(2);
		$tahun_perolehan = $this->uri->segment(3);

		$data = array(
			'title' => 'Penyusutan',
			'aset' => $this->mp->getFilterAsetWujud($id_lokasi,$tahun_perolehan)
		);
		$this->load->view('report/header',$data);
		$this->load->view('penyusutan/print');
		$this->load->view('report/footer');
	}

}

/* End of file Penyusutan.php */
/* Location: ./application/controllers/Penyusutan.php */