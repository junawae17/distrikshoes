<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountCTRL extends Members {

	function dataAkun() {
		$data	= $this->public_data;
		$data['title']='Akun';
		$data['content']='Akun/dataAkun.php';
		$where = array(
			'member_id' => $this->session->userdata('session_user'),
			);
		$data['akun'] = $this->M__db->cek('members__','*',$where)->row_array();
		$data['address'] = $this->M__db->cek('addressmembers__','*',$where)->row_array();
		$this->load->view('Styler/Template', $data);
	}

	function viewCheckout() {
		$data	= $this->public_data;
		$data['title']='Checkout';
		$where = array(
			'member_id' => $this->session->userdata('session_user'),
			);
		$data['akun'] = $this->M__db->cek('members__','*',$where)->row_array();

		// var_dump($this->cart->contents());
		// exit();
		
		foreach ($this->cart->contents() as $items){
		 	$databarang = $this->db->query("select datastock__.*, product__.*, msize__.nama_size FROM `datastock__` LEFT JOIN product__ on product__.product_id = datastock__.product_id
		 		left join msize__ on msize__.id_size = datastock__.id_size
		 	 where datastock__.product_id = ".$items['product_id']." and datastock__.id_size = ".$items['size_id']." and datastock__.status_stock = 1 limit ".$items['qty']." "); 
		} 

		// var_dump($databarang);
		// exit();

		// $data['databr'] = $databarang->result();
 

		$data['content']='Member/viewCheckout.php';
		$this->load->view('Styler/Template', $data);
	}

	function saveDataMember() {
		$this->db->trans_begin();
		$session_user=$this->session->userdata('session_user');
		$this->load->library('upload');
		$fileName = str_replace(' ', '_', str_replace('\'', '', $_FILES['photo']['name']));
		$ReplaceFileName = date('YmdHis').'_'.$fileName;
		if($fileName!=null){
			$config['upload_path'] = "./assets/uploads/users";
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '1000000';
			$config['file_name'] =$ReplaceFileName; 
			$this->upload->initialize($config);
			if (!$this->upload->do_upload("photo")){
				$this->session->set_flashdata('error','Ada Kesalahan Dalam Upload Gambar!');
				redirect(base_url().'Account');
			}else{
				$file_name = $ReplaceFileName;
				@unlink("./assets/uploads/users/".$this->input->post('photo_old'));
			}
		}else{
			$file_name = $this->input->post('photo_old');
		}
		$data = array(
			'fullname' => $this->input->post('fullname'),
			// 'birthday' => $this->input->post('birthday'),
			'gender' => $this->input->post('gender'),
			'phone' => $this->input->post('phone'),
			'address_name' => $this->input->post('address_name'),
			'address' => $this->input->post('address'),
			'province_id' => $this->input->post('province_id'),
			'email' => $this->input->post('email'),
			'city_id' => $this->input->post('city_id'),
			'nama_toko' => $this->input->post('namatoko'),
			'address_name' => $this->input->post('address'),
			'photo' => $file_name,
			);
		$where = array(
			'member_id' => $this->session->userdata('session_user'),
			);

		$this->M__db->update('members__',$where,$data);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error','Data gagal diedit!');	
		}else{
			$this->db->trans_commit();
			$this->upload->data('photo');
			$this->session->set_flashdata('success','Data berhasil diedit!');
		}
		redirect(base_url().'Account');
	}

	public function downloadPayment(){
		$this->load->library('pdf');
		$data	= $this->public_data;
		$data['title']='Checkout';
		$where = array(
			'member_id' => $this->session->userdata('session_user'),
			);
		$data['akun'] = $this->M__db->cek('members__','*',$where)->row_array();
		$data['content']='Member/viewCheckout.php';
		$this->pdf->load_view('Styler/Template', $data);
	}

	function prosesPesan(){

		// var_dump($_POST);
		// exit();

		$this->db->trans_begin();
		$true = true;
		while ($true == true) {
			$code = randcetak('huruf',8);
			$where = array(
				'transaction_code' => $code,
			);
			$hasil = $this->db->where($where)->get('transaction__')->num_rows();
			if($hasil==0){
				$true = false;
			}
		}

	if ($this->input->post('pengambilan') == 2) {
		$data =  array(
			'transaction_code' => $code,
			'member_id' => $this->input->post('member_id'),
			'address_name' => $this->input->post('address_name'),
			'address' => $this->input->post('address'),
			'province_id' => $this->input->post('province_id'),
			'city_id' => $this->input->post('city_id'),
			'kurir' => $this->input->post('kurir'),
			'service' => $this->input->post('service'),
			'cost' => $this->input->post('cost'),
			'total_price' => $this->input->post('total_price'),
			'payment' => $this->input->post('payment'),
			'weight' => $this->input->post('weight'),
			'status' => 1,
			'created_date' => date('Y-m-d H:i:s'),
			'status_pengambilan' =>  $this->input->post('pengambilan'),
			'date_out_cancel' => date('Y-m-d H:i:s', strtotime('3 hour')),
			
		);

	}else{
		$data =  array(
			'transaction_code' => $code,
			'member_id' => $this->input->post('member_id'),
			'address_name' => $this->input->post('address_name'),
			'address' => $this->input->post('address'),
			'province_id' => $this->input->post('province_id'),
			'city_id' => $this->input->post('city_id'),
			'kurir' => 'Cod',
			'service' => 'Cod',
			'cost' => 0,
			'total_price' => $this->input->post('total_price'),
			'payment' => $this->input->post('payment'),
			'weight' => $this->input->post('weight'),
			'status' => 1,
			'created_date' => date('Y-m-d H:i:s'),
			'status_pengambilan' =>  $this->input->post('pengambilan'),
			
			
		);

	}

		
		// date('Y-m-d H:i:s', strtotime('4 minute'));
  //  		echo date('Y-m-d H:i:s', strtotime('6 hour'));
  //  		echo date('Y-m-d H:i:s', strtotime('2 day'));

		$this->db->insert('transaction__',$data);
		$id =  $this->db->insert_id();
		
		

		// if ($this->input->post('pengambilan') == 2) {
			$dtambil =  array(
				'nama_tujuan' => $this->input->post('nama_tujuan'),
				'id_member' => $this->input->post('member_id'),
				'alamat_tujuan' => $this->input->post('address_name'),
				'city_id' => $this->input->post('city_id'),
				'kurir' => $this->input->post('kurir'),
				'service' => $this->input->post('service'),
				'province_id' => $this->input->post('province_id'),
				'cost_kirim' => $this->input->post('cost'),
				'weight' => $this->input->post('weight'),
				'id_transaksi' => $id,
				'rt' => $this->input->post('rtt'),
				'rw' => $this->input->post('rww'),
				'kode_pos' => $this->input->post('kde_pos'),
				'no_hp' =>  $this->input->post('no_hpp'),
				'nama_pengirim' => $this->input->post('nm_pengirimm'),
				'alamat_pengirim' => $this->input->post('almt_pengirimm'),
				'no_hp_pengirim' =>  $this->input->post('no_hp_pengirimm'),
				
			);
			$this->db->insert('dropship__',$dtambil);
		// }

		$jumlah=array(); $berat=array(); $no=1;
		   foreach ($this->input->post('id_stock') as $key => $value) {

		   	$dataitem = [ 

		   		'transaction_id'=>$id,
		   		'id_stock' => $this->input->post('id_stock')[$key], 
				'product_id' => $this->input->post('product_id')[$key], 
				'nama_size' => $this->input->post('nama_size')[$key], 
				'id_size' => $this->input->post('id_size')[$key], 
				'price' => $this->input->post('price')[$key], 
			 	
			 	];


			 	$this->db->insert('detail_transaction__',$dataitem);
			 	$this->updatedetailstock($this->input->post('id_stock')[$key]);
			}
		// foreach ($this->cart->contents() as $items): 
		// 	$jumlah[]=$items['price'];
		// 	$berat[]=$items['weight'];

		// 	$dataitem = array(
		// 		'transaction_id'=>$id,
		// 		'product_id' => $items['product_id'],
		// 		'amount' => $items['qty'],
		// 		'price' => $items['price'],
		// 		'sub_total' => $items['subtotal'],
		// 		'nama_size' => $items['nama_size'],
		// 		'id_size' => $items['size_id'],
		// 		'id_stock' => $items['id_stock'],
		// 	);
			// $this->db->insert('detail_transaction__',$dataitem);
		
		// endforeach;

		$this->cart->destroy();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			echo 500; die;
		}else{
			$this->db->trans_commit();
			echo paramEncrypt($id);	die;
		}
	}

	public function loadData(){
		$action =$this->input->post('action');
		$where = array(
			'transaction_id' => $this->input->post('id')
			);
		 $data['row'] = $this->M__db->cek('transaction__','*',$where)->row_array();
		 // var_dump($data['row']);
		 // exit();
		 $data['id_product'] =  $this->input->post('id') ;
		
		$this->load->view('LanderApp/Transaksi/Detail', $data);
		
	}

	public function updatedetailstock($id_stock){

				$data = array(
							'status_stock' => 2,
						);
	
			 	$where = array(
						'id_stock' => $id_stock
						
					);

				$this->M__db->update('datastock__',$where,$data);
			
			
		

	}

	public function updatecancedetailstock(){
		$datacancel =  $this->db->query("select * FROM `transaction__` where `status` = 1 and kurir != 'Cod' and status_transaksi = 1  and date_out_cancel <= NOW() ");

		foreach ($datacancel->result()  as $key => $datatr) {

			$datatran =  array('status_transaksi' => 3,);
			$wheree = array('transaction_id' => $datatr->transaction_id,);

			$this->M__db->update('transaction__',$wheree,$datatran);

			$dttransaksi = $this->db->query("select * FROM detail_transaction__ where transaction_id = ".$datatr->transaction_id."  ");
			foreach ($dttransaksi->result() as $key => $value) {
				$data = array(
								'status_stock' => 1,
							);
				for ($x = 1; $x <= $value->amount; $x++) {
				 	$where = array(
							'id_stock' => $value->id_stock,
							
						);

					$this->M__db->update('datastock__',$where,$data);
				}
				
			}

		}

		
	}

	function detailpembayaran() {
		$data	= $this->public_data;
		$data['title']='Detail Produk';
		$data['content']='Beranda/detailpembayaran.php';

		$where = array(
			'transaction_id' => paramDecrypt($this->uri->segment(2)),
		);
		$data['row'] = $this->M__db->cek('transaction__','*',$where)->row_array();
		$this->load->view('Styler/Template', $data);
	}

}
