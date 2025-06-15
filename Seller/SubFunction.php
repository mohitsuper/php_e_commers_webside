<?php
function update_category($val){
    global $conn;
    $user_id = $_GET['id'];
    $category_id = $_GET['category_id'];
    $qurey = "SELECT * FROM insert_category where user_id=$user_id and id=$category_id";
    $data = mysqli_query($conn,$qurey);
    if(isset($_POST['submit'])){
        $category_name = $_POST['category_name'];
        $qurey_update = "UPDATE insert_category SET category_name='$category_name' where user_id=$user_id and id=$category_id";
        $res_update = mysqli_query($conn,$qurey_update);
        if($res_update){
            echo "<script>alert('Category is update...');</script>";
            if($val =='Index.php'){
                echo "<script>window.location.href='Index.php?view_category'</script>";
            }
            else if($val =='Seller_dashbord.php'){
            echo "<script>window.location.href='Seller_dashbord.php?view_category'</script>";
            }

        }
        else{
          echo $conn->error;
        }
    }
    
    while($result = mysqli_fetch_assoc($data)){
        ?>
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm mx-auto h-1/2">
         <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Category Update Page</h2>
        
        <form action="" method="post" class="space-y-4 h-full">
        <div>
          <label class="block text-gray-700 font-medium mb-1">Category name</label>
          <input type="text"  name="category_name" required value="<?php echo $result['category_name']?>"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
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

function Remove_category($val){
 global $conn;
    $category_id = $_GET['category_id'];
    $user_id = $_GET['id'];
    $query_seller_Category = "DELETE FROM insert_category WHERE user_id=$user_id and id=$category_id";
    $res_delect_seller_category = mysqli_query($conn,$query_seller_Category);
    if($res_delect_seller_category){
        echo "<script>alert('Delect Category...');</script>";
        if($val =='Index.php'){
            echo "<script>window.location.href='Index.php?view_category'</script>";
        }
        else if($val =='Seller_dashbord.php'){
        echo "<script>window.location.href='Seller_dashbord.php?view_category'</script>";
        }

    }
    else{
    echo $conn->error;
    }
}



function update_brand($val){
    global $conn;
    $user_id = $_GET['id'];
    $brand_id = $_GET['brand_id'];
    $qurey = "SELECT * FROM insert_brand where user_id=$user_id and id=$brand_id";
    $data = mysqli_query($conn,$qurey);
    if(isset($_POST['submit'])){
        $brand_name = $_POST['brand_name'];
        $qurey_update = "UPDATE insert_brand SET brand_name='$brand_name' where user_id=$user_id and id=$brand_id";
        $res_update = mysqli_query($conn,$qurey_update);
        if($res_update){
            echo "<script>alert('brand is update...');</script>";
        if($val =='Index.php'){
            echo "<script>window.location.href='Index.php?view_brand'</script>";
        }
        else if($val =='Seller_dashbord.php'){
        echo "<script>window.location.href='Seller_dashbord.php?view_brand'</script>";
        }
        }
        else{
          echo $conn->error;
        }
    }
    
    while($result = mysqli_fetch_assoc($data)){
        ?>
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm mx-auto h-1/2">
         <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Brand Update Page</h2>
        
        <form action="" method="post" class="space-y-4 h-full">
        <div>
          <label class="block text-gray-700 font-medium mb-1">Category name</label>
          <input type="text"  name="brand_name" required value="<?php echo $result['brand_name']?>"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
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

function Remove_brand($val){
 global $conn;
    $brand_id = $_GET['brand_id'];
    $user_id = $_GET['id'];
    $query_seller_brand = "DELETE FROM insert_brand WHERE user_id=$user_id and id=$brand_id";
    $res_delect_seller_brand = mysqli_query($conn,$query_seller_brand);
    if($res_delect_seller_brand){
        echo "<script>alert('Delect Brand...');</script>";
        if($val =='Index.php'){
        echo "<script>window.location.href='Index.php?view_brand'</script>";
        }
        else if($val =='Seller_dashbord.php'){
        echo "<script>window.location.href='Seller_dashbord.php?view_brand'</script>";
        }
    }
    else{
    echo $conn->error;
    }
}


function update_product($val){
    global $conn;
    $user_id = $_GET['user_id'];
    $product_id = $_GET['product_id'];
    $qurey_get_product = "SELECT * FROM product_info where user_id=$user_id and id=$product_id";
    $data_get_product = mysqli_query($conn,$qurey_get_product);

    if(isset($_POST['submit'])){
    $product_image_old= $_POST['product_image_old'];
    // echo print_r($product_image_old);
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_brand = $_POST['product_brand'];
    $product_category = $_POST['product_category'];
    $folder = "../Commen_file/Product_images/";
    $fileimage[] = null;
    for($i=0;$i<4;$i++){
        $product_image_new_name = $_FILES['product_image'.$i+1]['name'];
        $product_image_new_tmp = $_FILES['product_image'.$i+1]['tmp_name'];
        $product_image_new = $folder.$product_image_new_name;
        if($product_image_new_name){
            $fileimage[$i] = $product_image_new;
            move_uploaded_file($product_image_new_tmp,$product_image_new);
        }
        else{
            $fileimage[$i] = $product_image_old[$i];
        }
    }

    // //select qurey 
     $Query_update = "UPDATE product_info set product_title='$product_title',product_description='$product_description',product_price=$product_price,product_brand='$product_brand',product_category='$product_category',product_image1='$fileimage[0]',product_image2='$fileimage[1]',
    product_image3='$fileimage[2]',product_image4='$fileimage[3]' where user_id=$user_id and id=$product_id";
    $data_update = mysqli_query($conn, $Query_update);
    if(!($data_update)){
      echo $conn->error;
    }
    else{
      echo "<script>alert('Update Product...');</script>";
        if($val =='Index.php'){
        echo "<script>window.location.href='Index.php?view_product'</script>";
        }
        else if($val =='Seller_dashbord.php'){
        echo "<script>window.location.href='Seller_dashbord.php?view_product'</script>";
        }
    }
 }

    while($result_product = mysqli_fetch_assoc($data_get_product)){
        ?>
    <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col overflow-y-scroll items-center h-full w-full   p-4">
    <div class="bg-white shadow-lg rounded-xl p-6 w-full max-w-xl">
            <h1 class="text-2xl font-bold text-center mb-6 text-blue-600 ">Update Product Data Form</h1>
            <div class="flex flex-col gap-4">
            <div>
                <label class="block font-medium mb-1">Product Title:</label>
                <input type="text" name="product_title" value="<?php echo $result_product['product_title']?>" placeholder="Enter product title" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Product Description:</label>
                <textarea name="product_description"  rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo $result_product['product_description']?></textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Product Price:</label>
                <input type="text" name="product_price" value="<?php echo $result_product['product_price']?>" placeholder="Enter a price" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block font-medium mb-1">Product Brand:</label>
                <select name="product_brand"  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="Select">Select</option>
                <?php
                $query = "SELECT * FROM insert_brand";
                $data = mysqli_query($conn, $query);
                while ($result = mysqli_fetch_assoc($data)) {
                    $brand_name = $result['brand_name'];
                    $select = ($result_product['product_brand'] == $brand_name)?'selected':'';
                    echo "<option value='$result[brand_name]' $select>{$result['brand_name']}</option>";
                }
                ?>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Product Category:</label>
                <select name="product_category" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select</option>
                    <?php
                    $query = "SELECT * FROM insert_category";
                    $data = mysqli_query($conn, $query);
                    while ($result = mysqli_fetch_assoc($data)) {
                        $category_name = $result['category_name'];
                        $selected = ($result_product['product_category'] == $category_name) ? 'selected' : '';
                        echo "<option value='$category_name' $selected>$category_name</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Product Images -->
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <div>
                <label class="block font-medium mb-1">Product Image <?php echo $i; ?>:</label>
                <img src="<?php echo $result_product['product_image'.$i]?>" class="w-20 h-20 object-contain py-2" alt="">
                <input type="hidden" value="<?php echo $result_product['product_image'.$i]?>" name="product_image_old[]">
                <input type="file" name="product_image<?php echo $i; ?>" class="w-full border border-gray-300 rounded px-3 py-2 file:bg-blue-500 file:text-white file:border-none file:rounded file:px-4 file:py-2" >
                </div>
            <?php endfor; ?>

            <div>
                <input type="submit" value="Submit" name="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded w-full mt-4 cursor-pointer">
            </div>
            </div>
        </div>
        </form>
 <?php
    }

}

function remove_product($val){
     global $conn;
    $product_id = $_GET['product_id'];
    $user_id = $_GET['user_id'];
    $query_seller_product = "DELETE FROM product_info WHERE user_id=$user_id and id=$product_id";
    $res_delect_seller_product = mysqli_query($conn,$query_seller_product);
    if($res_delect_seller_product){
        echo "<script>alert('Delect product...');</script>";
        if($val =='Index.php'){
            echo "<script>window.location.href='Index.php?view_product'</script>";
        }
        else if($val =='Seller_dashbord.php'){
        echo "<script>window.location.href='Seller_dashbord.php?view_product'</script>";
        }
    }
    else{
    echo $conn->error;
    }
}



?>