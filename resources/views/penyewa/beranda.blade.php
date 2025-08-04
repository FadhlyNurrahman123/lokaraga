<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Beranda - LokaRaga</title>
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
            <a href="/penyewa/beranda" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
                <img src="/images/beranda-black.png" class="h-5" alt="Home">
                <span>Beranda</span>
            </a>
            <a href="/penyewa/pesan" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/pesan-white.png" class="h-5" alt="Pesan">
                <span>Pesan</span>
            </a>
            <a href="/penyewa/riwayat" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="{{ asset('images/riwayat-white.png') }}" class="h-5" alt="Riwayat">
                <span>Riwayat</span>
            </a>
            <a href="/penyewa/akun" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="{{ asset('images/akun-white.png') }}" class="h-5" alt="Akun">
                <span>Akun</span>
            </a>
        </nav>
    </aside>
    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-xl" id="welcome">Selamat Datang, ...</h1>
            <div class="flex items-center gap-3">
                <div class="relative w-60">
                    <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder-black text-sm border border-black rounded-md focus:outline-none">
                    <img src="/images/icon-search.png" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
                </div>
                <a href="/penyewa/akun">
                    <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
                </a>
            </div>
        </div>
        <hr class="w-full border-t-2 border-black opacity-20">
        <div class="mt-5 mb-8">
            <h2 class="text-lg mb-4">Pilih Olahraga</h2>
            <div class="grid grid-cols-4 gap-6">
                <a href="/penyewa/pesan-lapangan?jenis=1">
                    <div class="bg-white rounded-xl border shadow-lg p-4 text-center hover:shadow-xl cursor-pointer">
                        <img src="/images/icon-futsal.png" class="h-12 mx-auto mb-2">
                        <p>Futsal</p>
                    </div>
                </a>
                <a href="/penyewa/pesan-lapangan?jenis=2">
                    <div class="bg-white rounded-xl border shadow-lg p-4 text-center hover:shadow-xl cursor-pointer">
                        <img src="/images/icon-sepakbola.png" class="h-12 mx-auto mb-2">
                        <p>Sepakbola</p>
                    </div>
                </a>
                <a href="/penyewa/pesan-lapangan?jenis=3">
                    <div class="bg-white rounded-xl border shadow-lg p-4 text-center hover:shadow-xl cursor-pointer">
                        <img src="/images/icon-badminton.png" class="h-12 mx-auto mb-2">
                        <p>Badminton</p>
                    </div>
                </a>
                <a href="/penyewa/pesan-lapangan?jenis=4">
                    <div class="bg-white rounded-xl border shadow-lg p-4 text-center hover:shadow-xl cursor-pointer">
                        <img src="/images/icon-basket.png" class="h-12 mx-auto mb-2">
                        <p>Basket</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="mb-8">
            <h2 class="text-lg mb-4">Rekomendasi Venue</h2>
            <div id="venueContainer" class="grid grid-cols-3 gap-6"></div>
        </div>

    </main>
    <script>
        const token = localStorage.getItem('token');

        async function loadUserProfile() {
            try {
                const res = await fetch(`${API_BASE_URL}/profile`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                const data = await res.json();
                document.getElementById('welcome').textContent = `Selamat Datang, ${data.nama}`;
            } catch (e) {
                console.error('Gagal ambil profil:', e);
            }
        }

        async function loadVenues() {
            try {
                const res = await fetch(`${API_BASE_URL}/lapangan`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                const result = await res.json();
                const container = document.getElementById('venueContainer');

                result.data.forEach(venue => {
                    const imageUrl = venue.foto ?
                        `http://127.0.0.1:8002/storage/foto/${venue.foto}` :
                        '/images/placeholder.jpg';

                    container.innerHTML += `
                    <a href="/penyewa/detail-lapangan/${venue.id}" class="block rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                    <div class="h-40 w-full overflow-hidden">
                        <img src="${imageUrl}" alt="${venue.nm_lapangan}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 bg-white">
                        <h3 class="font-bold text-black">${venue.nm_lapangan}</h3>
                        <p class="text-sm text-gray-600">${venue.alamat}</p>
                        <p class="text-sm text-right font-semibold text-gray-800">${venue.jenis_olahraga_id || '-'}</p>
                    </div>
                    </a>`;
                });
            } catch (e) {
                console.error('Gagal ambil venue:', e);
            }
        }

        loadUserProfile();
        loadVenues();
    </script>
</body>

</html>