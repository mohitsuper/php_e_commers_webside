<?php
  session_start();
  include("../Commen_file/Connction.php");
  include("../Commen_file/Get_ip_address.php");
  $get_ip_address = get_client_ip();
  if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user_info WHERE email='$email' AND user_password = '$password'";
    $result = mysqli_query($conn, $query);

    $query_card_id = "SELECT * FROM card_info WHERE get_ip_address='$get_ip_address'";
    $query_card_id_data = mysqli_query($conn,$query_card_id);

    if(mysqli_num_rows($result) >0){
      while($row = mysqli_fetch_assoc($result)){
        $_SESSION['username_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['user_password'];
        $_SESSION['profile_image'] = $row['profile_image'];
        $_SESSION['user_action'] = $row['user_action'];
        // if(!mysqli_num_rows($query_card_id_data)){
        //   header("Location:index.php");
        // }
        // else{
        //   header("Location:checkout.php");
        // }

      }
      echo "<script>alert('Login Success');
      window.location.href='index.php'</script>";
    }
    else{
        echo "<script>alert('Wrong Details');</script>";
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-[100vh]">

  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
    
    <form action="" method="post" class="space-y-4">
      <div>
        <label for="username" class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" id="username" name="email" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
      </div>

      <div>
        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
      </div>

      <input type="submit"
      value="login"
      name="submit"
      class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition ">

    </form>
     <p class="mt-4 text-center text-sm text-gray-600">
      Create a New Account?
      <a href="Singin.php" class="text-blue-600 hover:underline">Singin</a>
    </p>
  </div>

</body>
</html>
