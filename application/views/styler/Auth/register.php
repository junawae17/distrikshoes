<div class="border-main">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <section class="section-area">
          <h2 class="ui-title-block ui-title-block_small"><i class="icon fa fa-user"></i>Masuk Akun Anda</h2>
          <form class="form-contact ui-form" action="<?=base_url()?>prosesLogin" method="post">
            <div class="row">
              <div class="col-md-12">
                <input class="form-control" name="username" type="text" placeholder="Username" required>
              </div>
              <div class="col-md-12">
                <input class="form-control" name="password" type="password" placeholder="Password" required>
              </div>
              <div class="col-xs-12">
                <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Masuk</button>
              </div>
            </div>
          </form>
        </section>
      </div>
      <div class="col-md-2">
      
      </div>
      
      <div class="col-md-6">
        <section class="section-area section-contacts">
          <h2 class="ui-title-block ui-title-block_small"><i class="icon fa fa-user-plus"></i>Daftar Member Baru</h2>
          <form class="form-contact ui-form" action="<?=base_url()?>prosesRegister" method="post">
            <div class="row">
              <div class="col-md-12">
                <input class="form-control" type="text" name="fullname" placeholder="Nama Lengkap" required>
              </div>
              <div class="col-md-12">
                <input class="form-control" type="text" name="namatoko" placeholder="Nama Toko" required>
              </div>
               <div class="col-md-12">
                <input class="form-control" type="text" name="email" placeholder="Email" required>
              </div>
              <div class="col-md-6">
                <input class="form-control" type="Phone" name="phone" placeholder="Phone / WA" required>
              </div>
              <div class="col-md-6">
                <input class="form-control" type="text" name="username" placeholder="Username" required>
              </div>
              <div class="col-md-6">
                <input class="form-control" type="password" name="password" placeholder="Password" required>
              </div>
              <div class="col-md-6">
                <input class="form-control" type="password" name="confirmPass" placeholder="Konfirmasi Password" required>
              </div>
              
       
          <h2 class="ui-title-block ui-title-block_small"><i class="icon fa fa-map-marker"></i>Alamat Anda / Tujuan Pengiriman </h2>
           
             
            
                <div class="col-md-6">
                  <select class="form-control" required name="province_id" id="propinsi_asal">
                      <option value="" selected="" disabled="">Pilih Provinsi</option>
                      <?php $this->load->view('rajaongkir/getProvince'); ?>
                    </select>
                </div>
                <div class="col-md-6">
                  <select class="form-control" required name="city_id" id="origin">
                    <option value="" selected="" disabled="">Pilih Kota</option>
                  </select>
                </div>
            
            
                <div class="col-md-12">
                  <textarea class="form-control" name="address" type="text" placeholder="Alamat Anda" rows="9" required></textarea>
                </div>
      
              <div class="col-xs-12">
                <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Daftar</button>
              </div>
            </div>
          </form>
          <p>* Biaya Pendaftaran Member Baru / Aktivasi  dapat di TF ke Rek : BCA 7771938250 a/n Deden Deni Saerofi
          <a href="<?php base_url() ?>pembayaran">Pembayaran</a>
          </p>
        </section>
      </div>
    </div>
  </div>
</div>

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