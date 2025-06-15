<?php

function user_info_display(){
$i = 0;
global $conn;
if(isset($_SESSION['username'])){
?>
<div class="border rounded-lg shadow-md bg-white col-span-4 p-4 h-full flex flex-col gap-6">
     <?php 
     if(!isset($_GET['update'])){
       // user information 
       user_info();
       //order_item_padding oreder information
       Order_item_info();
     }
     update_user_info();


     ?>

</div>
<?php
  } 
}

function update_user_info(){
  if(isset($_GET['update'])){
  global $conn;
  $current_user = $_SESSION['username'];
  $query_user_info = "SELECT * FROM user_info WHERE username = '".$_SESSION['username']."' ";
  $result_user_info = mysqli_query($conn, $query_user_info);
  $query_profile_image = "ALTER TABLE user_info ADD profile_image VARCHAR(255)";
  $result_user_image = mysqli_query($conn, $query_profile_image);
  if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $file_info = ($_FILES['profile_image']);
    $file_name = $file_info['name'];
    $file_tmp = $file_info['tmp_name'];
    $path ="../Commen_file/Profile_image/".$file_name;
    move_uploaded_file($file_tmp,$path);

    $query_user_info_update = "UPDATE user_info SET username='$username',email='$email',user_password='$password',profile_image='$path' where username='$current_user'";
    $result_user_info_update = mysqli_query($conn, $query_user_info_update);
    if($result_user_info_update){
      echo "<script>alert('update success'); window.location.href='User.php'</script>";
    }
    else{
      echo $conn->error;
    }

  }
  while($row_user_info = mysqli_fetch_assoc($result_user_info)){
  ?>
    <div class="flex justify-center h-full w-full items-center">
      <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">UPDATE INFORMATION</h2>
  
      <form action="#" method="post" enctype="multipart/form-data" class="space-y-5">

        <div>
          <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
          <input type="text" id="username" name="username" value="<?php echo $row_user_info['username']?>" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
  
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1" >Email</label>
          <input type="email" value="<?php echo $row_user_info['email']?>" id="email" name="email" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
  
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input type="
          <?php
            if(isset($_GET['show'])){
              echo 'text';
            }
            else{
              echo 'password';
            }
          ?>" id="password" name="password" required value="<?php echo $row_user_info['user_password']?>"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
          <a href="User.php?update&show">
          <?php 
           if(isset($_GET['show'])){
            echo "hidden";
           }
           else{
            echo "show";
           }
          ?></a>
        </div>


          <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Profile Images:</label>
          <input type="file" name="profile_image" required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"/>
        </div>

        <input type="submit"
        name="submit"
        value="UPDATE"
        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
      </form>
  
    </div>
    </div>
  
  
  <?php
  }
  }
}

function user_info(){
  global $conn;
  $user_id=$_SESSION['username_id'];
  $query_user_info = "SELECT * FROM user_info where id=$user_id";
   $res_user_info = mysqli_query($conn,$query_user_info);
    while($row = mysqli_fetch_assoc($res_user_info)){
      ?>
          <div class="flex items-center gap-8 p-6 border rounded-lg shadow bg-gray-50">
            <!-- Profile Image -->
            <div>
                <img class="w-[100px] h-[100px] rounded-full object-cover border-2 border-blue-400" src="<?php 
      
                    if($row['profile_image'] != NULL){
                        echo $row['profile_image'];  // FIXED typo here (was 'profile image')
                    } else {
                        echo "../Commen_file/Product_images/user.png";
                    }
                ?>" alt="Profile Image">
            </div>

            <!-- User Info -->
            <div class="text-gray-800 space-y-2 text-[16px]">
                <h4 class="font-semibold">👤 Name: <span class="font-normal"><?php echo $row['username']?></span></h4>
                <h4 class="font-semibold">🔑 Password: <span class="font-normal"><?php echo $row['user_password']; ?></span></h4>
                <h4 class="font-semibold">📧 Email: <span class="font-normal"><?php echo $row['email']; ?></span></h4>
                <h4 class="font-semibold">🧑 Role: <span class="font-normal"><?php echo $row['user_action']; ?></span></h4>

                <!-- Action Buttons -->
                <div class="mt-4 flex gap-4">
                    <a href="User.php?update" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Update</a>
                    <a href="logout.php?id=<?php echo $row['id']?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Logout</a>
                </div>
            </div>

        </div>
      
      <?php
    }
}

