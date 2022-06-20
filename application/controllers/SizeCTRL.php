<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SizeCTRL extends Admins {
	
	public function getData() {
		$data	= $this->public_data;
		$data['title']='Data Master Size';
		$data['currentPage']='Size';
		$data['allData']=$this->M__db->get_select_order('msize__','id_size, nama_size, keterangan, berat','id_size','DESC');
		$data['content']='Size/AllData.php';
		$this->load->view('LanderApp/Template', $data);
	}
	
	public function saveData(){
		$this->db->trans_begin();
		$action = $this->input->post('action');
		
		$session_user = $this->session->userdata('session_user');	
		$this->form_validation->set_rules('nama_size','Satuan Size','trim|required');
		
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',validation_errors());
		}else{
			$data = array(
				'nama_size' => $this->input->post('nama_size'),
				'keterangan' => $this->input->post('keterangan'),
				'modified_date' => date('Y-m-d H:i:s'),
				'modified_by' => $session_user
			);
				
			
				if($action=='update'){
				
					$where = array(
						'id_size' => $this->input->post('id_size'),
					);
					$this->M__db->update('msize__',$where,$data);
				}else{
					
					$this->M__db->simpan('msize__',$data);
				}
						
			
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error','Data Size gagal disimpan');	
			}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Data Size berhasil disimpan!');	
			}
		}
		if($action=='update'){
			redirect(base_url().'Admin/formSize/'.paramEncrypt($this->input->post('id_size')));
		}else{
			redirect(base_url().'Admin/Size');
		}
	}
	
	public function updateStatus(){
		$this->db->trans_begin();
		$where = array(
			'product_id' => $this->uri->segment(3)
			);
			$data = array(
			'is_active' => $this->uri->segment(4),
			'modified_date' => date('Y-m-d H:i:s'),
			'modified_by' => $this->session->userdata('session_user')
		);
		
		$this->M__db->update('product__',$where,$data);
		if($this->uri->segment(4)==1){ $ms='aktifkan';}else{ $ms='nonaktifkan';}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error','Status Produk gagal di'.$ms.'!');	
		}else{
			$this->db->trans_commit();
			$this->session->set_flashdata('success','Status Porduk berhasil di'.$ms.'!');	
		}
		redirect('Admin/Product');
	}
	
	public function imagesProduct(){
		$this->db->trans_begin();
		$where = array(
			'product_id' => $this->uri->segment(3)
		);
		$rows = $this->M__db->cek('product__','images_product',$where)->row_array();
		$images = explode(',',$rows['images_product']);
		$convertData =  array();
		foreach ($images as $key) {
			if($key!=$this->uri->segment(4)){
				array_push($convertData, $key);
			}
		}
		$data = array(
			'images_product' => implode(",",$convertData),
			'modified_date' => date('Y-m-d H:i:s'),
			'modified_by' => $this->session->userdata('session_user')
		);
		
		$this->M__db->update('product__',$where,$data);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error','Gambar Produk gagal dihapus!');	
		}else{
			@unlink("./assets/uploads/product/".$this->uri->segment(4));
			$this->db->trans_commit();
			$this->session->set_flashdata('success','Gambar Porduk berhasil dihapus!');	
		}
		redirect(base_url().'Admin/formProduct/'.paramEncrypt($this->uri->segment(3)));
	}

	public function formData() {
		$data	= $this->public_data;
		$data['title']='Data Size';
		$data['currentPage']='Size';
		$where = array(
			'id_size' => paramDecrypt($this->uri->segment(3)),
			);
		$data['rows']=$this->M__db->cek('msize__','*',$where)->row_array();
		$data['content']='Size/formSize.php';
		$this->load->view('LanderApp/Template', $data);
	}
}
