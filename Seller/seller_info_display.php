<?php
function seller_info_display(){
    global $conn;
    $query_user_info = "SELECT * FROM seller_info WHERE seller_name = '".$_SESSION['username']."' ";
    $result_user_info = mysqli_query($conn, $query_user_info);
    while($row = mysqli_fetch_assoc($result_user_info)){
      ?>
          <div class="grid grid-cols-5 items-center gap-8 p-6 border rounded-lg shadow bg-gray-50 w-full h-[15rem]">
            <!-- Profile Image -->
            <div class="flex justify-center">
                <img class="w-[100px] h-[100px] rounded-full object-cover border-2 border-blue-400 object-top" src="<?php 
      
                    if($row['brand_logo'] != NULL){
                        echo $row['brand_logo'];  // FIXED typo here (was 'profile image')
                    } else {
                        echo "../Commen_file/Product_images/user.png";
                    }
                ?>" alt="Profile Image">
            </div>

            <!-- User Info -->
            <div class="text-gray-800 space-y-2 text-[16px]">
                <h4 class="font-semibold">👤 Name: <span class="font-normal"><?php echo $row['seller_name']?></span></h4>
                <h4 class="font-semibold">🔑 Password: <span class="font-normal"><?php echo $row['seller_password']?></span></h4>
                <h4 class="font-semibold">📧 Email: <span class="font-normal"><?php echo $row['seller_email']; ?></span></h4>
            </div>

              <div class="text-gray-800 space-y-2 text-[16px]">
                <h4 class="font-semibold">🆔 Aadhar Number: <span class="font-normal"><?php echo $row['aadhar_no']; ?></span></h4>
                <h4 class="font-semibold">🔐 Pan Card Number: <span class="font-normal"><?php echo $row['pancard_no']; ?></span></h4>
            </div>
        <?php
    } ?>

                <!-- Action Buttons -->
                <div class="mt-4 flex gap-4 col-span-full">
                    <a href="Seller_dashbord.php?update" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Update</a>
                    <a href="Seller_dashbord.php?logout" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Logout</a>
                </div>
        </div>
      <?php 
}

function seller_insert_category_num(){
    global $conn;
    // no of category insert user 
    $get_ip_address = get_client_ip();
    $user_id = $_SESSION['username_id'];
    $query_category = "SELECT * FROM insert_category where user_id=$user_id and user_ip_address='$get_ip_address'";
    $data_category = mysqli_query($conn, $query_category);
    $row_category = mysqli_num_rows($data_category);
    echo $row_category;
    
}

function seller_account_delect(){
  global $conn;
  $user_id=$_SESSION['username_id'];
  //delect seller account
  $query_seller_info = "DELETE FROM seller_info WHERE user_id=$user_id";
  $res_delect_seller = mysqli_query($conn,$query_seller_info);
  if($res_delect_seller){
    echo "<script>alert('Delect seller Account');<script>";
  }



//seller add category to delect 
$query_seller_Category = "DELETE FROM insert_category WHERE user_id=$user_id";
$res_delect_seller_category = mysqli_query($conn,$query_seller_Category);
if($res_delect_seller_category){
    echo "<script>alert('Delect seller Add Category');<script>";
}

// seller Add Brand TO delect 

$query_seller_Brand= "DELETE FROM insert_brand WHERE user_id=$user_id";
$res_delect_seller_Brand = mysqli_query($conn,$query_seller_Brand);
if($res_delect_seller_Brand){
    echo "<script>alert('Delect seller Add Brand');<script>";
}

//seller add product Delect

$query_seller_product= "DELETE FROM product_info WHERE user_id=$user_id";
$res_delect_seller_product = mysqli_query($conn,$query_seller_product);
if($res_delect_seller_product){
    echo "<script>alert('Delect seller Add product');<script>";
}

if($res_delect_seller){
  if($res_delect_seller_Brand){
    if($res_delect_seller_category){
      include('../Seller/Seller_info.php?id=".$user_id."');  
    }
  }
}


}