function Order_item_info(){
  global $conn;
  ?>
  <div class="flex flex-col gap-6 p-6 border rounded-lg shadow bg-white">
  <h1 class="font-semibold text-xl text-gray-700">📦 Orders</h1>


  
  <div class="h-[400px] overflow-y-auto border rounded-lg">
    <table class="min-w-full table-auto border-collapse text-sm text-left">
      <thead class="bg-gray-200 sticky top-0 text-gray-600 uppercase text-xs font-semibold">
        <tr>
          <th class="px-4 py-3 border">ID</th>
          <th class="px-4 py-3 border">User ID</th>
          <th class="px-4 py-3 border">Invoice Number</th>
          <th class="px-4 py-3 border">Date & Time</th>
          <th class="px-4 py-3 border">Total Price</th>
          <th class="px-4 py-3 border">Total Product</th>
          <th class="px-4 py-3 border">Order Status</th>
          <th class="px-4 py-3 border">Action</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        <?php
        //user id code 
        $email = $_SESSION['email'];
        $query_user_id_get = "SELECT * FROM user_info WHERE email='$email'";
        $result_user_id_get = mysqli_query($conn, $query_user_id_get);
        $row_user_id_get = mysqli_fetch_array($result_user_id_get);
        $user_id = $row_user_id_get['id'];
        //user id code end

        //order item to get 
        $query_order_item = "SELECT * FROM order_item WHERE user_id=$user_id";
        $res = mysqli_query($conn, $query_order_item);
        $row = mysqli_num_rows($res);
        $i = 1;
        if($row>0){
        while ($result_order_item = mysqli_fetch_assoc($res)) {

          //confirm table to cheked
          $total = $result_order_item['total_price'];
          $status = null;
          $username_id = $_SESSION['username_id'];
          $query_order_item_info = "SELECT * FROM user_confirm_payment WHERE user_id=$username_id and total_amount=$total";
          $result_order_item_info = mysqli_query($conn, $query_order_item_info);
          if(!$result_order_item_info){
            echo $conn->error;
          }
            while($res2 = mysqli_fetch_assoc($result_order_item_info)){
            $status = $res2['order_status'];
  }

        ?>
          <tr class="even:bg-gray-50 odd:bg-white hover:bg-gray-100 transition">
            <td class="px-4 py-3 border"><?php echo $i++; ?></td>
            <td class="px-4 py-3 border"><?php echo $result_order_item['user_id']; ?></td>
            <td class="px-4 py-3 border"><?php echo $result_order_item['invoice_number']; ?></td>
            <td class="px-4 py-3 border"><?php echo $result_order_item['date_time']; ?></td>
            <td class="px-4 py-3 border"><?php echo $result_order_item['total_price']; ?></td>
            <td class="px-4 py-3 border"><?php echo $result_order_item['total_product']; ?></td>
            <td class="px-4 py-3 border">
              <span class="inline-block px-2 py-1 rounded text-xs">
                <?php
                if($status !=null){
                  echo $status;
                }
                else{
                  echo $result_order_item['order_status'];
                }
                ?>
              </span>

            <td class="px-4 py-3 border">
            <?php 
            if($status !=null){
              echo "Paid";
            }
            else{
              echo "<a class=' underline text-black hover:text-blue-500' href='User_payment.php?id=".$result_order_item['user_id']."&total=".$result_order_item['total_price']."'>Confirm</a>";
            }
            ?>
            </td>
          </tr>
        <?php } }
        else{
          ?>
          <td class="text-center py-5 text-xl font-bold text-blue-500">NO PADDING OREDER</td><?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
  
  <?php
}

?>
