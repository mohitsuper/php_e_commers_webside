<?php
include("Seller_Function.php");
include("../Commen_file/Header.php");
include("../Commen_file/Sidebar_links.php");
include("../Commen_file/Connction.php");
include("seller_info_display.php");
include("../Commen_file/Get_ip_address.php");
include("../Commen_file/Fuction_home_sesstion.php");
include("SubFunction.php");
session_start();
$seller = "Seller_dashbord.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>E-commerce Website | Seller Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php
    $user_id = $_SESSION['username_id'];
    $query_seller_info = "SELECT * FROM seller_info where user_id=$user_id";
    $res_seller_info = mysqli_query($conn,$query_seller_info);
    if(mysqli_num_rows($res_seller_info)>0){
    while($res = mysqli_fetch_assoc($res_seller_info)){
      ?>
      <body class="bg-gray-100 text-gray-800">
        <!-- Header -->
        <header class=" top-0 left-0 right-0 bg-white shadow z-50">
          <?php header_seller(); ?>
        </header>
      
        <!-- Main Content Area -->
        <div class="flex h-[100vh] ">
      
          <!-- Sidebar -->
          <aside class=" bg-white shadow p-4 hidden md:block text-center">
            <?php Sidebar_Seller($seller); ?>
          </aside>
      
          <!-- Main Content -->
          <main class="flex-1 p-6 bg-white">
      
            <div class="bg-white p-6 rounded-lg shadow h-full w-full">
              <?php
                if(!isset($_GET['insert_category'])){
                    if(!isset($_GET['insert_brand'])){
                      if(!isset($_GET['insert_product'])){
                        if(!isset($_GET['Seller_dashbord'])){
                          if(!isset($_GET['view_product'])){
                            if(!isset($_GET['view_brand'])){
                              if(!isset($_GET['view_category'])){
                                if(!isset($_GET['update'])){
                                  if(!isset($_GET['logout'])){
                                      if(!isset($_GET['update_category'])){
                                          if(!isset($_GET['update_product'])){
                                                                                                if(!isset($_GET['remove_product'])){


                                        seller_User_display();}
                                      }

                                    }
                                  }
                                }
      
                              }
      
                            }
      
                          }
                        }
      
                      }
                    }
                }
                if(isset($_GET['insert_category'])){
                  include("../admin_sesstion/Insert_category.php");
                }
                else if(isset($_GET['insert_brand'])){
                  include("../admin_sesstion/Insert_brand.php");
                }
                else if(isset($_GET['insert_product'])){
                  include("../admin_sesstion/Insert_Product.php");
                }
                else if(isset($_GET['Seller_dashbord'])){
                  seller_User_display();
                }
                else if(isset($_GET['view_product'])){
                  echo "<h2 class='text-2xl font-semibold mb-4'>Product List</h2>";
                   seller_insert_product_display(); 
                }
                else if(isset($_GET['view_brand'])){
                  seller_insert_brand_display();
                }
               else if(isset($_GET['view_category'])){
                  seller_insert_category_display();
                }
      
                else if(isset($_GET['update'])){
                  seller_User_info_update();
                }
                else if(isset($_GET['logout'])){
                  seller_account_delect();
                }
                else if(isset($_GET['remove_category'])){
                  remove_category($seller);
                }
                else if(isset($_GET['update_category'])){
                  update_category($seller);
                }    
                else if(isset($_GET['update_brand'])){
                  update_brand($seller);
                }
                else if(isset($_GET['remove_brand'])){
                  remove_brand($seller);
                }
                else if(isset($_GET['update_product'])){
                  update_product($seller);
                }
                else if(isset($_GET['remove_product'])){
                  remove_product($seller);
                }
              ?>
            </div>
      
          </main>
        </div>
      
      </body>
      <?php
    }
  }
  else{
      $_GET['id'] = $user_id;  // Pass the value manually
      include('../Seller/Seller_info.php');  
  }

?>

</html>
