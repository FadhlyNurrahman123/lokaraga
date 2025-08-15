<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Riwayat - LokaRaga</title>
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
      <a href="/penyewa/pesan" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="/images/pesan-white.png" class="h-5" alt="Pesan">
        <span>Pesan</span>
      </a>
      <a href="/penyewa/riwayat" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
        <img src="/images/riwayat-black.png" class="h-5" alt="Riwayat">
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
      <h1 class="text-xl">Riwayat</h1>
      <div class="flex items-center gap-3">
        <div class="relative w-60">
          <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder-black border border-black rounded-md focus:outline-none">
          <img src="/images/icon-search.png" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
        </div>
        <a href="/penyewa/akun">
          <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
        </a>
      </div>
    </div>
    <hr class="w-full border-t-2 border-black opacity-20 mb-8">
    <h2 class="text-lg mb-6">Lihat riwayat pesanan Anda disini ...</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <h3 class="font-semibold mb-3 mt-3">Pesanan Sedang Berlangsung</h3>
        <div id="pesanan-berlangsung"></div>
      </div>
      <div>
        <h3 class="font-semibold mb-3 mt-3">Pesanan Selesai</h3>
        <div id="pesanan-selesai"></div>
      </div>
    </div>
    <div>
      <h3 class="font-semibold mb-3 mt-3">Membership</h3>
      <div id="riwayat-membership" class="grid grid-cols-1 md:grid-cols-2 gap-6"></div>
    </div>
  </main>
  <script>
    const token = localStorage.getItem("token");
    const userName = localStorage.getItem("user_name");

    function isSedangBerlangsung(dateStr) {
      const today = new Date();
      const date = new Date(dateStr);
      today.setHours(0, 0, 0, 0);
      date.setHours(0, 0, 0, 0);
      return date >= today;
    }

    function formatRupiah(angka) {
      if (!angka) return "-";
      const num = typeof angka === "string" ? angka.replace(/[^\d]/g, "") : angka;
      return `${parseInt(num).toLocaleString("id-ID")}`;
    }

    document.addEventListener("DOMContentLoaded", async () => {
      const sedangDiv = document.getElementById("pesanan-berlangsung");
      const selesaiDiv = document.getElementById("pesanan-selesai");
      const membershipDiv = document.getElementById("riwayat-membership");

      try {
        // === 1. Fetch Pesanan ===
        const resPesanan = await fetch(`${API_BASE_URL}/pesanan`, {
          headers: {
            Authorization: `Bearer ${token}`
          },
        });
        if (!resPesanan.ok) throw new Error("Gagal memuat data pesanan");
        const resultPesanan = await resPesanan.json();

        const pesananUser = resultPesanan.data.filter(item => item.user_id === userName);

        let hasSedang = false;
        let hasSelesai = false;

        pesananUser.forEach(item => {
          const card = document.createElement("div");
          card.className = "bg-white rounded-2xl shadow-md p-4 w-full max-w-2xl mb-4";
          card.innerHTML = `
          <div class="flex justify-between items-center mb-4">
            <p class="font-semibold text-md">ID transaksi: INV-${item.id}-FT</p>
            <span class="text-[#1BE387] font-bold text-md">${formatRupiah(item.total_harga)}</span>
          </div>
          <div class="flex justify-between items-start">
            <div class="space-y-1">
              <p class="text-sm text-gray-700">${item.lapangan_id}</p>
              <p class="text-sm text-gray-700">${item.tanggal}</p>
            </div>
            <a href="/penyewa/detail-riwayat/${item.id}" class="bg-[#FFE500] text-black px-4 py-1 text-sm rounded-full font-medium h-fit">Detail</a>
          </div>
        `;

          if (isSedangBerlangsung(item.tanggal)) {
            sedangDiv.appendChild(card);
            hasSedang = true;
          } else {
            selesaiDiv.appendChild(card);
            hasSelesai = true;
          }
        });

        if (!hasSedang) {
          sedangDiv.innerHTML = `
          <div class="bg-white rounded-2xl p-20 flex items-center justify-center shadow-md w-full">
            <p class="italic text-center text-gray-600">Tidak ada pesanan berlangsung</p>
          </div>`;
        }
        if (!hasSelesai) {
          selesaiDiv.innerHTML = `
          <div class="bg-white rounded-2xl p-20 flex items-center justify-center shadow-md w-full">
            <p class="italic text-center text-gray-600">Tidak ada riwayat pesanan selesai</p>
          </div>`;
        }

        // Fetch membership
        const resMember = await fetch(`${API_BASE_URL}/member`, {
          headers: {
            Authorization: `Bearer ${token}`
          },
        });
        const resultMember = await resMember.json();

        // Fetch jenis membership
        const resJenis = await fetch(`${API_BASE_URL}/jenismember`, {
          headers: {
            Authorization: `Bearer ${token}`
          },
        });
        const resultJenis = await resJenis.json();

        const memberUser = resultMember.data.filter(m => m.user_id == userName);

        if (memberUser.length > 0) {
          memberUser.forEach(m => {
            // Cari harga berdasarkan nama membership
            const jenis = resultJenis.data.find(j => j.nm_membership === m.jenismember_id) || {};

            const card = document.createElement("div");
            card.className = "bg-white rounded-2xl shadow-md p-4 w-full max-w-2xl mb-4";

            card.innerHTML = `
      <div class="flex justify-between items-center mb-2">
        <p class="font-semibold text-md">ID transaksi: INV-${m.id}-MB</p>
        <span class="text-[#1BE387] font-bold text-md">${formatRupiah(jenis.harga)}</span>
      </div>
      <div class="flex justify-between items-start">
        <div class="space-y-1">
          <p class="text-sm text-gray-900 font-semibold">${m.lapangan_id}</p>
          <p class="text-sm text-gray-700">${m.jenismember_id}</p>
        </div>
        <a href="/penyewa/detail-membership/${m.id}" class="bg-[#FFE500] text-black px-4 py-1 text-sm rounded-full font-medium h-fit">Detail</a>
      </div>
    `;
            membershipDiv.appendChild(card);
          });
        } else {
          membershipDiv.innerHTML = `
    <div class="bg-white rounded-2xl p-20 flex items-center justify-center shadow-md w-full">
      <p class="italic text-center text-gray-600">Tidak ada membership</p>
    </div>`;
        }

      } catch (error) {
        console.error(error);
      }
    });
  </script>
</body>

</html>