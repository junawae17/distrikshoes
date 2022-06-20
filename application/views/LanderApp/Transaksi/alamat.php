<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
/*	.penerima tr td{
		border:1px solid black;
	}*/
	table {
		
		border:1px solid black;
	}
	table tr td{
		padding: 0px;
	}
</style>
<body>
<table width="50%">
		<tr><td  align="" >DARI : <?php echo $datarow->nama_pengirim?></td>
		</tr>
		
		<tr>
			<td ><?php echo $datarow->alamat_pengirim ?></td>
		</tr>
		<tr>
			<td ><?php echo $datarow->no_hp_pengirim ?></td>
		</tr>
	</table>
	<br>
	
	<table class="penerima" width="50%">
		<tr><td  align="" >
		KE : <?php echo $datarow->nama_tujuan ?></td>
		
		</tr>
		

		<tr>
			<td ><?php echo $datarow->alamat_tujuan ?></td>
		</tr>
		<tr>
			<td ><?php echo $datarow->no_hp ?></td>
		</tr>
	</table>
	<br>
	<table width="50%">
		<tr>
			<td>Daftar Pesanan</td>
			<td align="right"><i>No Pesanan : <?php echo $datarow->transaction_code ?></i></td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" style="border:none;">
					<tr>
						<td>#</td>
						<td>Nama barang</td>
						<td>Size</td>
						<td>Qty</td>
					</tr>
						<?php $databarang = $this->db->query("SELECT * FROM detail_transaction__ as a 
														LEFT JOIN product__ as b on b.product_id = a.product_id 
														LEFT JOIN msize__ as c on c.id_size = a.id_size
														where transaction_id = ".$datarow->transaction_id." ")->result();
						    		$noo=1;
						    			foreach ($databarang as $key => $value) {
						    				
									 ?>
									 <tr>

											<td><?php echo $noo++ ?></td> 
											<td><?php echo $value->product_name ?></td>  
											<td><?php echo $value->nama_size ?></td> 
											<td><?php echo $value->amount ?></td>
										</tr>		
									<?php }?>			
				</table>
			</td>
		</tr>
	</table>
	
</body>
</html>