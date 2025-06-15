<?php
include_once("Connction.php");
include_once("Get_ip_address.php");
include_once("Add_to_card.php");


 function Card_Product(){
  global $conn;
       $sql = "SELECT * FROM product_info ORDER BY RAND() LIMIT 4";
       $data = mysqli_query($conn, $sql);
       $row = mysqli_num_rows($data);
       if($row !=0){
        if(!isset($_GET['category'])){
          if(!isset($_GET['brand'])){
            if(!isset($_POST['search'])){
            while($result = mysqli_fetch_assoc($data)){
              Single_Card_Product($result);
             }
           }
          }
        }
       }
       else{
        echo "DATA NOT A PRESENT";
       }
 }

function get_unique_category(){
  global $conn;
  if(isset($_GET['category'])){
    $category_id = $_GET['category'];
    $sql = "SELECT * FROM product_info WHERE product_category='$category_id'";
    $data = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($data);
      if($row >0){
        while($result = mysqli_fetch_assoc($data)){
          Single_Card_Product($result);
        }
      }
      else{
      echo "DATA NOT A PRESENT";
      }
  }

}

function get_unique_brand(){
  global $conn;
  if(isset($_GET['brand'])){
    $brand_id = $_GET['brand'];
    $sql = "SELECT * FROM product_info WHERE product_brand='$brand_id'";
    $data = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($data);
      if($row >0){
        while($result = mysqli_fetch_assoc($data)){
          Single_Card_Product($result);
        }
      }
      else{
      echo "DATA NOT A PRESENT";
      }
  }

}

function All_product_display(){
    global $conn;
    if(!isset($_POST['search'])){

    $query = "SELECT * FROM product_info";
    $data = mysqli_query($conn,$query);
    $row = mysqli_num_rows($data);
    if($row == 0){
      echo "<div class='col-span-1 text-red-500 text-lg text-center mt-10 w-full'>data is not present</div>".$conn->error;
    }
    else{
      while ($result = mysqli_fetch_assoc($data)) {
        Single_Card_Product($result);
      }
    }
  }
}

function Search_val(){
  global $conn;
  if(isset($_POST['search'])){
    $search_val = $_POST['search_val'];
    $query_search = "SELECT * FROM product_info where product_title like '%$search_val%' and product_description like '%$search_val%'";
    $data = mysqli_query($conn,$query_search);
    while($result = mysqli_fetch_assoc($data)){
      Single_Card_Product($result);
    }
  
  }
}

function Category_display(){
    ?>
    <?php

    global $conn;
    $query = "SELECT * FROM insert_category";
    $data = mysqli_query($conn, $query);
    while ($result = mysqli_fetch_assoc($data)) {
        echo "<li class='text-md mb-2 capitalize text-center'>
        <a href='index.php?category={$result['category_name']}' class='hover:text-blue-500 block'>$result[category_name]</a>
        </li>";
    }
    ?>
    <?php
}

function Brand_display(){
    ?>
    <?php
    global $conn;
    $query = "SELECT * FROM insert_brand";
    $data = mysqli_query($conn, $query);
    while ($result = mysqli_fetch_assoc($data)) {
        echo "<li class='text-mb mb-2 capitalize text-center'><a href='index.php?brand={$result['brand_name']}' class='hover:text-blue-500 block'>{$result['brand_name']}</a></li>";
    }
    ?>
    <?php
}


function Single_Card_Product($row){
  ?>
          <div class="border rounded-lg overflow-hidden shadow-sm bg-white hover:shadow-md transition  p-1 h-[360px]">
          <div class=" relative">
            <img class=" h-48 w-full object-contain object-top" src="<?php echo $row['product_image1']; ?>" alt="Product Image" />
          </div>
          <div class="p-4">
            <h2 class="font-bold text-lg"><?php echo substr($row['product_title'],0,25); ?>...</h2>
            <p class="text-sm text-gray-600">
              <?php echo substr($row['product_description'], 0, 50); ?>...
            </p>
            <p class="text-blue-600 font-semibold pb-1">₹<?php echo $row['product_price']; ?></p>

            <a href="View_more.php?product_id=<?php echo $row['id']; ?>" class="cursor-pointer bg-blue-500 px-3 py-2 mr-1 text-sm text-white rounded-[10px]">view more</a>

            <a href="index.php?Add_to_id=<?php echo $row['id'];?>" class="cursor-pointer bg-gray-500 px-3 py-2 mr-1 text-sm text-white rounded-[10px]">Add to cart</a>
          </div>
        </div>
<?php
}

