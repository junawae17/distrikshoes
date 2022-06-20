<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-sm-12">
<div class="modal fade modalTambah" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Transaksi</h4>
			</div>
			<div class="modal-body">
			<form action="<?=base_url()?>Admin/saveTransaksi" class="form-horizontal" method="post" enctype="multipart/form-data" >
				<div class="row form-group">
					<label class="col-sm-2 control-label">Nama Produk <font color="red">*</font> :</label>
					<div class="col-sm-9">
						<input type="text" name="product_name" class="form-control"  id="propinsi_asal" placeholder="Nama produk" autocomplete="off">
						<input type="hidden" name="action" value="tambah">
					</div>
				</div>
				
				<hr>
				
				<div class="row form-group">
					<label class="col-sm-2 control-label">Size <font color="red">*</font> :</label>
					<div class="col-sm-3">
						<?php $size = $this->M__db->get_select('msize__','id_size,nama_size')->result();?>
						<select name="id_size[]" class="form-control">
							<?php foreach ($size as $dt) { ?>
								<option value="<?=$dt->id_size;?>"><?=$dt->nama_size;?></option>
							<?php } ?>
						</select>
					</div>

					<label class="col-sm-2 control-label">Stock <font color="red">*</font> :</label>
					<div class="col-sm-3">
						<input type="number" name="stock[]" class="form-control" placeholder="Stok produk" autocomplete="off">
					</div>
					<div class="col-sm-1">
						<span onclick="addstock()" class="btn btn-success faa-parent animated-hover" data-toggle="tooltip" data-placement="top" title="" data-original-title="Simpan Stock Baru"><i class="fa fa-plus faa-vertical"></i></span>
					</div>
				</div>
				<!-- <div class="row form-group">
					<label class="col-sm-2 control-label">Stokkk <font color="red">*</font> :</label>
					<div class="col-sm-9">
						<input type="number" name="stock[]" class="form-control" placeholder="Stok produk" autocomplete="off">
					</div>
				</div> -->
				<!-- <div id="addsize"></div> -->
				<div id="addsize"></div>
				<hr>
			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success btn-rounded faa-parent animated-hover" data-toggle="tooltip" data-placement="top" title="" data-original-title="Simpan <?=$title?> Baru"><i class="fa fa-plus faa-vertical"></i> Simpan</button>
			</div>
			</form>			
		</div>
	</div> 
</div>

