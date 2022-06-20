
<div class="container">
  <div class="row">
  	<p class="col-md-12 col-xs-12" style="font-size: 13px;"><b> Selesaikan Pembayaran</b></p>
  	<div class="col-md-12 col-xs-12" style="border-bottom: 1px solid #dbd8d0">
	  	<span class="col-md-6 col-xs-6">REKENING BCA </span>
	  	<span class="col-md-6 col-xs-6 pull-right" ><img class="pull-right" src="<?php echo base_url()?>assets/uploads/bca.png" width="30%"></span> 
	  	<br><br>
  	</div>
  	<div class="col-md-12  col-xs-12" style="border-bottom: 1px solid #dbd8d0">
  			<span class="col-md-6 col-xs-6"><p>Nomor Rekening  Account</p><p style="font-weight: bold;"><input type="text" value="7771938250" id="salin" readonly="" style="border:none;"> a/n Deden Deni Saerofi</p> </span>
  			<span class="col-md-6 col-xs-6 "><span class="pull-right" style="color:green;"><br><br><button  onclick="salinn()" class="">salin</button></span></span>
  	</div>
  	<div class="col-md-12  col-xs-12" style="border-bottom: 1px solid #dbd8d0">
  			<span class="col-md-12 col-xs-12">
  			<p>Total Pembayaran</p>
  			<p><span style="color:orange;font-weight: bold;">Rp.100.000</span></p>
  			</span>
  			
  	</div>
  </div>
  <div class="row">
  	<div class="col-md-12 col-xs-12" style="text-align: center;">
  		<p>User anda akan aktif setelah pembayaran terverifikasi</p>

  		<p>Upload Bukti Transfer</p>
  		<p><button class="btn btn-default btn-sm btn-outline faa-parent animated-hover"  data-toggle="modal" data-target=".modalTambah"  data-placement="top" title="" data-loading-text="Loading..."  data-original-title="Upload bukti Transfer" ><i class="fa fa-upload faa-vertical"></i>Upload</button></p>
  	</div>
  </div>
</div>


<div class="modal fade modalTambah" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Upload Bukti Transfer</h4>
			</div>
			<div class="modal-body">
			<form action="<?=base_url()?>UploadBuktidaftar" class="form-horizontal" method="post" enctype="multipart/form-data" >
				<input type="hidden" name="id_transaction" id="id_transaction" value="">
				<div class="row form-group">
					<label class="col-sm-2 control-label">Gambar Bukti Transfer  :</label>
					<div class="col-sm-7">
						<input type="file" name="images[]" class="form-control upload-file" autocomplete="off"  accept="image/*">
					</div>
					<div class="col-sm-1">
						<span onclick="addImages()" class="btn btn-success faa-parent animated-hover" data-toggle="tooltip" data-placement="top" title="" data-original-title="Simpan Gambar Baru"><i class="fa fa-plus faa-vertical"></i></span>
					</div>
				</div>
				<div id="add"></div>
				<div class="row form-group">
						<label class="col-sm-2 col-md-2 control-label">* Nama User :</label>
				
				<div class="col-sm-5 col-md-5">
						<input type="text" name="nama_user" class="form-control ">
				</div>		
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success btn-rounded faa-parent animated-hover" data-toggle="tooltip" data-placement="top" title="" data-original-title="Simpan <?=$title?> Baru"><i class="fa fa-plus faa-vertical"></i> Simpan</button>
			</div>
			</form>			
		</div>
	</div> 
</div>

<script>
	

	function addImages() {
    $('#add').append('<div class="row form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-7"><input type="file" name="images[]" class="form-control upload-file" autocomplete="off"  accept="image/*"></div></div>');
	$('.upload-file').pixelFileInput({ placeholder: 'No file selected...' });
	}

	function salinn() {
	  /* Get the text field */
	 var copyText = document.getElementById("salin");

	  /* Select the text field */
	  copyText.select();
	  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

	  /* Copy the text inside the text field */
	  document.execCommand("copy");
	   
	}
</script>