<?php defined('BASEPATH') OR exit('No direct script access allowed.');
class MY_Pagination extends CI_Pagination {
protected $CI;
function __construct()
{
parent::__construct();
$this->CI =& get_instance();
$this->CI->load->helper('url');
$this->CI->load->library('pagination');
}
function paging($url, $total)
{
$url = site_url($url);
$this->config($url, $total);
$paging = $this->CI->pagination->create_links();
return $paging;
}
function config($url, $total)
{
$this->CI->config->load('pagination', true);
$config = $this->CI->config->item('pagination');
$config['base_url'] = $url;
$config['total_rows'] = $total;
$this->CI->pagination->initialize($config);
}
}
