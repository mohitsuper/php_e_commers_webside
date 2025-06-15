<?php
include('Connction.php');
function header_top(){
  global $conn;
  error_reporting(0);
  $user_id=$_SESSION['username_id'];
  if($user_id >0){
    $query_user_info = "SELECT * FROM user_info where id=$user_id";
     $res_user_info = mysqli_query($conn,$query_user_info);
     if(!$res_user_info){
      echo $conn->error;
     }
     $row_user_info = mysqli_num_rows($res_user_info);
     if($row_user_info>0){
      while($row_user = mysqli_fetch_assoc($res_user_info)){
        ?>
        <div class="bg-blue-500 text-white p-2 px-10 flex justify-between items-center text-sm">
          <p>Welcome to 
          <?php 
          echo $row_user['username'];
          ?>
          </p>
            
          <div class="flex gap-4">
            <a href="User.php" class="cursor-pointer hover:underline">Profie</a>
  
            <div class="cursor-pointer hover:underline Captize">
              <?php
                echo "<a href='logout.php?id=".$user_id."'>logout</a>";             
              ?>
            </div>
            <a href="Card.php" class="cursor-pointer hover:underline">card(<?php Card_num_items_present();?>)</a>
          </div>
        </div>
        <?php
      }
     }
     else{
        ?>
              <div class="bg-blue-500 text-white p-2 px-10 flex justify-between items-center text-sm">
            <p>Welcome to 
            <?php 
            echo "Guest";
            ?>
            </p>
              
            <div class="flex gap-4">
                <?php
                  echo "<a class='cursor-pointer hover:underline Captize' href='login.php'>Login</a>";             
                ?>
                <a href="Card.php" class="cursor-pointer hover:underline">card(<?php Card_num_items_present();?>)</a>
     
            </div>
          </div>
          <?php
       
     }
    
  }
    
else{
        ?>
              <div class="bg-blue-500 text-white p-2 px-10 flex justify-between items-center text-sm">
            <p>Welcome to 
            <?php 
            echo "Guest";
            ?>
            </p>
              
            <div class="flex gap-4">
                <?php
                  echo "<a class='cursor-pointer hover:underline Captize' href='login.php'>Login</a>";             
                ?>
                <a href="Card.php" class="cursor-pointer hover:underline">card(<?php Card_num_items_present();?>)</a>
     
            </div>
          </div>
          <?php
       
}   ?>
  <!-- Header -->

  <!-- Navbar -->
  <div class="sticky top-0 bg-red-500 z-50 shadow">
    <nav class="flex justify-between items-center p-4 px-10 text-white">
      <div class="text-xl font-bold">E-commerce Website</div>
      <ul class="flex gap-5 text-sm font-medium">
        <li><a href="index.php" class="hover:underline">Home</a></li>
        <li><a href="All_Product.php" class="hover:underline">All Products</a></li>
      </ul>
      <div class="flex">
        <form action="" method="post">
        <input type="text" class="pl-1 py-1 rounded-[3px] mr-2 text-black" placeholder="Search" name="search_val">
        <input type="submit" value="submit" class="bg-green-500 rounded-[3px] py-1 px-2" name="search">
        </form>
      </div>
    </nav>
  </div>
    
    <?php
}

?>