<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminCTRL extends Admins {

	public function beranda() {
		$data	= $this->public_data;
		$data['title']	= 'Beranda';
		$data['currentPage'] = 'beranda';
		$data['content']='Beranda/Beranda.php';
		$this->load->view('LanderApp/Template',$data);
	}
}
