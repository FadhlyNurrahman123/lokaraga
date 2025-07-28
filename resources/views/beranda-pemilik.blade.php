<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Beranda Pemilik - LokaRaga</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/js/config.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Reem+Kufi&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    .font-reem {
      font-family: 'Reem Kufi', sans-serif;
    }

    .bg-blue {
      background-color: #0F4BA1;
    }
  </style>
</head>

<body class="flex min-h-screen bg-white">
  <aside class="w-64 bg-blue text-white p-6 flex flex-col space-y-6">
    <div class="mb-3">
      <div class="flex items-center space-x-3">
        <img src="/images/logo2.png" alt="Logo" class="h-10">
        <span class="text-white text-2xl font-reem font-bold mt-5">LokaRaga</span>
      </div>
      <hr class="mt-5 border-t-2 border-white opacity-100">
    </div>
    <nav class="space-y-4">
      <a href="/beranda-pemilik" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
        <img src="/images/beranda-black.png" class="h-5" alt="Home">
        <span>Beranda</span>
      </a>
      <a href="/kelola-pemilik" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="/images/pesan-white.png" class="h-5" alt="Kelola">
        <span>Kelola</span>
      </a>
      <a href="/riwayat-pemilik" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="/images/riwayat-white.png" class="h-5" alt="Riwayat">
        <span>Riwayat</span>
      </a>
      <a href="/membership-pemilik" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="/images/membership-white.png" class="h-5" alt="Membership">
        <span>Membership</span>
      </a>
      <a href="/akun-pemilik" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="/images/akun-white.png" class="h-5" alt="Akun">
        <span>Akun</span>
      </a>
    </nav>
  </aside>
  <main class="flex-1 p-8">
    <div class="flex justify-between items-center mb-5">
      <h1 class="text-xl" id="welcome">Selamat Datang, ...</h1>
      <div class="flex items-center gap-3">
        <div class="relative w-60">
          <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder-black text-sm border border-black rounded-md focus:outline-none">
          <img src="/images/icon-search.png" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
        </div>
        <a href="/akun-pemilik">
          <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
        </a>
      </div>
    </div>
    <hr class="w-full border-t-2 border-black opacity-20">

    <div class="gap-8 mt-6">
      <div class="bg-blue text-white rounded-2xl p-8 flex justify-between items-center">
        <div>
          <p class="text-2xl font-bold">Total Pendapatan</p>
          <p class="text-lg">Rajawali Futsal</p>
        </div>
        <h2 class="text-4xl font-bold">Rp 5.000.000</h2>
      </div>
    </div>
    <div class="grid grid-cols-2 gap-8 mt-10">
      <div>
        <div class="flex justify-between mb-3">
          <h2 class="text-lg">Riwayat Pesanan</h2>
          <a href="/riwayat-pemilik" class="w-10 h-10 flex items-center justify-center">
            <img src="/images/arrow-rounded.png" class="w-5 h-5">
          </a>
        </div>
        <div id="pesananContainer" class="space-y-4"></div>
      </div>
      <div>
        <div class="flex justify-between mb-3">
          <h2 class="text-lg">Daftar Membership</h2>
          <a href="/membership-pemilik" class="w-10 h-10 flex items-center justify-center">
            <img src="/images/arrow-rounded.png" class="w-5 h-5">
          </a>
        </div>
        <div id="membershipContainer" class="space-y-4"></div>
      </div>
    </div>
  </main>

  <script>
    const token = localStorage.getItem("token");

    document.getElementById("welcome").textContent = `Selamat Datang, ${localStorage.getItem("user_name") || "Pengguna"}`;

    // Dummy data bisa diganti dari API
    const pesananContainer = document.getElementById("pesananContainer");
    const membershipContainer = document.getElementById("membershipContainer");

    const pesananDummy = [{
        id: 843012,
        lapangan_id: "Jonathan Kristianto",
        tanggal: "30 November 2024",
        total_harga: "70.000"
      },
      {
        id: 843014,
        lapangan_id: "Fadhly Nurrahman",
        tanggal: "29 November 2024",
        total_harga: "210.000"
      },
      {
        id: 843015,
        lapangan_id: "Fabian Marcell",
        tanggal: "29 November 2024",
        total_harga: "70.000"
      }
    ];

    const membershipDummy = [{
        id: 1,
        nama: "Jonathan Kristianto",
        info: "2 kali / minggu",
        harga: "450.000"
      },
      {
        id: 2,
        nama: "Fabian Marcell",
        info: "1 kali / minggu",
        harga: "255.000"
      }
    ];

    pesananDummy.forEach(item => {
      const card = document.createElement("div");
      card.className = "bg-white rounded-2xl p-4 shadow-md";
      card.innerHTML = `
        <div class="flex justify-between items-center mb-2">
          <p class="font-semibold text-md">ID transaksi: INV-${item.id}-FT</p>
          <span class="text-[#1BE387] font-bold text-xl">${item.total_harga}</span>
        </div>
        <div class="flex justify-between items-start">
          <div class="space-y-1">
            <p class="text-sm text-gray-700">${item.lapangan_id}</p>
            <p class="text-sm text-gray-700">${item.tanggal}</p>
          </div>
          <a href="/detail-riwayat/${item.id}" class="bg-yellow-400 text-black px-4 py-1 text-sm rounded-full font-medium h-fit">Detail</a>
        </div>
      `;
      pesananContainer.appendChild(card);
    });

    membershipDummy.forEach(item => {
      const card = document.createElement("div");
      card.className = "bg-white rounded-2xl p-4 shadow-md";
      card.innerHTML = `
        <div class="flex justify-between items-center mb-2">
          <p class="font-semibold text-md">Membership Bulanan</p>
          <span class="text-[#1BE387] font-bold text-xl">${item.harga}</span>
        </div>
        <div class="flex justify-between items-start">
          <div class="space-y-1">
            <p class="text-sm text-gray-700">${item.nama}</p>
            <p class="text-sm text-gray-700">${item.info}</p>
          </div>
          <a href="/detail-membership/${item.id}" class="bg-yellow-400 text-black px-4 py-1 text-sm rounded-full font-medium h-fit">Detail</a>
        </div>
      `;
      membershipContainer.appendChild(card);
    });
  </script>
</body>

</html>