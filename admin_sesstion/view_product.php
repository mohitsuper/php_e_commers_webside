<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP Table with Tailwind CSS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="container mx-auto mt-10 px-4">
    <h1 class="text-2xl font-bold text-center mb-6 text-blue-600">User Data Table</h1>

    <div class="overflow-x-auto overflow-y-auto shadow-lg rounded-lg bg-white p-6 h-[80vh]">
      <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="text-xs uppercase bg-blue-100 text-gray-700">
          <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3">PRODUCT TITLE</th>
            <th class="px-6 py-3">PRODUCT DESCRTION</th>
            <th class="px-6 py-3">PRODUCT BRAND</th>
            <th class="px-6 py-3">PRODUCT CATEGORY</th>
            <th class="px-6 py-3">PRODUCT PRICE</th>
            <th class="px-6 py-3">PRODUCT IMAGE1</th>
            <th class="px-6 py-3">PRODUCT IMAGE2</th>
            <th class="px-6 py-3">PRODUCT IMAGE3</th>
            <th class="px-6 py-3">PRODUCT IMAGE4</th>
            <th class="px-6 py-3">ACTION</th>

          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php
          include("../Commen_file/Connction.php");
          $sql = "SELECT * FROM product_info";
          $data = mysqli_query($conn,$sql);
          $row = mysqli_num_rows($data);
          if ($row> 0) {
            $i =1;
            while($resulte = mysqli_fetch_assoc($data)) {
              echo "<tr>
                      <td class='px-6 py-4'>" . $i++ . "</td>
                      <td class='px-6 py-4'>" . $resulte["product_title"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["product_description"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["product_brand"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["product_category"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["product_price"] . "</td>
                      <td class='px-6 py-4'><img src='" . $resulte["product_image1"] . "'/></td>
                      <td class='px-6 py-4'><img src='" . $resulte["product_image2"] . "'/></td>
                      <td class='px-6 py-4'><img src='" . $resulte["product_image3"] . "'/></td>
                      <td class='px-6 py-4'><img src='" . $resulte["product_image4"] . "'/></td>


                      <td class='px-6 py-4'>
                      <a href='Index.php?update_product&user_id=".$resulte['user_id']."&product_id=".$resulte['id']."' class='bg-green-500 px-2 py-1 text-white rounded-[3px] mr-2' class='bg-green-500 px-2 py-1 text-white rounded-[3px] mr-2'>Edit</a>
                      <a href='Index.php?remove_product&user_id=".$resulte['user_id']."&product_id=".$resulte['id']."' class='bg-red-500 px-2 py-1 text-white rounded-[3px] mr-2' class='bg-red-500 px-2 py-1 text-white rounded-[3px] mr-2'>Remove</a>
                      </td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='3' class='px-6 py-4 text-center text-red-500'>No records found</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
