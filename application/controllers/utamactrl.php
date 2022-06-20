<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class utamactrl extends Admins {

	public function utama() {
		$data	= $this->public_data;
		$data['title']	= 'Welcome';
		$data['currentPage'] = 'welcome';
		$data['content']='utama/utama.php';
		$this->load->view('utama/template',$data);
	}
}
