
<?php


    function productInvoeren(){
        include 'database.php';

        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
          $artikelnaam = $_POST['artikelnaam'];
          $soort = $_POST['soort'];
          $omschrijving = $_POST['omschrijving'];
          $prijs = $_POST['prijs'];
        
        
          if(empty($artikelnaam) || empty($soort) || empty($omschrijving) || empty($prijs)) {
            $status = "All fields are compulsory.";
          } else {
            if(strlen($artikelnaam) >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $artikelnaam)) {
              $status = "Please enter a valid name";
            } else {
        
              $sql = "INSERT INTO webshop (artikelnaam, soort, omschrijving, prijs) VALUES (:artikelnaam, :soort, :omschrijving, :prijs)";
        
              $stmt = $connect->prepare($sql);
              
              $stmt->execute(['artikelnaam' => $artikelnaam, 'soort' => $soort, 'omschrijving' => $omschrijving, 'prijs' => $prijs]);
        
              
              $artikelnaam = "";
              $soort = "";
              $omschrijving = "";
              $prijs = "";
              


         
            }
          }
        
        }
        if($stmt == true){
          echo "Product is ingevoerd <br>";
        }
       
    }

    function showList(){
        include 'database.php';
        $query = "SELECT * FROM webshop";
        $data = $connect->query($query);
        echo '<table width="70%" border="1" cellpadding="10" cellspacing="10">
        <tr>
        <th>Productnaam</th>
        <th>Soort</th>
        <th>Omschrijving</th>
        <th>Prijs</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>';


        foreach ($data as $row)
        {
            echo '<tr>
            <td>'.$row["artikelnaam"].'</td>
            <td>'.$row["soort"].'</td>
            <td>'.$row["omschrijving"].'</td>
            <td>'.$row["prijs"].'</td>
            <td><a href="?id=' . $row['artikelnummer'] . '&action=edit"><div style="color:green">Edit</div></a></td>
            <td><a href="?id=' . $row['artikelnummer'] . '&action=delete"><div style="color:red">Delete</div></a></td>
            </tr>';
            

}

echo '</table>';
return $data;
    }
    function deleteItem($id, $artikelnaam, $soort, $omschrijving, $prijs){
        include 'database.php';
        $id = $_GET['id'];
        $query = "DELETE FROM webshop where artikelnummer = $id";
        $stmt = $connect->prepare($query);
        $stmt->execute();
        if($stmt == true){
          echo "Artikel is verwijderd <br>";
        }
        
    }
    function updateItem($id, $artikelnaam, $soort, $omschrijving, $prijs)
    {
        include 'database.php';
        $query = "UPDATE webshop SET artikelnaam='$artikelnaam', soort='$soort', omschrijving='$omschrijving', prijs='$prijs' where artikelnummer ='$id'";
        $stmt = $connect->prepare($query);
        $stmt->execute();
        if($stmt == true){
          echo "Artikel is geupdate <br>";
        }
        
    }
    
    function showUpdateItem($id, $artikelnaam, $soort, $omschrijving, $prijs, $row){
      include 'database.php';
      $update = true;
       $id = $_GET['id'];
       $artikelnaam = $row['artikelnaam'];
       $soort = $row['soort'];
       $omschrijving = $row['omschrijving'];
       $prijs = $row['prijs'];
         $query = $connect->query("SELECT * FROM webshop WHERE artikelnummer=$id");
         $row = $query->fetch();
         
    }

    function showListData(){
        include 'database.php';
        $query = "SELECT * FROM webshop";
        $stmt = $connect->query($query);
        return $stmt;
    }


    function showItemsIndex(){
        $item = showListData();
      foreach ($item as $row){
        echo '
        <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
          <div class="lg:w-4/5 mx-auto flex flex-wrap">
            <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://dummyimage.com/400x400">
            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
              <h2 class="text-sm title-font text-gray-500 tracking-widest">'.$row["soort"].'</h2>
              <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">'.$row["artikelnaam"].'</h1>
              <div class="flex mb-4">
                <span class="flex items-center">
                  <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                  </svg>
                  <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                  </svg>
                  <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                  </svg>
                  <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                  </svg>
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                  </svg>
                  <span class="text-gray-600 ml-3">4 Reviews</span>
                </span>
                <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200 space-x-2s">
                  <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                      <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                  </a>
                  <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                      <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                    </svg>
                  </a>
                  <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                      <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                    </svg>
                  </a>
                </span>
              </div>
              <p class="leading-relaxed">'. $row["omschrijving"].'</p>
              <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">

                <div class="flex ml-6 items-center">
                  <div class="relative">

                    <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                      <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4" viewBox="0 0 24 24">
                      </svg>
                    </span>
                  </div>
                </div>
              </div>
              <div class="flex">
                <span class="title-font font-medium text-2xl text-gray-900">€'.$row["prijs"].' </span>
                <button id="'.$row["artikelnummer"].'" onClick="reply_click(this.id)" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Buy</button>
                <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
                  <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

        ';

      }


    }

?>

