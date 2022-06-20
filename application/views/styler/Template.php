<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function path_members(){
  echo base_url()."assets/styler";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
  <title><?=$title.' | '.$info['title_app']?></title>
	<link rel="icon" type="image/png" href="<?=base_url().'assets/images/'.$info['favicon_app']?>">
<link href="<?=path_members()?>/css/master.css" rel="stylesheet">
<script src="<?=path_members()?>/plugins/jquery/jquery-1.11.3.min.js"></script>
<script src="<?=base_url()?>assets/growl/js/jquery.growl.js" type="text/javascript"></script>
<link href="<?=base_url()?>assets/growl/css/jquery.growl.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!-- Loader -->
<div id="page-preloader"><span class="spinner"></span></div>
<!-- Loader end -->
<div class="layout-theme animated-css "  data-header="sticky" data-header-top="200"  > 
<?php if($error=$this->session->flashdata('error')){ ?>
    <script>
      $.growl.error({ message: '<?=$error?>' });
    </script>
    <?php }
    if($success=$this->session->flashdata('success')){ ?>
    <script>
      $.growl.notice({ message: '<?=$success?>' });
    </script>
    <?php }
    if($warning=$this->session->flashdata('warning')){?>
    <script>
      $.growl.warning({ message: '<?=$warning?>' });
    </script>
    <?php }?>
  <div id="wrapper">
    <header class="header">
      <div class="top-header">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <ul class="top-header__links list-unstyled">
                <?php if((!$this->session->userdata('session_user')) or ($this->session->userdata('level_user')!=0)){ ?>
                <li class="top-header__link"><a href="<?=base_url()?>Register"><i class="fa fa-sign-in"></i> MASUK</a></li>
                <li class="top-header__link"><a href="<?=base_url()?>Register"><i class="fa fa-user-plus"></i> DAFTAR</a></li>
                <?php }else{ ?>
                  <li class="top-header__link"><a href="<?=base_url().'Account'?>"><i class="fa fa-user"></i> <?=$info['user_fullname']?></a></li>
                  <li class="top-header__link"><a href="<?=base_url().'TransaksiMember'?>"><i class="fa fa-money"></i> Transaksi</a></li>
                 <li class="top-header__link"><a href="<?=base_url()?>Destroy"><i class="fa fa-sign-out"></i> Keluar</a></li>
                <?php } ?> 
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- end top-header -->
      
      <div class="container">
        <div class="header-inner">
          <div class="row">
           
             <div class="col-sm-3 col-xs-12 hidden-xs"> <a href="<?=base_url()?>Beranda" class="logo"> <img class="logo__img" src="<?=base_url().'assets/images/'.$info['logo_app'];?>" width="20%" alt="Logo"> </a> </div>
           
            <div class="col-sm-6 col-xs-12">
              <div class="header-search clearfix">
                <div class="header-search__filter hidden-sm hidden-xs">
                  <div class="jelect">
                    <div role="button" class="jelect-current   ">Filter By</div>
                    <ul class="jelect-options">
                      <li class="jelect-option">Nama</li>
                      <li class="jelect-option">Kategori</li>
                    </ul>
                  </div>
                </div>
                <div class="header-search__form">
                  <form class="product-search" method="post" action="<?=base_url()?>searchBy">
                    <input class="product-search__field" id="searchQuery" name="code" type="search">
                    <button class="product-search__btn ui-btn ui-btn_primary" type="submit" >CARI</button>
                  </form>
                </div>
              </div>
            </div>
            
            <div class="col-sm-3 col-xs-12">
            
              <div class="header-cart">
                <div class="header-cart__preview"> <span class="icon fa fa-shopping-cart color_primary" aria-hidden="true"></span> <span class="header-cart__inner"> <span class="header-cart__qty">keranjang</span> <span class="header-cart__amount">TOTAL: <span class="color_primary"><?=currency($this->cart->total()); ?></span></span> </span> <i class="caret"></i> </div>
                <div class="header-cart__product">
                  <h3 class="header-cart__title">Keranjang Belanja</h3>
                  <ul class="product-list list-unstyled">
                    <?php $jumlah=array();
                      foreach ($this->cart->contents() as $items): 
                          $jumlah[]=$items['price'];
                      ?>
                    <li class="product-list__item clearfix">
                      <a class="product-list__img" href="javascript:void(0);"><img class="img-responsive" src="<?=base_url().'assets/uploads/product/'.$items['picture']?>" alt="Product"></a>
                      <div class="product-list__inner">
                        <h4 class="product-list__name"><a class="product-list__link" href="<?=base_url().'detailProduct/'.paramEncrypt($items['product_id']);?>"><span class="product-list__model"><?='( '.$items['qty'].' ) item<br>'.$items['name'] ?></a></h4>
                        <span class="product-list__price"><?=currency($items['subtotal']); ?></span> </div>
                      <a href="<?=base_url().'deleteKeranjang/'.$items['rowid']?>"><i class="product-list__del icon icon-trash color_primary"></i></a>
                    </li>
                    <?php endforeach; ?>
                  </ul>
                  <div class="product-list__total">Subtotal:<span class="product-list__total_price"><?=currency($this->cart->total()); ?></span></div>
                  <div class="header-cart__buttons clearfix"> <a class="ui-btn ui-btn_danger" href="javascript:void(0);">Keranjang</a> <a class="ui-btn ui-btn_primary" href="<?=base_url().'viewCheckout'?>">Checkout</a> </div>
                  <div class="text-center"><br><br><a href="<?=base_url().'kosongkanKeranjang';?>">Kosongkan keranjang</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </header>
    
    <div class="top-nav ">
      <div class="container">
        <div class="row">
          <div class="col-md-12  col-xs-12">
            <div class="navbar yamm cate">
              <?php if((!$this->session->userdata('session_user')) or ($this->session->userdata('level_user')!=0)){ ?>
              <div class="navbar-header hidden-md  hidden-lg  hidden-sm ">
               
                <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a href="javascript:void(0);" class="navbar-brand">Menu</a>
              </div>
              <div id="navbar-collapse-1" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                 
                  <li><a href="<?=base_url()?>Beranda">Shoes</a></li>
                  <li> <a href="<?=base_url()?>Beranda"> Tentang Kami</a> </li>
                  <li> <a href="<?=base_url()?>Beranda">Kontak</a> </li>
                  <li> <a href="<?=base_url()?>faq">FAQ</a> </li>
               

                 
                </ul>
              </div>
              <?php }else{ ?>
                 <ul class="nav nav-tabs tab-child hidden-lg hidden-md hidden-sm cut">
                  <li class=""><a href="<?=base_url()?>Beranda">Product</a></li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Category</a>
                    <div class="dropdown-menu">
                       <?php $where  = array(
                        'sub_category' => 0,
                        'is_active' => 1 
                      );
                      $menuCategory = $this->M__db->get_cek_limit('category__','category_id, category_name',$where,9)->result();
                      foreach ($menuCategory as $key) { ?>
                        <a class="dropdown-item" href="<?=base_url().'Category?v='.paramEncrypt($key->category_id)?>"> <span class="list-categories__name"><?=strtoupper($key->category_name)?></span> </a> 
                      <?php }
                      ?>
                    
                    </div>
                  </li>
               <!--    <li class="dropdown">
                  <a data-toggle="tab" href="#po">Category</a>
                  </li> -->
                <!--   <li class=""><a data-toggle="tab" href="#po">FlashSale</a></li> -->
                  <li> <a href="<?=base_url()?>faq">FAQ</a> </li>
              </ul>
             <!--  <div class="tab-content hidden-lg hidden-md hidden-sm">
                <div id="po" class="tab-pane fade ">
                    <ul class="">
                      <?php $where  = array(
                        'sub_category' => 0,
                        'is_active' => 1 
                      );
                      $menuCategory = $this->M__db->get_cek_limit('category__','category_id, category_name',$where,9)->result();
                      foreach ($menuCategory as $key) { ?>
                        <li class=""> <a class="" href="<?=base_url().'Category?v='.paramEncrypt($key->category_id)?>"> <span class="list-categories__name"><?=strtoupper($key->category_name)?></span> </a> </li>
                      <?php }
                      ?>
                    </ul>
                </div>
              </div> -->
              <?php } ?> 
            
             
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if($content){
				include $content;
			} 
		?>
    <footer class="footer footer_mod-a wow bounceInUp" data-wow-duration="1s">
  <!--     <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-md-3"> <img src="<?=base_url().'assets/images/'.$info['logo_app'];?>" width="20%" alt="Logo">
              <div class="footer-info">
                <label><?=$info['name_app']?></label>
                <p><?=$info['deskripsi_app']?></p>
              </div>
            </div>
            <div class="col-md-2">
              <h3 class="footer-title">Contact</h3>
              <ul class="footer-list">
                <?php $contact = $this->db->get('contact__');
                foreach($contact->result() as $row){ ?>
                <table width="100%">
                    <tr>
                        <th><?=$row->aplikasi.' - '.$row->number;?></th>
                    </tr>
                    <tr><td colspan="2">
                        <hr style="border-top: 1px dashed #8c8b8b;"></td></tr>
                <?php }?>
              </table>
              </ul>
            </div>
            <div class="col-md-2">
              <h3 class="footer-title">Rekening Bank</h3>
              <ul class="footer-list">
                <?php $payment = $this->db->where('is_active',1)->get('payment__');
                foreach($payment->result() as $row){ ?>
                <table width="100%">
                    <tr>
                        <td rowspan="2" width="40%"><img src="<?=base_url().'assets/uploads/'.$row->payment_logo?>" width="90%" alt=""></td>
                        <th><?=$row->payment_number;?></th>
                    </tr>
                    <tr>
                        <td>[ <?=$row->payment_account_name;?> ]</td>
                    </tr>
                    <tr><td colspan="2">
                        <hr style="border-top: 1px dashed #8c8b8b;"></td></tr>
                <?php }?>
                </table>
              </ul>
            </div>
          </div>
        </div>
      </div> -->
      
      <div class="footer-bottom">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="copyright text-center">
                <p > <a href="<?=base_url()?>"><strong><?=$info['name_app']?></strong></a> <?=date('Y')?></p>
             <!--    <p style="display:none;"  id="log_admin"><a href="<?=base_url().'LogiN' ?>">Login Admin</a> </p> -->

              </div>
            </div>
          </div>
          <!-- end row --> 
        </div>
        <!-- end container --> 
      </div>
      <!-- end footer-bottom --> 
    </footer>
  </div>
</div>
<script>
        // function tampil(){
        //     document.getElementById("log_admin").style.display='block';
        // }




    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5f7be70cf0e7167d0016768b/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();


    </script>
<!-- SCRIPTS --> 
<script src="<?=path_members()?>/js/jquery-migrate-1.2.1.js"></script>
<script src="<?=path_members()?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=path_members()?>/js/modernizr.custom.js"></script>
<script src="<?=path_members()?>/plugins/isotope/jquery.isotope.min.js"></script> 
<script src="<?=path_members()?>/plugins/owl-carousel/owl.carousel.min.js"></script> 
<script src="<?=path_members()?>/js/waypoints.min.js"></script> 
<script src="<?=path_members()?>/plugins/prettyphoto/js/jquery.prettyPhoto.js"></script> 
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>  -->
<script src="<?=path_members()?>/js/jquery.easing.min.js"></script> 
<script src="<?=path_members()?>/plugins/jelect/jquery.jelect.js"></script> 
<script src="<?=path_members()?>/plugins/nouislider/jquery.nouislider.all.min.js"></script> 
<script src="<?=path_members()?>/plugins/flexslider/jquery.flexslider.js"></script> 

<!--Color Switcher--> 
 <script src="<?=path_members()?>/plugins/switcher/js/bootstrap-select.js"></script> 
 <script src="<?=path_members()?>/plugins/switcher/js/dmss.js"></script> 

<!--THEME--> 
<script src="<?=path_members()?>/js/cssua.min.js"></script> 
<script src="<?=path_members()?>/js/wow.min.js"></script> 
<script src="<?=path_members()?>/js/custom.js"></script>
</body>
</html>
