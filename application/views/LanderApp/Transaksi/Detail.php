	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Detail Transaksi Barang </h4>
			</div>
			<div class="modal-body">
				<div class="row form-group">
					<table class='table table-bordered'>
					<thead> <tr>
						     		<th>No</th><th>pic</th> <th>Qty</th> <th>Nama Barang </th> <th>Size</th> <th>harga</th> <th>Total harga</th>
						    		</tr></thead>
						    		<?php $databarang = $this->db->query("SELECT * FROM detail_transaction__ as a 
														LEFT JOIN product__ as b on b.product_id = a.product_id 
														LEFT JOIN msize__ as c on c.id_size = a.id_size
														where transaction_id = ".$id_product." ")->result();
						    		$noo=1;
						    			foreach ($databarang as $key => $value) {
						    				$images = explode(',', $value->images_product);
									 ?>
										<tr>

											<td><?php echo $noo++ ?></td> 
											<td>
											<?php if($images[0]!=null){
												foreach ($images as $key) { ?>
									
													<img src="<?=base_url()?>assets/uploads/product/<?=$key?>" width="15%">
												
											<?php  } 

											}?>
						
											</td>  
											<td><?php echo $value->amount ?></td> 
											<td><?php echo $value->product_name ?></td>  
											
											<td><?php echo $value->nama_size ?></td>  
											<td><?php echo $value->price ?></td> 
											<td><?php echo $value->sub_total ?></td>
										</tr>		
									<?php }?>			
						    		<!-- <tfoot>
						    		<tr>
								         <td>Total Order</td>
								         <td> </td>
								         <td></td>
								         <td></td>
								         <td></td>
								         <td><?php currency($row->total_price) ?><br>
								             <?php currency($row->cost) ?><br>
								         	 <?php currency($row->payment)?> <br>
								         </td>
								      </tr>
						    		</tfoot> -->
						    		</table>
				</div>
			</div>	 	
		</div>
	</div> 