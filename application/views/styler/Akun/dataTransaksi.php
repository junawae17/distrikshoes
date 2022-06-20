<div class="border-main">
	
	<div class="container">
 <h3 style="text-align:center;">Data Transaksi</h3>
		<div class="table-Light hidden-xs hidden-sm">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="datatables">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Transaksi </th>
						<th>Date</th>
						<th>Nama Tujuan</th>
						<th>Kurir</th>
						<th>Barang</th>
						<th>Total Harga</th>
						<th>Total Bayar</th>
						<th>Status Pembayaran</th>
						<th>Status Pengiriman</th>
						<th>Status Transaksi</th>
				<!-- 		<th>Opsi</th> -->
					</tr>
				</thead>
				<?php if (!empty($allData->result() )) { ?>
					<tbody>
					<?php $no=1; foreach($allData->result() as $row){ 

						$databarang = $this->db->query("SELECT b.product_id,b.product_name FROM detail_transaction__ as a 
													LEFT JOIN product__ as b on b.product_id = a.product_id 
													LEFT JOIN msize__ as c on c.id_size = a.id_size
													where transaction_id = ".$row->transaction_id." group BY product_id,product_name ")->result();
						$data_stock = NULL;
						$noo = 1;
						foreach ($databarang as $key => $value) {
						$data_stock .= " ".$noo++.". ".$value->product_name."<br>";
						
						}
					?>
					
					<tr class="odd gradeX">
						<td><?=$no?></td>
						<td><?=$row->transaction_code?> </td>
						<td><?=$row->created_date?> </td>
						<td><?php if ($row->kurir == 'Cod') { ?>
							<?=$row->nama_toko?>
						<?php }else{ ?>
							<?=$row->nama_tujuan?>
						<?php	} ?> </td>
						
						<td><?=$row->kurir?>  <?=$row->service?>  <?=currency($row->cost)?></td>
						<td><?php echo $data_stock ;?>
						    <button class="btn btn-default btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-loading-text="Loading..."  data-original-title="Detail Stock" onclick="loadEdit(<?=$row->transaction_id?>,'detail')"><i class="fa fa-eye faa-vertical"></i></button>
							
						</td>
						<td><?=currency($row->total_price)?></td>
						<td><?=currency($row->payment)?>
							
						</td>
						<td class="text-center">
							<?php if($row->status==1 and $row->status_transaksi ==1){ ?>

							<a href="<?=base_url().'detailpembayaran/'.paramEncrypt($row->transaction_id);?>">Detail Pembayaran</a>
								<a href="#" class="label label-primary">Unpaid</a>
								<button class="btn btn-default btn-sm btn-outline faa-parent animated-hover"  data-toggle="modal" data-target=".modalTambah" onclick="clickbukti(<?=$row->transaction_id?>)"  data-placement="top" title="" data-loading-text="Loading..."  data-original-title="Detail Stock" ><i class="fa fa-upload faa-vertical"></i> Bukti Transfer</button>
							<?php }else if($row->status==1 and $row->status_transaksi ==3){ ?>
								<a href="#" class="label label-danger">UnPaid</a>
								Waktu batas pembayaran telah habis 
							<?php }else{ ?>
								<a href="#" class="label label-warning">Paid</a>
							<?php	} ?>

							<?php  $databuktitf = $this->db->query("SELECT * from buktitf__ where id_transaction = ".$row->transaction_id." ")->result();
								if (!empty($databuktitf)) {
									$noId=0;
									$noIdd=0;
									foreach ($databuktitf as $keyy => $val) {

										$images = explode(',',$val->images_bukti); ;
										if($images[0]!=null){
											foreach ($images as $te => $key) { 
							?>

												<a href="#" class=""  data-toggle="modal" data-target=".<?='images_'.$row->transaction_id?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lihat Gambar Produk"><img src="<?=base_url()?>assets/uploads/buktitf/<?=$key?>" width="10%"></a>
												<?php if ($row->status_pengiriman == '1') { ?>
														<a class=""  data-toggle="modal" data-target=".modalTambah" onclick="clickbukti(<?=$row->transaction_id?>,1)"  data-placement="top" title="" data-loading-text="Loading..."   ><i class="fa fa-pencil"></i></a>
												<?php } ?>
											
												<div class="modal fade <?='images_'.$row->transaction_id?>" tabindex="-1" role="dialog" style="display: none;">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																<h4 class="modal-title text-center"><?=$key?></h4>
															</div>
															<div class="modal-body text-center">
																<img src="<?=base_url()?>assets/uploads/buktitf/<?=$key?>" width="80%">
															</div>
															<div class="modal-footer text-center">
																<button type="button" class="btn btn-outline btn-default" data-dismiss="modal">Close</button>
																
															</div>
														</div>
													</div>
												</div>
							<?php		$noId++;
											}
										}
									}

								}

							 ?>
						</td>
						<td class="text-center">
							<?php if($row->status_pengiriman==1){ ?>
								<a href="#" style="background-color: gray;" class="label label-secondary">Not delive</a>
							<?php }else{ ?>
								<a href="#" class="label label-success">Delivered</a>
							<?php }?>
							<br>
							<?php echo $row->no_resi ? $row->no_resi  : NULL ?>
							<?php if (!empty($row->gambar_resi)) { ?> 
							<a href="<?=base_url().'/assets/uploads/dataresi/'.$row->gambar_resi?>" target="_blank">	<img src="<?php echo base_url().'/assets/uploads/dataresi/'.$row->gambar_resi;?>" width="20%"></a>
							<?php } ?>
						</td>
						<td class="text-center">
							<?php if($row->status_transaksi==1){ ?>
								<a href="#" style="background-color: orange;" class="label ">Prosses</a>
							<?php }else if($row->status_transaksi==2){ ?>
								<a href="#" class="label label-info">Selesai</a>
							<?php }else if($row->status_transaksi==3){ ?>
								<a  href="#" class="label label-danger">Cancel</a>
							<?php }else if($row->status_transaksi==4){ ?>
								<a  href="#" class="label label-danger">Refund</a>
							<?php }?>
						</td>
						</td>
						<!-- <td class="text-center" >
							<a href="<?=base_url().'TransaksiCTRL/formProduct/'.paramEncrypt($row->transaction_id)?>" class="btn btn-success btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit "><i class="fa fa-edit faa-vertical"></i></a>							
						</td> -->
					</tr>
				<?php $no++; }?>
				</tbody>
				<?php }else{ ?>
					<tr class="">
						<td colspan="11" align="center" style="font-size: 20px;font-weight: bold;">Data Transaksi Belum Ada</td>
					</tr>
				<?php } ?>
				
			</table>
		</div>
		<div class="table-Light hidden-md hidden-lg">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="datatables">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Transaksi </th>
						<th>Status Pembayaran</th>
						<th>Status Pengiriman</th>
						<th>Status Transaksi</th>
				<!-- 		<th>Opsi</th> -->
					</tr>
				</thead>
				<?php if (!empty($allData->result() )) { ?>
					<tbody>
					<?php $no=1; foreach($allData->result() as $row){ 

						$databarang = $this->db->query("SELECT b.product_id,b.product_name FROM detail_transaction__ as a 
													LEFT JOIN product__ as b on b.product_id = a.product_id 
													LEFT JOIN msize__ as c on c.id_size = a.id_size
													where transaction_id = ".$row->transaction_id." group BY product_id,product_name ")->result();
						$data_stock = NULL;
						$noo = 1;
						foreach ($databarang as $key => $value) {
						$data_stock .= " ".$noo++.". ".$value->product_name."<br>";
						
						}
					?>
					
					<tr class="odd gradeX">
						<td><?=$no?></td>
						<td><?=$row->transaction_code?><br><?php echo $data_stock ;?>
						    <button class="btn btn-default btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-loading-text="Loading..."  data-original-title="Detail Stock" onclick="loadEdit(<?=$row->transaction_id?>,'detail')"><i class="fa fa-eye faa-vertical"></i></button> </td>
					
					
										
						<td class="text-center">
							<?php if($row->status==1){ ?>
								<a href="#" class="label label-primary">Unpaid</a>
								<button class="btn btn-sm  faa-parent animated-hover"  data-toggle="modal" data-target=".modalTambah" onclick="clickbukti(<?=$row->transaction_id?>)"  data-placement="top" title="" data-loading-text="Loading..."  data-original-title="Detail Stock" ><i class="fa fa-upload faa-vertical"></i> Bukti TF</button>
							<?php }else{ ?>
								<a href="#" class="label label-warning">Paid</a>
							<?php }?>
							<?php  $databuktitf = $this->db->query("SELECT * from buktitf__ where id_transaction = ".$row->transaction_id." ")->result();
								if (!empty($databuktitf)) {
									$noId=0;
									$noIdd=0;
									foreach ($databuktitf as $keyy => $val) {

										$images = explode(',',$val->images_bukti); ;
										if($images[0]!=null){
											foreach ($images as $te => $key) { 
							?>

												<a href="#" class=""  data-toggle="modal" data-target=".<?='images_'.$row->transaction_id?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lihat Gambar Produk"><img src="<?=base_url()?>assets/uploads/buktitf/<?=$key?>" width="10%"></a>
												<div class="modal fade <?='images_'.$row->transaction_id?>" tabindex="-1" role="dialog" style="display: none;">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																<h4 class="modal-title text-center"><?=$key?></h4>
															</div>
															<div class="modal-body text-center">
																<img src="<?=base_url()?>assets/uploads/buktitf/<?=$key?>" width="80%">
															</div>
															<div class="modal-footer text-center">
																<button type="button" class="btn btn-outline btn-default" data-dismiss="modal">Close</button>
																
															</div>
														</div>
													</div>
												</div>
							<?php		$noId++;
											}
										}
									}

								}

							 ?>
						</td>
						<td class="text-center">
							<?php if($row->status_pengiriman==1){ ?>
								<a href="#" class="label label-secondary">Not delive</a>
							<?php }else{ ?>
								<a href="#" class="label label-success">Deliv</a>
							<?php }?>
							<br>
							<?php echo $row->no_resi ? $row->no_resi  : NULL ?>
							<?php if (!empty($row->gambar_resi)) { ?> 
							<a href="<?=base_url().'/assets/uploads/dataresi/'.$row->gambar_resi?>" target="_blank">	<img src="<?php echo base_url().'/assets/uploads/dataresi/'.$row->gambar_resi;?>" width="20%"></a>
							<?php } ?>
						</td>
						<td class="text-center">
							<?php if($row->status_transaksi==1){ ?>
								<a href="#" class="label label-danger">Prosses</a>
							<?php }else if($row->status_transaksi==2){ ?>
								<a href="#" class="label label-info">Selesai</a>
							<?php }else if($row->status_transaksi==3){ ?>
								<a  href="#" class="label label-danger">Cancel</a>
							<?php }else if($row->status_transaksi==4){ ?>
								<a  href="#" class="label label-danger">Refund</a>
							<?php }?>
						</td>
						</td>
						
					</tr>
				<?php $no++; }?>
				</tbody>
				<?php }else{ ?>
					<tr class="">
						<td colspan="11" align="center" style="font-size: 20px;font-weight: bold;">Data Transaksi Belum Ada</td>
					</tr>
				<?php } ?>
				
			</table>
		</div>
	</div>
	<div class="panel-footer">
		
	</div>
</div>
<div class="modal fade modalstock" id="modalcancelinfo"  tabindex="-1" role="dialog" style="display: none;">
	<div id="tampil-box"></div>
</div>

<div class="modal fade modalTambah" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Upload Bukti Transfer</h4>
			</div>
			<div class="modal-body">
			<form action="<?=base_url()?>UploadBukti" class="form-horizontal" method="post" enctype="multipart/form-data" >
				<input type="hidden" name="id_transaction" id="id_transaction" value="">
				<input type="hidden" name="action" id="action" value="">
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
	function loadEdit(id,action){
		$.ajax({
          type:"POST",
          url:"<?=base_url()?>AccountCTRL/loadData",
          data:{id:id, action:action},
          cache:false,
          success:function(a){
          	$('#modalcancelinfo').modal('show');
            $('#tampil-box').html(a);
          }
        });
	}

	function clickbukti(id,param) {
		
		$("#id_transaction").val(id);
		if (param == 1) {
			$("#action").val('update');
		}
		
	}
</script>

<script>
	init.push(function () {
		$('.datatables').dataTable();
		$('#datatables_wrapper .table-caption').text('Data Produk');
		$('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
	});

	function addImages() {
    $('#add').append('<div class="row form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-7"><input type="file" name="images[]" class="form-control upload-file" autocomplete="off"  accept="image/*"></div></div>');
	$('.upload-file').pixelFileInput({ placeholder: 'No file selected...' });
	}
</script>