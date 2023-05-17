<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Model {

	public function getAllData($table){
		$data = $this->db->get($table);
		return $data->result_array();
	}

    public function getAllDataDesc($table, $id){
		$this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($id, 'desc');
        $data = $this->db->get();

		return $data->result_array();
	}

    public function getDetailData($table, $id){
		$this->db->select('*');
        $this->db->from($table);
        $this->db->where('id', $id);
        $data = $this->db->get();
        
		return $data->row_array();
	}

    public function addData($table, $data)
    {
        return $this->db->insert($table, $data);
    }

	public function updateData($id,$table,$data){
        $this->db->where('id', $id);
        $res = $this->db->update($table,$data);
        return $res;
    }

	public function update_data($column, $id,$table,$data){
        $this->db->where($column, $id);
        $res = $this->db->update($table,$data);
        return $res;
    }

    public function deleteData($id, $table)
    {
        $this->db->where('id', $id);
		$res = $this->db->delete($table);
		return $res;
    }

	public function CreateCode($category, $year){
	    $this->db->select('LEFT(asets.kode_aset,5) as kode_aset', FALSE);
	    $this->db->order_by('kode_aset','DESC');    
	    $this->db->limit(1);    
	    $query = $this->db->get('asets');
	        if($query->num_rows() <> 0){      
	             $data = $query->row();
	             $kode = intval($data->kode_aset) + 1; 
	        }
	        else{      
	             $kode = 1;  
	        }
	    $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
	    $kodetampil = $batas."/".$category."/".$year;
	    return $kodetampil;  
	}

	public function getDetailBarang($id_barang)
	{
		$this->db->select('*');
		$this->db->from('barang a');
		$this->db->join('kategori_barang d', 'd.id_kategori = a.id_kategori');
		$this->db->where('id_barang', $id_barang);
		$query = $this->db->get();
		return $query->row_array(); 
	}

	public function getPengembalian()
	{
		$this->db->select('a.*, b.kode_pinjam, b.tgl_pinjam');
		$this->db->from('pengembalian a');
		$this->db->join('peminjaman b', 'b.id = a.pinjam_id');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getFilterPengembalian($date1, $date2)
	{
		$this->db->select('a.*, b.kode_pinjam, b.tgl_pinjam');
		$this->db->from('pengembalian a');
		$this->db->join('peminjaman b', 'b.id = a.pinjam_id');
		$this->db->where('b.tgl_pinjam >=', $date1);
		$this->db->where('b.tgl_pinjam <=', $date2);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getDetailPengembalian($id)
	{
		$this->db->select('a.*, b.kode_pinjam, b.tgl_pinjam');
		$this->db->from('pengembalian a');
		$this->db->join('peminjaman b', 'b.id = a.pinjam_id');
		$this->db->where('a.id', $id);
		$query = $this->db->get();
		return $query->row_array(); 
	}

	//Peminjaman
	public function getLoanByDate($date1, $date2){
		$this->db->select('*');
        $this->db->from('peminjaman');
		$this->db->where('CAST(created_at AS DATE) >=',$date1);
        $this->db->where('CAST(created_at AS DATE) <=',$date2);

        $data = $this->db->get();

		return $data->result_array();
	}

	public function findLoan($id_loan)
	{
		$this->db->select('*');
		$this->db->from('peminjaman');
		$this->db->where('id_loan', $id_loan);
		
		$query = $this->db->get();
		return $query->row_array(); 
	}

	public function findBarangLoan($id_loan)
	{
		$this->db->select('*');
		$this->db->from('brg_pinjam a');
		$this->db->join('asets b', 'b.id_aset = a.aset_id');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$this->db->where('a.loan_id', $id_loan);
		
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function destroyData($column, $id, $table)
    {
        $this->db->where($column, $id);
		$res = $this->db->delete($table);
		return $res;
    }

	public function addCart()
	{
		$data = array(
			'aset_id' => $this->input->post('aset_id'), 
			'amount' => $this->input->post('amount')
		);
		$result = $this->db->insert('cart',$data);
		return $result;
	}

	function updateCart(){
        $id = $this->input->post('id');

        $amount = $this->input->post('amount');
 
        $this->db->set('amount', $amount);
        
		$this->db->where('id_cart', $id);
        $result = $this->db->update('cart');
        return $result;
    }

	public function deleteCart()
	{
		$id = $this->input->post('id');
        $this->db->where('id_cart', $id);
        $result = $this->db->delete('cart');
        return $result;
	}

}

/* End of file Master.php */
/* Location: ./application/models/Master.php */