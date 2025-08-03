<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Daftar Anggota Membership - LokaRaga</title>
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

        <h2 class="text-lg mb-4">Daftar Anggota Membership</h2>
        <div id="memberList" class="space-y-4"></div>
    </main>
    <script>
  document.addEventListener("DOMContentLoaded", async function () {
    const pathParts = window.location.pathname.split('/');
    const jenisId = pathParts[pathParts.length - 1]; // ambil ID dari URL

    try {
      // Ambil semua jenis membership
      const resJenis = await fetch(`${API_BASE_URL}/jenismember`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`
        }
      });
      const jenisData = await resJenis.json();

      // Cari nama jenis membership berdasarkan ID
      const jenisTarget = jenisData.data.find(j => j.id == jenisId);
      if (!jenisTarget) {
        throw new Error("Jenis membership tidak ditemukan.");
      }

      const targetNamaMembership = jenisTarget.nm_membership;

      // Ambil semua member
      const resMember = await fetch(`${API_BASE_URL}/member`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`
        }
      });
      const memberData = await resMember.json();

      const listContainer = document.getElementById("memberList");
      listContainer.innerHTML = "";

      // Filter berdasarkan nama membership yang cocok
      const filteredMembers = memberData.data.filter(
        item => item.jenismember_id === targetNamaMembership
      );

      if (filteredMembers.length === 0) {
        listContainer.innerHTML = "<p class='text-gray-500'>Belum ada anggota.</p>";
        return;
      }

      filteredMembers.forEach(item => {
        const card = document.createElement("div");
        card.className = "flex justify-between items-center bg-white rounded-xl shadow-md px-6 py-3 w-[500px]";

        const nama = document.createElement("p");
        nama.className = "font-medium text-lg";
        nama.textContent = item.user_id;

        const button = document.createElement("button");
        button.className = "bg-[#FFE500] text-sm text-black px-5 py-1 rounded-full shadow";
        button.textContent = "Detail";

        button.addEventListener("click", function () {
          window.location.href = `/pemilik/detail-membership/${item.id}`;
        });

        card.appendChild(nama);
        card.appendChild(button);
        listContainer.appendChild(card);
      });

    } catch (err) {
      console.error("Gagal fetch data:", err);
      document.getElementById("memberList").innerHTML = "<p class='text-red-500'>Gagal memuat data.</p>";
    }
  });
</script>
</body>
</html>