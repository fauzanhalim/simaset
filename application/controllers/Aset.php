<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aset extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged")<>1) {
	      redirect(site_url('login'));
	    }
		
		//load model
		$this->load->model('ModelAset','ma');
		$this->load->model('ModelBarang','mb');
		$this->load->model('ModelLokasi','ml');
		$this->load->model('ModelKategori','mk');

		//load library
		$this->load->library('ciqrcode');
		$this->load->library('uuid');
	}

	public function index()
	{		
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'kategori' => $this->mk->getKategoriBarang() 
		);

		if (isset($_POST['filter'])) {
			$id_lokasi = $this->input->post('id_lokasi');
			$tahun_perolehan = $this->input->post('tahun_perolehan');

			$data['aset'] = $this->ma->getFilterAsetWujud($id_lokasi,$tahun_perolehan);

			$data['id_lokasi'] = $id_lokasi;
			$data['tahun_perolehan'] = $tahun_perolehan;
		} else {
			$data['aset'] = $this->ma->getAsetWujud();
		}

		$this->load->view('layouts/header',$data);
		$this->load->view('aset/v_wujud');
		$this->load->view('layouts/footer');
	}

	public function tambahAset()
	{
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getAsetWujud(),
			'brg' => $this->mb->getDataBarang(),
			'lokasi' => $this->ml->getLokasi()
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('aset/c_wujud',$data);
		$this->load->view('layouts/footer');
	}

	public function simpanAset()
	{
		$generate = $this->input->post('generate');
		if ($generate) {

			$config['cacheable']    = true; 
			$config['cachedir']     = './src/';
			$config['errorlog']     = './src/'; 
			$config['imagedir']     = './src/img/qrcode/'; 
			$config['quality']      = true; 
			$config['size']         = '1024'; 
			$config['black']        = array(224,255,255); 
			$config['white']        = array(70,130,180); 
			$this->ciqrcode->initialize($config);

			$id = $this->uuid->v4();
			$image = str_replace('-', '', $id);

			$id_as = $this->uuid->v4();
			$id_aset = str_replace('-', '', $id_as);

			$image_name = $image.'.png'; 

			$url = 'http://example-url.com/aset/detail/'.$id_aset;

			$params['data'] = $url; 
			$params['level'] = 'H'; 
			$params['size'] = 10;
			$params['savename'] = FCPATH.$config['imagedir'].$image_name; 
			$this->ciqrcode->generate($params);

			//membuat kode aset otomatis
	        $id_barang = $this->input->post('id_barang');

	        $brg = $this->ma->getDetailBarang($id_barang); 

	        $category = $brg['kode_kategori'];
	        $year = $brg['tahun_perolehan'];

	        $kode_aset = $this->ma->CreateCode($category, $year);

			$data = array(
				'id_aset' => $id_aset,
				'kode_aset' => $kode_aset,
				'id_barang' => $this->input->post('id_barang'),
				'id_lokasi' => $this->input->post('id_lokasi'),
				'volume' =>  $this->input->post('volume'),
				'satuan' => $this->input->post('satuan'),
				'harga' => $this->input->post('harga'),
				'kondisi' => $this->input->post('kondisi'),
				'status_aset' => 'Aktif',
				'umur_ekonomis' => $this->input->post('umur_ekonomis'),
				'qr_code' => $image_name
			);

			$this->ma->storeAset($data);

			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('aset_wujud');

		} else {

			$id = $this->uuid->v4();
			$id_aset = str_replace('-', '', $id);

			//membuat kode aset otomatis
	        $id_barang = $this->input->post('id_barang');

	        $brg = $this->ma->getDetailBarang($id_barang); 

	        $category = $brg['kode_kategori'];
	        $year = $brg['tahun_perolehan'];

	        $kode_aset = $this->ma->CreateCode($category, $year);

			$data = array(
				'id_aset' => $id_aset,
				'kode_aset' => $kode_aset,
				'id_barang' => $this->input->post('id_barang'),
				'id_lokasi' => $this->input->post('id_lokasi'),
				'volume' =>  $this->input->post('volume'),
				'satuan' => $this->input->post('satuan'),
				'harga' => $this->input->post('harga'),
				'kondisi' => $this->input->post('kondisi'),
				'status_aset' => 'Aktif',
				'umur_ekonomis' => $this->input->post('umur_ekonomis')
			);

			$this->ma->storeAset($data);

			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('aset_wujud');
		}		
	}

	public function editAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);

		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getDetailAsetWujud($id_aset),
			'brg' => $this->mb->getDataBarang(),
			'lokasi' => $this->ml->getLokasi()
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('aset/u_wujud',$data);
		$this->load->view('layouts/footer');
	}

	public function ubahAset()
	{
		$id_aset = $this->input->post('id_aset');
		$generate = $this->input->post('generate');
		$aset = $this->ma->getFindAset($id_aset);

		if ($generate) {
			$data = array(
				'id_barang' => $this->input->post('id_barang'),
				'id_lokasi' => $this->input->post('id_lokasi'),
				'volume' =>  $this->input->post('volume'),
				'satuan' => $this->input->post('satuan'),
				'harga' => $this->input->post('harga'),
				'kondisi' => $this->input->post('kondisi'),
				'status_aset' => 'Aktif',
				'umur_ekonomis' => $this->input->post('umur_ekonomis'),
			);

			if ($aset['qr_code'] == NULL) {
				$config['cacheable']    = true; 
				$config['cachedir']     = './src/'; 
				$config['errorlog']     = './src/'; 
				$config['imagedir']     = './src/img/qrcode/'; 
				$config['quality']      = true; 
				$config['size']         = '1024'; 
				$config['black']        = array(224,255,255); 
				$config['white']        = array(70,130,180); 
				$this->ciqrcode->initialize($config);

				$id = $this->uuid->v4();
				$image = str_replace('-', '', $id);

				$image_name = $image.'.png'; 

				$url = 'https://example-url.com/aset/detail/'.$id_aset;

				$params['data'] = $url; 
				$params['level'] = 'H'; 
				$params['size'] = 10;
				$params['savename'] = FCPATH.$config['imagedir'].$image_name; 
				$this->ciqrcode->generate($params);

				$data['qr_code'] = $image_name;
			}

			$this->ma->updateAset($id_aset,$data);

			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('aset_wujud');
			
		}else{
			$data = array(
				'id_barang' => $this->input->post('id_barang'),
				'id_lokasi' => $this->input->post('id_lokasi'),
				'volume' =>  $this->input->post('volume'),
				'satuan' => $this->input->post('satuan'),
				'harga' => $this->input->post('harga'),
				'kondisi' => $this->input->post('kondisi'),
				'status_aset' => 'Aktif',
				'umur_ekonomis' => $this->input->post('umur_ekonomis'),
			);

			unlink('src/img/qrcode/'.$aset['qr_code']);
			$data['qr_code'] = NULL;

			$this->ma->updateAset($id_aset,$data);

			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('aset_wujud');
		}	
	}

	public function detailAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getDetailAsetWujud($id_aset)
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('aset/d_wujud',$data);
		$this->load->view('layouts/footer');
	}

	public function hapusAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);

		$this->db->where('id_aset',$id_aset);
        $get_image_file=$this->db->get('asets')->row();
        @unlink('src/img/qrcode/'.$get_image_file->qr_code);

        $this->db->where('id_aset',$id_aset);
        $this->db->delete('asets');
        $this->session->set_flashdata('sukses', 'Dihapus');
		redirect('aset_wujud');
	}

	public function filterAset()
	{
		$id_kategori = $this->input->post('id_kategori');
		$tahun_perolehan = $this->input->post('tahun_perolehan');
		$kondisi = $this->input->post('kondisi');

		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getFilterAsetWujud($id_kategori,$tahun_perolehan,$kondisi),
			'kategori' => $this->mk->getKategoriBarang() 
		);
		if (count($data['aset'])>0) {
			$this->load->view('layouts/header',$data);
			$this->load->view('aset/v_wujud',$data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
			redirect('aset_wujud');
		}		
	}

	public function dihapuskanAset()
	{
		$data = array(
			'title' => 'Aset Dihapuskan',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_hapuskan' => 'active',
			'lokasi' => $this->ml->getLokasi() 
		);

		if (isset($_POST['filter'])) {
			$id_lokasi = $this->input->post('id_lokasi');
			$tgl_penghapusan = $this->input->post('tgl_penghapusan');

			$data['aset'] = $this->ma->getFilterAsetDihapuskan($id_lokasi, $tgl_penghapusan);
			$data['id_lokasi'] = $id_lokasi;
			$data['tgl_penghapusan'] = $tgl_penghapusan;
		} else {
			$data['aset'] = $this->ma->getAsetDihapuskan();
		}
		$this->load->view('layouts/header',$data);
		$this->load->view('aset/v_dihapuskan',$data);
		$this->load->view('layouts/footer');
	}

	public function detailDihapuskanAset($id_aset)
	{
		$id_penghapusan = $this->uri->segment(3);
		$item = $this->ma->getFindAsetDihapuskan($id_penghapusan);

		$id_aset = $item['id_aset'];

		$data = array(
			'title' => 'Detail Aset Dihapuskan',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_hapuskan' => 'active',
			'item' => $item,
			'aset' => $this->ma->getDetailAsetWujud($id_aset)
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('aset/d_dihapuskan');
		$this->load->view('layouts/footer');
	}

	public function filterAsetDihapuskan()
	{
		$id_kategori = $this->input->post('id_kategori');
		$tgl_penghapusan = $this->input->post('tgl_penghapusan');

		$data = array(
			'title' => 'Aset Dihapuskan',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_hapuskan' => 'active',
			'kategori' => $this->mk->getKategoriBarang(),
			'aset' => $this->ma->getFilterAsetDihapuskan($id_kategori,$tgl_penghapusan)  
		);
		if (count($data['aset'])>0) {
			$this->load->view('layouts/header',$data);
			$this->load->view('aset/v_dihapuskan',$data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
			redirect('aset_dihapuskan');
		}
	}

	public function destroy_aset($id_penghapusan)
	{
		$id_penghapusan = $this->uri->segment(2);

        $this->db->where('id_penghapusan',$id_penghapusan);
        $this->db->delete('penghapusan');
        $this->session->set_flashdata('sukses', 'Dihapus');
		redirect('aset_dihapuskan');
	}

	public function cariAset()
	{
		$bar = $this->input->get('bar');
		$query = $this->ma->searchAset($bar, 'nama_barang');

		echo json_encode($query);
	}

	public function print_all_aset()
	{
		$data = array(
			'title' => 'Laporan Data Aset', 
			'aset' => $this->ma->getAsetWujud() 
		);
		$this->load->view('report/header',$data);
		$this->load->view('aset/print');
		$this->load->view('report/footer');
	}

	public function print_filter_aset($id_lokasi, $tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(2);
		$tahun_perolehan = $this->uri->segment(3);

		$data = array(
			'title' => 'Laporan Data Aset'
		);

		$data['aset'] = $this->ma->getFilterAsetWujud($id_lokasi,$tahun_perolehan);
		
		$this->load->view('report/header',$data);
		$this->load->view('aset/print');
		$this->load->view('report/footer');
	}

	public function print_all_Qrcode()
	{
		$data = array(
			'title' => 'Print QR Code', 
			'aset' => $this->ma->getAllQr() 
		);

		$this->load->view('laporan/p_qrcode',$data);
	}

	public function printFilterQR($id_lokasi, $tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(2);
		$tahun_perolehan = $this->uri->segment(3);

		$data = array(
			'title' => 'Laporan QR Code',
			'aset' => $this->ma->getFilterQR($id_lokasi, $tahun_perolehan)
		);

		$this->load->view('laporan/p_qrcode',$data);
	}

	public function printDihapuskan()
	{
		$data = array(
			'title' => 'Laporan Aset Dihapuskan',
			'aset' => $this->ma->getAsetDihapuskan()
		);

		$this->load->view('report/header',$data);
		$this->load->view('laporan/p_penghapusan');
		$this->load->view('report/footer');
	}

	public function printFilterDihapuskan($id_lokasi, $tgl_penghapusan)
	{
		$id_lokasi = $this->uri->segment(2);
		$tgl_penghapusan = $this->uri->segment(3);

		$data = array(
			'title' => 'Laporan Penghapusan Aset',
			'aset' =>  $this->ma->getFilterAsetDihapuskan($id_lokasi, $tgl_penghapusan)
		);

		$this->load->view('report/header',$data);
		$this->load->view('laporan/p_penghapusan');
		$this->load->view('report/footer');
	}

	public function get_list_item()
	{
		$id_aset = $this->input->post('id',TRUE);

		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->where('id_aset', $id_aset);;

		$data = $this->db->get()->result();
        echo json_encode($data);
	}

}

/* End of file Aset.php */
/* Location: ./application/controllers/Aset.php */