	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Update Stock</h4>
			</div>
			<div class="modal-body">
				<div class="row form-group">
					<table class="table">
						<?php
							$total_stock = $this->db->query(" select * FROM datastock__ LEFT JOIN msize__ on msize__.id_size = datastock__.id_size where product_id = ".$id_product." and status_stock = 1 ")->result();
							$data_stock = NULL;
						foreach ($total_stock as $key => $value) { ?>

						<tr class="odd gradeX">
							<td>Size </td>
							<td>: </td>
							<td><?php echo $value->nama_size ?> </td>
							<td></td>
						</tr>
												
						<?php }
							$total_st = count($total_stock);
						?> 
						<tr>
							<td>Total Stock</td>
							<td>:</td>
							<td><b><?php echo $total_st ?></b></td>
							<td></td>
						</tr>
					</table>
					<table class="table">
					<?php
							$datatransaction = $this->db->query(" select * FROM detail_transaction__  where product_id = ".$id_product." and status = 1 ")->result();
							$data_stock = NULL;
							$amount = NULL ;
						foreach ($datatransaction as $keyy => $valuee) { ?>

						<tr class="odd gradeX">
							<td>Size </td>
							<td>: </td>
							<td><?php echo $valuee->nama_size ?> </td>
							<td><?php echo $valuee->amount ?> </td>
						</tr>
												
						<?php $amount += $valuee->amount; }
							$data_stock = count($amount);
						?> 
						<tr>
							<td>Total Stock</td>
							<td>:</td>
							<td><b><?php echo $amount ?></b></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>	 	
		</div>
	</div> 