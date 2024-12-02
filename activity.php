<?php 

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>activity</title>
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
  </head>
  <body>
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
          class="nav-links duration-500 md:static absolute bg-white md:min-h-fit min-h-[60vh] left-0 top-[-100%] md:w-auto w-full flex items-center px-2 lg:px-5 z-10 text-xs lg:text-base"
        >
          <ul
            class="flex md:flex-row flex-col md:items-center md:gap-[4vw] gap-8"
          >
            <li>
              <a
                class="hover:text-gray-500"
                href="user_dashboard.php"
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
              <a class="hover:text-gray-500 border-b-4 border-[#124076] pb-2" href="activity.html">Activity</a>
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

    <!-- Activity Section -->
    <div class="bg-[#9BB3CD] min-h-screen py-10">
        <!-- My Activity Section -->
        <section class="max-w-5xl mx-auto bg-white rounded-md shadow-md p-8">
          <h2 class="text-3xl font-semibold mb-6">My Activity</h2>
      
          <!-- Activity Item 1 -->
          <div class="flex items-start justify-between bg-blue-50 p-4 rounded-md mb-4">
            <div class="flex items-center space-x-4">
              <img
                src="https://via.placeholder.com/100"
                alt="Tas Ransel"
                class="w-24 h-24 object-cover rounded"
              />
              <div>
                <h3 class="text-xl font-medium">Tas Ransel</h3>
                <p class="text-gray-500">Detail Laporan</p>
                <button data-action="update_status" id="7" class="mt-2 bg-[#124076] text-white py-1 px-4 rounded hover:bg-[#336fb3]">Ubah Status</button>
                <button data-action="delete" id="8" class="mt-2 bg-red-100 text-red-700 py-1 px-4 rounded hover:bg-red-200">Hapus Laporan</button>
              </div>
            </div>
            <div class="flex flex-col space-y-2 ml-4">
              <span class="bg-green-100 text-green-700 px-3 py-1 rounded-md text-sm text-center">Completed</span>
              <span class="bg-red-100 text-red-700 px-3 py-1 rounded-md text-sm text-center">Found</span>
            </div>
          </div>
      
          <!-- Activity Item 2 -->
          <div class="flex items-start justify-between bg-blue-50 p-4 rounded-lg mb-4">
            <div class="flex items-center space-x-4">
              <img
                src="https://via.placeholder.com/100"
                alt="Topi Abu Abu"
                class="w-24 h-24 object-cover rounded"
              />
              <div>
                <h3 class="text-xl font-medium">Topi Abu Abu</h3>
                <p class="text-gray-500">Detail Laporan</p>
                <button class="mt-2 bg-[#124076] text-white py-1 px-4 rounded hover:bg-[#336fb3]">Ubah Status</button>
                <button class="mt-2 bg-red-100 text-red-700 py-1 px-4 rounded hover:bg-red-200">Hapus Laporan</button>
              </div>
            </div>
            <div class="flex flex-col space-y-2 ml-4">
              <span class="bg-red-100 text-red-700 px-3 py-1 rounded-md text-sm text-center">On Going</span>
              <span class="bg-red-100 text-red-700 px-3 py-1 rounded-md text-sm text-center">Lost</span>
            </div>
          </div>
      
          <!-- Activity Item 3 -->
          <div class="flex items-start justify-between bg-blue-50 p-4 rounded-lg mb-4">
            <div class="flex items-center space-x-4">
              <img
                src="https://via.placeholder.com/100"
                alt="Jam Tangan"
                class="w-24 h-24 object-cover rounded"
              />
              <div>
                <h3 class="text-xl font-medium">Jam Tangan</h3>
                <p class="text-gray-500">Detail Laporan</p>
                <button class="mt-2 bg-[#124076] text-white py-1 px-4 rounded hover:bg-[#336fb3]">Ubah Status</button>
                <button class="mt-2 bg-red-100 text-red-700 py-1 px-4 rounded hover:bg-red-200">Hapus Laporan</button>
              </div>
            </div>
            <div class="flex flex-col space-y-2 ml-4">
              <span class="bg-red-100 text-red-700 px-3 py-1 rounded-md text-sm text-center">On Going</span>
              <span class="bg-red-100 text-red-700 px-3 py-1 rounded-md text-sm text-center">Found</span>
            </div>
          </div>
      
          <!-- Activity Item 4 -->
          <div class="flex items-start justify-between bg-blue-50 p-4 rounded-lg mb-4">
            <div class="flex items-center space-x-4">
              <img
                src="https://via.placeholder.com/100"
                alt="Dompet"
                class="w-24 h-24 object-cover rounded"
              />
              <div>
                <h3 class="text-xl font-medium">Dompet</h3>
                <p class="text-gray-500">Detail Laporan</p>
                <button class="mt-2 bg-[#124076] text-white py-1 px-4 rounded hover:bg-[#336fb3]">Ubah Status</button>
                <button class="mt-2 bg-red-100 text-red-700 py-1 px-4 rounded hover:bg-red-200">Hapus Laporan</button>
              </div>
            </div>
            <div class="flex flex-col space-y-2 ml-4">
              <span class="bg-red-100 text-red-700 px-3 py-1 rounded-md text-sm text-center">On Going</span>
              <span class="bg-red-100 text-red-700 px-3 py-1 rounded-md text-sm text-center">Lost</span>
            </div>
          </div>
        </section>
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
                    <a href="https://flowbite.com/" class="hover:underline"
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
      <!-- Javascript -->
      <script>
        const navLinks = document.querySelector(".nav-links");
        function onToggleMenu(e) {
          e.name = e.name === "menu" ? "close" : "menu";
          navLinks.classList.toggle("top-[11%]");
        }
      </script>

      <!-- JS Ajax -->
      <script>
document.addEventListener('DOMContentLoaded', function () {
    // Event listener for "Ubah Status" buttons
    document.querySelectorAll('button[data-action="update_status"]').forEach(button => {
        button.addEventListener('click', function () {
            const reportId = this.dataset.id;
            const newStatus = prompt('Enter new status (e.g., Completed, On Going):');

            if (newStatus) {
                fetch('actions.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        action: 'update_status',
                        id: reportId,
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => alert(data.message))
                .catch(error => console.error('Error:', error));
            }
        });
    });

    // Event listener for "Hapus Laporan" buttons
    document.querySelectorAll('button[data-action="delete"]').forEach(button => {
        button.addEventListener('click', function () {
            const reportId = this.dataset.id;

            if (confirm('Are you sure you want to delete this report?')) {
                fetch('actions.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        action: 'delete',
                        id: reportId
                    })
                })
                .then(response => response.json())
                .then(data => alert(data.message))
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
</script>

  </body>
</html>
