<?php
include("../Commen_file/Connction.php");
include("../Commen_file/Get_ip_address.php");
session_start();

$get_ip_address = get_client_ip();
$id_user = $_GET['id']; 
// You forgot this in your previous code!
$query_select_seller_info = "SELECT * FROM seller_info WHERE user_id=$_GET[id]";
$result_select_seller_info = mysqli_query($conn, $query_select_seller_info);

$rows = mysqli_num_rows($result_select_seller_info);
if (!$result_select_seller_info) {
    echo "Error: " . $conn->error;
}

if ($rows >0) {
        echo "<script>alert('Seller Account Already Present'); window.location.href='Seller_dashbord.php';
        </script>";
}
else{
  if (isset($_POST['submit'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $aadhar_no = $_POST['aadhar_no'];
      $pancard_no = $_POST['pancard_no'];
      $brand_logo = $_FILES['brand_logo'];
      $filename = $brand_logo['name'];
      $filetemp = $brand_logo['tmp_name'];
      
      // Correct file path
      $path = '../Commen_file/Seller_image' . $filename; 
      move_uploaded_file($filetemp, $path);
  
      // Update user_info
      $user_action = 'seller';
      $query_user_info = "UPDATE user_info SET user_action='$user_action' WHERE email='$email'";
      mysqli_query($conn, $query_user_info);
  
          // Insert new seller_info
          $query_insert_seller_info = "INSERT INTO seller_info(user_ip_address, seller_name, seller_email, seller_password, aadhar_no, pancard_no, brand_logo, user_id)
              VALUES('$get_ip_address', '$username', '$email', '$password', '$aadhar_no', '$pancard_no', '$path', '$id_user')";
  
          $result_insert_seller_info = mysqli_query($conn, $query_insert_seller_info);
  
          if (!$result_insert_seller_info) {
              echo "Error: " . $query_insert_seller_info . "<br>" . $conn->error;
          } else {
              echo "<script>alert('Seller Account Created'); window.location.href='Seller_dashbord.php'</script>";
          }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Seller infomation Account</h2>

    <form action="#" method="post" enctype="multipart/form-data" class="space-y-5">
      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <input type="text" id="username" value="<?php echo $_SESSION['username'];?>" name="username" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <div>
        <label for="email"  class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" id="email" value="<?php echo $_SESSION['email'];?>" name="email" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <div>
        <label for="password"  class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="text" value="<?php echo $_SESSION['password'];?>" id="password" name="password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

            <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Aadhar Card No:</label>
        <input type="number"  name="aadhar_no" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>


            <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Pancard number:</label>
        <input type="text" name="pancard_no" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

            <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Brand Logo:</label>
        <input type="file" name="brand_logo" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <input type="submit"
      name="submit"
      value="Submit"
      class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
    </form>


  </div>

</body>
</html>
