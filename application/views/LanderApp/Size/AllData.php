<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-sm-12">
<div class="modal fade modalTambah" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Tambah Size</h4>
			</div>
			<div class="modal-body">
			<form action="<?=base_url()?>Admin/saveSize" class="form-horizontal" method="post" enctype="multipart/form-data" >
				<div class="row form-group">
					<label class="col-sm-2 control-label"> Size <font color="red">*</font> :</label>
					<div class="col-sm-9">
						<input type="text" name="nama_size" class="form-control" placeholder="Satuan Ukuran" autocomplete="off">
						<input type="hidden" name="action" value="tambah">
					</div>
				</div>
				<div class="row form-group">
					<label class="col-sm-2 control-label">Informasi  :</label>
					<div class="col-sm-9">
						<textarea class="form-control summernote" name="keterangan"></textarea>
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
		<h4><?=$title?> <button class="btn btn-success btn-outline faa-parent animated-hover"  data-toggle="modal" data-target=".modalTambah" data-placement="top" title="" data-loading-text="Loading..." ><i class="fa fa-plus faa-vertical"></i> Size</button></h4>
	</div>
	<div class="panel-body">
		<div class="table-Light">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="datatables">
				<thead>
					<tr>
						<th>No</th>
						<th>Size</th>
						<th>Keterangan</th>
						<th class="text-center">Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach($allData->result() as $row){ 
						?>
					<tr class="odd gradeX">
						<td><?=$no?></td>
						<td><?=$row->nama_size?></td>
						<td><?=$row->keterangan?></td>
						<td class="text-center" style="width: 30%;">
							<a href="<?=base_url().'Admin/formSize/'.paramEncrypt($row->id_size)?>" class="btn btn-success btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit <?=$row->nama_size?>"><i class="fa fa-edit faa-vertical"></i></a>							
						</td>
					</tr>
				<?php $no++; }?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="panel-footer">
		
	</div>
</div>
</div>
<script>
	init.push(function () {
		$('.datatables').dataTable();
		$('#datatables_wrapper .table-caption').text('Data Size');
		$('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
	});
</script>
