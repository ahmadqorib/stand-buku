<?php  
 //action.php  
 session_start();  
 include'../../confiq/koneksi.php';
 if(isset($_POST["product_id"]))  
 {  
      $order_table = '';  
      $message = '';  
      if($_POST["action"] == "add")  
      {  
           if(isset($_SESSION["shopping_cart"]))  
           {  
                $is_available = 0;  
                foreach($_SESSION["shopping_cart"] as $keys => $values)  
                {  
                     if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
                     {  
                          $is_available++;  
                          $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["product_quantity"];  
                     }  
                }  
                if($is_available < 1)  
                {  
                     $item_array = array(  
                          'product_id'               =>     $_POST["product_id"],  
                          'product_name'               =>     $_POST["product_name"],  
                          'product_price'               =>     $_POST["product_price"],  
                          'product_diskon'               =>     $_POST["product_diskon"], 
                          'product_hdiskon'               =>     $_POST["product_hdiskon"], 
                          'product_quantity'          =>     $_POST["product_quantity"],
                          'product_foto'          =>     $_POST["product_foto"]    
                     );  
                     $_SESSION["shopping_cart"][] = $item_array;  
                }  
           }  
           else  
           {  
                $item_array = array(  
                     'product_id'               =>     $_POST["product_id"],  
                     'product_name'               =>     $_POST["product_name"],  
                     'product_price'               =>     $_POST["product_price"],  
                     'product_diskon'               =>     $_POST["product_diskon"], 
                     'product_hdiskon'               =>     $_POST["product_hdiskon"], 
                     'product_quantity'          =>     $_POST["product_quantity"],
                     'product_foto'          =>     $_POST["product_foto"]    
                );  
                $_SESSION["shopping_cart"][] = $item_array;  
           }  

      }  

      if($_POST["action"] == "remove")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["product_id"] == $_POST["product_id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     $message = '<label class="text-success">Data terhapus</label>';  
                }  
           }  
      }  
      if($_POST["action"] == "quantity_change")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
                {  
                     $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_POST["quantity"];  
                }  
           }  
      }  
      $order_table .= '  
           '.$message.'  
           <table class="table">  
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
           ';  
      if(!empty($_SESSION["shopping_cart"]))  
      {  
           $total = 0;  
           $no = 0;
           foreach($_SESSION["shopping_cart"] as $keys => $values){  
              $no++;
                $order_table .= '  
                     <tr>  
                          <td>'.$no.'</td>
                          <td><img src="images/buku/'.$values['product_foto'].'" class="img-responsive" width="125px"></td>
                          <td><input type="text" class="form-control" value="'.$values["product_name"].'" disabled></td>  
                          <td><input type="text" class="form-control" value="Rp '.number_format($values["product_price"],0,",",".").'" disabled></td>
                          <td><input type="text" class="form-control" value="'.$values["product_diskon"].' %" disabled></td>
                          <td><input type="text" class="form-control" value="Rp '.number_format($values["product_hdiskon"],0,",",".").'" disabled></td>
                          <td><input type="text" name="quantity[]" id="quantity'.$values["product_id"].'" value="'.$values["product_quantity"].'" class="form-control quantity" data-product_id="'.$values["product_id"].'" /></td>  
                          <td><input type="text" class="form-control" value="Rp '.number_format($values["product_quantity"] * $values["product_hdiskon"],0,",",".").'" disabled></td>  
                          <td><button name="delete" class="btn btn-danger btn-xs delete" id="'.$values["product_id"].'">
                              <span class="glyphicon glyphicon-remove"></span> hapus</button></td>  
                     </tr>  
                ';  
                $total = $total + ($values["product_quantity"] * $values["product_hdiskon"]);  
           }  
           $order_table .= '  
                <tr>  
                     <td colspan="7" align="right"><b>Total Harga :</b></td>  
                     <td><input type="text" class="form-control" value="Rp '.number_format($total,0,",",".").'" disabled></td>  
                     <td></td>  
                </tr>  
                <tr>  
                     <td colspan="8" align="right">  
                          <form method="post" action="">  
                               <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-usd"></span> Beli & Bayar</button>
                          </form>  
                     </td>  
                     <td></td>
                </tr>  
           ';  
      }  
      $order_table .= '</table>';  
      $output = array(  
           'order_table'     =>     $order_table,  
           'cart_item'          =>     count($_SESSION["shopping_cart"])  
      );  
      echo json_encode($output);  
 }  
 
