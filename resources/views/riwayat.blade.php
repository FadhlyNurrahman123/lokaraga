<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Riwayat - LokaRaga</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
      <a href="/beranda" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="{{ asset('images/beranda-white.png') }}" class="h-5" alt="Home">
        <span>Beranda</span>
      </a>
      <a href="/pesan" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="{{ asset('images/pesan-white.png') }}" class="h-5" alt="Pesan">
        <span>Pesan</span>
      </a>
      <a href="/riwayat" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
        <img src="{{ asset('images/riwayat-black.png') }}" class="h-5" alt="Riwayat">
        <span>Riwayat</span>
      </a>
      <a href="/akun" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="{{ asset('images/akun-white.png') }}" class="h-5" alt="Akun">
        <span>Akun</span>
      </a>
    </nav>
  </aside>

  <main class="flex-1 p-8">
    <div class="flex justify-between items-center mb-5">
      <div class="flex items-center space-x-2">
        <h1 class="text-xl">Riwayat</h1>
      </div>
      <div class="flex items-center gap-3">
        <div class="relative w-60">
          <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder-black placeholder:text-sm border border-black rounded-md focus:outline-none">
          <img src="{{ asset('images/icon-search.png') }}" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
        </div>
        <a href="/akun">
          <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
        </a>
      </div>
    </div>
    <hr class="w-full border-t-2 border-black opacity-20 mb-8">

    <h2 class="text-lg mb-6">Lihat riwayat pesanan Anda disini ...</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <h3 class="font-semibold mb-3 mt-3">Pesanan Sedang Berlangsung</h3>
        <div class="bg-white rounded-2xl shadow-md p-4 w-full max-w-2xl">
          <div class="flex justify-between items-center mb-4">
            <p class="font-semibold text-md">ID transaksi: INV–843012–FT</p>
            <span class="text-[#1BE387] font-bold text-md">Rp 70.000</span>
          </div>
          <div class="flex justify-between items-start">
            <div class="space-y-1">
              <p class="text-sm text-gray-700">Rajawali Futsal</p>
              <p class="text-sm text-gray-700">12 Juni 2025</p>
            </div>
            <a href="/detail-riwayat" class="bg-yellow-400 text-black px-4 py-1 text-sm rounded-full font-medium h-fit">Detail</a>
          </div>

        </div>
      </div>
      <div>
        <h3 class="font-semibold mb-3 mt-3">Pesanan Selesai</h3>
        <div class="bg-white rounded-2xl shadow-md p-4 w-full max-w-2xl">
          <div class="flex justify-between items-center mb-4">
            <p class="font-semibold text-md">ID transaksi: INV–321097–BD</p>
            <span class="text-[#1BE387] font-bold text-md">Rp 50.000</span>
          </div>
          <div class="flex justify-between items-start">
            <div class="space-y-1">
              <p class="text-sm text-gray-700">GOR Premium</p>
              <p class="text-sm text-gray-700">15 Mei 2025</p>
            </div>
            <a href="/detail-riwayat" class="bg-yellow-400 text-black px-4 py-1 text-sm rounded-full font-medium h-fit">Detail</a>
          </div>
        </div>
      </div>
  </main>
</body>

</html>