function View_more(){
  global $conn;
  if(!isset($_POST['search'])){
  $product_id = $_GET['product_id'];
  $query = "SELECT * FROM product_info WHERE id='$product_id'";
  $data = mysqli_query($conn,$query);
  $row = mysqli_num_rows($data);
  if($row !=0){
    while ($result = mysqli_fetch_assoc($data)) {
      ?>
      <div class="h-[80vh] col-span-4 w-full">
        <div class="w-full h-full  bg-white rounded-lg shadow-lg p-6 flex flex-col md:flex-row gap-6">

          <!-- Image Gallery -->
          <div class="flex gap-3 h-full basis-[60%] w-full md:w-1/2 h-full ">
            <!-- Thumbnails -->
            <div class="flex flex-col gap-2">
              <?php
                for($i=1;$i<=4;$i++){
                  $image = $result['product_image'.$i];
                  echo "<a href='View_more.php?product_id=$product_id&main_image=$image'>
                  <img src='$image' class='w-20 h-20 object-contain border rounded cursor-pointer '/>
                  </a>";

                }
              ?>
            </div>

            <!-- Main Image -->
            <div class="flex-1 h-full">
              <?php
              if(!isset($_GET['main_image'])){
                echo "<img  src='$result[product_image1]' id='main-image' class='w-full h-full  object-contain rounded-lg shadow-md' alt='Main Image'>";
              }
              else{
              $main_image = $_GET['main_image'];
              echo "<img  src='$main_image' id='main-image' class='w-full h-full  object-contain rounded-lg shadow-md' alt='Main Image'>";

              }
              ?>
            </div>
          </div>

          <!-- Product Info -->
          <div class="w-full md:w-1/2 flex flex-col gap-4">
            <h1 class="text-3xl font-bold text-gray-800"><?php echo $result['product_title']; ?></h1>

            <div class="text-gray-700">
              <h3 class="font-semibold mb-1">Description:</h3>
              <p class="text-sm"><?php echo $result['product_description']; ?></p>
            </div>

            <div class="text-lg font-bold text-green-600">
              ₹<?php echo $result['product_price']; ?>
            </div>

            <div class="text-sm text-gray-600 space-y-1">
              <p><span class="font-semibold text-gray-800">Category:</span> <?php echo $result['product_category']; ?></p>
              <p><span class="font-semibold text-gray-800">Brand:</span> <?php echo $result['product_brand']; ?></p>
            </div>

            <div>
              <a href="View_more.php?Add_to_id=<?php echo $result['id']; Add_to_card();?>" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full transition font-medium shadow-sm" href="">
                Add to Cart
              </a>  
            </div>
          </div>

        </div>
      </div>
      <?php
    }
  }
  else{
    echo $conn->error;
  }
 }
}
function Realted_product(){
  global $conn;
  if(!isset($_POST['search'])){
  //product itesm to get 
  $product_id = $_GET['product_id'];
  $query = "SELECT * FROM product_info WHERE id='$product_id'";
  $data = mysqli_query($conn,$query);
  $row = mysqli_num_rows($data);
  if($row >0){
    while($result = mysqli_fetch_assoc($data)){
      //select a related product 
      $related_product_query = "SELECT * FROM product_info WHERE product_category like '%$result[product_category]%' and  product_brand like '%$result[product_brand]%' ORDER BY RAND() LIMIT 4";
      $related_product_data = mysqli_query($conn,$related_product_query);
      echo "<h1 class='text-xl py-3 w-full font-bold'>Related Product:</h1>";
     echo "<div class='grid grid-cols-4 gap-3 h-full w-full'>";

      while($resulte2 = mysqli_fetch_assoc
      ($related_product_data)){
        //display the related product
        Single_Card_Product($resulte2);
      }
     echo "</div>";

    }
  }
  
  }
  ?><?php
}
?>



