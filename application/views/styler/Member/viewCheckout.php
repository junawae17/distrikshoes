<style type="text/css">
  .ui-title-block {
   
    margin-bottom: 0px !important;
  }
</style>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="section-area section-default">
       
        <h3> Data Barang</h3>
        <table class="table table-striped table-bordered datatables hidden-xs ">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>gambar</th> 
              <th>Size</th>
             <!--  <th>Jumlah Barang</th> -->
              <th style="text-align:center;">Harga/item</th>
           <!--    <th style="text-align:center;">Sub Total</th> -->
            </tr>
          </thead>
          <form id="my_awesome_form" method="post" name="frm" action="">
          <tbody>
            <?php foreach ($this->cart->contents() as $itemss){ 
              $databarang = $this->db->query("select datastock__.*, product__.*, msize__.nama_size FROM `datastock__` LEFT JOIN product__ on product__.product_id = datastock__.product_id
                left join msize__ on msize__.id_size = datastock__.id_size
                where datastock__.product_id = ".$itemss['product_id']." and datastock__.id_size = ".$itemss['size_id']." and datastock__.status_stock = 1 limit ".$itemss['qty']." "); 
            ?>

            <?php $jumlah=array(); $berat=array(); $no=1;
              foreach ($databarang->result() as $items){ 
                  $jumlah[]=$items->price;
                  $berat[]=$items->weight;
                  $rows_images = explode(",",$items->images_product);
              ?>
            <tr>
              <td><?=$no;?></td>
                <td><a class="product-list__link" href="<?=base_url().'detailProduct/'.paramEncrypt($items->product_id);?>"><?=$items->product_name ?></a></td>
              <td><a class="product-list__link" href="<?=base_url().'detailProduct/'.paramEncrypt($items->product_id);?>"><img src="<?=base_url().'assets/uploads/product/'.$rows_images[0]?>" alt="Product" width="70px"></a></td>
            
              <td><?=$items->nama_size ?> </td>
          
              <td style="text-align:right;"><?=currency($items->price) ?></td>
          
                <input type="hidden" name="nama_size[]" value="<?=$items->nama_size ?>" class="">
                <input type="hidden" name="id_size[]" value="<?=$items->id_size ?>" class="">
          
                <input type="hidden" name="id_stock[]" value="<?=$items->id_stock ?>" id="id_stock">
                <input type="hidden" name="product_id[]" value="<?=$items->product_id ?>" id="product_id">
                <input type="hidden" name="price[]" value="<?=$items->price ?>" id="price">
            </tr>
            <?php $no++; } ?>
          
            <?php } ?>
            
          </tbody>
          <tfoot>
            <tr>
              <th colspan="3" style="text-align:right;">&nbsp;</th>
              <th style="text-align:center;">Total Harga Barang</th>
              <th style="text-align:right;"><span style="background-color:#FFEFD5; font-size:16px;"><?=currency($this->cart->total());?></span></th>
            </tr>
          </tfoot>
        </table>

        
       <table class="" width="100%">
          <tbody>
            <tr>
            <td>Pilih Pengiriman</td>
             <td>:</td>
              <td rowspan="5">
                <select class="form-control" id="pengambilan" name="pengambilan" onchange="pilih_pengambilan(this)">
                  <option value="1">COD</option>
                  <option value="2">DROPSHIP</option>
                </select>
              </td>
            </tr>
          </tbody>
        </table>  
        

        
        <table class="table tbl_hidden" style="display: none;">
          <tbody>
           <tr>
              <td><h3>Data Penerima</h3> <button data-toggle="modal" data-target=".modalTambah" data-placement="top" title="" data-loading-text="Loading..."  class="card-btns__add pull-right ">Ganti</button></td>
            </tr>
           
            <tr>
              <td><span class="fullname"><?=$akun['fullname']?></span></td>
            </tr>
            <tr>
              <td><span class="phone"><?=$akun['email'].' , Telp. '.$akun['phone']?></span></td>
            </tr>
            <tr>
              <td><span class="alamat1"><?=$akun['address_name']?></span></td>
            </tr>
            <tr>
              <td><span class="alamat2"><?='Alamat : '.$akun['address_name']?></span></td>
            </tr>
            <tr>
              <td><span class="city_get"><?php $address = $this->M__db->getcity($akun['city_id'],$akun['province_id']); echo 'Kota '.$address['city_name'].' - '.$address['postal_code'].' - '.$address['province']?></span></td>
            </tr>
          </tbody>
        </table>
        <table class="table tbl_hidden" style="display: none;">
          <tbody>
           <tr>
              <td><h3>Data Pengirim</h3> <button data-toggle="modal" data-target=".modalTambahpengirim" data-placement="top" title="" data-loading-text="Loading..."  class="card-btns__add pull-right ">Ganti</button></td>
            </tr>
           
            <tr>
              <td><span class="nm_pengirimmm"><?=$akun['nama_toko']?></span></td>
            </tr>
            <tr>
              <td><span class="no_hp_pengirimmm">Phone / wa : <?=$akun['phone']?></span></td>
            </tr>
      <!--       <tr>
              <td><span syt class="almt_pengirimmm"><?=$akun['address_name']?> <?=$akun['address']?></span></td>
            </tr> -->
           
           <!--  <tr>
              <td><span class="email_pengirim"><?php $address = $this->M__db->getcity($akun['city_id'],$akun['province_id']); echo 'Kota '.$address['city_name'].' - '.$address['postal_code'].' - '.$address['province']?></span></td>
            </tr>
          </tbody> -->
        </table>
        <?php if($this->cart->contents()){?>
       
        <table class="table tbl_hidden" style="display: none;">
          <tbody>
             <tr>
              <td rowspan="5">
                <h3>Kurir Pengiriman</h3>
                </td>
              </tr>
            <tr>
              <td rowspan="5">
                <select required onchange="tampil_data('data')" class="form-control" name="courier" id="courier">
                    <option value="">Pilih Kurir</option>
                    <option value="jne">JNE</option>
                    <option value="pos">POS</option>
                    <option value="tiki">TIKI</option>
                   <!--  <option value="sicepat">SICEPAT</option>
                    <option value="j&t">  J&T Express</option> -->
                   
                </select>
              </td>
              <td>
                <?php $city = $this->db->select('city_id')->get('system__')->row_array()?>
                <script>
                    function tampil_data(act){
                        var w = '<?php echo $city['city_id']?>';
                        // var x = '<?php //echo $akun['city_id']?>';
                        var x = $('#city_id').val();
                        
                        var y = '<?php echo array_sum($berat)?>';
                        var z = $('#courier').val();
                        // alert(w,x,y,z)
                        if(z!=''){
                          $.ajax({
                              url: "<?php echo site_url('cost') ?>",
                              type: "GET",
                              data : {origin: w, destination: x, berat: y, courier: z},
                              success: function (ajaxData){
                                document.getElementById("bgtotal").style.backgroundColor = 'yellow';
                                  $("#hasil").html(ajaxData);
                                  $('.kurir').val(z);
                              }
                          });
                        }
                    };
                  </script>
                  <div id="hasil"></div>
              </td>
            </tr>
          </tbody>

          <tfoot >
            <tr>
              <th colspan="2" style="text-align:right;">Biaya pengiriman</th>
              <td>&nbsp;</th>
              <th style="text-align:right;">
                <span class="cost" style="background-color:#ff00ff; font-size:16px;">-</span></th>
            </tr>
            <tr>
              <th colspan="2" style="text-align:right;">Total Pembayaran</th>
              <td>&nbsp;</th>
              <th id="bgtotal" style="text-align:right; font-size:20px;">
                <span class="totalBayarText" style="font-size:20px;"><?=currency($this->cart->total()); ?></span></th>
            </tr>
            <tr>
                    <td colspan="3">&nbsp;</td>
                    <td style="text-align:right;">
                      <input type="hidden" name="member_id" id="member_id" value="<?=$this->session->userdata('session_user')?>">
                      <input type="hidden" name='address_name' id="address_name" value="<?=$akun['address_name']?>">
                      <input type="hidden" name="address" id="address" value="<?=$akun['address_name']?>">
                      <input type="hidden" name="province_id" id="province_id" value="<?=$akun['province_id']?>">
                      <input type="hidden" name="city_id" id="city_id" value="<?=$akun['city_id']?>">
                      <input type="hidden" name="kurir" id="kurir" class="kurir" value="">
                      <input type="hidden" name="service" id="service" class="service" value="">
                      <input type="hidden" name="cost" id="cost" class="cost" value="">
                      <input type="hidden" name="total_price" id="total_price" value="<?=$this->cart->total(); ?>">
                      <input type="hidden" name="payment" id="payment" value="<?=$this->cart->total(); ?>" class="payment">
                      <input type="hidden" name="weight" id="weight" class="weight" value="<?=array_sum($berat)?>">
                      <input type="hidden" name="nama_tujuan" id="nama_tujuan" class="nama_tujuan" value="<?=$akun['fullname']?>">
                      <input type="hidden" name="rtt" id="rtt" class="rt" value=""> 
                      <input type="hidden" name="rww" id="rww" class="rw" value="">
                      <input type="hidden" name="kde_pos" id="kde_pos" class="kode_pos" value="">
                      <input type="hidden" name="no_hpp" id="no_hpp" class="no_hpp" value="">
                      <input type="hidden" name="nama_kota" id="nama_kota" class="" value="">
                      <input type="hidden" name="nama_prov" id="nama_prov" class="" value="">
                      <input type="hidden" name="nm_pengirimm" id="nm_pengirimm" class="kode_pos" value="<?=$akun['nama_toko']?>">
                      <input type="hidden" name="no_hp_pengirimm" id="no_hp_pengirimm" class="no_hpp" value="<?=$akun['phone']?>">
                      <input type="hidden" name="almt_pengirimm" id="almt_pengirimm" class="" value="<?=$akun['address_name']?>">
                      <input type="hidden" name="mail_pengirimm" id="mail_pengirimm" class="" value="">
                    </td>
            </tr>
          </tfoot>
        </table>
          <button onclick="prosesPesan()" class="card-btns__add pull-right">Proses Pemesanan <i class="icon fa fa-angle-double-right"></i> </button>
                  <?php }?>
      </div>
    </div>
  </div>
</div>
<br><br><br><br><br><br><br><br>
<div class="modal fade modalTambah" tabindex="-1" role="dialog" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         <h2 class="ui-title-block ui-title-block_small"><i class="icon fa fa-map-marker"></i>Alamat Anda / Tujuan Pengiriman </h2>
      </div>
      <div class="modal-body">
      
        <div class="row form-contact ui-form">
              <div class="col-md-12 col-xs-12">
                <div class="col-md-12 col-xs-12">
                  <input class="form-control" name="nama_penerima" id="nama_penerima" type="text" placeholder="Nama Penerima" required >
                </div>
              </div>
              <div class="col-md-12 col-xs-12">
                <div class="col-md-12 col-xs-12">
                  <input class="form-control" name="no_hp" id="no_hp" type="text" placeholder="No HP / Telp" required >
                </div>
              </div>
              <div class="col-md-12 col-xs-12">
                <div class="col-md-6 col-xs-12">
                  <select class="form-control" required name="nama_provinsi" onChange="pilihprovince(this);" id="propinsi_asal">
                      <option value="<?=$address['province_id']?>" selected="" disabled="">Pilih Provinsi</option>
                      <?php $this->load->view('rajaongkir/getProvince'); ?>
                    </select>
                </div>
                <div class="col-md-6 col-xs-12">
                  <select class="form-control" required name="nama_kota" onChange="pilihkota(this);" id="origin">
                    <option value="<?=$address['city_id']?>" selected="" disabled="">Pilih Kota</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12 col-xs-12">
                <div class="col-md-12  col-xs-12">
                  <textarea class="form-control" name="alamat_drop" id="alamat_drop" type="text" placeholder="Alamat Anda" rows="9" required></textarea>
                </div>
              </div>
              <div class="col-md-12  col-xs-12">
                <div class="col-md-4  col-xs-12">
                  <input class="form-control" name="rt" id="rt" type="text" placeholder="RT" required >
                </div>
             
                <div class="col-md-4  col-xs-12">
                  <input class="form-control" name="rw" id="rw" type="text" placeholder="RW" required >
                </div>
            
               
                <div class="col-md-4">
                  <input class="form-control" name="kode_pos" id="kode_pos" type="text" placeholder="Kode Pos" required >
                </div>
              </div>
              <div class="col-md-12  col-xs-12">
                <div class="col-md-12  col-xs-12">
                  <button type="button" onclick="prosesdropship()"  class="btn btn-primary pull-right"><i class="fa fa-send"></i> Ganti</button>
                   <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div> 
</div>


<div class="modal fade modalTambahpengirim" tabindex="-1" role="dialog" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         <h2 class="ui-title-block ui-title-block_small"><i class="icon fa fa-map-marker"></i>Data Pengirim </h2>
      </div>
      <div class="modal-body">
      
        <div class="row form-contact ui-form">
              <div class="col-md-12 col-xs-12">
                <div class="col-md-12 col-xs-12">
                  <input class="form-control" name="nama_pengirim" id="nm_pne" type="text" placeholder="Nama Toko" required >
                </div>
              </div>
              <div class="col-md-12 col-xs-12">
                <div class="col-md-12 col-xs-12">
                  <input class="form-control" name="no_hp_pengirim" id="no_hp_pengirim" type="text" placeholder="No HP / Telp" required >
                </div>
              </div>
             
             <!--  <div class="col-md-12 col-xs-12">
                <div class="col-md-12 col-xs-12">
                  <textarea class="form-control" name="alamat_pengirim" id="almt_pengirim" type="text" placeholder="Alamat Pengirim" rows="9" required></textarea>
                </div>
              </div> -->
             
              <div class="col-md-12 col-xs-12">
                <div class="col-md-12 col-xs-12">
                  <button type="button" onclick="prosesdropshippengirim()"  class="btn btn-primary pull-right"><i class="fa fa-send"></i> Ganti</button>
                   <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        
    </div>
  </div> 
</div>  
  
</form>
<script>
  function prosesPesan(){
    var member_id = $('#member_id').val();
    var address_name = $('#address_name').val();
    var address = $('#address_name').val();
    var province_id = $('#province_id').val();
    var city_id = $('#city_id').val();
    var kurir = $('#kurir').val();
    var service = $('#service').val();
    var id_size = $('#service').val();
    var id_stock = $('#id_stock').val();
    var cost = $('#cost').val();
    var total_price = $('#total_price').val();
    var payment = $('#payment').val();
    var weight = $('#weight').val();
    var pengambilan = $('#pengambilan').val();
    var nama_tujuan = $('#nama_tujuan').val();
    var rtt = $('#rtt').val();
    var rww = $('#rww').val();
    var kde_pos = $('#kde_pos').val();
    var no_hpp = $('#no_hpp').val();

    var nm_pengirimm =  $('#nm_pengirimm').val();
    var no_hp_pengirimm = $('#no_hp_pengirimm').val();
    var almt_pengirimm = $('#almt_pengirimm').val();
                  
   

    if( member_id ==''){
			$.growl.warning({ message: 'member_id is required'});
		}else if( address_name ==''){
			$.growl.warning({ message: 'address name is required'});
		}else if( address ==''){
			$.growl.warning({ message: 'address is required'});
		}else if( province_id ==''){
			$.growl.warning({ message: 'province is required'});
		}else if( city_id ==''){
			$.growl.warning({ message: 'city is required'});
		// }else if( kurir ==''){
		// 	$.growl.warning({ message: 'kurir is required'});
		// }else if( service ==''){
		// 	$.growl.warning({ message: 'service is required'});
		// }else if( cost ==''){
		// 	$.growl.warning({ message: 'cost is required'});
		}else if( total_price ==''){
			$.growl.warning({ message: 'total price is required'});
		// }else if( payment ==''){
		// 	$.growl.warning({ message: 'payment is required'});
		}else if( weight ==''){
			$.growl.warning({ message: 'weight is required'});
		}else if( pengambilan == 2 && kurir == ''  ){
       
         $.growl.warning({ message: 'kurir is required'});
     
    }else if ( pengambilan == 2 && cost == '') {
        $.growl.warning({ message: 'Jenis Layanan is required'});
    }
    else{
      var form = $('#my_awesome_form');
      $.ajax({
        type:"POST",
        url:"<?=base_url()?>prosesPesan",
        data: form.serialize(),
    // data:{member_id:member_id,address_name:address_name,address:address,province_id:province_id,city_id:city_id,kurir:kurir,service:service,cost:cost,total_price:total_price,payment:payment,weight:weight,pengambilan:pengambilan,no_hpp:no_hpp,kde_pos:kde_pos,rww:rww,rtt:rtt,nama_tujuan:nama_tujuan,nm_pengirimm:nm_pengirimm,no_hp_pengirimm:no_hp_pengirimm,almt_pengirimm:almt_pengirimm,id_stock:id_stock},
        cache:false,
        success:function(code){
          if(code==500){
            $.growl.warning({ message: 'Gagal memproses pesanan, Mohon mencoba lagi', duration:5000 });
          }else{
            $.growl.notice({ message: 'Pemesanan behasil, Silahkan melakukan pembayaran', duration:5000 });
             // window.location = "<?//=base_url()?>transactionCode?v="+code;
              window.location = "<?=base_url()?>detailpembayaran/"+code;
            // alert('Pemesanan behasil, Silahkan melakukan pembayaran');
          }
        },error: function (status) {
          $.growl.error({ message: status.status+' '+status.statusText, duration:5000 });
          $.growl.warning({ message: 'Refresh this page and try again', duration:5000 });
        }
      });
    }
  }


  function prosesdropship(){
    var nama_penerima = $('#nama_penerima').val();
    var no_hp = $('#no_hp').val();
    var propinsi_asal = $('#propinsi_asal').val();
    var nama_kota = $('#origin').val();
    var alamat_drop = $('#alamat_drop').val();
    var rt = $('#rt').val();
    var rw = $('#rw').val();
    var kode_pos = $('#kode_pos').val();
   
    
 
    if( nama_penerima ==''){
      $.growl.warning({ message: 'Nama Penerima is required'});
    }else if( no_hp ==''){
      $.growl.warning({ message: 'No Hp  is required'});
    }else if( propinsi_asal ==''){
      $.growl.warning({ message: ' Provinsi is required'});
    // }else if( propinsi_asal ==''){
    //   $.growl.warning({ message: 'province is required'});
    }else if( nama_kota ==''){
      $.growl.warning({ message: 'Kota is required'});
    // }else if( kurir ==''){
    //  $.growl.warning({ message: 'kurir is required'});
    // }else if( service ==''){
    //  $.growl.warning({ message: 'service is required'});
    // }else if( cost ==''){
    //  $.growl.warning({ message: 'cost is required'});
    }else if( alamat_drop ==''){
      $.growl.warning({ message: 'Alamat  is required'});
    }else if( rw ==''){
     $.growl.warning({ message: 'RW is required'});
    }else if( rt ==''){
      $.growl.warning({ message: 'RT is required'});
    }else{

      $('#address_name').val(alamat_drop);
      $('#address').val(alamat_drop);
      $('#province_id').val(propinsi_asal);
      $('#city_id').val(nama_kota);
      $('#nama_tujuan').val(nama_penerima);
      $('#rtt').val(rt);
      $('#rww').val(rw);
      $('#kde_pos').val(kode_pos);
      $('#no_hpp').val(no_hp);
      


      $('.fullname').html(nama_penerima);
      $('.phone').html(no_hp);
      $('.alamat1').html(alamat_drop);
      $('.city_get').html('');
      
      var nm = $('#nama_kota').val();
      var prov = $('#nama_prov').val();
      
      $('.alamat2').html(''+nm+','+prov+' RT : '+rt+', RW : '+rw+', Kode Pos : '+kode_pos+'');
     
      $('.modalTambah').modal('hide');
    }
  }


  function prosesdropshippengirim(){
    var nm_pne = $('#nm_pne').val();
    var no_hp_pengirim = $('#no_hp_pengirim').val();
    var almt_pengirim = $('#almt_pengirim').val();
    
    
 
    if( nm_pne ==''){
      $.growl.warning({ message: 'Nama Penerima is required'});
    }else if( no_hp_pengirim ==''){
      $.growl.warning({ message: 'No Hp  is required'});
    }else if( almt_pengirim ==''){
      $.growl.warning({ message: ' Provinsi is required'});
    // }else if( propinsi_asal ==''){
    //   $.growl.warning({ message: 'province is required'});
    }else{

      $('#nm_pengirimm').val(nm_pne);
      $('#no_hp_pengirimm').val(no_hp_pengirim);
      $('#almt_pengirimm').val(almt_pengirim);
      


      $('.nm_pengirimmm').html(nm_pne);
      $('.no_hp_pengirimmm').html(no_hp_pengirim);
      $('.almt_pengirimmm').html(almt_pengirim);
       $('.email_pengirim').html('');
      
     
      $('.modalTambahpengirim').modal('hide');
    }
  }

  function pilih_pengambilan(sel){
    // alert(sel.value)
    if (sel.value == 2) {
      $('.tbl_hidden').css('display', 'inline-table');

    }else if(sel.value == 1){
       $('.tbl_hidden').css('display', 'none');
       $('#kurir').val('cod');
       $('#service').val('cod')
       $('#cost').val('0')
       
    }
  }

  function pilihprovince(element) {
    var text1 = element.options[element.selectedIndex].text;
    $('#nama_prov').val(text1);
  
  }

  function pilihkota(element) {
    var textt = element.options[element.selectedIndex].text;
   
    $('#nama_kota').val(textt);
  }
</script>

<script>
    $(document).ready(function(){

        $("#propinsi_asal").change(function(){
         var propinsi=$('#propinsi_asal').val();
            $.ajax({
                url:"<?php echo site_url('getcity')?>",
                type:"POST",
                cache:false,
                data:"propinsi="+propinsi,
                success:function(data){
                     $('#origin').html(data);
                }
            });
                
        });
    });
</script>