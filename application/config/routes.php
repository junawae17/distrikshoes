<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'PublicCTRL/beranda';
// $route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// Translate Enkipsi
$route['Translate'] = 'TranslateCTRL';


// Member
$route['Beranda'] = 'PublicCTRL/Beranda';
$route['faq'] = 'PublicCTRL/faq';
$route['fetch'] = 'PublicCTRL/fetch';
$route['pembayaran'] = 'PublicCTRL/pembayaran';
$route['Account'] = 'AccountCTRL/dataAkun';
$route['saveDataMember'] = 'AccountCTRL/saveDataMember';

// Transaksimember

$route['TransaksiMember'] = 'TransaksiMemberCTRL/dataAkun';
$route['UploadBukti'] = 'TransaksiMemberCTRL/saveDataBukti';
$route['UploadBuktidaftar'] = 'PublicCTRL/saveDataBuktidaftar';



// Raja Ongkir
$route['getcity'] = 'RajaOngkirCTRL/getcity';
$route['getcityfirst'] = 'RajaOngkirCTRL/getcityfirst';
$route['cost'] = 'RajaOngkirCTRL/cost';


$route['getstock'] = 'RajaOngkirCTRL/getstock';


// Auth Member
$route['Register'] = 'AuthCTRL/registerMember';
$route['prosesRegister'] = 'AuthCTRL/prosesRegister';
$route['Verifikasi/:any'] = 'AuthCTRL/verifikasiAkun';
$route['prosesLogin'] = 'AuthCTRL/prosesLoginMember';



// Auth Admin
$route['LogiN'] = 'AuthCTRL/login';
$route['cekLogin'] = 'AuthCTRL/prosesLogin';
$route['Destroy'] = 'AuthCTRL/deleteSession';


 // Admin
 // Beranda
 $route['Admin/Beranda'] = 'AdminCTRL/beranda';

 // $route['welcome'] = 'utamactrl/utama';

 // Email
 $route['Admin/Email'] = 'EmailCTRL/getData';
 $route['Admin/saveEmail'] = 'EmailCTRL/saveData';
 $route['Admin/testSendEmail'] = 'EmailCTRL/testEmail';
 $route['Admin/emailTemplate'] = 'EmailCTRL/getTemplate';
 $route['Admin/saveTemplateEmail'] = 'EmailCTRL/saveTemplate';
 $route['Admin/statusEmail/:any/:any'] = 'EmailCTRL/updateStatus';
 $route['Admin/updateEmail/:any'] = 'EmailCTRL/updateData';
 
 
 // Payment
 $route['Admin/Payment'] = 'PaymentCTRL/getData';
 $route['Admin/savePayment'] = 'PaymentCTRL/saveData';
 $route['Admin/statusPayment/:any/:any'] = 'PaymentCTRL/updateStatus';
 
 //Category
 $route['Admin/Category'] = 'CategoryCTRL/getData';
 $route['Admin/statusCategory/:any/:any'] = 'CategoryCTRL/statusCategory';
 $route['Admin/tambahCategory'] = 'CategoryCTRL/tambahCategory';
 $route['Admin/saveCategory'] = 'CategoryCTRL/saveCategory';
 $route['Admin/updateCategory/:any'] = 'CategoryCTRL/updateCategory';
 $route['Admin/detailCategory/:any'] = 'CategoryCTRL/detailCategory';
 
 //  Product
 $route['Admin/Product'] = 'ProductCTRL/getData';
 $route['Admin/saveProduct'] = 'ProductCTRL/saveData';
 $route['Admin/savegambarProduct'] = 'ProductCTRL/saveGambar';
 $route['Admin/statusProduct/:any/:any'] = 'ProductCTRL/updateStatus';
 $route['Admin/formProduct/:any'] = 'ProductCTRL/formData';
 $route['Admin/imagesProduct/:any/:any'] = 'ProductCTRL/imagesProduct';
 $route['Admin/hapusstock/:any/:any'] = 'ProductCTRL/hapusStock';
 $route['Admin/savestock'] = 'ProductCTRL/saveStock';


 //  Transaksi
 $route['Admin/Transaksi'] = 'TransaksiCTRL/getData';
 $route['Admin/saveTransaksi'] = 'TransaksiCTRL/saveData';
 $route['Admin/savegambarTransaksi'] = 'TransaksiCTRL/saveGambar';
 $route['Admin/statusPembayaran/:any/:any'] = 'TransaksiCTRL/updateStatusPembayaran';
 $route['Admin/statusPengiriman/:any/:any'] = 'TransaksiCTRL/updateStatusPengiriman';
 $route['Admin/statusTransaksi/:any/:any'] = 'TransaksiCTRL/updateStatusTransaksi';
 $route['Admin/formTransaksi/:any'] = 'TransaksiCTRL/formData';
 $route['Admin/imagesTransaksi/:any/:any'] = 'TransaksiCTRL/imagesProduct';
 $route['UploadResi'] = 'TransaksiCTRL/saveDataResi';
 $route['Admin/printalamat/:any'] = 'TransaksiCTRL/printalamat';


 
  //  Size
 $route['Admin/Size'] = 'SizeCTRL/getData';
 $route['Admin/saveSize'] = 'SizeCTRL/saveData';
 $route['Admin/statusSize/:any/:any'] = 'SizeCTRL/updateStatus';
 $route['Admin/formSize/:any'] = 'SizeCTRL/formData';
 $route['Admin/imagesSize/:any/:any'] = 'SizeCTRL/imagesProduct';


   //  member
 $route['Admin/Member'] = 'MemberCTRL/getData';
 $route['Admin/saveMember'] = 'MemberCTRL/saveData';
 $route['Admin/statusMember/:any/:any'] = 'MemberCTRL/updateStatus';
 $route['Admin/formMember/:any'] = 'MemberCTRL/formData';
 $route['Admin/imagesMember/:any/:any'] = 'MemberCTRL/imagesProduct';


