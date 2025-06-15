
<?php
include("Connction.php");
function Sidebar_link(){
?>
    <div class="w-64 bg-white rounded-lg shadow p-4 flex flex-col gap-6 h-full">

      <!-- Categories -->
      <div>
        <!-- <h3 class="bg-blue-500 text-white text-center font-semibold py-2 rounded mb-1"><a href="All_Product.php">All product</a></h3> -->

        <h3 class="bg-blue-500 text-white text-center font-semibold py-2 rounded">Category</h3>
        <ul class="mt-2 space-y-1 text-left pl-3 text-sm">
          <?php
           Category_display()
          ?>
        </ul>
      </div>

      <!-- Brands -->
      <div>
        <h3 class="bg-blue-500 text-white text-center font-semibold py-2 rounded">Brand</h3>
        <ul class="mt-2 space-y-1 text-left pl-3 text-sm">
          <?php 
            Brand_display()
          ?>
        </ul>
      </div>

    </div>

<?php
}

?>