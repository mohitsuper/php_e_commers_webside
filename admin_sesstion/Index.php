<?php
session_start();
include("Admin_funtion.php");
include('../Seller/Seller_Function.php');
include('../Seller/seller_info_display.php');
include('../Commen_file/Connction.php');
include('../Commen_file/Get_ip_address.php');
include('../Seller/SubFunction.php');
include('../Commen_file/Fuction_home_sesstion.php');
$admin = 'Index.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Session</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<!-- header -->
 <?php header_admin();?>
<!-- heading -->

<!-- first layout -->
 <div class="user-info">
    <div class="flex gap-3 h-[100vh] w-full">
        <!-- <div class="nav-links-section bg-white w-[300px] h-full text-center">
            <h1 class="bg-blue-600 text-lg font-bold text-white text-center py-3">Manage Details</h1>
            <ul class="w-full flex flex-col gap-5 mt-3">
                <li><a href="#" class=" text-md text-black text-center py-5 w-full ">user information</a></li>
                <li><a href="Index.php?insert_category" class=" text-md text-black text-center py-5 w-full ">insert category</a></li>
                <li><a href="Index.php?insert_brand" class=" text-md text-black text-center py-5 w-full ">insert brand</a></li>
                <li><a href="Index.php?insert_product" class=" text-md text-black text-center py-5 w-full ">insert product</a></li>
                <li><a href="Index.php?view_product" class=" text-md text-black text-center py-5 w-full " >view product</a></li>
                <li><a href="Index.php?view_brand" class=" text-md text-black text-center py-5 w-full ">view brand</a></li>
                <li><a href="Index.php?view_category" class=" text-md text-black text-center py-5 w-full ">view Category</a></li>
                <li><a href="Index.php?view_user" class=" text-md text-black text-center py-5 w-full ">view User</a></li>

                <li><a href="#" class=" text-md text-black text-center py-5 w-full ">All Payment</a></li>
                <li><a href="#" class=" text-md text-black text-center py-5 w-full ">List order</a></li>

                <li><a href="#" class=" text-md text-black text-center py-5 w-full ">Logout</a></li>


            </ul>
        </div> -->
        <?php Sidebar_Seller($admin)?>
        <div class="display w-full">
            <?php

            if(isset($_GET['insert_category'])){
                include("insert_category.php");
            }
            else if(isset($_GET['dashbord'])){
                Dashbord();
            }
            else if(isset($_GET['insert_brand'])){
                include("insert_brand.php");
            }
            else if(isset($_GET['insert_product'])){
                include("Insert_product.php");
            }
            else if(isset($_GET['view_brand'])){
                include("view_brand.php");
            }
            else if(isset($_GET['view_product'])){
                include("view_product.php");
            }
            else if(isset($_GET['view_category'])){
                include("view_category.php");
            }
            else if(isset($_GET['view_user'])){
                include("View_user_info.php");
            }

            else if(isset($_GET['update_category'])){
                update_category($admin);
            }
            else if(isset($_GET['remove_category'])){
                remove_category($admin);
            }

            else if(isset($_GET['update_brand'])){
                update_brand($admin);
            }
            else if(isset($_GET['remove_brand'])){
                remove_brand($admin);
            }
            else if(isset($_GET['update_product'])){
                update_product($admin);
            }
            else if(isset($_GET['remove_product'])){
                remove_product($admin);
            }
            else if(isset($_GET['remove_user'])){
                remove_user();
            }
            else if(isset($_GET['update_user'])){
                update_user();
            }
            else{
                Dashbord();
            }
            ?>
        </div>
    </div>
 </div>

</body>
</html>