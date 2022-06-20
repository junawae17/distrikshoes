<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-sm-12">
<div class="modal fade modalTambah" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Produk</h4>
			</div>
			<div class="modal-body">
			<form action="<?=base_url()?>Admin/saveProduct" class="form-horizontal" method="post" enctype="multipart/form-data" >
				<div class="row form-group">
					<label class="col-sm-2 control-label">Nama Produk <font color="red">*</font> :</label>
					<div class="col-sm-9">
						<input type="text" name="product_name" class="form-control" placeholder="Nama produk" autocomplete="off">
						<input type="hidden" name="action" value="tambah">
					</div>
				</div>
				<div class="row form-group">
					<label class="col-sm-2 control-label">Harga <font color="red">*</font> :</label>
					<div class="col-sm-9">
						<input type="number" name="price" class="form-control" placeholder="Harga produk" autocomplete="off">
					</div>
				</div>
				<div class="row form-group">
					<label class="col-sm-2 control-label">Berat (gram) <font color="red">*</font> :</label>
					<div class="col-sm-9">
						<input type="number" name="weight" class="form-control" placeholder="Berat produk (gram)" autocomplete="off">
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
				<div class="row form-group">
					<label class="col-sm-2 control-label">Kategori <font color="red">*</font> :</label>
					<div class="col-sm-9">
						<?php $category = $this->M__db->get_select('category__','category_id,category_name')->result();?>
						<select name="category_id" class="form-control">
							<?php foreach ($category as $key) { ?>
								<option value="<?=$key->category_id;?>"><?=$key->category_name;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-sm-2 control-label">Gambar Produk :</label>
					<div class="col-sm-7">
						<input type="file" name="images[]" class="form-control upload-file" autocomplete="off"  accept="image/*">
					</div>
					<div class="col-sm-1">
						<span onclick="addImages()" class="btn btn-success faa-parent animated-hover" data-toggle="tooltip" data-placement="top" title="" data-original-title="Simpan Gambar Baru"><i class="fa fa-plus faa-vertical"></i></span>
					</div>
				</div>
				<div id="add"></div>
				<div class="row form-group">
					<label class="col-sm-2 control-label">Informasi <font color="red">*</font> :</label>
					<div class="col-sm-9">
						<textarea class="form-control summernote" name="information"></textarea>
					</div>
				</div>
				<div class="row form-group">
					<label class="col-sm-2 control-label">&nbsp;</label>
					<div class="col-sm-9">
							<font color="red">*</font> : Wajib diisi 
					</div>
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

<div class="panel">
	<div class="panel-heading">
		<h4><?=$title?> <button class="btn btn-success btn-outline faa-parent animated-hover"  data-toggle="modal" data-target=".modalTambah" data-placement="top" title="" data-loading-text="Loading..." ><i class="fa fa-plus faa-vertical"></i> Produk</button></h4>
	</div>
	<div class="panel-body">
		<div class="table-Light">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="datatables">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Kategori</th>
						<th>Harga</th>
						<th>Stok</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($allData->result() as $row){ 
					$total_stock = $this->db->query(" select * FROM datastock__ LEFT JOIN msize__ on msize__.id_size = datastock__.id_size where product_id = ".$row->product_id."  ")->result();
					$data_stock = NULL;
					$total_st = 0;
					foreach ($total_stock as $key => $value) {
						$data_stock .= "
								Size : ".$value->nama_size."<br>
						";
						// $total_st += $value->stock;


					}
					$total_st  = count($total_stock);

					$total_transak = $this->db->query(" select sum(amount) as hasil, transaction__.status FROM detail_transaction__ LEFT JOIN transaction__ on transaction__.transaction_id = detail_transaction__.transaction_id where product_id = ".$row->product_id." and transaction__.status = 2 ")->row();
					$total_transaksi = $total_transak->hasil;
					$total_stock_all = $total_st - $total_transaksi;

						$kategori = $this->db->where('category_id', $row->category_id)->get('category__')->row_array()?>
					<tr class="odd gradeX">
						<td><?=$no?></td>
						<td><?=$row->product_name?></td>
						<td><?=$kategori['category_name']?></td>
						<td><?=currency($row->price)?></td>
						<td><?//=$data_stock  ?><?='Total Stock : '.$total_stock_all?>
							<button class="btn btn-default btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-loading-text="Loading..."  data-original-title="Detail Stock" onclick="loadEdit(<?=$row->product_id?>,'detail')"><i class="fa fa-eye faa-vertical"></i></button>
						</td>
						<td class="text-center">
							<?php if($row->is_active==1){ ?>
								<a href="<?=base_url().'Admin/statusProduct/'.$row->product_id.'/0'?>" class="label label-info">Aktif</a>
							<?php }else{ ?>
								<a href="<?=base_url().'Admin/statusProduct/'.$row->product_id.'/1'?>"class="label label-danger">Nonaktif</a>
							<?php }?>
						</td>
						<td class="text-center" >
							<a href="<?=base_url().'Admin/formProduct/'.paramEncrypt($row->product_id)?>" class="btn btn-success btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit <?=$row->product_name?>"><i class="fa fa-edit faa-vertical"></i></a>							
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

<script>
	function loadEdit(id,action){
		$.ajax({
          type:"POST",
          url:"<?=base_url()?>ProductCTRL/loadData",
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
</script>