

<?php
 include("../Commen_file/Connction.php");
 if(isset($_POST['submit'])){
    $user_id = $_SESSION['username_id'];
    $get_ip_address = get_client_ip();
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_brand = $_POST['product_brand'];
    $product_category = $_POST['product_category'];
    $folder = "../Commen_file/Product_images/";
    $filelocation = [];
    for($i=1;$i<=4;$i++){

      $file = $_FILES['product_image'.$i];
      $filename = $_FILES['product_image'.$i]['name'];
      $templocation = $_FILES['product_image'.$i]['tmp_name'];
      $path = $folder.$filename;
      $filelocation[] = $path;
      $move = move_uploaded_file($templocation,$path);
    }
    $query_table = "CREATE TABLE IF NOT EXISTS Product_info(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    product_title VARCHAR(255),
    product_description TEXT,
    product_price DECIMAL(10,2),
    product_brand VARCHAR(255),
    product_category VARCHAR(255),
    product_image1 VARCHAR(255),
    product_image2 VARCHAR(255),
    product_image3 VARCHAR(255),
    product_image4 VARCHAR(255)
    )";
    $data = mysqli_query($conn, $query_table);

    //select qurey 
    $Query_select = "SELECT * FROM product_info WHERE product_title = '$product_title' AND  product_description = '$product_description'";
    $data = mysqli_query($conn, $Query_select);
    if(!($data)){
      echo $conn->error;
    }
    $row = mysqli_num_rows($data);
    if($row !=0){
      echo '<script>alert("Product Data Alredy Insert ");</script>';
    }
    else{
      $query_insert = "INSERT INTO product_info (
        user_id,user_ip_address,product_title, product_description, product_price, product_brand, product_category, 
        product_image1, product_image2, product_image3, product_image4
    ) VALUES (
        $user_id,'$get_ip_address','$product_title', '$product_description', '$product_price', '$product_brand', '$product_category',
        '{$filelocation[0]}', '{$filelocation[1]}', '{$filelocation[2]}', '{$filelocation[3]}'
    )";
     if(!(mysqli_query($conn, $query_insert)))
     {
        echo 'no done'.$conn->error;
     }
     else{
      echo '<script>alert("Product Data Insert successfully");</script>';
     }
    }
    
 }
?>

<form action="" method="POST" enctype="multipart/form-data" class="flex flex-col overflow-y-scroll items-center h-full w-full   p-4">
    <div class="bg-white shadow-lg rounded-xl p-6 w-full max-w-xl">
    <h1 class="text-2xl font-bold text-center mb-6 text-blue-600 ">Insert Product Data Form</h1>
    <div class="flex flex-col gap-4">
      <div>
        <label class="block font-medium mb-1">Product Title:</label>
        <input type="text" name="product_title" placeholder="Enter product title" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block font-medium mb-1">Product Description:</label>
        <textarea name="product_description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
      </div>

      <div>
        <label class="block font-medium mb-1">Product Price:</label>
        <input type="text" name="product_price" placeholder="Enter a price" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div>
        <label class="block font-medium mb-1">Product Brand:</label>
        <select name="product_brand" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="Select">Select</option>
          <?php
          $query = "SELECT * FROM insert_brand";
          $data = mysqli_query($conn, $query);
          while ($result = mysqli_fetch_assoc($data)) {
              echo "<option value='$result[brand_name]'>{$result['brand_name']}</option>";
          }
          ?>
        </select>
      </div>

      <div>
        <label class="block font-medium mb-1">Product Category:</label>
        <select name="product_category" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="Select">Select</option>
          <?php
          $query = "SELECT * FROM insert_category";
          $data = mysqli_query($conn, $query);
          while ($result = mysqli_fetch_assoc($data)) {
              echo "<option value='$result[category_name]'>{$result['category_name']}</option>";
          }
          ?>
        </select>
      </div>

      <!-- Product Images -->
      <?php for ($i = 1; $i <= 4; $i++): ?>
        <div>
          <label class="block font-medium mb-1">Product Image <?php echo $i; ?>:</label>
          <input type="file" name="product_image<?php echo $i; ?>" class="w-full border border-gray-300 rounded px-3 py-2 file:bg-blue-500 file:text-white file:border-none file:rounded file:px-4 file:py-2">
        </div>
      <?php endfor; ?>

      <div>
        <input type="submit" value="Submit" name="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded w-full mt-4 cursor-pointer">
      </div>
    </div>
  </div>
</form>
