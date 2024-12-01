<?php
session_start();


// Pastikan pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
  // Jika tidak, arahkan ke halaman login
  header("Location: log_in.html");
  exit;
}
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
      rel="stylesheet"
    />
    <!-- Tailwind JS -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <!-- bx bx-icons -->
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- flowbite -->
    <link
      href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"
      rel="stylesheet"
    /> 
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
            alt="..."
          />
        </div>
        <!-- Menu navigasi ini tetap absolute, tanpa kelas sticky -->
        <div
          class="nav-links duration-500 md:static absolute bg-white md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-2 lg:px-5 z-10 text-xs lg:text-base z-20"
        >
          <ul
            class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8"
          >
            <li>
              <a
                class="hover:text-gray-500 border-b-4 border-[#124076] pb-2"
                href="#"
                >Home</a
              >
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
              <a class="hover:text-gray-500" href="activity.html">Activity</a>
            </li>
            <li>
              <a class="hover:text-gray-500 block md:hidden" href="about-us.html">About us</a>
            </li>
          </ul>
        </div>
        <div class="flex items-center gap-6">
          <button
            class="bg-[#124076] text-white p-4 rounded-md hover:bg-[#87acec] flex items-center md:block hidden"
          >
            <a href="about-us.html"><i class="bx bxs-quote-left"></i></a>
          </button>
          <ion-icon
            onclick="onToggleMenu(this)"
            name="menu"
            class="text-3xl cursor-pointer md:hidden"
          ></ion-icon>
        </div>
      </nav>
    </header>
    <!-- Header Section -->

    <!-- Search Section -->
    <section class="bg-[#91B0D3] h-[15rem] z-10">
      <div class="pt-10 relativ">
        <!-- Dropdown Buttons and Search -->
        <div
          class="w-[70%] m-auto mt-5 flex flex-col sm:flex-row items-center gap-4"
        >
          <!-- Dropdown Button 1 -->
          <div class="relative inline-block w-full sm:w-auto">
            <button
              type="button"
              class="bg-[#fff] py-2 px-4 rounded-md shadow-lg w-full sm:w-auto"
              onclick="toggleDropdown1()"
            >
              Pelaporan Barang
            </button>
            <!-- Dropdown Menu 1 -->
            <div
              id="dropdownMenu1"
              class="absolute mt-2 bg-white border border-gray-300 rounded-md shadow-md w-40 hidden z-20"
            >
              <ul>
                <li>
                  <a
                    href="form-pelaporan-hilang.html"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >
                    Barang Hilang
                  </a>
                </li>
                <li>
                  <a
                    href="form-pelaporan-ditemukan.html"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >
                    Barang Ditemukan
                  </a>
                </li>
                <li>
                  <a
                    href="form-pelaporan-informasi.html"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                  >
                    Informasi Barang
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <!-- Search input -->
          <form class="w-[250px] lg:w-[800px]  mx-auto">
            <div class="flex">
              <!-- Dropdown button -->
              <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your Email</label>
              <button 
                id="dropdown-button" 
                data-dropdown-toggle="dropdown" 
                class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-black bg-gray-100 border border-gray-300 rounded-s-lg focus:ring-2 focus:outline-none focus:ring-blue-500" 
                type="button">
                <span class="hidden lg:block">All categories</span> 
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
              </button>
              
              <!-- Dropdown menu -->
              <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                  <li>
                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Elektronik</button>
                  </li>
                  <li>
                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Buku & Dokument</button>
                  </li>
                  <li>
                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Aksesori Pribadi</button>
                  </li>
                  <li>
                    <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Peralatan Khusus</button>
                  </li>
                </ul>
              </div>
              
              <!-- Search input and button -->
              <div class="relative w-full">
                <input 
                  type="search" 
                  id="search-dropdown" 
                  class="block p-2.5 w-full z-20 text-sm text-black bg-white rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500  dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" 
                  placeholder="Search" 
                  required />
                <button   
                  type="submit" 
                  class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-[#124076] rounded-e-lg focus:ring-4 focus:outline-none focus:ring-blue-300">
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
            <button
              type="button"
              class="text-white bg-[#124076] p-2 w-full h-full items-center rounded-[20%]"
            >
              <!-- Notification Icon -->
              <i
                style="font-size: 1.5rem; padding-left: 0.5rem"
                class="bx bxs-bell"
              ></i>
              <span class="ml-2 text-sm font-medium text-gray-700"></span>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Section Card -->
    <section class="bg-[#91B0D3]  h-[100rem] sm:h-[50rem]">
      <div class="container mx-auto">
        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
        >
          <!-- Card 1 -->
          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="relative">
              <div
                class="absolute top-2 left-2 bg-red-500 text-white text-xs uppercase font-semibold px-2 py-1 rounded"
              >
                Lost
              </div>
              <img
                src="Assets/img/items/dompet.webp"
                alt="Tas Ransel"
                class="w-full h-48 object-cover"
              />
            </div>
            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-800">Tas Ransel</h3>
              <p class="text-sm text-gray-500 mt-2 flex items-center">
                <i class="bx bx-calendar-alt mr-1"></i> 24 April 2024
              </p>
              <button
                class="mt-4 w-full bg-[#124076] text-white text-sm py-2 px-4 rounded hover:bg-[#2e64a1]"
              >
                Details
              </button>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="relative">
              <div
                class="absolute top-2 left-2 bg-green-500 text-white text-xs uppercase font-semibold px-2 py-1 rounded"
              >
                Found
              </div>
              <img
                src="Assets/img/items/dompet.webp"
                alt="Tas Ransel"
                class="w-full h-48 object-cover"
              />
            </div>
            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-800">Tas Ransel</h3>
              <p class="text-sm text-gray-500 mt-2 flex items-center">
                <i class="bx bx-calendar-alt mr-1"></i> 24 April 2024
              </p>
              <button
                class="mt-4 w-full bg-[#124076] text-white text-sm py-2 px-4 rounded hover:bg-[#2e64a1]"
              >
                Details
              </button>
            </div>
          </div>
          <!-- Card 2 -->
          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="relative">
              <div
                class="absolute top-2 left-2 bg-green-500 text-white text-xs uppercase font-semibold px-2 py-1 rounded"
              >
                Found
              </div>
              <img
                src="Assets/img/items/dompet.webp"
                alt="Tas Ransel"
                class="w-full h-48 object-cover"
              />
            </div>
            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-800">Tas Ransel</h3>
              <p class="text-sm text-gray-500 mt-2 flex items-center">
                <i class="bx bx-calendar-alt mr-1"></i> 24 April 2024
              </p>
              <button
                class="mt-4 w-full bg-[#124076] text-white text-sm py-2 px-4 rounded hover:bg-[#2e64a1]"
              >
                Details
              </button>
            </div>
          </div>
          <!-- Card 2 -->
          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="relative">
              <div
                class="absolute top-2 left-2 bg-green-500 text-white text-xs uppercase font-semibold px-2 py-1 rounded"
              >
                Found
              </div>
              <img
                src="Assets/img/items/dompet.webp"
                alt="Tas Ransel"
                class="w-full h-48 object-cover"
              />
            </div>
            <div class="p-4">
              <h3 class="text-lg font-semibold text-gray-800">Tas Ransel</h3>
              <p class="text-sm text-gray-500 mt-2 flex items-center">
                <i class="bx bx-calendar-alt mr-1"></i> 24 April 2024
              </p>
              <button
                class="mt-4 w-full bg-[#124076] text-white text-sm py-2 px-4 rounded hover:bg-[#2e64a1]"
              >
                Details
              </button>
            </div>
          </div>

          <!-- Tambahkan Card lainnya -->
        </div>
      </div>
    </section>
    <!-- END Card Section -->

    <!-- Footer Section -->

    <footer class="bg-[#124076]">
      <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
          <div class="mb-6 md:mb-0">
            <a href="#" class="flex items-center">
              <img
                src="Assets/img/lostnfoundlogowhite.png"
                class="h-28 me-3"
                alt="FlowBite Logo"
              />
            </a>
          </div>
          <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
            <div>
              <h2
                class="mb-6 text-sm font-semibold text-white uppercase dark:text-white"
              >
                About
              </h2>
              <ul class="text-white font-medium">
                <li class="mb-4">
                  <a href="#" class="hover:underline"
                    >About Lost and Found Items</a
                  >
                </li>
              </ul>
            </div>
            <div>
              <h2
                class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white"
              >
                Lost and Found Items
              </h2>
              <ul class="text-white font-medium">
                <li class="mb-4">
                  <a
                    href="#"
                    class="hover:underline"
                    >Lost Items</a
                  >
                </li>
                <li>
                  <a
                    href="#"
                    class="hover:underline"
                    >Found Items</a
                  >
                </li>
                <li>
                  <a
                    href="#"
                    class="hover:underline"
                    >Information about Lost and Found Items</a
                  >
                </li>
              </ul>
            </div>
            <div>
              <h2
                class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white"
              >
                Legal
              </h2>
              <ul class="text-white font-medium">
                <li class="mb-4">
                  <a href="#" class="hover:underline">Feedback</a>
                </li>
                <li>
                  <a href="#" class="hover:underline"
                    >Terms &amp; Conditions Lost and Found Items</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
        <hr class="my-6 border-white sm:mx-auto" />
        <div class="text-center sm:flex sm:items-center sm:justify-between">
          <span class="text-sm text-white text-center"
            >© 2024 <a href="/" class="hover:underline">Lost and Found Team</a>.
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
    <!-- Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  </body>
</html>