<?php
include("../Commen_file/Header.php");
session_start();
include("../Commen_file/Fuction_home_sesstion.php");
$get_ip_address=get_client_ip();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>payment Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 text-gray-800">
   <!-- header -->
    <?php header_top()?>
  <!-- Main Content -->
  <h1 class="py-5 bg-white text-xl uppercase font-bold text-blue-600 w-full text-center">payment Page</h1>
    <div class="bg-white h-[100vh] w-full">
        <div class="flex items-center gap-10">
            <div class="w-full h-30 ml-10">
                <a class="" href="https://www.paypal.com/" target="_blank">
                    <img src="../Commen_file/Product_images/online_payment.png" alt="" class="w-full h-full object-contain">
                </a>    
            </div>
            <a href="Offline_payment.php?get_ip_address=<?php echo $get_ip_address;?>" class="flex justify-center  w-full underline text-blue-500 text-lg font-bold">OFFLINE PAYMENT</a>
        </div>
  </div>

</body>
</html>