function seller_User_info_update(){
  global $conn;
  $current_user = $_SESSION['username'];
  $query_user_info = "SELECT * FROM seller_info WHERE seller_name= '".$_SESSION['username']."' ";
  $result_user_info = mysqli_query($conn, $query_user_info);
  if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $aadhar_no = $_POST['aadhar_no'];
    $pancard_no = $_POST['pancard_no'];
    $file_info = ($_FILES['brand_logo']);
    $file_name = $file_info['name'];
    $file_tmp = $file_info['tmp_name'];
    $path ="../Commen_file/Seller_image".$file_name;
    move_uploaded_file($file_tmp,$path);

    $query_user_info_update = "UPDATE seller_info SET seller_name='$username',seller_email='$email',seller_password='$password',brand_logo='$path',aadhar_no=$aadhar_no,pancard_no=$pancard_no where seller_name='$current_user'";
    $result_user_info_update = mysqli_query($conn, $query_user_info_update);
    if($result_user_info_update){
      echo "<script>alert('update success'); window.location.href='Seller_dashbord.php'</script>";
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
          <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Seller Name:</label>
          <input type="text" id="username" name="username" value="<?php echo $row_user_info['seller_name']?>" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
  
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1" >Seller Email</label>
          <input type="email" value="<?php echo $row_user_info['seller_email']?>" id="email" name="email" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
  
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Seller Account Password:</label>
          <input type="text" name="password"  value="<?php echo $row_user_info['seller_password']?>"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Seller Aadhar Number:</label>
          <input type="text" name="aadhar_no"  value="<?php echo $row_user_info['aadhar_no']?>"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Seller Pancard Number:</label>
          <input type="text" name="pancard_no"  value="<?php echo $row_user_info['pancard_no']?>"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>


          <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Brand Logo:</label>
          <img src="<?php echo $row_user_info['brand_logo']?>" class="w-20 h-20 mb-2" alt="">
          <input type="file" name="brand_logo" 
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

function seller_insert_brand_num(){
    global $conn;
    // no of category insert user 
    $get_ip_address = get_client_ip();
    $user_id = $_SESSION['username_id'];
    $query_category = "SELECT * FROM insert_brand where user_id=$user_id and user_ip_address='$get_ip_address'";
    $data_category = mysqli_query($conn, $query_category);
    $row_category = mysqli_num_rows($data_category);
    echo $row_category;
    
}

function seller_insert_product_num(){
    global $conn;
    // no of category insert user 
    $get_ip_address = get_client_ip();
    $user_id = $_SESSION['username_id'];
    $query_category = "SELECT * FROM product_info where user_id=$user_id and user_ip_address='$get_ip_address'";
    $data_category = mysqli_query($conn, $query_category);
    $row_category = mysqli_num_rows($data_category);
    echo $row_category;
    
}

function seller_insert_product_pre(){
global $conn;
$get_ip_address = get_client_ip();
$user_id = $_SESSION['username_id'];
$sql = "SELECT * FROM product_info where user_id=$user_id and user_ip_address='$get_ip_address'";
$data = mysqli_query($conn,$sql);
$row = mysqli_num_rows($data);
if($row>0){
    echo "<div class='grid grid-cols-4 gap-2 w-full'>";
    while($result = mysqli_fetch_assoc($data)){
        Single_Card_Product($result);
    }
    echo "</div>";
}
else{
    echo "DATA NOT A PRESENT PLEASE INSERT A PRODUCT";
}
}

function seller_insert_product_display(){
    global $conn;
    $i =0;
    ?>
      <div class="container mx-auto mt-10 px-4">
    <h1 class="text-2xl font-bold text-center mb-6 text-blue-600">User Data Table</h1>

    <div class="overflow-x-auto overflow-y-auto shadow-lg rounded-lg bg-white p-6 h-[80vh]">
      <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="text-xs uppercase bg-blue-100 text-gray-700">
          <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3">PRODUCT TITLE</th>
            <th class="px-6 py-3">PRODUCT DESCRTION</th>
            <th class="px-6 py-3">PRODUCT BRAND</th>
            <th class="px-6 py-3">PRODUCT CATEGORY</th>
            <th class="px-6 py-3">PRODUCT PRICE</th>
            <th class="px-6 py-3">PRODUCT IMAGE1</th>
            <th class="px-6 py-3">PRODUCT IMAGE2</th>
            <th class="px-6 py-3">PRODUCT IMAGE3</th>
            <th class="px-6 py-3">PRODUCT IMAGE4</th>
            <th class="px-6 py-3">ACTION</th>

          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php
             $get_ip_address = get_client_ip();
           $user_id = $_SESSION['username_id'];
          $sql = "SELECT * FROM product_info where user_id=$user_id and user_ip_address='$get_ip_address'";
          $data = mysqli_query($conn,$sql);
          $row = mysqli_num_rows($data);
          if ($row> 0) {
            while($resulte = mysqli_fetch_assoc($data)) {
              $i++;
              echo "<tr>
                      <td class='px-6 py-4'>".$i."</td>
                      <td class='px-6 py-4'>" . $resulte["product_title"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["product_description"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["product_brand"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["product_category"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["product_price"] . "</td>
                      <td class='px-6 py-4'><img src='" . $resulte["product_image1"] . "'/></td>
                      <td class='px-6 py-4'><img src='" . $resulte["product_image2"] . "'/></td>
                      <td class='px-6 py-4'><img src='" . $resulte["product_image3"] . "'/></td>
                      <td class='px-6 py-4'><img src='" . $resulte["product_image4"] . "'/></td>


                      <td class='px-6 py-4'>
                      <a href='Seller_dashbord.php?update_product&product_id=".$resulte['id']."&user_id=".$resulte['user_id']."' class='bg-green-500 px-2 py-1 text-white rounded-[3px] mr-2'>Edit</a>
                      <a href='Seller_dashbord.php?remove_product&product_id=".$resulte['id']."&user_id=".$resulte['user_id']."' class='bg-red-500 px-2 py-1 text-white rounded-[3px] mr-2'>Remove</a>
                      </td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='3' class='px-6 py-4 text-center text-red-500'>No records found</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
    
    <?php
}

function seller_User_display(){
              echo "<h2 class='text-2xl font-semibold mb-4'>Dashboard Summary</h2>";
            seller_info_display();

            echo "<div class='grid grid-cols-1 md:grid-cols-3 gap-4 mt-6'>";
              echo "<div class='p-4 bg-blue-100 rounded text-center font-medium'>Category: ";
              seller_insert_category_num();
              echo "</div>";

              echo "<div class='p-4 bg-green-100 rounded text-center font-medium'>Brand: ";
              seller_insert_brand_num();
              echo "</div>";

              echo "<div class='p-4 bg-yellow-100 rounded text-center font-medium'>Product: ";
              seller_insert_product_num();
              echo "</div>";
              
            echo "</div>";

            // seller insert a product display
            echo "<div class='mt-6'>";
            echo "<h3 class='text-xl font-semibold mb-2'>Recent Products list</h3>";
            seller_insert_product_pre();
            echo "</div>";

  
}

function seller_insert_brand_display(){
    global $conn;
    $i =0;
    ?>
      <div class="container mx-auto mt-10 px-4">
    <h1 class="text-2xl font-bold text-center mb-6 text-blue-600">User Brand Display Table</h1>
    <div class="overflow-x-auto overflow-y-auto shadow-lg rounded-lg bg-white p-6 h-[80vh]">
      <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="text-xs uppercase bg-blue-100 text-gray-700">
          <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3">BRAND NAME</th>
            <th class="px-6 py-3">ACTION</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php
             $get_ip_address = get_client_ip();
           $user_id = $_SESSION['username_id'];
          $sql = "SELECT * FROM insert_brand where user_id=$user_id and user_ip_address='$get_ip_address'";
          $data = mysqli_query($conn,$sql);
          $row = mysqli_num_rows($data);
          if ($row> 0) {
            while($resulte = mysqli_fetch_assoc($data)) {
              $i++;
              echo "<tr>
                      <td class='px-6 py-4'>".$i."</td>
                      <td class='px-6 py-4'>" . $resulte["brand_name"] . "</td>
                      <td class='px-6 py-4'>
                      <a href='Seller_dashbord.php?update_brand&id=".$resulte['user_id']."&brand_id=".$resulte['id']."' class='bg-green-500 px-2 py-1 text-white rounded-[3px] mr-2'>Edit</a>
                      <a href='Seller_dashbord.php?remove_brand&id=".$resulte['user_id']."&brand_id=".$resulte['id']."' class='bg-red-500 px-2 py-1 text-white rounded-[3px] mr-2'>Remove</a>
                      </td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='3' class='px-6 py-4 text-center text-red-500'>No records found</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
    
    <?php
}

function seller_insert_category_display(){
    global $conn;
    $i =0;
    ?>
      <div class="container mx-auto mt-10 px-4">
    <h1 class="text-2xl font-bold text-center mb-6 text-blue-600">User Category Display Table</h1>
    <div class="overflow-x-auto overflow-y-auto shadow-lg rounded-lg bg-white p-6 h-[80vh]">
      <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="text-xs uppercase bg-blue-100 text-gray-700">
          <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3">Category NAME</th>
            <th class="px-6 py-3">ACTION</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php
             $get_ip_address = get_client_ip();
           $user_id = $_SESSION['username_id'];
          $sql = "SELECT * FROM insert_category where user_id=$user_id and user_ip_address='$get_ip_address'";
          $data = mysqli_query($conn,$sql);
          $row = mysqli_num_rows($data);
          if ($row> 0) {
            while($resulte = mysqli_fetch_assoc($data)) {
              $i++;
              echo "<tr>
                      <td class='px-6 py-4'>".$i."</td>
                      <td class='px-6 py-4'>" . $resulte["category_name"] . "</td>
                      <td class='px-6 py-4'>
                      <a href='Seller_dashbord.php?update_category&id=".$resulte['user_id']."&category_id=".$resulte['id']."' class='bg-green-500 px-2 py-1 text-white rounded-[3px] mr-2'>Edit</a>
                      <a href='Seller_dashbord.php?remove_category&id=".$resulte['user_id']."&category_id=".$resulte['id']."' class='bg-red-500 px-2 py-1 text-white rounded-[3px] mr-2'>Remove</a>
                      </td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='3' class='px-6 py-4 text-center text-red-500'>No records found</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
    
    <?php
}
?>