<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Kelola Venue - LokaRaga</title>
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

        input:read-only {
            background-color: #f1f5f9;
            border: 1px solid #dbeafe;
        }

        input::placeholder,
        textarea::placeholder {
            font-weight: normal;
            color: #9CA3AF;
        }

        input,
        textarea {
            outline: 1px solid #D1E5F5;
            outline-offset: 0px;
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
                <img src="/images/beranda-white.png" class="h-5" alt="Beranda">
                <span>Beranda</span>
            </a>
            <a href="/pemilik/kelola" class="flex items-center space-x-3 px-4 py-2 bg-[#CCDBED] text-black rounded-lg font-semibold">
                <img src="/images/pesan-black.png" class="h-5" alt="Kelola">
                <span>Kelola</span>
            </a>
            <a href="/pemilik/riwayat" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/riwayat-white.png" class="h-5" alt="Riwayat">
                <span>Riwayat</span>
            </a>
            <a href="/pemilik/membership" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/membership-white.png" class="h-5" alt="Membership">
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
            <h1 class="text-xl">Kelola</h1>
            <div class="flex items-center gap-3">
                <div class="relative w-60">
                    <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder:text-sm border border-black rounded-md focus:outline-none">
                    <img src="/images/icon-search.png" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
                </div>
                <a href="/pemilik/akun">
                    <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
                </a>
            </div>
        </div>

        <hr class="w-full border-t-2 border-black opacity-20 mb-8">

        <div class="grid grid-cols-12 gap-x-8 gap-y-6 mb-6">
            <div class="col-span-6">
                <label class="block mb-1">Nama Venue</label>
                <input type="text" id="nama" readonly class="w-full rounded-md px-3 py-2" />
            </div>
            <div class="col-span-6">
                <label class="block mb-1">Jam Operasional</label>
                <div class="flex items-center gap-4">
                    <span class="text-gray-400">Buka</span>
                    <input type="text" id="jam-buka" readonly class="w-24 rounded-md px-2 py-1" />
                    <span class="text-gray-400">Tutup</span>
                    <input type="text" id="jam-tutup" readonly class="w-24 rounded-md px-2 py-1" />
                </div>
            </div>
            <div class="col-span-6">
                <label class="block mb-1">Alamat Venue</label>
                <input type="text" id="alamat" readonly class="w-full rounded-md px-3 py-2" />
            </div>
            <div class="col-span-6">
                <label class="block mb-1">Jenis Olahraga</label>
                <input type="text" id="olahraga" readonly class="w-full rounded-md px-3 py-2 mb-4" />
            </div>
            <div class="col-span-12 md:col-span-6">
                <label class="block mb-1">Foto Venue</label>
                <img id="foto" src="" alt="Foto Venue" class="w-full rounded-xl shadow" />
            </div>
            <div class="col-span-12 md:col-span-6 p-1">
                <label class="block mb-1">Fasilitas</label>
                <div class="grid grid-cols-2 gap-x-4">
                    <ul id="fasilitas-kiri" class="list-disc list-inside text-sm space-y-1"></ul>
                    <ul id="fasilitas-kanan" class="list-disc list-inside text-sm space-y-1"></ul>
                </div>
            </div>
        </div>

        <div class="flex justify-center">
            <a href="/pemilik/edit-lapangan" class="bg-blue text-white px-10 py-2 rounded-full font-medium shadow-md hover:bg-[#0d3f86] transition mt-5 w-72 text-center">
                Edit
            </a>
        </div>
    </main>

    <script>
        const token = localStorage.getItem("token");

        async function fetchVenue() {
            try {
                const profileRes = await fetch(`${API_BASE_URL}/profile`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                const profile = await profileRes.json();
                const userId = profile.id;

                const lapanganRes = await fetch(`${API_BASE_URL}/lapangan?user_id=${userId}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                const lapanganData = await lapanganRes.json();
                const data = lapanganData.data[0];

                document.getElementById("nama").value = data.nm_lapangan;
                document.getElementById("alamat").value = data.alamat;
                document.getElementById("jam-buka").value = data.jam_buka_operasional.slice(0, 5);
                document.getElementById("jam-tutup").value = data.jam_tutup_operasional.slice(0, 5);
                document.getElementById("olahraga").value = data.jenis_olahraga_id;
                document.getElementById("foto").src = `/storage/${data.foto}`;

                const fasilitas = data.fasilitas.split(", ");
                const tengah = Math.ceil(fasilitas.length / 2);
                const kiri = fasilitas.slice(0, tengah);
                const kanan = fasilitas.slice(tengah);
                document.getElementById("fasilitas-kiri").innerHTML = kiri.map(f => `<li>${f}</li>`).join("");
                document.getElementById("fasilitas-kanan").innerHTML = kanan.map(f => `<li>${f}</li>`).join("");

            } catch (err) {
                console.error(err);
            }
        }

        document.addEventListener("DOMContentLoaded", fetchVenue);
    </script>
</body>

</html>