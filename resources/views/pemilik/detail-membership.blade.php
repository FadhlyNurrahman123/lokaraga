<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Detail Membership - LokaRaga</title>
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
            <a href="/pemilik/beranda" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/beranda-white.png" class="h-5" alt="Home">
                <span>Beranda</span>
            </a>
            <a href="/pemilik/kelola" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/pesan-white.png" class="h-5" alt="Kelola">
                <span>Kelola</span>
            </a>
            <a href="/pemilik/riwayat" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/riwayat-white.png" class="h-5" alt="Riwayat">
                <span>Riwayat</span>
            </a>
            <a href="/pemilik/membership" class="flex items-center space-x-3 px-4 py-2 bg-[#CCDBED] text-black rounded-lg transition font-semibold">
                <img src="/images/membership-black.png" class="h-5" alt="Membership">
                <span>Membership</span>
            </a>
            <a href="/pemilik/akun" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/akun-white.png" class="h-5" alt="Akun">
                <span>Akun</span>
            </a>
        </nav>
    </aside>

  <main class="flex-1 p-8">
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center space-x-2">
        <a href="javascript:history.back()">
          <img src="/images/back-button.png" alt="Back" class="h-10 mx-3">
        </a>
        <h1 class="text-xl">Membership</h1>
      </div>
      <div class="flex items-center gap-3">
        <div class="relative w-60">
          <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder-black placeholder:text-sm border border-black rounded-md focus:outline-none">
          <img src="/images/icon-search.png" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
        </div>
        <a href="/pemilik/akun">
          <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
        </a>
      </div>
    </div>
    <hr class="w-full border-t-2 border-black opacity-20 mb-8">
    <h2 class="text-lg mb-4">Detail Membership</h2>

    <div class="bg-white rounded-xl p-4 w-full max-w-3xl shadow-md">
      <div class="flex items-center mb-6">
        <div class="bg-[#0F4BA1] text-white w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold mr-4">
          <span id="initialUser">U</span>
        </div>
        <div>
          <p id="namaUser" class="font-medium text-lg">-</p>
        </div>
      </div>

      <div class="grid grid-cols-3 gap-6 mb-6">
        <div>
          <p class="text-md font-medium">Jenis Membership</p>
          <p id="jenisMembership">-</p>
        </div>
        <div>
          <p class="text-md font-medium">ID Transaksi</p>
          <p id="idTransaksi">INV-856917-FT</p>
        </div>
        <div>
          <p class="text-md font-medium">Masa Berlaku</p>
          <p id="masaBerlaku">-</p>
        </div>
      </div>

      <hr class="mb-6">

      <div class="space-y-3">
        <span class="font-medium">Detail Pesanan</span>
        <div class="grid grid-cols-2 gap-y-3 gap-x-8">
          <div class="font-medium">Tanggal Pesanan</div>
          <div id="tanggalPesanan">-</div>

          <div class="font-medium">Total Harga</div>
          <div id="totalHarga">-</div>
        </div>
      </div>
    </div>
  </main>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const pathParts = window.location.pathname.split('/');
    const id = pathParts[pathParts.length - 1];

    fetch(`${API_BASE_URL}/member/${id}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`
      }
    })
      .then(res => res.json())
      .then(async res => {
        const data = res.data;

        document.getElementById("namaUser").textContent = data.user_id;
        document.getElementById("initialUser").textContent = data.user_id.charAt(0).toUpperCase();
        document.getElementById("jenisMembership").textContent = data.jenismember_id;
        document.getElementById("idTransaksi").textContent = `INV-${data.id}-MB`;
        document.getElementById("masaBerlaku").textContent = data.tgl_selesai;
        document.getElementById("tanggalPesanan").textContent = data.tgl_mulai;

        const jenisRes = await fetch(`${API_BASE_URL}/jenismember`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`
          }
        });

        const jenisData = await jenisRes.json();
        const match = jenisData.data.find(j => j.nm_membership === data.jenismember_id);

        if (match) {
          document.getElementById("totalHarga").textContent = match.harga;
        } else {
          document.getElementById("totalHarga").textContent = "Tidak ditemukan";
        }
      })
      .catch(err => {
        console.error("Gagal ambil data:", err);
        alert("Gagal menampilkan detail membership.");
      });
  });
</script>

</body>

</html>
