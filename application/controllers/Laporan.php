<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if ($this->session->userdata("logged")<>1) {
	      redirect(site_url('login'));
	    }

		//load model
		$this->load->model('ModelLaporan','ml');
		$this->load->model('ModelAset','ma');
		$this->load->model('ModelPengadaan','mp');
	    $this->load->model('ModelMonitoring','mm');
		$this->load->model('ModelPenyusutan','mpy');
		$this->load->model('Master','m');
	}

	public function aset()
	{
		$data = array(
			'title' => 'Laporan Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_ast' => 'active',
			'lokasi' => $this->ml->getLokasi()  
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('laporan/v_laporan',$data);
		$this->load->view('layouts/footer');
	}

	public function searchAset()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$tahun_perolehan = $this->input->post('tahun_perolehan');

		$data = array(
			'title' => 'Laporan Data Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_ast' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'lok' => $this->ml->getLokasiId($id_lokasi),
			'aset' => $this->ml->getAsetWujud($id_lokasi,$tahun_perolehan) 
		);

		if (count($data['aset'])>0) {
			$this->load->view('layouts/header',$data);
			$this->load->view('laporan/r_aset',$data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
		    redirect('laporan/aset');
		}
	}

	public function printAset($id_lokasi,$tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(3);
		$tahun_perolehan = $this->uri->segment(4);

		$data['aset'] = $this->ml->getAsetWujud($id_lokasi,$tahun_perolehan);
		$data['lokasi'] = $this->ml->getLokasiId($id_lokasi);

		if (count($data['aset'])>0) {
			$this->load->view('laporan/p_aset',$data);
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
		    redirect('laporan/aset');
		}
	}

	public function export_all_aset()
	{
		$aset = $this->ma->getExportAsetWujud();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'NO')
					->setCellValue('B1', 'NAMA')
					->setCellValue('C1', 'LOKASI')
					->setCellValue('D1', 'JUMLAH')
					->setCellValue('E1', 'HARGA (Rp.)')
					->setCellValue('F1', 'TOTAL HARGA (Rp.)');

		$kolom = 2;
		$nomor = 1;
		foreach($aset as $item) {

			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $kolom, $nomor)
			->setCellValue('B' . $kolom, $item->nama_barang)
			->setCellValue('C' . $kolom, $item->nama_lokasi)
			->setCellValue('D' . $kolom, $item->volume)
			->setCellValue('E' . $kolom, $item->harga)
			->setCellValue('F' . $kolom, $item->volume*$item->harga);

			$kolom++;
			$nomor++;

		}

		foreach (range('A','F') as $col) {
			$spreadsheet->setActiveSheetIndex(0)->getColumnDimension($col)->setAutoSize(true);
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Data Aset.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_filter_aset($id_lokasi, $tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(2);
		$tahun_perolehan = $this->uri->segment(3);

		$aset = $this->ma->getFilterExportAsetWujud($id_lokasi,$tahun_perolehan);

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'NO')
					->setCellValue('B1', 'NAMA')
					->setCellValue('C1', 'LOKASI')
					->setCellValue('D1', 'JUMLAH')
					->setCellValue('E1', 'HARGA (Rp.)')
					->setCellValue('F1', 'TOTAL HARGA (Rp.)');

		$kolom = 2;
		$nomor = 1;
		foreach($aset as $item) {

			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $kolom, $nomor)
			->setCellValue('B' . $kolom, $item->nama_barang)
			->setCellValue('C' . $kolom, $item->nama_lokasi)
			->setCellValue('D' . $kolom, $item->volume)
			->setCellValue('E' . $kolom, $item->harga)
			->setCellValue('F' . $kolom, $item->volume*$item->harga);

			$kolom++;
			$nomor++;

		}

		foreach (range('A','F') as $col) {
			$spreadsheet->setActiveSheetIndex(0)->getColumnDimension($col)->setAutoSize(true);
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Data Aset.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function penghapusan()
	{
		$data = array(
			'title' => 'Laporan Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_php' => 'active',
			'lokasi' => $this->ml->getLokasi()  
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('laporan/v_laporan_ph',$data);
		$this->load->view('layouts/footer');
	}

	public function searchPenghapusan()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$tahun_perolehan = $this->input->post('tahun_perolehan');

		$data = array(
			'title' => 'Laporan Data Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_php' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'lok' => $this->ml->getLokasiId($id_lokasi),
			'aset' => $this->ml->getAsetDihapuskan($id_lokasi,$tahun_perolehan) 
		);

		if (count($data['aset'])>0) {
			$this->load->view('layouts/header',$data);
			$this->load->view('laporan/r_penghapusan',$data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
		    redirect('laporan/aset');
		}
	}

	public function printPenghapusan($id_lokasi,$tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(3);
		$tahun_perolehan = $this->uri->segment(4);

		$data['aset'] = $this->ml->getAsetDihapuskan($id_lokasi,$tahun_perolehan);
		$data['lokasi'] = $this->ml->getLokasiId($id_lokasi);

		if (count($data['aset'])>0) {
			$this->load->view('laporan/p_penghapusan',$data);
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
		    redirect('laporan/aset');
		}
	}

	public function export_penghapusan($id_lokasi,$tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(3);
		$tahun_perolehan = $this->uri->segment(4);

		$aset = $this->ml->getAsetDihapuskanExcel($id_lokasi,$tahun_perolehan);

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'NO')
					->setCellValue('B1', 'NAMA')
					->setCellValue('C1', 'VOLUME')
					->setCellValue('D1', 'SATUAN')
					->setCellValue('E1', 'HARGA (Rp.)')
					->setCellValue('F1', 'JUMLAH (Rp.)');

		$kolom = 2;
		$nomor = 1;
		foreach($aset as $item) {

			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $kolom, $nomor)
			->setCellValue('B' . $kolom, $item->nama_barang)
			->setCellValue('C' . $kolom, $item->volume)
			->setCellValue('D' . $kolom, $item->satuan)
			->setCellValue('E' . $kolom, $item->harga)
			->setCellValue('F' . $kolom, $item->total_harga);

			$kolom++;
			$nomor++;

		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data Aset Dihapuskan.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function qrcodeAset()
	{
		$data = array(
			'title' => 'Laporan Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_qr' => 'active',
			'lokasi' => $this->ml->getLokasi()  
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('laporan/v_qrcode',$data);
		$this->load->view('layouts/footer');
	}

	public function printQrcode()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$tahun_perolehan = $this->input->post('tahun_perolehan');

		$data['aset'] = $this->ml->getAsetQr($id_lokasi,$tahun_perolehan);
		$data['lokasi'] = $this->ml->getLokasiId($id_lokasi);

		if (count($data['aset'])>0) {
			$this->load->view('laporan/p_qrcode',$data);
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
		    redirect('laporan/aset');
		}
	}

	public function pengadaan()
	{
		$data = array(
			'title' => 'Laporan Aset',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_lpnd' => 'active',
			'lokasi' => $this->ml->getLokasi()  
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('laporan/v_pengadaan',$data);
		$this->load->view('layouts/footer');
	}

	public function searchPengadaan()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$tahun_pengadaan = $this->input->post('tahun_pengadaan');

		$data = array(
			'title' => 'Laporan Pengadaan',
			'active_menu_lp' => 'menu-open',
			'active_menu_lpr' => 'active',
			'active_menu_lpnd' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'lok' => $this->ml->getLokasiId($id_lokasi),
			'pnd' => $this->ml->getPengadaan($id_lokasi,$tahun_pengadaan) 
		);

		if (count($data['pnd'])>0) {
			$this->load->view('layouts/header',$data);
			$this->load->view('laporan/r_pengadaan',$data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
		    redirect('laporan/pengadaan');
		}
	}

	public function printPengadaan($id_lokasi,$tahun_pengadaan)
	{
		$id_lokasi = $this->uri->segment(3);
		$tahun_pengadaan = $this->uri->segment(4);

		$data['pnd'] = $this->ml->getPengadaan($id_lokasi,$tahun_pengadaan);
		$data['lokasi'] = $this->ml->getLokasiId($id_lokasi);

		$this->load->view('laporan/p_pengadaan',$data);
	}

	public function export_pengadaan()
	{
		$aset = $this->mp->getSetujuiPengadaan();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'NO')
					->setCellValue('B1', 'PENEMPATAN')
					->setCellValue('C1', 'NAMA ASET')
					->setCellValue('D1', 'TANGGAL')
					->setCellValue('E1', 'JUMLAH')
					->setCellValue('F1', 'HARGA (Rp.)')
					->setCellValue('G1', 'TOTAL (Rp.)');

		$kolom = 2;
		$nomor = 1;
		foreach($aset as $item) {

			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $kolom, $nomor)
			->setCellValue('B' . $kolom, $item['nama_lokasi'])
			->setCellValue('C' . $kolom, $item['nama_aset'])
			->setCellValue('D' . $kolom, date('d-m-Y', strtotime($item['created_at'])))
			->setCellValue('E' . $kolom, $item['volume'])
			->setCellValue('F' . $kolom, $item['harga_satuan'])
			->setCellValue('G' . $kolom, ($item['volume']*$item['harga_satuan']));

			$kolom++;
			$nomor++;

		}

		foreach (range('A','G') as $col) {
			$spreadsheet->setActiveSheetIndex(0)->getColumnDimension($col)->setAutoSize(true);
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Pengadaan Aset '.date('d-m-Y').'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_loan($id_tk)
	{
		$id_tk = $this->uri->segment(2);

		$item = $this->m->findLoan($id_tk);
		$brg = $this->m->findBarangLoan($id_tk);

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'LAPORAN PEMINJAMAN BARANG')->mergeCells("A1:E1")
					->setCellValue('A3', 'Nama Peminjam : '.$item['name_loan'])->mergeCells("A3:E3")
					->setCellValue('A4', 'Tanggal Peminjaman : '.$item['loan_date'])->mergeCells("A4:E4")
					->setCellValue('A5', 'Tanggal Pengeluaran : '.$item['return_date'])->mergeCells("A5:E5")
					->setCellValue('A7', 'NO')
					->setCellValue('B7', 'KODE ASET')
					->setCellValue('C7', 'NAMA ASET')
					->setCellValue('D7', 'JUMLAH');

		$kolom = 8;
		$nomor = 1;
		foreach($brg as $row) {

			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $kolom, $nomor)
			->setCellValue('B' . $kolom, $row['kode_aset'])
			->setCellValue('C' . $kolom, $row['nama_barang'])
			->setCellValue('D' . $kolom, $row['amount']);

			$kolom++;
			$nomor++;

		}

		foreach (range('A','D') as $col) {
			$spreadsheet->setActiveSheetIndex(0)->getColumnDimension($col)->setAutoSize(true);
		}

		//text middle style
		$styleArray = [
			'font' => [
				'bold' => true,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
		];
		$styleCenter = [
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
			],
		];
		$spreadsheet->setActiveSheetIndex(0)->getStyle('A7:D7')->applyFromArray($styleArray);
		$spreadsheet->setActiveSheetIndex(0)->getStyle('A1:D1')->applyFromArray($styleArray);
		$spreadsheet->setActiveSheetIndex(0)->getStyle('A2:D2')->applyFromArray($styleCenter);
		$spreadsheet->setActiveSheetIndex(0)->getStyle('A8:D8')->applyFromArray($styleCenter);

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Peminjaman '.date("d-m-Y").'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_all_monitoring()
	{
		$aset = $this->mm->getMonitoring();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'NO')
					->setCellValue('B1', 'KODE ASET')
					->setCellValue('C1', 'NAMA ASET')
					->setCellValue('D1', 'LOKASI')
					->setCellValue('E1', 'JUMLAH RUSAK')
					->setCellValue('F1', 'KERUSAKAN')
					->setCellValue('G1', 'AKIBAT YANG TERJADI')
					->setCellValue('H1', 'FAKTOR YANG MEMPENGARUHI')
					->setCellValue('I1', 'MONITORING')
					->setCellValue('J1', 'PEMELIHARAAN YANG HARUS DILAKUKAN');

		$kolom = 2;
		$nomor = 1;
		foreach($aset as $item) {

			$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('A' . $kolom, $nomor)
						->setCellValue('B' . $kolom, $item['kode_aset'])
						->setCellValue('C' . $kolom, $item['nama_barang'])
						->setCellValue('D' . $kolom, $item['nama_lokasi'])
						->setCellValue('E' . $kolom, $item['jml_rusak'])
						->setCellValue('F' . $kolom, stripHTMLtags($item['kerusakan']))
						->setCellValue('G' . $kolom, stripHTMLtags($item['akibat']))
						->setCellValue('H' . $kolom, stripHTMLtags($item['faktor']))
						->setCellValue('I' . $kolom, stripHTMLtags($item['monitoring']))
						->setCellValue('J' . $kolom, stripHTMLtags($item['pemeliharaan']));

			$kolom++;
			$nomor++;

		}

		foreach (range('A','J') as $col) {
			$spreadsheet->setActiveSheetIndex(0)->getColumnDimension($col)->setAutoSize(true);
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Monitoring Aset '.date('d-m-Y').'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_filter_monitoring($id_lokasi, $tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(2);
		$tahun_perolehan = $this->uri->segment(3);

		$aset = $this->mm->getFilterMonitoring($id_lokasi,$tahun_perolehan);

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'NO')
					->setCellValue('B1', 'KODE ASET')
					->setCellValue('C1', 'NAMA ASET')
					->setCellValue('D1', 'LOKASI')
					->setCellValue('E1', 'JUMLAH RUSAK')
					->setCellValue('F1', 'KERUSAKAN')
					->setCellValue('G1', 'AKIBAT YANG TERJADI')
					->setCellValue('H1', 'FAKTOR YANG MEMPENGARUHI')
					->setCellValue('I1', 'MONITORING')
					->setCellValue('J1', 'PEMELIHARAAN YANG HARUS DILAKUKAN');

		$kolom = 2;
		$nomor = 1;
		foreach($aset as $item) {

			$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('A' . $kolom, $nomor)
						->setCellValue('B' . $kolom, $item['kode_aset'])
						->setCellValue('C' . $kolom, $item['nama_barang'])
						->setCellValue('D' . $kolom, $item['nama_lokasi'])
						->setCellValue('E' . $kolom, $item['jml_rusak'])
						->setCellValue('F' . $kolom, stripHTMLtags($item['kerusakan']))
						->setCellValue('G' . $kolom, stripHTMLtags($item['akibat']))
						->setCellValue('H' . $kolom, stripHTMLtags($item['faktor']))
						->setCellValue('I' . $kolom, stripHTMLtags($item['monitoring']))
						->setCellValue('J' . $kolom, stripHTMLtags($item['pemeliharaan']));

			$kolom++;
			$nomor++;

		}

		foreach (range('A','J') as $col) {
			$spreadsheet->setActiveSheetIndex(0)->getColumnDimension($col)->setAutoSize(true);
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Monitoring Aset '.date('d-m-Y').'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_penyusutan()
	{
		$aset = $this->mpy->getAsetWujud();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'NO')
					->setCellValue('B1', 'KODE ASET')
					->setCellValue('C1', 'NAMA ASET')
					->setCellValue('D1', 'LOKASI')
					->setCellValue('E1', 'PEROLEHAN')
					->setCellValue('F1', 'MASA MANFAAT')
					->setCellValue('G1', 'UMUR EKONOMIS')
					->setCellValue('H1', 'JUMLAH')
					->setCellValue('I1', 'HARGA')
					->setCellValue('J1', 'PENYUSUTAN')
					->setCellValue('K1', 'NILAI AKHIR');

		$kolom = 2;
		$nomor = 1;
		foreach($aset as $row) {

			//Rumus
			$tahun_skrg_x = date("Y");
			$rentang_x = ($tahun_skrg_x-$row['tahun_perolehan'])+1;
			if($rentang_x > $row['umur_ekonomis']){
				$rentang_x = $row['umur_ekonomis'];
			}

			//Rumus
			$tarif_penyusutan= (100/100)/$row['umur_ekonomis'];
			$nilai_sisa = $tarif_penyusutan*$row['harga'];
			$penyusutan = ($row['harga']-$nilai_sisa)/$row['umur_ekonomis'];
			$akumulasi_penyusutan = $penyusutan* $rentang_x; 
			$nilai_aset = $row['harga']-$akumulasi_penyusutan;

			$usia = date('Y')- ($row['tahun_perolehan']-1);
                            

			$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('A' . $kolom, $nomor)
						->setCellValue('B' . $kolom, $row['kode_aset'])
						->setCellValue('C' . $kolom, $row['nama_barang'])
						->setCellValue('D' . $kolom, $row['nama_lokasi'])
						->setCellValue('E' . $kolom, $row['tahun_perolehan'])
						->setCellValue('F' . $kolom, $row['umur_ekonomis']." Tahun")
						->setCellValue('G' . $kolom, $usia." Tahun")
						->setCellValue('H' . $kolom, $row['volume'])
						->setCellValue('I' . $kolom, $row['harga'])
						->setCellValue('J' . $kolom, $akumulasi_penyusutan)
						->setCellValue('K' . $kolom, $nilai_aset);

			$kolom++;
			$nomor++;

		}

		foreach (range('A','K') as $col) {
			$spreadsheet->setActiveSheetIndex(0)->getColumnDimension($col)->setAutoSize(true);
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Penyusutan Aset '.date('d-m-Y').'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_filter_penyusutan($id_lokasi, $tahun_perolehan)
	{
		$id_lokasi = $this->uri->segment(2);
		$tahun_perolehan = $this->uri->segment(3);

		$aset = $this->mpy->getFilterAsetWujud($id_lokasi,$tahun_perolehan);

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
					->setCellValue('A1', 'NO')
					->setCellValue('B1', 'KODE ASET')
					->setCellValue('C1', 'NAMA ASET')
					->setCellValue('D1', 'LOKASI')
					->setCellValue('E1', 'PEROLEHAN')
					->setCellValue('F1', 'MASA MANFAAT')
					->setCellValue('G1', 'UMUR EKONOMIS')
					->setCellValue('H1', 'JUMLAH')
					->setCellValue('I1', 'HARGA')
					->setCellValue('J1', 'PENYUSUTAN')
					->setCellValue('K1', 'NILAI AKHIR');

		$kolom = 2;
		$nomor = 1;
		foreach($aset as $row) {

			//Rumus
			$tahun_skrg_x = date("Y");
			$rentang_x = ($tahun_skrg_x-$row['tahun_perolehan'])+1;
			if($rentang_x > $row['umur_ekonomis']){
				$rentang_x = $row['umur_ekonomis'];
			}

			//Rumus
			$tarif_penyusutan= (100/100)/$row['umur_ekonomis'];
			$nilai_sisa = $tarif_penyusutan*$row['harga'];
			$penyusutan = ($row['harga']-$nilai_sisa)/$row['umur_ekonomis'];
			$akumulasi_penyusutan = $penyusutan* $rentang_x; 
			$nilai_aset = $row['harga']-$akumulasi_penyusutan;

			$usia = date('Y')- ($row['tahun_perolehan']-1);
                            

			$spreadsheet->setActiveSheetIndex(0)
						->setCellValue('A' . $kolom, $nomor)
						->setCellValue('B' . $kolom, $row['kode_aset'])
						->setCellValue('C' . $kolom, $row['nama_barang'])
						->setCellValue('D' . $kolom, $row['nama_lokasi'])
						->setCellValue('E' . $kolom, $row['tahun_perolehan'])
						->setCellValue('F' . $kolom, $row['umur_ekonomis']." Tahun")
						->setCellValue('G' . $kolom, $usia." Tahun")
						->setCellValue('H' . $kolom, $row['volume'])
						->setCellValue('I' . $kolom, $row['harga'])
						->setCellValue('J' . $kolom, $akumulasi_penyusutan)
						->setCellValue('K' . $kolom, $nilai_aset);

			$kolom++;
			$nomor++;

		}

		foreach (range('A','K') as $col) {
			$spreadsheet->setActiveSheetIndex(0)->getColumnDimension($col)->setAutoSize(true);
		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Penyusutan Aset '.date('d-m-Y').'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function print_selected_qr()
	{
		$id_aset = $this->input->post('id_aset');

		if ($id_aset != NULL) {
			$data = array(
				'title' => 'Print QR Code', 
				'aset' => $this->ml->getSelectedQR($id_aset) 
			); 
			$this->load->view('aset/print-qr',$data);
		} else {
			$data = array(
				'title' => 'Print QR Code'
			); 
			echo "QR Code Not Found";
		}
	}

	public function getSelectedQR($id_aset)
	{
		$this->db->select('qr_code,kode_aset');
		$this->db->from('asets');
		$this->db->where_in('id_aset', $id_aset);
		$this->db->where('qr_code !=', NULL);
		$query = $this->db->get();
		return $query->result_array();
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */