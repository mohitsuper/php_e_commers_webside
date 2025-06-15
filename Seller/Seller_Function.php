<?php
function header_seller(){
  global $conn;
    $user_id = $_SESSION['username_id'];
    $query_seller_info = "SELECT * FROM seller_info where user_id=$user_id";
    $res_seller_info = mysqli_query($conn,$query_seller_info);
    if(mysqli_num_rows($res_seller_info)>0){
    while($res = mysqli_fetch_assoc($res_seller_info)){
    ?>
  <!-- Header -->
  <div class="bg-blue-500 text-white p-2 px-10 flex justify-between items-center text-sm">
    <p>Welcome to seller Dashbord
    <?php 
    echo $res['seller_name'];
    ?>
    </p>
      
    <div class="flex gap-4">
      <p class="cursor-pointer hover:underline"><?php $res['seller_name']?></p>
      <p><?php $res['seller_email']?></p>
      <div class="cursor-pointer hover:underline Captize">
        <a href="Seller_dashbord.php">logout</a>
      </div>
    </div>
  </div>

  <!-- Navbar -->

    
    <?php
    }
  }
  
}

function Sidebar_Seller($val){
  ?>
      <div class="w-64 bg-white rounded-lg shadow p-4 flex flex-col gap-6 h-full">
      <div>
        <h3 class="bg-blue-500 text-white text-center font-semibold py-2 rounded  rounded">Seller Funtions</h3>
        <ul class="mt-2 space-y-2 text-sm">
                <li class="py-2 rounded  text-center text-md underline text-white bg-red-500 py-2 rounded   hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize"><a href="<?php echo $val?>?dashbord" >Dashbord</a></li>
                <li class="py-2 rounded  text-center text-md underline text-white bg-red-500 py-2 rounded   hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize"><a href="<?php echo $val?>?insert_category" >insert category</a></li>
                <li class="py-2 rounded  text-center text-md underline text-white bg-red-500 py-2 rounded   hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize"><a href="<?php echo $val?>?insert_brand" >insert brand</a></li>
                <li class="py-2 rounded  text-center text-md underline text-white bg-red-500 py-2 rounded   hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize"><a href="<?php echo $val?>?insert_product" >insert product</a></li>
                <li class="py-2 rounded  text-center text-md underline text-white bg-red-500 py-2 rounded   hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize"><a href="<?php echo $val?>?view_product"  >view product</a></li>
                <li class="py-2 rounded  text-center text-md underline text-white bg-red-500 py-2 rounded   hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize"><a href="<?php echo $val?>?view_brand" >view brand</a></li>
                <li class="py-2 rounded  text-center text-md underline text-white bg-red-500 py-2 rounded   hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize"><a href="<?php echo $val?>?view_category" >view Category</a></li>
                <?php
                if($val == 'Index.php'){
                  ?>
                  <li class="py-2 rounded  text-center text-md underline text-white bg-red-500 py-2 rounded   hover:text-blue-500 duration-[0.1s] cursor-pointer capitalize"><a href="<?php echo $val?>?view_user" >view user</a></li>
                  <?php
                }
                
                ?>



                <li class=""></li>

        </ul>
      </div>
    </div>
  <?php
}


?>