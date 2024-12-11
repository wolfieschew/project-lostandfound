<?php
session_start();

// Pastikan pengguna sudah login dan memiliki role user
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
  // Jika tidak, arahkan ke halaman login
  header("Location: log_in.html");
  exit;
}

// Koneksi ke database
$host = 'localhost'; // Ganti dengan host database kamu
$user = 'root';      // Ganti dengan username database kamu
$password = '';      // Ganti dengan password database kamu
$dbname = 'lost_and_found_items'; // Ganti dengan nama database kamu

$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Ambil semua laporan dari tabel items
$sql = "SELECT * FROM items ORDER BY date_of_event DESC"; // Menampilkan semua laporan terbaru
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Playpen+Sans:wght@300;500&display=swap"
    rel="stylesheet" />
  <!-- Tailwind JS -->
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
  <!-- bx bx-icons -->
  <link
    href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
    rel="stylesheet" />
  <!-- flowbite -->
  <link
    href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"
    rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>user-dasboard</title>
</head>

<!-- Header Section -->

<body class="font-[Lato] h-screen">
  <header class="bg-white">
    <!-- Hanya header yang diberi sticky -->
    <nav class="flex justify-between items-center w-[90%] xl:w-[70%] mx-auto">
      <div>
        <img
          class="mb-3 mt-3 h-[4rem] sm:h-20 cursor-pointer"
          src="Assets/img/lostnfoundlogo.png"
          alt="..." />
      </div>
      <!-- Menu navigasi ini tetap absolute, tanpa kelas sticky -->
      <div
        class="nav-links duration-500 md:static absolute bg-white md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-2 lg:px-5 z-10 text-xs lg:text-base z-20">
        <ul
          class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8">
          <li>
            <a
              class="hover:text-gray-500 border-b-4 border-[#124076] pb-2"
              href="#">Home</a>
          </li>
          </li>
          <li>
            <a class="hover:text-gray-500" href="static_menu.html">Static</a>
          </li>
          <li>
            <a class="hover:text-gray-500" href="message.html">Message</a>
          </li>
          <li>
            <a class="hover:text-gray-500" href="profile.php">Profile</a>
          </li>
          <li>
            <a class="hover:text-gray-500" href="activity.php">Activity</a>
          </li>
          <li>
            <a class="hover:text-gray-500" href="about-us.html">About us</a>
          </li>
        </ul>
      </div>
      <div class="flex items-center gap-6">
        <!-- Notification Button -->
        <button
          type="button"
          class="text-white bg-[#124076] p-2 w-full h-full items-center rounded-[20%] hidden md:block">
          <!-- Notification Icon -->
          <i
            style="font-size: 1.5rem; padding-left: 0.5rem"
            class="bx bxs-bell"></i>
          <span class="ml-2 text-sm font-medium text-gray-700"></span>
        </button>

        <!-- Menu Icon -->
        <ion-icon
          onclick="onToggleMenu(this)"
          name="menu"
          class="text-3xl cursor-pointer md:hidden"></ion-icon>
      </div>

    </nav>
  </header>
  <!-- Header Section -->

  <!-- Search Section -->
  <section class="bg-[#91B0D3] h-[15rem] z-10">
    <div class="pt-10 relativ">
      <!-- Dropdown Buttons and Search -->
      <div
        class="w-[70%] m-auto mt-5 flex flex-col sm:flex-row items-center gap-4">
        <!-- Dropdown Button 1 -->
        <div class="relative inline-block w-full sm:w-auto">
          <button
            type="button"
            class="bg-[#fff] py-2 px-4 rounded-md shadow-lg w-full sm:w-auto"
            onclick="toggleDropdown1()">
            Pelaporan Barang
            <i style="font-size: 1.1rem;" class='bx bx-chevron-down'></i>
          </button>

          <!-- Dropdown Menu 1 -->
          <div
            id="dropdownMenu1"
            class="absolute mt-2 bg-white border border-gray-300 rounded-md shadow-md w-40 hidden z-20">
            <ul>
              <li>
                <a
                  href="form-pelaporan-hilang.html"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  Barang Hilang
                </a>
              </li>
              <li>
                <a
                  href="form-pelaporan-ditemukan.html"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  Barang Ditemukan
                </a>
              </li>
              <li>
                <a
                  href="form-pelaporan-informasi.html"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  Informasi Barang
                </a>
              </li>
            </ul>
          </div>
        </div>

        <!-- Search input -->
        <form class="w-full max-w-sm sm:max-w-md lg:max-w-4xl mx-auto px-auto">
          <div class="flex">
            <!-- Dropdown (Select) -->
            <div class="relative">
              <select
                id="category-dropdown"
                class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-black bg-gray-100 border border-gray-300 rounded-l-lg focus:ring-2 focus:outline-none focus:ring-blue-500">
                <option value="all" selected>All Categories</option>
                <option value="electronics">Elektronik</option>
                <option value="books">Buku & Dokument</option>
                <option value="accessories">Aksesori Pribadi</option>
                <option value="tools">Peralatan Khusus</option>
              </select>
            </div>

            <!-- Search input and button -->
            <div class="relative w-full">
              <input
                type="search"
                id="search-dropdown"
                class="block p-2.5 w-full z-20 text-sm text-black bg-white rounded-r-lg border border-gray-300 focus:text-black focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
                placeholder="Search"
                required />
              <button
                type="submit"
                class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-[#124076] rounded-r-lg focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
              </button>
            </div>
          </div>
        </form>

        <!-- Notification Button -->
        <div class="sm:ml-auto hidden sm:block">
          <!-- <button
              type="button"
              class="text-white bg-[#124076] p-2 w-full h-full items-center rounded-[20%]"
            > -->
          <!-- Notification Icon -->
          <!-- <i
                style="font-size: 1.5rem; padding-left: 0.5rem"
                class="bx bxs-bell"
              ></i>
              <span class="ml-2 text-sm font-medium text-gray-700"></span>
            </button> -->
        </div>
      </div>
    </div>
  </section>

  <!-- Card Section -->
  <section class="bg-[#91B0D3] h-[100rem] sm:h-[50rem] px-4 sm:px-6 lg:px-8">
    <div class="container mx-auto">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php
        if ($result->num_rows > 0) {
          // Loop melalui semua laporan
          while ($row = $result->fetch_assoc()) {
            // Tentukan warna dan keterangan status berdasarkan nilai 'type' di database
            $statusColor = ($row['type'] == 'hilang') ? 'bg-red-500' : 'bg-green-500'; // Warna merah untuk Lost, hijau untuk Found
            $statusText = ($row['type'] == 'hilang') ? 'Lost' : 'Found'; // Keterangan Lost atau Found

            // Tampilkan setiap laporan dalam bentuk card
            echo '<div class="bg-white shadow-md rounded-lg overflow-hidden">';
            echo '<div class="relative">';
            echo '<div class="absolute top-2 left-2 ' . $statusColor . ' text-white text-xs uppercase font-semibold px-2 py-1 rounded">';
            echo $statusText; // Menampilkan Lost atau Found
            echo '</div>';
            echo '<img src="' . $row['photo_path'] . '" alt="' . $row['item_name'] . '" class="w-full h-48 object-cover" />';
            echo '</div>';
            echo '<div class="p-4">';
            echo '<h3 class="text-lg font-semibold text-gray-800">' . htmlspecialchars($row['item_name']) . '</h3>';
            echo '<p class="text-sm text-gray-500 mt-2 flex items-center">';
            echo '<i class="bx bx-calendar-alt mr-1"></i> ' . htmlspecialchars($row['date_of_event']);
            echo '</p>';
            echo '<button class="mt-4 w-full bg-[#124076] text-white text-sm py-2 px-4 rounded hover:bg-[#2e64a1]" data-toggle="modal" data-target="#itemModal" data-id="' . $row['id'] . '" onclick="showItemDetails(' . $row['id'] . ')">';
            echo 'Details';
            echo '</button>';
            echo '</div>';
            echo '</div>';
          }
        } else {
          echo '<p class="text-center text-gray-500">No reports found.</p>';
        }
        ?>
      </div>
    </div>
  </section>
  <!-- End of Card Section -->

  <!-- Modal -->
  <!-- Modal -->
  <div id="itemModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex justify-center items-center h-full">
      <div class="bg-white p-6 rounded-lg max-w-lg w-full">
        <h2 class="text-xl font-semibold text-gray-800" id="modalItemName">Item Name</h2>
        <p class="text-sm text-gray-500 mt-2" id="modalItemDate">Date: Event Date</p>
        <p class="text-sm text-gray-500 mt-2" id="modalItemCategory">Category: Item Category</p>
        <p class="text-sm text-gray-500 mt-2" id="modalItemLocation">Location: Item Location</p>
        <p class="mt-4 text-gray-700" id="modalItemDescription">Item Description</p>
        <img id="modalItemImage" src="" alt="Item Image" class="mt-4 w-full h-48 object-cover">
        <p class="text-sm text-gray-500 mt-2" id="modalItemContact">Contact: Contact Info</p>
        <button id="closeModalBtn" class="mt-4 w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Close</button>
      </div>
    </div>
  </div>



  <!-- Footer Section -->

  <footer class="bg-[#124076]">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
      <div class="md:flex md:justify-between">
        <div class="mb-6 md:mb-0">
          <a href="#" class="flex items-center">
            <img
              src="Assets/img/lostnfoundlogowhite.png"
              class="h-28 me-3"
              alt="FlowBite Logo" />
          </a>
        </div>
        <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
          <div>
            <h2
              class="mb-6 text-sm font-semibold text-white uppercase dark:text-white">
              About
            </h2>
            <ul class="text-white font-medium">
              <li class="mb-4">
                <a href="#" class="hover:underline">About Lost and Found Items</a>
              </li>
            </ul>
          </div>
          <div>
            <h2
              class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
              Lost and Found Items
            </h2>
            <ul class="text-white font-medium">
              <li class="mb-4">
                <a
                  href="#"
                  class="hover:underline">Lost Items</a>
              </li>
              <li>
                <a
                  href="#"
                  class="hover:underline">Found Items</a>
              </li>
              <li>
                <a
                  href="#"
                  class="hover:underline">Information about Lost and Found Items</a>
              </li>
            </ul>
          </div>
          <div>
            <h2
              class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
              Legal
            </h2>
            <ul class="text-white font-medium">
              <li class="mb-4">
                <a href="#" class="hover:underline">Feedback</a>
              </li>
              <li>
                <a href="#" class="hover:underline">Terms &amp; Conditions Lost and Found Items</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <hr class="my-6 border-white sm:mx-auto" />
      <div class="text-center sm:flex sm:items-center sm:justify-between">
        <span class="text-sm text-white text-center">© 2024 <a href="/" class="hover:underline">Lost and Found Team</a>.
          All Rights Reserved.
        </span>
      </div>
    </div>
  </footer>

  <!-- Script JS  -->

  <script>
    const navLinks = document.querySelector(".nav-links");

    function onToggleMenu(e) {
      e.name = e.name === "menu" ? "close" : "menu";
      navLinks.classList.toggle("top-[11%]");
    }
  </script>

  <script>
    document.addEventListener("click", (e) => {
      // Dropdown 1
      const dropdownMenu1 = document.getElementById("dropdownMenu1");
      const dropdownButton1 = document.querySelector(
        'button[onclick="toggleDropdown1()"]'
      );

      if (
        !dropdownButton1.contains(e.target) &&
        !dropdownMenu1.contains(e.target)
      ) {
        dropdownMenu1.classList.add("hidden");
      }

      // Dropdown 2
      const dropdownMenu2 = document.getElementById("dropdownMenu2");
      const dropdownButton2 = document.querySelector(
        'button[onclick="toggleDropdown2()"]'
      );

      if (
        !dropdownButton2.contains(e.target) &&
        !dropdownMenu2.contains(e.target)
      ) {
        dropdownMenu2.classList.add("hidden");
      }
    });

    function toggleDropdown1() {
      const dropdownMenu1 = document.getElementById("dropdownMenu1");
      dropdownMenu1.classList.toggle("hidden");
    }

    function toggleDropdown2() {
      const dropdownMenu2 = document.getElementById("dropdownMenu2");
      dropdownMenu2.classList.toggle("hidden");
    }
  </script>
  <!-- Report Link -->
  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById('dropdownContent');
      dropdown.classList.toggle('hidden'); // Menampilkan atau menyembunyikan dropdown
    }
  </script>

  <!-- JavaScript for Modal -->
  <script>
    // Fungsi untuk menampilkan modal dan mengisi data
    function showItemDetails(itemId) {
      // Ambil data detail item berdasarkan ID (gunakan AJAX untuk mengambil data dari server)
      fetch('get_item_details.php?id=' + itemId)
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            alert('Item not found!');
          } else {
            // Isi modal dengan data item
            document.getElementById('modalItemName').innerText = data.item_name;
            document.getElementById('modalItemDate').innerText = 'Date: ' + data.date_of_event;
            document.getElementById('modalItemCategory').innerText = 'Category: ' + data.category;
            document.getElementById('modalItemLocation').innerText = 'Location: ' + data.location;
            document.getElementById('modalItemDescription').innerText = data.description;
            document.getElementById('modalItemImage').src = data.photo_path;
            document.getElementById('modalItemContact').innerText = 'Contact: ' + data.email + ' / ' + data.phone_number;

            // Tampilkan modal dengan menghapus class hidden
            document.getElementById('itemModal').classList.remove('hidden');
          }
        })
        .catch(error => console.error('Error fetching item details:', error));
    }

    // Fungsi untuk menutup modal
    document.getElementById('closeModalBtn').addEventListener('click', function() {
      document.getElementById('itemModal').classList.add('hidden');
    });
  </script>

  <!-- Flowbite -->
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>