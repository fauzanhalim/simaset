<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAset extends CI_Model {

	public function getAsetWujud()
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->where('volume !=', 0);
		$this->db->order_by('kode_aset', 'asc');
		
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getAsetDihapuskan()
	{
		$this->db->select('*');
		$this->db->from('penghapusan a');
		$this->db->join('asets b', 'b.id_aset = a.id_aset');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$this->db->join('lokasi_aset d', 'd.id_lokasi = b.id_lokasi');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function storeAset($data)
	{
		$query = $this->db->insert('asets', $data);
		return $query;
	}

	public function searchAset($bar, $column)
	{
		$this->db->select('*');
		$this->db->limit(10);
		$this->db->from('barang');
		$this->db->like('nama_barang', $bar);
		$this->db->order_by('id_barang', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getDetailAsetWujud($id_aset)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->where('id_aset', $id_aset);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getFindAset($id_aset)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->where('id_aset', $id_aset);
		$query = $this->db->get();
		return $query->row_array(); 
	}

	public function getFilterAsetWujud($id_lokasi,$tahun_perolehan)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');

		if($id_lokasi != 'all'){
			$this->db->where('a.id_lokasi', $id_lokasi);
		}

		if($tahun_perolehan != 'all'){
			$this->db->where('b.tahun_perolehan', $tahun_perolehan);
		}
		
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getExportAsetWujud()
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->where('volume !=', 0);
		$this->db->where('volume >', 0);
		$query = $this->db->get();
		return $query->result(); 
	}

	public function getFilterAsetDihapuskan($id_lokasi,$tgl_penghapusan)
	{
		$this->db->select('*');
		$this->db->from('penghapusan a');
		$this->db->join('asets b', 'b.id_aset = a.id_aset');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$this->db->join('lokasi_aset d', 'd.id_lokasi = b.id_lokasi');

		if($id_lokasi != 'all'){
			$this->db->where('b.id_lokasi', $id_lokasi);
		}

		if($tgl_penghapusan != 'all'){
			$this->db->where('YEAR(`tgl_penghapusan`)', $tgl_penghapusan);
		}

		$query = $this->db->get();
		return $query->result_array();
	}

	public function updateAset($id_aset,$data){
        $this->db->where(array('id_aset' => $id_aset));
        $res = $this->db->update('asets',$data);
        return $res;
    }

    public function deleteBarang($where)
	{
		$this->db->where($where);
		$res = $this->db->delete("asets");
		return $res;
	}

	public function totalAset()
	{
		$this->db->select('SUM(volume) AS jumlah');
		$this->db->from('asets');
		
		$query = $this->db->get();
		return $query->row();
	}

	public function totalAsetWujud()
	{
		$this->db->select('*');
		$this->db->from('asets');
		$this->db->where('volume !=', 0);
		$this->db->where('volume >', 0);
		$query = $this->db->get();
		return $query->num_rows(); 
	}

	public function totalAsetHapuskan()
	{
		$this->db->select('SUM(jumlah) AS jml');
		$this->db->from('penghapusan');
		
		$query = $this->db->get();
		return $query->row(); 
	}

	public function getAllQr()
	{
		$this->db->select('*');
		$this->db->from('asets');
		$this->db->where('qr_code !=', NULL);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getFilterQR($id_lokasi,$tahun_perolehan)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');

		if($id_lokasi != 'all'){
			$this->db->where('a.id_lokasi', $id_lokasi);
		}

		if($tahun_perolehan != 'all'){
			$this->db->where('tahun_perolehan', $tahun_perolehan);
		}

		$this->db->where('qr_code !=', NULL);

		$query = $this->db->get();
		return $query->result_array();
	}

	public function getFilterExportAsetWujud($id_lokasi,$tahun_perolehan)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');

		if($id_lokasi != 'all'){
			$this->db->where('a.id_lokasi', $id_lokasi);
		}

		if($tahun_perolehan != 'all'){
			$this->db->where('b.tahun_perolehan', $tahun_perolehan);
		}
		
		$query = $this->db->get();
		return $query->result();
	}

	public function getFindAsetDihapuskan($id_penghapusan)
	{
		$this->db->select('*');
		$this->db->from('penghapusan');
		$this->db->where('id_penghapusan', $id_penghapusan);

		$query = $this->db->get();
		return $query->row_array(); 
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

}

/* End of file ModelAset.php */
/* Location: ./application/models/ModelAset.php */