<div class="panel">
	<div class="panel-heading">
		<h4><?=$title?> <button class="btn btn-success btn-outline faa-parent animated-hover"  data-toggle="modal" data-target=".modalTambah" data-placement="top" title="" data-loading-text="Loading..." ><i class="fa fa-plus faa-vertical"></i> Transaksi</button></h4>
	</div>
	<div class="panel-body">
		<div class="table-Light">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="datatables">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Transaksi </th>
						<th>Tanggal </th>
						<th>Pengirim </th>
						<th>Penerima</th>
						<th>Kurir</th>
						<th>Barang</th>
						<th>Total Harga</th>
					<!-- 	<th>Total Bayar</th> -->
						<th>Status Pembayaran</th>
						<th>Status Pengiriman</th>
						<th>Status Transaksi</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($allData->result() as $row){ 

						$databarang = $this->db->query("SELECT b.product_id,b.product_name FROM detail_transaction__ as a 
													LEFT JOIN product__ as b on b.product_id = a.product_id 
													LEFT JOIN msize__ as c on c.id_size = a.id_size
													where transaction_id = ".$row->transaction_id." group BY product_id,product_name ")->result();
						$data_stock = count($databarang) ;
						$noo = 1;
						// foreach ($databarang as $key => $value) {
						// $data_stock .= " ".$noo++.". ".$value->product_name."<br>";
						
						// }
					?>
					
					<tr class="odd gradeX">
						<td><?=$no?></td>
						<td><?=$row->transaction_code?></td>
						<td><?=date('d-M-Y H:i:s', strtotime($row->created_date))?></td>
						<td><?=$row->nama_pengirim?> <?=$row->no_hp_pengirim?> <?=$row->alamat_pengirim?></td>
						<td><?=$row->nama_tujuan?> <?=$row->no_hp?> <?=$row->alamat_tujuan?></td>
						
						 <td> <?php if (empty($row->kurir)) { ?>
						 	COD
						 		<?php }else{ ?>
									<?=$row->kurir?>  <?=$row->service?>  <?=currency($row->cost)?>
								<?php } ?>
						 
						 	
						 </td>
						<td><?php echo $data_stock ;?>
						    <button class="btn btn-default btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-loading-text="Loading..."  data-original-title="Detail Stock" onclick="loadEdit(<?=$row->transaction_id?>,'detail')"><i class="fa fa-eye faa-vertical"></i></button>
							
						</td>
						<td><?=currency($row->total_price)?> <br>
							<?=$row->kurir?>  <?=$row->service?>  <?=currency($row->cost)?><br>
							 <b><?=currency($row->payment)?></b>
						</td>
						<!-- <td>
							
						</td> -->
						<td class="text-center">
							<?php if($row->status==1){ ?>
								<a href="<?=base_url().'Admin/statusPembayaran/'.$row->transaction_id.'/2'?>" class="label label-primary">Unpaid</a>
							<?php }else{ ?>
								<a href="<?=base_url().'Admin/statusPembayaran/'.$row->transaction_id.'/1'?>" class="label label-warning">Paid</a>
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

												<a href="#" class=""  data-toggle="modal" data-target=".<?='images_'.$row->transaction_id?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Lihat Gambar Produk"><img src="<?=base_url()?>assets/uploads/buktitf/<?=$key?>" width="20%"></a>
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
								<a href="<?=base_url().'Admin/statusPengiriman/'.$row->transaction_id.'/2'?>" class="label label-secondary">Not delive</a>
							<?php }else{ ?>
								<a href="<?=base_url().'Admin/statusPengiriman/'.$row->transaction_id.'/1'?>" class="label label-success">Delivered</a>
							<?php }?>
								<button class="btn btn-default btn-sm btn-outline faa-parent animated-hover"  data-toggle="modal" data-target=".modalTambahresi" onclick="clickbukti(<?=$row->transaction_id?>)"  data-placement="top" title="" data-loading-text="Loading..."  data-original-title="Detail Stock" ><i class="fa fa-upload faa-vertical"></i>  Resi</button>
								<i><?php echo $row->no_resi ? 'NoResi: '.$row->no_resi.'' : NULL; ?></i>
						</td>
						<td class="text-center">
							<?php if($row->status_transaksi==1){ ?>
								<a href="<?=base_url().'Admin/statusTransaksi/'.$row->transaction_id.'/2'?>" style="background-color: orange;" class="label ">Prosses</a>
							<?php }else if($row->status_transaksi==2){ ?>
								<a href="<?=base_url().'Admin/statusTransaksi/'.$row->transaction_id.'/1'?>" class="label label-info">Selesai</a>
							<?php }else if($row->status_transaksi==3){ ?>
								<a href="<?=base_url().'Admin/statusTransaksi/'.$row->transaction_id.'/1'?>" class="label label-danger">Cancel</a>
							<?php }else if($row->status_transaksi==4){ ?>
								<a href="<?=base_url().'Admin/statusTransaksi/'.$row->transaction_id.'/1'?>" class="label label-danger">Refund</a>
							<?php }?>
						</td>
						<td class="text-center" >
						<!-- 	<a href="<?=base_url().'Admin/formProduct/'.paramEncrypt($row->transaction_id)?>" class="btn btn-success btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit "><i class="fa fa-edit faa-vertical"></i></a>	 -->
							<a href="<?=base_url().'Admin/printalamat/'.paramEncrypt($row->transaction_id)?>" class="btn btn-success btn-sm btn-outline faa-parent animated-hover" target="_blank" ><i class="fa fa-print faa-vertical"></i></a>							
						</td>
					</tr>
				<?php $no++; }?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="panel-footer">
		<div class="text-center">Keterangan : 
			<button class="btn btn-default btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-loading-text="Loading..."  data-original-title="Detail Data" ><i class="fa fa-eye faa-vertical"></i> Detail Data</button>
			<button class="btn btn-success btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data"><i class="fa fa-edit faa-vertical"></i> Edit Data</button>
		</div>
	</div>
</div>
</div>
<div class="modal fade modalstock" id="modalcancelinfo"  tabindex="-1" role="dialog" style="display: none;">
	<div id="tampil-box"></div>
</div>


<div class="modal fade modalTambahresi" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Upload  Resi</h4>
			</div>
			<div class="modal-body">
			<form action="<?=base_url()?>UploadResi" class="form-horizontal" method="post" enctype="multipart/form-data" >
				<input type="hidden" name="id_transaction" id="id_transaction" value="">
				<input type="hidden" name="action" id="id_transaction" value="update">
				<div class="row form-group">
					<label class="col-sm-2 control-label">No Resi  :</label>
					<div class="col-sm-7">
						<input type="text" name="resi" class="form-control ">
					</div>
				</div>
				<div class="row form-group">
					<label class="col-sm-2 control-label">Gambar Resi  :</label>
					<div class="col-sm-7">
						<input type="file" name="images[]" class="form-control upload-file" autocomplete="off"  accept="image/*">
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
          url:"<?=base_url()?>TransaksiCTRL/loadData",
          data:{id:id, action:action},
          cache:false,
          success:function(a){
          	$('#modalcancelinfo').modal('show');
            $('#tampil-box').html(a);
          }
        });
	}
</script>

<script>
	init.push(function () {
		$('.datatables').dataTable();
		$('#datatables_wrapper .table-caption').text('Data Produk');
		$('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
	});
</script>

<script>
function addImages() {
    $('#add').append('<div class="row form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-7"><input type="file" name="images[]" class="form-control upload-file" autocomplete="off"  accept="image/*"></div></div>');
	$('.upload-file').pixelFileInput({ placeholder: 'No file selected...' });
}

function addstock() {

	$('#addsize').append('<div class="row form-group"><label class="col-sm-2 control-label">Size <font color="red">*</font> :</label><div class="col-sm-3"><?php $size = $this->M__db->get_select('msize__','id_size,nama_size')->result();?><select name="id_size[]" class="form-control"><?php foreach ($size as $dt) { ?><option value="<?=$dt->id_size;?>"><?=$dt->nama_size;?></option><?php } ?></select></div><label class="col-sm-2 control-label">Stock <font color="red">*</font> :</label><div class="col-sm-3"><input type="number" name="stock[]" class="form-control" placeholder="Stok produk" autocomplete="off"></div></div>');

    // $('#addstock').append('<div class="row form-group"><label class="col-sm-2 control-label">Stokkk <font color="red">*</font> :</label><div class="col-sm-9"><input type="number" name="stock[]" class="form-control" placeholder="Stok produk" autocomplete="off"></div></div>');

}

function clickbukti(id) {
		
		$("#id_transaction").val(id);
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