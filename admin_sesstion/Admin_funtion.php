<?php

function header_admin(){
    ?>
  <!-- Header -->
  <div class="bg-blue-500 text-white p-2 px-10 flex reletive  justify-between items-center text-sm">
    <p>Welcome To Admin Dashbord
    <?php 
    if(isset($_SESSION['username'])){
    echo $_SESSION['username'];
    }
    else{
      echo "Guest";
    }
    ?>
    </p>
      
    <div class="flex gap-4">
      <a href="User.php" class="cursor-pointer hover:underline"><?php if(isset($_SESSION['username'])){echo "Profile"; }?></a>
      <p><?php if(isset($_SESSION['username'])){echo $_SESSION['email']; }?></p>
      <div class="cursor-pointer hover:underline Captize">
        <?php
         if(isset($_SESSION['username'])){
          echo "<a href='logout.php'>logout</a>";
         }
         else{
          echo "<a href='login.php'>login</a>";
         }
         
        ?>
      </div>
    </div>
  </div>

  <!-- Navbar -->

    
    <?php
}



function admin_info_display(){
    global $conn;
    $query_user_info = "SELECT * FROM user_info WHERE user_action ='admin'";
    $result_user_info = mysqli_query($conn, $query_user_info);
    if(!$result_user_info){
      echo $conn->error;    
    }
    while($row = mysqli_fetch_assoc($result_user_info)){
      ?>
          <div class="flex items-center gap-8 p-6 border rounded-lg shadow bg-gray-50 w-full h-[15rem]">
            <!-- Profile Image -->
            <div class="flex justify-center w-[200px]">
                <img class="w-[100px] h-[100px] rounded-full object-cover border-2 border-blue-400 object-top" src="<?php 
      
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
                <h4 class="font-semibold">🔑 Password: <span class="font-normal"><?php echo $row['user_password']?></span></h4>
                <h4 class="font-semibold">📧 Email: <span class="font-normal"><?php echo $row['email']; ?></span></h4>
                 <h4 class="font-semibold">😎 Role: <span class="font-normal"><?php echo $row['user_action']; ?></span></h4>
                 <div class="mt-4 flex gap-4 col-span-full">
                     <a href="Index.php?update_user&id=<?php echo $row['id']?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Update</a>
                     <a href="Index.php?logout" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Logout</a>
                 </div>
            </div>                <!-- Action Buttons -->
        </div>
      <?php 
    }
}
function Dashbord(){
              echo "<h2 class='text-2xl font-semibold mb-4'>Dashboard Summary</h2>";
            admin_info_display();

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

function remove_user(){
  global $conn;
  $id = $_GET['id'];
  $query_user_delect = "DELETE FROM user_info where id=$id";
  $res = mysqli_query($conn,$query_user_delect);
  if($res){
    echo "<script>alert('Delete User Account...'); window.location.href='Index.php?view_user';</script>";
  }
}

function  update_user(){
  global $conn;
  $id = $_GET['id'];
  $query_get_user = "SELECT * FROM user_info where id=$id";
  $data_get_user = mysqli_query($conn,$query_get_user);
  if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $user_action = $_POST['user_action'];
    $user_profile_name = $_FILES['user_profile']['name'];
    $tmp = $_FILES['user_profile']['tmp_name'];
    $folder="../Commen_file/Profile_image/";
    $filename = $folder.$user_profile_name;
    move_uploaded_file($tmp,$filename);
    $query_update = "UPDATE user_info set username='$username',user_password='$password',email='$email',user_action='$user_action',profile_image='$filename' where id=$id";
    $res_update = mysqli_query($conn,$query_update);
    if($res_update){
      echo "<script>alert('Update User Information...');window.location.href='Index.php?view_user'</script>";
    }
  }
  while($result_get_user = mysqli_fetch_assoc($data_get_user)){
    ?>
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm mx-auto h-[70vh] my-5">
         <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">User Information Update Page</h2>
        
        <form action="" method="post" class="space-y-4 h-full" enctype="multipart/form-data">
        <div>
          <label class="block text-gray-700 font-medium mb-1">username:</label>
          <input type="text"  name="username" required value="<?php echo $result_get_user['username']?>"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-1">Email:</label>
          <input type="text"  name="email" required value="<?php echo $result_get_user['email']?>"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>
          <div>
          <label class="block text-gray-700 font-medium mb-1">Password:</label>
          <input type="text"  name="password" required value="<?php echo $result_get_user['user_password']?>"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>        
        <div>
          <label class="block text-gray-700 font-medium mb-1">User Role:</label>
          <select name="user_action" class="bg-white border w-full w-full px-4 py-2 border-gray-200 rounded-lg">
            <option value="user" <?php if($result_get_user['user_action']=='user'){echo "selected";}?>>user</option>
            <option value="seller" <?php if($result_get_user['user_action']=='seller'){echo "selected";}?>>seller</option>
            <option value="admin" <?php if($result_get_user['user_action']=='admin'){echo "selected";}?>>admin</option>
          </select>
        </div>   
        <div class="">
          <label class="block text-gray-700 font-medium mb-1">User Profile Image:</label>
           <?php 
           if($result_get_user['profile_image']){
            echo "<img src='".$result_get_user['profile_image']."'>";
           }?>
          <input type="file" class="bg-white border w-full w-full px-4 py-2 border-gray-200 rounded-lg" name="user_profile">
        </div>    
        <input type="submit"
        value="submit"
        name="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition ">
  
      </form>
        
      </div>
    
    <?php
  }

}

?>