//  Toko
$route['Admin/shopInformation'] = 'ShopCTRL/getData';
$route['Admin/saveShop'] = 'ShopCTRL/saveData';

//Contact
$route['Admin/contact'] = 'ContactCTRL/getData';
$route['Admin/getAllContact'] = 'ContactCTRL/getAllContact';
$route['Admin/addContact'] = 'ContactCTRL/addContact';
$route['Admin/deleteContact'] = 'ContactCTRL/deleteContact';
$route['Admin/updateContact'] = 'ContactCTRL/updateContact';

// User 
$route['Admin/user'] = 'UserCTRL/getData';
$route['Admin/statusUser/:any/:any'] = 'UserCTRL/updateStatus';

//Admin
$route['Admin/admin'] = 'DataAdminCTRL/getData';
$route['Admin/statusAdmin/:any/:any'] = 'DataAdminCTRL/updateStatus';
$route['Admin/tambahAdmin'] = 'CategoryCTRL/tambahAdmin';
 $route['Admin/saveAdmin'] = 'CategoryCTRL/saveAdmin';
 $route['Admin/updateAdmin/:any'] = 'CategoryCTRL/updateAdmin';
 $route['Admin/detailAdmin/:any'] = 'CategoryCTRL/detailAdmin';

// shop
$route['detailProduct/(:any)'] = 'PublicCTRL/detailProduct';
$route['masukKeranjang/(:any)'] = 'PublicCTRL/tocart';
$route['deleteKeranjang/(:any)'] = 'PublicCTRL/removecart';
$route['kosongkanKeranjang'] = 'PublicCTRL/deletecart';
$route['viewCheckout'] = 'AccountCTRL/viewCheckout';
$route['prosesPesan'] = 'AccountCTRL/prosesPesan';
$route['transactionCheck'] = 'PublicCTRL/transactioncheck';
$route['transactionCode'] = 'PublicCTRL/transactionview';
$route['Category'] = 'PublicCTRL/category';
$route['searchBy'] = 'PublicCTRL/categorysearch';
$route['downloadimage/(:any)'] = 'PublicCTRL/downloadall';

$route['detailpembayaran/(:any)'] = 'AccountCTRL/detailpembayaran';
$route['cancelstock'] = 'AccountCTRL/updatecancedetailstock';

