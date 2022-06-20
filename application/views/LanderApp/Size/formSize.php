<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="col-sm-12">
<div class="modal fade modalUpdate" tabindex="-1" role="dialog" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Update Size</h4>
			</div>
			<div class="modal-body">
			<form action="<?=base_url()?>Admin/saveSize" class="form-horizontal" method="post" enctype="multipart/form-data" >
				<div class="row form-group">
					<label class="col-sm-2 control-label"> Size <font color="red">*</font> :</label>
					<div class="col-sm-9">
						<input type="text" name="nama_size" class="form-control" placeholder="Satuan Ukuran" autocomplete="off" value="<?=$rows['nama_size']?>">
						<input type="hidden" name="id_size" value="<?=$rows['id_size']?>">
						
						<input type="hidden" name="action" value="update">
					</div>
				</div>
			
				<div class="row form-group">
					<label class="col-sm-2 control-label">keterangan  :</label>
					<div class="col-sm-9">
						<textarea class="form-control summernote" name="keterangan"><?=$rows['keterangan']?></textarea>
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
				<button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success btn-rounded faa-parent animated-hover" data-toggle="tooltip" data-placement="top" title="" data-original-title="Simpan <?=$title?> Baru"><i class="fa fa-edit faa-vertical"></i> Simpan</button>
			</div>
			</form>			
		</div>
	</div> 
</div>

<div class="panel">
	<div class="panel-heading">
		<span class="panel-title" >Data Size <button class="btn btn-success btn-sm btn-outline faa-parent animated-hover" data-toggle="modal" data-target=".modalUpdate" data-placement="top" title="" data-loading-text="Loading..."><i class="fa fa-edit faa-vertical"></i></button></span>
		<div class="panel-heading-controls">
			<a href="<?=base_url()?>Admin/Size" class="btn btn-xs btn-default btn-outline faa-parent animated-hover"><span class="fa fa-arrow-left faa-horizontal"></span>&nbsp;&nbsp;Kembali</a>
			<button class="btn btn-xs btn-success btn-sm btn-outline faa-parent animated-hover" data-toggle="modal" data-target=".modalUpdate" data-placement="top" title="" data-loading-text="Loading..."><i class="fa fa-edit faa-vertical"></i> Edit data</button>
		</div>
	</div>
	<div class="panel-body">
		<table class="table table-bordered">
			<tbody>
			
				<tr>
					<th>Satuan Ukuran</th>
					<td><?=$rows['nama_size']?></td>
				</tr>
				<tr>
					<th>Keterangan</th>
					<td><?=$rows['keterangan']?></td>
				</tr>
				<tr>
					<th>Terakhir merubah</th>
					<td><?php $modifiedBy = $this->db->where('user_id', $rows['modified_by'])->get('users__')->row_array(); echo $modifiedBy['fullname']?></td>
				</tr>
				
				<tr>
					<th>Perubahan terakhir</th>
					<td><?=date_format(date_create($rows['modified_date']),"d M Y H:i:s")?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="panel-footer">
		<div class="text-center">Keterangan : 
			<button class="btn btn-success btn-sm btn-outline faa-parent animated-hover"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data"><i class="fa fa-edit faa-vertical"></i> Edit Data</button>
		</div>
	</div>
</div>
</div>
<script>
function addImages() {
    $('#add').append('<div class="row form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-7"><input type="file" name="images[]" class="form-control upload-file" autocomplete="off"  accept="image/*"></div></div>');
	$('.upload-file').pixelFileInput({ placeholder: 'No file selected...' });
}
</script>