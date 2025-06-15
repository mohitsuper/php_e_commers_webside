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

    <div class="overflow-x-auto overflow-y-auto shadow-lg rounded-lg bg-white p-6">
      <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="text-xs uppercase bg-blue-100 text-gray-700">
          <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3">USERNAME</th>
            <th class="px-6 py-3">PASSWORD</th>
            <th class="px-6 py-3">EMAIL</th>
            <th class="px-6 py-3">ROLE</th>
            <th class="px-6 py-3">profile image</th>
            <th class="px-6 py-3">ACTION</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php
          include("../Commen_file/Connction.php");
          $sql = "SELECT * FROM user_info";
          $data = mysqli_query($conn,$sql);
          $row = mysqli_num_rows($data);
          if ($row> 0) {
            $i=1;
            while($resulte = mysqli_fetch_assoc($data)) {
              $img = ($resulte["profile_image"])?$resulte["profile_image"]:"../Commen_file/Product_images/user.png";
              echo "<tr>
                      <td class='px-6 py-4'>" .$i++. "</td>
                      <td class='px-6 py-4'>" . $resulte["username"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["user_password"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["email"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["user_action"] . "</td>
                      <td class='px-6 py-4'><img src=".$img." class='h-20 w-30 overflow-contain'/></td>
                      <td class='px-6 py-4'>
                      <a href='Index.php?update_user&id=".$resulte['id']."' class='bg-green-500 px-2 py-1 text-white rounded-[3px] mr-2'>Edit</a>
                      <a href='Index.php?remove_user&id=".$resulte['id']."' class='bg-red-500 px-2 py-1 text-white rounded-[3px] mr-2'>Remove</a>
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
