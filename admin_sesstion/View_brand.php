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

    <div class="overflow-x-auto shadow-lg rounded-lg bg-white p-6">
      <table class="min-w-full text-sm text-left text-gray-500">
        <thead class="text-xs uppercase bg-blue-100 text-gray-700">
          <tr>
            <th class="px-6 py-3">ID</th>
            <th class="px-6 py-3">BRAND NAME</th>
            <th class="px-6 py-3">ACTION</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php
          include("../Commen_file/Connction.php");
          $sql = "SELECT * FROM insert_brand";
          $data = mysqli_query($conn,$sql);
          $row = mysqli_num_rows($data);
          if ($row> 0) {
            while($resulte = mysqli_fetch_assoc($data)) {
              echo "<tr>
                      <td class='px-6 py-4'>" . $resulte["id"] . "</td>
                      <td class='px-6 py-4'>" . $resulte["brand_name"] . "</td>
                      <td class='px-6 py-4'>
                      <a href='Index.php?update_brand&id=".$resulte['user_id']."&brand_id=".$resulte['id']."' class='bg-green-500 px-2 py-1 text-white rounded-[3px] mr-2'>Edit</a>
                      <a href='Index.php?remove_brand&id=".$resulte['user_id']."&brand_id=".$resulte['id']."' class='bg-red-500 px-2 py-1 text-white rounded-[3px] mr-2' class='bg-red-500 px-2 py-1 text-white rounded-[3px] mr-2' onclick='return remove()'>Remove</a>
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

<script>
  function remove() {
    var r = confirm("Are you sure you want to delete this record?");

  }
</script>