<?php
session_start();


// Pastikan pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  // Jika tidak, arahkan ke halaman login
  header("Location: log_in.html");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Lost and Found</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Konfigurasi -->
    <script>
    // Mencegah pengguna kembali ke halaman sebelumnya
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>

  </head>
  <body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
      <div class="w-64 bg-[#124076] text-white">
        <img
          class="h-[5rem] m-auto mt-[1rem]"
          src="Assets/img/lostnfoundlogowhite.png"
        />
        <ul class="mt-6 space-y-2">
          <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Items Lost</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700"
              >Items Found</a
            >
          </li>
          <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Users</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Settings</a>
          </li>
        </ul>
      </div>

      <!-- Main Content -->
      <div class="flex-1 p-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
          <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Lost Items -->
            <div class="bg-blue-100 p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Lost Items</h3>
              <p class="text-xl font-bold">120</p>
            </div>
            <!-- Found Items -->
            <div class="bg-green-100 p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Found Items</h3>
              <p class="text-xl font-bold">85</p>
            </div>
            <!-- Users -->
            <div class="bg-yellow-100 p-4 rounded-lg shadow-md">
              <h3 class="text-lg font-semibold">Registered Users</h3>
              <p class="text-xl font-bold">200</p>
            </div>
          </div>
        </div>

        <div class="mt-6 bg-white rounded-lg shadow-lg p-6">
          <h2 class="text-2xl font-semibold mb-4">Recent Activity</h2>
          <table class="min-w-full table-auto">
            <thead>
              <tr>
                <th class="px-4 py-2 text-left">Item Name</th>
                <th class="px-4 py-2 text-left">Category</th>
                <th class="px-4 py-2 text-left">Status</th>
                <th class="px-4 py-2 text-left">Date</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-t">
                <td class="px-4 py-2">Wallet</td>
                <td class="px-4 py-2">Personal</td>
                <td class="px-4 py-2 text-green-500">Found</td>
                <td class="px-4 py-2">Nov 25, 2024</td>
              </tr>
              <tr class="border-t">
                <td class="px-4 py-2">Keys</td>
                <td class="px-4 py-2">Household</td>
                <td class="px-4 py-2 text-blue-500">Lost</td>
                <td class="px-4 py-2">Nov 23, 2024</td>
              </tr>
              <tr class="border-t">
                <td class="px-4 py-2">Phone</td>
                <td class="px-4 py-2">Electronics</td>
                <td class="px-4 py-2 text-green-500">Found</td>
                <td class="px-4 py-2">Nov 21, 2024</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
