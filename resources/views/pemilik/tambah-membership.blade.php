<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Tambah Membership - LokaRaga</title>
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
        <h2 class="text-lg mb-4">Tambah Membership</h2>
        <form id="formMembership" class="w-[400px] space-y-4">
            <div>
                <label class="block mb-1">Nama Membership</label>
                <input id="nama" type="text" class="w-full px-4 py-2 rounded-md bg-[#F0F7FE] focus:outline-none">
            </div>
            <div>
                <label class="block mb-1">Masa Berlaku</label>
                <input id="masa" type="text" class="w-full px-4 py-2 rounded-md bg-[#F0F7FE] focus:outline-none">
            </div>
            <div>
                <label class="block mb-1">Harga</label>
                <input id="harga" type="number" class="w-full px-4 py-2 rounded-md bg-[#F0F7FE] focus:outline-none">
            </div>
            <div>
                <label class="block mb-1">Deskripsi</label>
                <textarea id="deskripsi" rows="4" class="w-full px-4 py-2 rounded-md bg-[#F0F7FE] focus:outline-none"></textarea>
            </div>
            <button type="submit" class="bg-blue text-white px-8 py-2 rounded-full hover:bg-[#0d3f86] transition">Simpan</button>
        </form>
    </main>

    <script>
        document.getElementById("formMembership").addEventListener("submit", function(e) {
            e.preventDefault();

            const data = {
                nm_membership: document.getElementById("nama").value,
                masa_berlaku: document.getElementById("masa").value,
                harga: document.getElementById("harga").value,
                deskripsi: document.getElementById("deskripsi").value
            };

            fetch(`${API_BASE_URL}/Createjenismember`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": `Bearer ${localStorage.getItem("token")}`
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    alert("Membership berhasil ditambahkan!");
                    window.location.href = "/pemilik/membership";
                })
                .catch(error => {
                    alert("Gagal menambahkan membership.");
                    console.error("Error:", error);
                });
        });
    </script>
</body>

</html>