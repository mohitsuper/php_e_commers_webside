<?php
include("../Commen_file/Connction.php");
 if(isset($_POST['submit'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $user_action = 'user';

    $query_table = "CREATE TABLE user_info
    (
      id INT(11) AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(255) NOT NULL,
      user_password VARCHAR(255) NOT NULL,
      email VARCHAR(255) NOT NULL
    )";
    mysqli_query($conn,$query_table);
    $query_insert = "INSERT INTO user_info (username, user_password,email,user_action) VALUES ('$username','$password','$email','$user_action')";
     $res = mysqli_query($conn,$query_insert);
     if(!$res){
      echo $conn->error;
     }
     else{
        echo "<script>alert('Data Inserted');</script>";
        header("Location:login.php");
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
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Create Account</h2>

    <form action="#" method="post" class="space-y-5">

      <div>
        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
        <input type="text" id="username" name="username" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" id="email" name="email" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" id="password" name="password" required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <input type="submit"
      name="submit"
      value="Sign Up"
      class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
    </form>

    <p class="mt-4 text-center text-sm text-gray-600">
      Already have an account?
      <a href="login.php" class="text-blue-600 hover:underline">Login here</a>
    </p>
  </div>

</body>
</html>
