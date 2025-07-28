<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Pilihan Membership - LokaRaga</title>
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
            <a href="/beranda" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/beranda-white.png" class="h-5" alt="Home">
                <span>Beranda</span>
            </a>
            <a href="/pesan" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
                <img src="/images/pesan-black.png" class="h-5" alt="Pesan">
                <span>Pesan</span>
            </a>
            <a href="/riwayat" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/riwayat-white.png" class="h-5" alt="Riwayat">
                <span>Riwayat</span>
            </a>
            <a href="/akun" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/akun-white.png" class="h-5" alt="Akun">
                <span>Akun</span>
            </a>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-2">
                <a href="javascript:history.back()">
                    <img src="/images/back-button.png" alt="Back" class="h-10 mx-3">
                </a>
                <h1 class="text-xl font-semibold">Pesan</h1>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative w-60">
                    <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder-black placeholder:text-sm border border-black rounded-md focus:outline-none">
                    <img src="/images/icon-search.png" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
                </div>
                <a href="/akun">
                    <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
                </a>
            </div>
        </div>
        <hr class="w-full border-t-2 border-black opacity-20 mb-8">
        <h2 class="text-lg font-medium mb-4">Pilih Membership</h2>
        <div id="membershipList" class="grid grid-cols-1 md:grid-cols-2 gap-6"></div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch(`${API_BASE_URL}/jenismember`)
                .then(response => response.json())
                .then(result => {
                    const list = document.getElementById("membershipList");
                    const data = result.data;

                    if (!data || data.length === 0) {
                        list.innerHTML = '<p class="text-gray-600">Belum ada data membership.</p>';
                        return;
                    }

                    data.forEach(item => {
                        const card = document.createElement("a");
                        card.href = `/konfirm-membership?id=${item.id}`;
                        card.innerHTML = `
                        <div class="flex justify-between items-center bg-[#F4FAFF] border border-[#C4DAEE] px-6 py-4 rounded-xl shadow-sm hover:shadow-md transition">
                            <div>
                                <p class="font-semibold">${item.nm_membership}</p>
                                <p class="text-sm text-gray-700 mt-2">${item.masa_berlaku}</p>
                            </div>
                            <p class="font-semibold">${item.harga}</p>
                        </div>
                    `;
                        list.appendChild(card);
                    });
                })
                .catch(error => {
                    console.error("Gagal memuat data:", error);
                    document.getElementById("membershipList").innerHTML = `<p class="text-red-500">Gagal memuat data.</p>`;
                });
        });
    </script>
</body>
</html>