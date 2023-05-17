<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelStatistik extends CI_Model {

	public function getKondisiAset()
	{
		$this->db->select('COUNT(kondisi) as kon');
		$this->db->from('asets');
		$this->db->where('volume !=', 0);
		$this->db->where('volume >', 0);
		$this->db->group_by('kondisi');
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
	}

	public function getJenisAset()
	{
		$this->db->select('COUNT(status_aset) as status');
		$this->db->from('asets a');
		$this->db->group_by('status_aset');
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
	}

	public function getNamaKategoriAset()
	{
		$this->db->select('nama_kategori');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('kategori_barang c', 'c.id_kategori = b.id_kategori');
		$this->db->where('status_aset', 'Aktif');
		$this->db->group_by('nama_kategori');
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
	}

	public function getKodeKategoriAset()
	{
		$this->db->select('SUM(volume) AS jumlah');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('kategori_barang c', 'c.id_kategori = b.id_kategori');
		$this->db->where('volume !=', 0);
		$this->db->group_by('kode_kategori');
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
	}
	
	public function getAsetWujud()
	{
		$this->db->select('SUM(volume) AS jml_wujud');
		$this->db->from('asets');
		$query = $this->db->get();
		return $query->row(); 
	}

	public function totalAsetHapuskan()
	{
		$this->db->select('SUM(jumlah) AS jml_hapuskan');
		$this->db->from('penghapusan');
		
		$query = $this->db->get();
		return $query->row(); 
	}

	public function getAsetBaik()
	{
		$this->db->select('SUM(volume) AS jml_baik');
		$this->db->from('asets');
		$this->db->where('kondisi =', 'Baik');
		$query = $this->db->get();
		return $query->row();  
	}

	public function getAsetRenovasi()
	{
		$this->db->select('SUM(volume) AS jml_renovasi');
		$this->db->from('asets');
		$this->db->where('kondisi =', 'Renovasi');
		$query = $this->db->get();
		return $query->row(); 
	}

	public function getAsetRusak()
	{
		$this->db->select('SUM(volume) AS jml_rusak');
		$this->db->from('asets');
		$this->db->where('kondisi =', 'Rusak');
		$query = $this->db->get();
		return $query->row();  
	}

}

/* End of file ModelStatistik.php */
/* Location: ./application/models/ModelStatistik.php */