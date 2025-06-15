<?php
include("../Commen_file/Fuction_home_sesstion.php");
include("../Commen_file/Header.php");
include("../Commen_file/Sidebar_links.php");
session_start();
Add_to_card();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>E-commerce Website | Home Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
   <!-- header -->
    <?php header_top()?>
  <!-- Main Content -->
  <div class="flex flex-row-reverse gap-4 p-4 h-[100vh]">

    <!-- Product List -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 w-full">
     <?php
      Card_Product();
      get_unique_category();
      get_unique_brand();
      Search_val();
     ?>   
     </div>

    <!-- Sidebar -->
     <?php Sidebar_link()?>
  </div>

</body>
</html>
