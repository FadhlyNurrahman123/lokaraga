<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Tambah Pemilik - LokaRaga</title>
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
            <a href="/admin/daftar-pemilik" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
                <img src="/images/pemilik-black.png" class="h-5" alt="Home">
                <span>Daftar Pemilik</span>
            </a>
            <a href="/admin/daftar-penyewa" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/penyewa-white.png" class="h-5" alt="Pesan">
                <span>Daftar Penyewa</span>
            </a>
            <a href="/admin/akun" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/akun-white.png" class="h-5" alt="Akun">
                <span>Akun</span>
            </a>
        </nav>
    </aside>
    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-2">
                <div class="flex items-center space-x-2">
                    <a href="javascript:history.back()">
                        <img src="{{ asset('images/back-button.png') }}" alt="Back" class="h-10 mx-3">
                    </a>
                    <h1 class="text-xl">Tambah Pemilik</h1>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative w-60">
                    <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder-black placeholder:text-sm border border-black rounded-md focus:outline-none">
                    <img src="/images/icon-search.png" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
                </div>
                <a href="/admin/akun">
                    <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
                </a>
            </div>
        </div>

        <hr class="border-t-2 border-black opacity-20 mb-6">
        <form id="registerForm" class="max-w-md space-y-7">
            <div>
                <label class="block text-md mb-1">Nama Pemilik</label>
                <input id="nama" type="text" placeholder="Masukkan nama pemilik" class="w-full border rounded-md px-4 py-2 text-sm text-black bg-[#F2F8FF] border-[#CCE0F7] focus:outline-none">
            </div>
            <div>
                <label class="block text-md mb-1">Email</label>
                <input id="email" type="email" placeholder="Masukkan email pemilik" class="w-full border rounded-md px-4 py-2 text-sm text-black bg-[#F2F8FF] border-[#CCE0F7] focus:outline-none">
            </div>
            <div>
                <label class="block text-md mb-1">Password</label>
                <input id="kata_sandi" type="password" placeholder="Masukkan password pemilik" class="w-full border rounded-md px-4 py-2 text-sm text-black bg-[#F2F8FF] border-[#CCE0F7] focus:outline-none">
            </div>
            <div>
                <label class="block text-md mb-1">Nomor Telepon</label>
                <input id="no_telp" type="text" placeholder="Masukkan nomor telepon pemilik" class="w-full border rounded-md px-4 py-2 text-sm text-black bg-[#F2F8FF] border-[#CCE0F7] focus:outline-none">
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-[#0F4BA1] text-white font-semibold text-md py-2 px-16 rounded-full hover:bg-[#0d3f86] transition mt-4">
                    Simpan
                </button>
            </div>
        </form>

        <script>
            document.getElementById('registerForm').addEventListener('submit', async function(e) {
                e.preventDefault();

                const data = {
                    nama: document.getElementById('nama').value,
                    email: document.getElementById('email').value,
                    no_telp: document.getElementById('no_telp').value,
                    kata_sandi: document.getElementById('kata_sandi').value,
                    role_id: 1 // role 1 untuk pemilik
                };

                try {
                    const response = await fetch(`${API_BASE_URL}/Createuser`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        alert('Pemilik berhasil ditambahkan!');
                        window.location.href = '/admin/daftar-pemilik';
                    } else {
                        alert('Gagal menambahkan pemilik: ' + (result.message || 'Periksa kembali input Anda.'));
                    }
                } catch (error) {
                    alert('Terjadi kesalahan jaringan. Coba lagi nanti.');
                    console.error(error);
                }
            });
        </script>
</body>

</html>