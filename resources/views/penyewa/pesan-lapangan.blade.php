<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Pesan Lapangan - LokaRaga</title>
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
      <a href="/penyewa/beranda" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="/images/beranda-white.png" class="h-5" alt="Home">
        <span>Beranda</span>
      </a>
      <a href="/penyewa/pesan" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
        <img src="/images/pesan-black.png" class="h-5" alt="Pesan">
        <span>Pesan</span>
      </a>
      <a href="/penyewa/riwayat" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="/images/riwayat-white.png" class="h-5" alt="Riwayat">
        <span>Riwayat</span>
      </a>
      <a href="/penyewa/akun" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="/images/akun-white.png" class="h-5" alt="Akun">
        <span>Akun</span>
      </a>
    </nav>
  </aside>

  <main class="flex-1 p-8">
    <div class="flex justify-between items-center mb-5">
      <div class="flex items-center space-x-2">
        <a href="javascript:history.back()">
          <img src="/images/back-button.png" alt="Back" class="h-10 mx-3">
        </a>
        <h1 class="text-xl">Pesan</h1>
      </div>
      <div class="flex items-center gap-3">
        <div class="relative w-60">
          <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder-black placeholder:text-sm border border-black rounded-md focus:outline-none">
          <img src="/images/icon-search.png" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
        </div>
        <a href="/penyewa/akun">
          <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
        </a>
      </div>
    </div>
    <hr class="w-full border-t-2 border-black opacity-20 mb-8">

    <h2 class="text-lg mt-4 mb-4">Pilih Arena Olahraga</h2>

    <div id="lapangan-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    </div>
  </main>

  <script>
    const token = localStorage.getItem('token');

    if (!token) {
      alert("Kamu belum login. Silakan login dulu.");
    }

    const jenisMap = {
      1: "Futsal",
      2: "Sepakbola",
      3: "Basket",
      4: "Badminton"
    };

    function getJenisIdFromURL() {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get('jenis');
    }

    async function fetchLapangan() {
      try {
        const res = await fetch(`${API_BASE_URL}/lapangan`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });

        if (!res.ok) {
          throw new Error(`HTTP error! status: ${res.status}`);
        }

        const result = await res.json();
        const semuaLapangan = result.data;

        const jenisId = getJenisIdFromURL();
        const jenisNama = jenisMap[jenisId];

        if (!jenisNama) {
          document.getElementById('lapangan-container').innerHTML = '<p class="text-gray-500">Kategori tidak valid.</p>';
          return;
        }

        const filtered = semuaLapangan.filter(l => l.jenis_olahraga_id.toLowerCase() === jenisNama.toLowerCase());
        renderLapangan(filtered);
      } catch (error) {
        console.error("Gagal ambil data lapangan:", error);
        document.getElementById('lapangan-container').innerHTML = '<p class="text-red-500">Gagal mengambil data lapangan.</p>';
      }
    }

    function renderLapangan(data) {
      const container = document.getElementById('lapangan-container');
      const hargaFormat = (angka) => {
        return "Rp " + Number(angka).toLocaleString("id-ID");
      };

      container.innerHTML = '';

      if (data.length === 0) {
        container.innerHTML = '<p class="text-gray-500">Tidak ada lapangan untuk kategori ini.</p>';
        return;
      }

      data.forEach(lapangan => {
        container.innerHTML += `
          <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <img src="/storage/${lapangan.foto}" alt="${lapangan.nm_lapangan}" class="w-full h-40 object-cover">
            <div class="p-5 space-y-4">
              <h3 class="text-xl font-bold text-center mt-3">${lapangan.nm_lapangan}</h3>
              <p class="text-xs text-gray-600 text-center">${lapangan.alamat}</p>
              <p class="text-md text-center">${hargaFormat(lapangan.harga)} / jam</p>
              <a href="/penyewa/detail-lapangan/${lapangan.id}" class="inline-block w-full bg-[#0F4BA1] text-white text-center mt-5 py-2 rounded-md hover:bg-blue-800 transition">Detail Lapangan</a>
            </div>
          </div>
        `;
      });
    }

    window.addEventListener('DOMContentLoaded', fetchLapangan);
  </script>
</body>

</html>