<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PublicCTRL extends Users {
	
	function beranda() {
		$data	= $this->public_data;
		$data['title']='Beranda';
		$output = '';
		$data['content']='Beranda/beranda.php';
		$where = array(
			'is_active' => 1,
		);

		$data['allData'] = $this->db->query('select * from product__ where is_active = 1 order by product_id DESC limit 4 ');

		// $allData = $this->M__db->fetch_data($this->input->post('limit'), $this->input->post('start'));
		// if($allData->num_rows() > 0)
		// {
		// 	foreach($allData->result() as $row)
		// 	{
		// 		$output .= '
		// 		 <a href="'base_url().'detailProduct/'.paramEncrypt($row->product_id).'" >
		//                <li class="isotope-item best products__item">
		//                 '.$rows_images = explode(",",$row->images_product) 
		//                   $kategori = $this->db->where('category_id', $row->category_id)->get('category__')->row_array();
		//             .'
		              
		//                 <img src="'.base_url().'assets/uploads/product/'.$rows_images[0].'" height="100%" width="100%" alt="'.$row->product_name.'">
		               
		//                 <h4 class="products__name">'.$row->product_name.'</h4>
		            
		//                 <div class="products__inner clearfix">
		//                   <span class="products__price-new">'.currency($row->price).'</span></span>
		//               </div>
		            
		//               </li>
		//             </a>
		// 		';
		// 	}
		// }

		// $data['output'] = $output;

		$this->load->view('Styler/Template', $data);
	}

	function fetch()
	{
		$output = '';
		$allData = $this->M__db->fetch_data($this->input->post('limit'), $this->input->post('start'));
		if($allData->num_rows() > 0)
		{
			foreach($allData->result() as $row)
			{
					$output .= ' 
				<div class="post_data">
				<a href="'.base_url().'detailProduct/'.paramEncrypt($row->product_id).'" >
		               <li class="isotope-item best products__item">';

		            $rows_images = explode(",",$row->images_product) ;
		             $kategori = $this->db->where('category_id', $row->category_id)->get('category__')->row_array();
		            
		              
		         $output .= '<img src="'.base_url().'assets/uploads/product/'.$rows_images[0].'" height="100%" width="100%" alt="'.$row->product_name.'">
		               
		                <h4 class="products__name">'.$row->product_name.'</h4>
		            
		                <div class="products__inner clearfix">
		                  <span class="products__price-new">'.currency($row->price).'</span></span>
		              </div>
		            
		              </li>
		            </a>
		           </div>
				';
			}
		}
		echo $output;
	}


	

	function faq() {
		$data	= $this->public_data;
		$data['title']='Beranda';
		$data['content']='Beranda/faq.php';
		$this->load->view('Styler/Template', $data);
	}

	function pembayaran() {
		$data	= $this->public_data;
		$data['title']='Pembayaran';
		$data['content']='Beranda/pembayaran.php';
		$this->load->view('Styler/Template', $data);
	}

 	function saveDataBuktidaftar(){
		
		// echo '</pre>'; var_dump($this->input->post('images'));
		// exit();

		$this->db->trans_begin();
		$action = $this->input->post('action');
		$session_user = $this->session->userdata('session_user');	
	
		// if($this->form_validation->run()==FALSE){
		// 	$this->session->set_flashdata('error',validation_errors());
		// }else{
			
				
			$fileName = str_replace(' ', '_', str_replace('\'', '', $_FILES['images']['name']));
			if($fileName[0]!=null){ // ada file
				$this->load->library('upload');
				if(($action=='update') and ($this->input->post('images_old')!=null)){
					$convertData = explode(",",$this->input->post('images_old'));
				}else{
					$convertData = array();
				}
				$dateNow = date('YmdHis');
				for ($i=0; $i < count($fileName); $i++) { 
					$config = array(
						'upload_path'   => "./assets/uploads/buktitf",
						'allowed_types' => 'jpg|gif|png',
						'max_size'     => '1000000',                       
						'file_name'     => $dateNow.'_'.$fileName[$i],                       
					);
					$_FILES['file']['name']     = $_FILES['images']['name'][$i];
					$_FILES['file']['type']     = $_FILES['images']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
					$_FILES['file']['error']     = $_FILES['images']['error'][$i];
					$_FILES['file']['size']     = $_FILES['images']['size'][$i];
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('file')){
						$fileData = $this->upload->data();
						array_push($convertData, $dateNow.'_'.$fileName[$i]);
					}
				}
				if($action=='update'){
					if($fileName[0]!=null){
						$data = array(
							'images_bukti' => implode(",",$convertData),
						);
					}
					
				}else{
					$data = array(
						'images_bukti' => implode(",",$convertData),
						'created_date' => date('Y-m-d H:i:s'),
						'nama_user' => $this->input->post('nama_user'),
						
					);
					
					$this->M__db->simpan('buktitfdaftar',$data);
					$idp =  $this->db->insert_id();

					

				}
						
			}else{ // tidak ada file

				$this->db->trans_rollback();
				$this->session->set_flashdata('error','Gambar Bukti transfer harus di isi');	
				$this->session->set_flashdata('error','Nama user harus di isi');	
			}

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error','Gambar Bukti transfer gagal disimpan');	
			}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Gambar  Bukti transfer berhasil disimpan!');	
			}
		// }

		if($action=='update'){
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Gambar  Bukti transfer berhasil disimpan!');
			redirect(base_url().'pembayaran');
		}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Gambar  Bukti transfer berhasil disimpan! Silahkan menunggu aktivasi member oleh admin distrik store dan akan di konfirmasi via email atau chat. Terimakasih');
			redirect(base_url().'pembayaran');
		}
	}


	function category() {
		$data	= $this->public_data;
		$data['title']='Beranda';
		$data['content']='Beranda/berandamember.php';

		$where = array(
			'category_id' => paramDecrypt($this->input->get('v')),
			'is_active' => 1,
		);
		$data['allData'] = $this->M__db->get_cek_order('product__','*',$where,'product_id','DESC');
		$this->load->view('Styler/Template', $data);
	}

	function categorysearch() { 
		$data	= $this->public_data;
		$data['title']='Beranda';
		$data['content']='Beranda/berandamember.php';

		$cond = [];
 		// $cond["a.kode_mr LIKE '%{$this->input->post('kode_mr')}%'"] = NULL;
		$cond["product_name LIKE '%{$this->input->post('code')}%'"]= NULL;
			
		
		$data['allData'] = $this->M__db->get_cek_order('product__','*',$cond,'product_id','DESC');
		$this->load->view('Styler/Template', $data);
	}

	function detailProduct() {
		$data	= $this->public_data;
		$data['title']='Detail Produk';
		$data['content']='Beranda/detailProduct.php';

		$where = array(
			'product_id' => paramDecrypt($this->uri->segment(2)),
		);
		$data['row'] = $this->M__db->cek('product__','*',$where)->row_array();
		$this->load->view('Styler/Template', $data);
	}

	function sisastock() {
		$data	= $this->public_data;
		$data['title']='Detail Produk';
		$data['content']='Beranda/detailProduct.php';
		
		$where = array(
			'product_id' => paramDecrypt($this->uri->segment(2)),
		);
		$data['row'] = $this->M__db->cek('product__','*',$where)->row_array();
		$this->load->view('Styler/Template', $data);
	}

	function transactioncheck(){
		redirect(base_url().'transactionCode?v='.paramEncrypt($this->input->post('code')));
	}
	function transactionview() { 
		$data	= $this->public_data;
		$data['title']='Transaksi';
		$where = array(
			'transaction_code' => $this->input->get('v'),
			);
		$data['trans'] = $this->M__db->cek('transaction__','*',$where)->row_array();
		$data['content']='Member/viewTransaction.php';
		$this->load->view('Styler/Template', $data);
	}

	public function tocart() {
		// $this->cart->destroy();
		$jumlah = $this->input->post('jumlah');
		$size_id = $this->input->post('size_idd');
		 $id_stock = $this->input->post('id_stock');
		$where = array(
			'id_size' => $size_id ,
			);
		$nama_size = $this->db->where('id_size',$size_id)->get('msize__')->row_array();
		$product_id = paramDecrypt($this->uri->segment(2));
		$row = $this->db->where('product_id',$product_id)->get('product__')->row_array();
		$row_images = explode(",",$row['images_product']); 
		$data = array(
				'id'      => date('YmdHis'),
				'product_id' => $row['product_id'],
				'qty'     => $jumlah,
				'price'   => $row['price'],
				'weight'  => $row['weight'],
				'name'    => substr($row['product_name'],0,16),
				'picture'    => $row_images[0],
				'nama_size' => $nama_size['nama_size'],
				'size_id' => $size_id,
				'id_stock' => $id_stock
		);
		$this->cart->insert($data);
		$this->session->set_flashdata('success','Barang berhasil masuk keranjang!');
		redirect(base_url().'detailProduct/'.$this->uri->segment(2));
	}

	public function downloadall(){
			$product_id = paramDecrypt($this->uri->segment(2));
		
		    $this->load->helper('download');
		    $this->load->library('zip');


		    $row = $this->db->where('product_id',$product_id)->get('product__')->row_array();
			$row_images = explode(",",$row['images_product']); 
		
		    foreach ($row_images as $key) {
		    	$filepath1     =  FCPATH.'assets/uploads/product/'.$key;

		
          		$this->zip->read_file($filepath1);

		    }

 			$filename = $row['product_name'].'.zip' ;
		    $this->zip->download($filename);

		   
	}
	public function deletecart() {
		$this->cart->destroy();
		$this->session->set_flashdata('success','Keranjang berhasil dikosongkan!');
		redirect(base_url().'/Beranda');
	}

	public function removecart() {
		$id = $this->uri->segment(2);
		$data = array(
	        'rowid'      => $id,
	        'id'      => 0,
	        'product_id' => 0,
	        'qty'     => 0,
	        'price'   => 0,
	        'weight'   => 0,
	        'name'    => 0,
	        'picture' => 0,
	    );
		$this->cart->update($data);
		$this->session->set_flashdata('success','Barang berhasil dihapus dari keranjang!');
		redirect(base_url().'/Beranda');
	}

	public function getStock(){		
		$id_size =$this->input->post('id_size');
		$product_id =$this->input->post('product_id');

		$dtstock = $this->db->query("select * from datastock__ where id_size = ".$id_size." and product_id = ".$product_id." and status_stock = 1 ")->num_rows();

		$dttransaksi = $this->db->query("select  sum(amount) as hasil from detail_transaction__ left JOIN transaction__ ON transaction__.transaction_id = detail_transaction__.transaction_id where id_size = ".$id_size." and product_id = ".$product_id." and transaction__.status = 2  ")->row()->hasil;
		if (!empty($dttransaksi)) {
			$totaltransaksi = $dttransaksi;
		}else{
			$totaltransaksi = 0;
		}

		$totalstock  = $dtstock - $totaltransaksi;
		 // var_dump($totalstock);
		 // exit();

		 echo $totalstock;
	}

}