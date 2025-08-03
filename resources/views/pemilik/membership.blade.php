<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Membership - LokaRaga</title>
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
    <div class="flex justify-between items-center mb-5">
      <div class="flex items-center space-x-2">
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
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg">Daftar Membership</h2>
            <a href="/pemilik/tambah-membership" class="bg-[#0F4BA1] text-white px-4 py-2 rounded-xl font-semibold text-sm flex items-center gap-2 shadow-md hover:bg-[#0d3f86] transition">
                <span class="font-semibold text-xl">+</span> Tambah Membership
            </a>
        </div>
        <div id="membershipList" class="flex flex-wrap justify-between gap-2 mt-4"></div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch(`${API_BASE_URL}/jenismember`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem("token")}`
                    }
                })
                .then(response => response.json())
                .then(result => {
                    const list = document.getElementById("membershipList");
                    const data = result.data;

                    if (!data || data.length === 0) {
                        list.innerHTML = '<p class="text-gray-600">Belum ada data membership.</p>';
                        return;
                    }

                    list.innerHTML = '';
                    data.forEach(item => {
                        const card = document.createElement("div");
                        card.className = "bg-white rounded-2xl shadow-md p-4 w-full max-w-2xl mb-4";

                        card.innerHTML = `
                            <div class="flex justify-between items-center mb-2">
                            <p class="font-bold text-md">${item.nm_membership}</p>
                            <span class="text-[#1BE387] font-bold text-xl">${formatHarga(item.harga)}</span>
                            </div>
                            <div class="flex justify-between items-start">
                            <div class="space-y-1">
                                <p class="text-sm text-gray-700">${item.deskripsi}</p>
                            </div>
                            <button onclick="lihatDetailMembership(${item.id})"
                                class="bg-[#FFE500] text-black px-4 py-1 text-sm rounded-full font-medium h-fit">
                                Detail
                            </button>
                            </div>
                        `;
                        list.appendChild(card);
                    });
                })
                .catch(error => {
                    console.error("Gagal memuat data:", error);
                    document.getElementById("membershipList").innerHTML =
                        `<p class="text-red-500">Gagal memuat data.</p>`;
                });

            function formatHarga(angka) {
                if (typeof angka === "string") {
                    angka = angka.replace(/[Rp.\s]/g, "").trim();
                }
                const numeric = Number(angka);
                return numeric ? `Rp ${numeric.toLocaleString("id-ID")}` : "-";
            }

            window.lihatDetailMembership = function(id) {
                window.location.href = `/pemilik/anggota-membership/${id}`;
            };
        });
    </script>
</body>

</html>