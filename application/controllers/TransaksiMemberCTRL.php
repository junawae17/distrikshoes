<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiMemberCTRL extends Members {

	function dataAkun() {
		$data	= $this->public_data;
		$data['title']='Transaksi';
		$data['content']='Akun/dataTransaksi.php';
		$where = array(
			'member_id' => $this->session->userdata('session_user'),
			);
		$data['akun'] = $this->M__db->cek('members__','*',$where)->row_array();
		
		$data['allData']= $this->db->query("select transaction__.*,members__.*,dropship__.nama_tujuan FROM transaction__ 
LEFT JOIN members__ on members__.member_id = transaction__.member_id 
LEFT JOIN dropship__ on dropship__.id_transaksi = transaction__.transaction_id where transaction__.member_id = ".$this->session->userdata('session_user')." ");
		$this->load->view('Styler/Template', $data);
	}

	public function loadData(){
		$action =$this->input->post('action');
		$where = array(
			'transaction_id' => $this->input->post('id')
			);
		// $data['row'] = $this->M__db->cek('datastock__','*',$where);
		 $data['id_product'] =  $this->input->post('id') ;
		
		$this->load->view('LanderApp/Transaksi/Detail', $data);
		
	}

	public function saveDataBukti(){
		
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
					$data = array(
						'images_bukti' => implode(",",$convertData),
						
					);

					$where = array(
						'id_transaction' => $this->input->post('id_transaction'),
					);

					$this->M__db->update('buktitf__',$where,$data);

					// $this->updatedetailstock($this->input->post('id_transaction'));
				}else{
					$data = array(
						'images_bukti' => implode(",",$convertData),
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $session_user,
						'id_transaction' => $this->input->post('id_transaction'),
					);
					
					$this->M__db->simpan('buktitf__',$data);
					$idp =  $this->db->insert_id();

					$datas = array(
							'status' => 2,
						);
					
					$wheres = array(
						'transaction_id' => $this->input->post('id_transaction'),
					);
					$this->M__db->update('transaction__',$wheres,$datas);

					// $this->updatedetailstock($this->input->post('id_transaction'));

				}
						
			}else{ // tidak ada file

				$where = array(
					'id_bukti_tf' => $this->input->post('id_bukti_tf'),
				);

				$this->M__db->update('buktitf__',$where,$data);
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
			redirect(base_url().'TransaksiMember');
		}else{
			redirect(base_url().'TransaksiMember');
		}
	}


	public function updatedetailstock($id_transaksi){
		$dttransaksi = $this->db->query("select * FROM detail_transaction__ where transaction_id = ".$id_transaksi."  ");
		foreach ($dttransaksi->result() as $key => $value) {
			$data = array(
							'status_stock' => 2,
						);
			for ($x = 1; $x <= $value->amount; $x++) {
			 	$where = array(
						'product_id' => $value->product_id,
						'id_size' => $value->id_size,
						'status_stock' => 1
					);

				$this->M__db->update('datastock__',$where,$data);
			}
			
		}

	}

}
