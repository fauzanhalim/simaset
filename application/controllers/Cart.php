<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//load model
		$this->load->model('Master','m');
	}

	public function index()
	{
		$this->db->select('*');
		$this->db->from('cart a');
		$this->db->join('asets b', 'b.id_aset = a.aset_id');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
        
		$data = $this->db->get()->result();
        echo json_encode($data);
	}

	public function store()
	{
		$data = $this->m->addCart();
		echo json_encode($data);
	}

	public function update_data()
	{
		$data = $this->m->updateCart();
        echo json_encode($data);
	}

	public function destroy()
	{
		$data = $this->m->deleteCart();
        echo json_encode($data);
	}

	public function reset_data()
    {
        $data = $this->db->truncate('cart');
        echo json_encode($data);
    }



	

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */