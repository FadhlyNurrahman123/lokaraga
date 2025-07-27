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
            <a href="/beranda" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/beranda-white.png" class="h-5" alt="Home">
                <span>Beranda</span>
            </a>
            <a href="/pesan" class="flex items-center space-x-3 px-4 py-2 bg-[#CCDBED] text-black rounded-lg font-semibold">
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
                <a href="/akun">
                    <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
                </a>
            </div>
        </div>
        <hr class="w-full border-t-2 border-black opacity-20 mb-8">

        <div class="space-y-6">
            <h2 class="text-xl mb-4">Membership</h2>
            <div class="w-full flex justify-center my-6">
                <div class="w-full max-w-4xl">
                    <a href="/pilihan-membership">
                        <img src="/images/membership.png" alt="Banner Membership" class="w-full rounded-xl shadow-md cursor-pointer">
                    </a>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="w-full max-w-5xl">
                    <h3 class="text-xl font-semibold text-[#0F4BA1] mb-4 text-center">Keuntungan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-items-center">
                        <div class="bg-white rounded-xl shadow-md p-4 flex gap-4 items-center w-full max-w-lg">
                            <div class="text-3xl font-bold text-[#0F4BA1]">1</div>
                            <p class="text-sm">Diskon pemesanan lapangan hingga 20% untuk member bulanan dan hingga 30% untuk member tahunan</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-4 flex gap-4 items-center w-full max-w-lg">
                            <div class="text-3xl font-bold text-[#0F4BA1]">2</div>
                            <p class="text-sm">Prioritas pemesanan dengan akses lebih awal dibanding pengguna reguler</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-4 flex gap-4 items-center w-full max-w-lg">
                            <div class="text-3xl font-bold text-[#0F4BA1]">3</div>
                            <p class="text-sm">Bonus waktu bermain berupa tambahan waktu bermain gratis setelah jam tertentu</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-4 flex gap-4 items-center w-full max-w-lg">
                            <div class="text-3xl font-bold text-[#0F4BA1]">4</div>
                            <p class="text-sm">Tidak perlu membayar seluruh bookingan di awal</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="w-full max-w-5xl">
                    <h3 class="text-xl font-semibold text-[#0F4BA1] mb-4 text-center mt-3">Syarat & Ketentuan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-items-center">
                        <div class="bg-white rounded-xl shadow-md p-4 flex gap-4 items-center w-full max-w-lg">
                            <div class="text-3xl font-bold text-[#0F4BA1]">1</div>
                            <p class="text-sm">Membership bulanan berlaku selama 30 hari, sedangkan tahunan berlaku 12 bulan sejak aktivasi</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-4 flex gap-4 items-center w-full max-w-lg">
                            <div class="text-3xl font-bold text-[#0F4BA1]">2</div>
                            <p class="text-sm">Aktivasi membership dilakukan setelah pembayaran berhasil dan tidak dapat dibatalkan</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-4 flex gap-4 items-center w-full max-w-lg">
                            <div class="text-3xl font-bold text-[#0F4BA1]">3</div>
                            <p class="text-sm">Diskon dan manfaat hanya berlaku saat login sebagai member dan tidak dapat digabung dengan promo lain</p>
                        </div>
                        <div class="bg-white rounded-xl shadow-md p-4 flex gap-4 items-center w-full max-w-lg">
                            <div class="text-3xl font-bold text-[#0F4BA1]">4</div>
                            <p class="text-sm">Pemesanan lapangan dapat dilakukan melalui aplikasi/website dan diskon diterapkan secara otomatis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>