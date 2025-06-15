
<?php
$id = $_SESSION['username_id'];
function pandding_order_number(){
    global $conn;
    $email = $_SESSION['email'];
    $query_user_id = "SELECT * FROM user_info where email='$email'";
    $data_user_id = mysqli_query($conn,$query_user_id);
    $data= mysqli_fetch_array($data_user_id);
    $user_id = $data['id'];
    // user id code end 

    //padding order
    $query_order_item = "SELECT * FROM order_item where user_id='$user_id'";
    $data_order_item = mysqli_query($conn,$query_order_item);
    echo mysqli_num_rows($data_order_item);

}
?>
    <div class="w-64 bg-white rounded-lg shadow p-4 flex flex-col gap-6 h-full">

      <!-- User Action -->
      <div>
        <h3 class="bg-blue-500 text-white text-center font-semibold py-2 rounded">User Action</h3>
        <ul class="mt-2 space-y-1 text-left pl-3 text-sm">
            <li class="py-2 text-center text-md underline hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize">pandding order <sup>(<?php pandding_order_number();?>)</sup></li>
            <li class="py-2 text-center text-md underline hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize">My order</li>
            <li class="py-2 text-center text-md underline hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize">
              <?php 
               if($_SESSION['user_action'] == 'seller' or $_SESSION['user_action'] == 'user' or $_SESSION['user_action'] ==''){
                echo "<a href='../Seller/Seller_info.php?id=".$id."'>Sale Product</a>";
               }
               else if($_SESSION['user_action'] == 'admin'){
                echo "<a href='../admin_sesstion/Index.php'>admin</a>";
               }
               
              ?>
            </li>
        </ul>
      </div>
    </div>

<?php


?>