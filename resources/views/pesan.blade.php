<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Pesan - LokaRaga</title>
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
            <a href="/pesan" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
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

    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center space-x-2">
                <h1 class="text-xl">Pesan</h1>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative w-60">
                    <input
                        type="text"
                        placeholder="Search..."
                        class="w-full py-2 pl-4 pr-10 text-black placeholder-black placeholder:text-sm border border-black rounded-md focus:outline-none">
                    <img src="{{ asset('images/icon-search.png') }}"
                        alt="Search"
                        class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
                </div>
                <a href="/akun">
                    <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
                </a>
            </div>
        </div>
        <hr class="w-full border-t-2 border-black opacity-20 mb-8">

        <h2 class="text-lg mb-4">Pilih olahraga yang Anda inginkan ...</h2>
        <div class="grid grid-cols-2 md:grid-cols-2 gap-6 mt-6">
            <a href="/pesan-lapangan?jenis=1">
                <div class="bg-white rounded-2xl shadow-md px-8 py-8 flex items-center space-x-8 w-full hover:shadow-xl transition-shadow duration-300 cursor-pointer">
                    <img src="{{ asset('images/icon-futsal.png') }}" alt="Futsal" class="h-24 w-auto pl-2">
                    <p class="text-xl font-bold text-[#0F4BA1]">Futsal</p>
                </div>
            </a>
            <a href="/pesan-lapangan?jenis=2">
                <div class="bg-white rounded-2xl shadow-md px-8 py-8 flex items-center space-x-8 w-full hover:shadow-xl transition-shadow duration-300 cursor-pointer">
                    <img src="{{ asset('images/icon-sepakbola.png') }}" alt="Sepakbola" class="h-24 w-auto pl-2">
                    <p class="text-xl font-bold text-[#0F4BA1]">Sepakbola</p>
                </div>
            </a>
            <a href="/pesan-lapangan?jenis=3">
                <div class="bg-white rounded-2xl shadow-md px-8 py-8 flex items-center space-x-8 w-full hover:shadow-xl transition-shadow duration-300 cursor-pointer">
                    <img src="{{ asset('images/icon-basket.png') }}" alt="Basket" class="h-24 w-auto pl-2">
                    <p class="text-xl font-bold text-[#0F4BA1]">Basket</p>
                </div>
            </a>
            <a href="/pesan-lapangan?jenis=4">
                <div class="bg-white rounded-2xl shadow-md px-8 py-8 flex items-center space-x-8 w-full hover:shadow-xl transition-shadow duration-300 cursor-pointer">
                    <img src="{{ asset('images/icon-badminton.png') }}" alt="Badminton" class="h-24 w-auto pl-2">
                    <p class="text-xl font-bold text-[#0F4BA1]">Badminton</p>
                </div>
            </a>
        </div>
    </main>
</body>

</html>