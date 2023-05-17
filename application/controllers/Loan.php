<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends CI_Controller {

    public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged")<>1) {
	      redirect(site_url('login'));
	    }

		//load model
		$this->load->model('Master','m');
        $this->load->model('ModelBarang','mb');
        $this->load->model('ModelAset','ma');
	}

    public function index()
    {
        $data = array(
			'title' => 'Peminjaman',
			'active_pinjam' => 'active',  
		);

		if (isset($_POST['filter'])) {
			$date1 = $this->input->post('date1');
			$date2 = $this->input->post('date2');

			$data['item'] = $this->m->getLoanByDate($date1, $date2);

			$data['date1'] = $date1;
			$data['date2'] = $date2;
		} else {
			$data['item'] = $this->m->getAllDataDesc('peminjaman', 'id_loan');
		}
			
		$this->load->view('layouts/header',$data);
		$this->load->view('loan/index');
		$this->load->view('layouts/footer');
    }

    public function create()
	{
		$data = array(
			'title' => 'Peminjaman',
			'active_pinjam' => 'active',
            'aset' => $this->ma->getAsetWujud(),
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('loan/create');
		$this->load->view('layouts/footer');
	}

    public function store()
	{
		$data = array(
            'name_loan' => $this->input->post('name_loan'),   
            'loan_date' => $this->input->post('loan_date'),
            'return_date' => $this->input->post('return_date'),
            'status' => 'Dipinjam',
			'created_at' => date('Y-m-d H:i:s') 
        );

		$this->db->insert('peminjaman', $data);
   		$id_loan = $this->db->insert_id();

		$aset_id = $this->input->post('aset_id');

		$number = count($aset_id);
		if($number > 0){  
			for($i=0; $i<$number; $i++){  
				$items = array(
					'loan_id' => $id_loan, 
					'aset_id' => $aset_id[$i], 
					'amount' => $this->input->post('amount')[$i] 
				);
				$this->m->addData('brg_pinjam', $items);

                //get stok alat
                $brg = $this->ma->getFindAset($aset_id[$i]);
                $stok_awal = $brg['volume'];
                $stok_keluar = $this->input->post('amount')[$i];
                $stok_akhir = $stok_awal-$stok_keluar;

                $data_stok['volume'] = $stok_akhir;
                $this->ma->updateAset($aset_id[$i],$data_stok);
			}  
		}

		$this->db->truncate('cart');

		$this->session->set_flashdata('success', '<strong>Sukses!</strong> Data Peminjaman berhasil disimpan..');
		redirect('loan');
	}

	public function store_bl()
	{
		$id_loan = $this->input->post('id_loan');
		$aset_id = $this->input->post('id_aset');
		$amount = $this->input->post('amount');

		$data = array(
			'loan_id' => $id_loan,
            'aset_id' => $aset_id,
            'amount' => $amount
        );

		$this->m->addData('brg_pinjam',$data);

		//get stok alat
		$brg = $this->ma->getDetailAsetWujud($aset_id);
		$stok_awal = $brg['volume'];
		$stok_keluar = $this->input->post('amount');
		$stok_akhir = $stok_awal-$stok_keluar;

		$data_stok['volume'] = $stok_akhir;
		$this->ma->updateAset($aset_id,$data_stok);

		$this->session->set_flashdata('success', '<strong>Sukses!</strong> Data Barang berhasil disimpan..');
		redirect('loan/edit/'.$id_loan);
	}

	public function show($id_loan)
	{
		$id_loan = $this->uri->segment(3);

		$data = array(
			'title' => 'Peminjaman',
			'active_pinjam' => 'active',  
			'item' => $this->m->findLoan($id_loan),  
			'bk' => $this->m->findBarangLoan($id_loan),  
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('loan/detail');
		$this->load->view('layouts/footer');
	}

	public function edit($id_loan)
	{
		$id_loan = $this->uri->segment(3);

		$data = array(
			'title' => 'Peminjaman',
			'active_pinjam' => 'active',
			'aset' => $this->ma->getAsetWujud(),   
			'item' => $this->m->findLoan($id_loan),  
			'bk' => $this->m->findBarangLoan($id_loan),  
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('loan/update');
		$this->load->view('layouts/footer');
	}

	public function update_data()
	{
		$id_loan = $this->input->post('id_loan');

		$data = array( 
            'name_loan' => $this->input->post('name_loan'), 
            'loan_date' => $this->input->post('loan_date'), 
            'return_date' => $this->input->post('return_date'), 
            'status' => $this->input->post('status') 
        );

		$this->m->update_data('id_loan', $id_loan, 'peminjaman', $data);
		$this->session->set_flashdata('success', '<strong>Sukses!</strong> Data Peminjaman berhasil diubah..');
		redirect('loan/edit/'.$id_loan);
	}

	public function destroy($id_loan)
	{
		$id_loan = $this->uri->segment(3);

		$this->m->destroyData('id_loan',$id_loan, 'peminjaman');

       	$this->session->set_flashdata('success', '<strong>Sukses!</strong> Data Peminjaman berhasil dihapus..');
		redirect('loan');

	}

	public function update_bl()
	{
		$id_bp = $this->input->post('id_bp');
		$id_loan = $this->input->post('id_loan');

		$data = array(
            'amount' => $this->input->post('amount') 
        );

		$this->m->update_data('id_bp', $id_bp, 'brg_pinjam', $data);
		$this->session->set_flashdata('success', '<strong>Sukses!</strong> Data Barang berhasil diubah..');
		redirect('loan/edit/'.$id_loan);
	}

	public function print_data($id_loan)
	{
		$id_loan = $this->uri->segment(2);

		$data = array(
			'title' => 'Peminjaman',
			'active_pinjam' => 'active',  
			'item' => $this->m->findLoan($id_loan),  
			'bk' => $this->m->findBarangLoan($id_loan),  
		);
			
		$this->load->view('report/header',$data);
		$this->load->view('loan/print');
		$this->load->view('report/footer');
	}

	public function destroy_bl($id_bp, $id_loan)
	{
		$id_bp = $this->uri->segment(2);
		$id_loan = $this->uri->segment(3);

		$this->m->destroyData('id_bp',$id_bp, 'brg_pinjam');

       	$this->session->set_flashdata('success', '<strong>Sukses!</strong> Data Barang berhasil dihapus..');
		redirect('loan/edit/'.$id_loan);

	}

}

/* End of file Loan.php */
