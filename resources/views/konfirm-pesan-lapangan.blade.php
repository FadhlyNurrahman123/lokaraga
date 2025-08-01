<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Konfirmasi Pesan Lapangan - LokaRaga</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/js/config.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Reem+Kufi&display=swap"
    rel="stylesheet">
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
  <!-- Sidebar -->
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
      <a href="/pesan"
        class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
        <img src="{{ asset('images/pesan-black.png') }}" class="h-5" alt="Pesan">
        <span>Pesan</span>
      </a>
      <a href="/riwayat" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="{{ asset('images/riwayat-white.png') }}" class="h-5" alt="Riwayat">
        <span>Riwayat</span>
      </a>
      <a href="/akun" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
        <img src="{{ asset('images/akun-white.png') }}" class="h-5" alt="Akun">
        <span>Akun</span>
      </a>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-8">
    <div class="flex justify-between items-center mb-5">
      <div class="flex items-center space-x-2">
        <a href="javascript:history.back()">
          <img src="{{ asset('images/back-button.png') }}" alt="Back" class="h-10 mx-3">
        </a>
        <h1 class="text-xl">Pesan</h1>
      </div>
      <div class="flex items-center gap-3">
        <div class="relative w-60">
          <input type="text" placeholder="Search..."
            class="w-full py-2 pl-4 pr-10 text-black placeholder-black placeholder:text-sm border border-black rounded-md focus:outline-none">
          <img src="{{ asset('images/icon-search.png') }}" alt="Search"
            class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
        </div>
        <a href="/akun">
          <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
        </a>
      </div>
    </div>

    <hr class="w-full border-t-2 border-black opacity-20 mb-8">

    <h2 class="text-lg mb-4">Yuk selesaikan pesananmu ...</h2>

    <div
      class="bg-white rounded-2xl shadow-md p-6 flex flex-col lg:flex-row justify-between items-start lg:items-start space-y-4 lg:space-y-0">
      <div class="w-full lg:w-1/2">
        <h3 id="lapangan" class="text-xl font-bold mb-3">-</h3>
        <p id="harga" class="text-md">-</p>
      </div>

      <div class="w-full lg:w-1/2 pl-0 lg:pl-12 text-sm space-y-3">
        <div class="flex justify-between gap-8">
          <span class="text-xl font-medium">Detail Pesanan</span>
        </div>
        <div class="flex justify-between gap-8">
          <span>Tanggal</span>
          <span id="tanggal">-</span>
        </div>
        <div class="flex justify-between gap-8">
          <span>Jam</span>
          <span id="jam">-</span>
        </div>
        <div class="flex justify-between gap-8">
          <span>Total Bayar</span>
          <span id="total">-</span>
        </div>
      </div>
    </div>

    <div class="mt-6 flex justify-center">
      <button id="pesanBtn"
        class="w-72 bg-[#0F4BA1] text-white font-semibold px-8 py-2 rounded-full hover:bg-blue-800 transition">
        Pesan
      </button>
    </div>
    <div id="popupBerhasil"
      class="hidden fixed bottom-8 left-[60%] -translate-x-[110px] bg-green-600 text-white font-bold py-3 px-6 rounded-md shadow-lg w-32">
      <p class="text-center">Berhasil</p>
    </div>
  </main>

  <script>
    function getQueryParams() {
      const params = new URLSearchParams(window.location.search);
      return {
        tanggal: params.get("tanggal"),
        jam: params.get("jam"),
      };
    }

    document.addEventListener("DOMContentLoaded", () => {
      const {
        tanggal,
        jam
      } = getQueryParams();

      // Ambil data dari localStorage
      const namaLapangan = localStorage.getItem("nama_lapangan") || "Lapangan Tidak Dikenal";
      const harga = localStorage.getItem("harga") || "Rp -";
      const lapangan_id = localStorage.getItem("lapangan_id");
      const jadwal_id = localStorage.getItem("jadwal_id");
      const token = localStorage.getItem("token");

      // Tampilkan ke UI
      document.getElementById("lapangan").textContent = namaLapangan;
      document.getElementById("harga").textContent = harga;
      document.getElementById("tanggal").textContent = tanggal || "-";
      document.getElementById("jam").textContent = jam || "-";
      document.getElementById("total").textContent = harga;

      const pesanBtn = document.getElementById("pesanBtn");
      const popup = document.getElementById("popupBerhasil");

      pesanBtn.addEventListener("click", async () => {
        if (!lapangan_id || !jadwal_id || !tanggal || !token) {
          console.log({ lapangan_id, jadwal_id, tanggal, token });
          alert("Data pemesanan tidak lengkap.");
          return;
        }

        try {
          const response = await fetch(`${API_BASE_URL}/Createpesanan`, {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
              Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify({
              lapangan_id: parseInt(lapangan_id),
              jadwal_id: parseInt(jadwal_id),
              tanggal: tanggal,
            }),
          });

          const result = await response.json();

          if (response.ok) {
            // tampilkan popup dan redirect
            popup.classList.remove("hidden");
            setTimeout(() => {
              popup.classList.add("hidden");

              // optional: bersihkan localStorage
              localStorage.removeItem("lapangan_id");
              localStorage.removeItem("jadwal_id");
              localStorage.removeItem("nama_lapangan");
              localStorage.removeItem("harga");

              window.location.href = "/riwayat";
            }, 2000);
          } else {
            alert("Gagal memesan: " + (result.message || "Terjadi kesalahan."));
          }
        } catch (error) {
          console.error("Error:", error);
          alert("Terjadi kesalahan saat memesan.");
        }
      });
    });
  </script>


</body>

</html>