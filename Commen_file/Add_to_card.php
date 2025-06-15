
<?php



function Add_to_card(){
  global $conn;
  if(isset($_GET['Add_to_id'])){
    $product_id = $_GET['Add_to_id'];
    $get_ip_address = get_client_ip();
    $query_select = "SELECT * FROM card_info WHERE product_add_card_id='$product_id' AND get_ip_address='$get_ip_address'";

    $data = mysqli_query($conn,$query_select);
    $row = mysqli_num_rows($data);
    if($row !=0){
      while($result = mysqli_fetch_assoc($data)){
        $temp = $result['quantity'];
        $temp += 1;
        $quantity = $temp;
        $query_update = "UPDATE card_info SET quantity=$quantity WHERE get_ip_address='$get_ip_address' and product_add_card_id='$product_id'";
        $res = mysqli_query($conn,$query_update);
        if($res){
          echo "<script>alert('Product Are Added to Card +1')</script>";
          echo "<script>window.location.href='Card.php'</script>";

        }
        else{
          echo $conn->error;
        }
      }    
    }
    else{
      $query_insert = "INSERT INTO card_info(product_add_card_id,get_ip_address,quantity) VALUES('$product_id','$get_ip_address',1)";
  
      $res = mysqli_query($conn,$query_insert);
      if($res){
        echo "<script>alert('Product Added to Card')</script>";
         echo "<script>window.location.href='Card.php'</script>";
      }
      else{
          echo "<script>alert('Product Added to failed')</script>".$conn->error;
      }
    }



  }
}

function Card_num_items_present(){
  global $conn;
  $get_ip_address = get_client_ip();
  $query_select = "SELECT * FROM card_info WHERE get_ip_address='$get_ip_address'";
  $data = mysqli_query($conn,$query_select);
  $row = mysqli_num_rows($data);
  if($row==0){
    echo 0;
  }
  else{
    echo $row;
  }
}

function Add_card_diplay(){
  global $conn;
  if(!isset($_POST['search'])){

  $i = 0;
  $totle = 0;
  $get_ip_address = get_client_ip();
  $query_select = "SELECT * FROM card_info WHERE get_ip_address='$get_ip_address'";
  $data = mysqli_query($conn,$query_select);
  if(isset($_POST['remove'])){
    $product_id_uniqe = $_POST['product_id_uniqe'];
      $delect_query = "DELETE FROM card_info WHERE product_add_card_id='$product_id_uniqe' AND get_ip_address='$get_ip_address'";
      $res_del = mysqli_query($conn,$delect_query);
      if($res_del){
       echo "<script>window.location.href='Card.php';</script>";
      }
  }

                  
  ?>
  <div class="bg-white shadow-md rounded-lg p-4 col-span-4 overflow-y-scroll h-[80vh]">
      <table class="min-w-full table-auto text-sm text-left text-gray-700 text-center">
        <thead class="bg-blue-500 text-white uppercase">
          <tr>
            <th class="px-4 py-2">id</th>
            <th class="px-4 py-2">Main Image</th>
            <th class="px-4 py-2">Product Title</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Quantity</th>
            <th class="px-4 py-2">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <?php
           while($result = mysqli_fetch_assoc($data)){
            $product_id = $result['product_add_card_id'];
            $query = "SELECT * FROM product_info where id=$product_id";
            $data1 = mysqli_query($conn,$query);
            if(!$data1){
              echo $conn->error;
            }
            if(mysqli_num_rows($data1)>0){
              while($result1 = mysqli_fetch_assoc($data1)){
                $i++;
                 $product_price = $result1['product_price'];
                $subtotal = $product_price * $result['quantity'];
                $totle+=$subtotal;                
                ?>
                 <tr>
                  <form action="" method="post">
                  <td><?php echo $i?></td>
                  <td class=" flex items-center justify-center"><img src="<?php echo $result1['product_image1']?>" class="w-20 h-20 object-contain"/></td>
                  <td><?php echo $result1['product_title']?></td>
                  <td><?php echo $result1['product_price']?></td>
                  <td>
                    <input type="hidden" name="product_id_uniqe" value="<?php echo $product_id?>">
                    <input type="number" value="<?php echo $result['quantity']?>" name="quantity_val" class="border text-center"></td>
                  <td>
                  <input type='submit' class='cursor-pointer bg-green-500 text-white px-2 py-1 rounded-[3px]  text-[12px] mr-1' name='update' value='UPDATE'>
                  <input type='submit' class='cursor-pointer bg-red-500 text-white px-2 py-1 rounded-[3px]  text-[12px] mr-1' name='remove' value='REMOVE'>
                  </td>
                </form>
                 </tr>
                <?php
              }
            }
                
           }
             if(isset($_POST['update'])){
    $quantity_val = $_POST['quantity_val'];
    $product_id_uniqe = $_POST['product_id_uniqe'];
    $update_quantity = "UPDATE card_info SET quantity=$quantity_val WHERE get_ip_address='$get_ip_address' and  product_add_card_id='$product_id_uniqe'";
    $update_quantity_result = mysqli_query($conn,$update_quantity);
    if($update_quantity_result){
      echo "<script>alert('Quantity updated successfully'); window.location.href='Card.php';</script>";

    }
  }
          
          ?>
       </tbody>
      </table>
      <div class="px-1 py-5 flex gap-5">
        <h3 class="font-bold">Totle:<span class="text-blue-500"><?php echo $totle;?>/-</span></h3>

        <a href="index.php" class="bg-blue-500 px-2 py-1 text-sm rounded-[4px] text-white">Countine Shoping</a>

        <?php 
          if(isset($_SESSION['username'])){
            echo "<a href='Checkout.php' class='bg-blue-500 px-2 py-1 text-sm rounded-[4px] text-white'>Checkout</a>";
          }
          else{
            echo "<a href='login.php' class='bg-blue-500 px-2 py-1 text-sm rounded-[4px] text-white'>Checkout</a>";
          }
        ?>




      </div>
  </div>
  <?php     
   
}
}

?>
