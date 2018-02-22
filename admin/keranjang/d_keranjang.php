<div class="panel panel-info">
	<div class="panel-heading panel-data">Keranjang Belanja</div>
	<div class="panel-body">
		<div class="table-responsive" id="order_table">  
           <table class="table">  
           	<thead>
                <tr> 
                	<th width="2%">No.</th>
                	<th width="10%">Foto</th>
                    <th>Judul Buku</th>  
                    <th width="14%">Harga</th>
                    <th width="8%">Diskon</th>
                    <th width="14%">Harga Diskon</th> 
                    <th width="7%">Qty</th>  
                    <th width="14%">Total</th>  
                    <th>Aksi</th>  
                </tr> 
            </thead> 
                <?php  
	                if(!empty($_SESSION["shopping_cart"])){  
                    	$total = 0;  
                    	$no = 0;
                     	foreach($_SESSION["shopping_cart"] as $keys => $values){   
                     		$no++;
                ?> 
                <tbody>
                <tr>  
                	<td><?php echo $no; ?></td>
                	<td><img src="images/buku/<?php echo $values['product_foto'];?>" class="img-responsive" width="125px"></td>
                    <td><input type="text" class="form-control" value="<?php echo $values["product_name"]; ?>" disabled></td>  
                    <td><input type="text" class="form-control" value="Rp <?php echo number_format($values["product_price"],0,",","."); ?>" disabled></td>  
                    <td><input type="text" class="form-control" value="<?php echo $values["product_diskon"]; ?> %" disabled></td>
                    <td><input type="text" class="form-control" value="Rp <?php echo number_format($values["product_hdiskon"],0,",","."); ?>" disabled></td>
                    <td><input type="text" name="quantity[]" id="quantity<?php echo $values["product_id"]; ?>" value="<?php echo $values["product_quantity"]; ?>" data-product_id="<?php echo $values["product_id"]; ?>" class="form-control quantity" /></td>
                    <td><input type="text" class="form-control" value="Rp <?php echo number_format($values["product_quantity"] * $values["product_hdiskon"], 0,",","."); ?>" disabled></td>  
                    <td><button name="delete" class="btn btn-danger btn-xs delete" id="<?php echo $values["product_id"]; ?>">
                    	<span class="glyphicon glyphicon-remove"></span> hapus</button>
                    </td>  
                </tr>  
                <?php  
                          $total = $total + ($values["product_quantity"] * $values["product_hdiskon"]);  
                     }  
                ?>  
                <tr>  
                     <td colspan="7" align="right"><b>Total Harga :</b></td>  
                     <td><input type="text" class="form-control" value="Rp <?php echo number_format($total, 0,",","."); ?>" disabled></td>  
                     <td></td>  
                </tr>  
                <tr>  
                     <td colspan="8" align="right">  
                          <form method="post" action="keranjang/s_keranjang.php">  
                               <button type="submit" class="btn btn-success" name="simpanK"><span class="glyphicon glyphicon-usd"></span> Beli & Bayar</button>
                          </form>  
                     </td>  
                     <td></td>
                </tr>
                </tbody>  
                <?php  
                	}  
                ?>  
           	</table>  
      	</div>
	</div>
</div>
