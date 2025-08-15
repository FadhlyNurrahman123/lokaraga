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

    <!-- SIDEBAR -->
    <aside class="w-64 bg-blue text-white p-6 flex flex-col space-y-6">
        <div class="mb-3">
            <div class="flex items-center space-x-3">
                <img src="/images/logo2.png" alt="Logo" class="h-10">
                <span class="text-white text-2xl font-reem font-bold mt-5">LokaRaga</span>
            </div>
            <hr class="mt-5 border-t-2 border-white opacity-100">
        </div>
        <nav class="space-y-4">
            <a href="/penyewa/beranda" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/beranda-white.png" class="h-5" alt="Home">
                <span>Beranda</span>
            </a>
            <a href="/penyewa/pesan" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/pesan-white.png" class="h-5" alt="Pesan">
                <span>Pesan</span>
            </a>
            <a href="/penyewa/riwayat" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
                <img src="/images/riwayat-black.png" class="h-5" alt="Riwayat">
                <span>Riwayat</span>
            </a>
            <a href="/penyewa/akun" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/akun-white.png" class="h-5" alt="Akun">
                <span>Akun</span>
            </a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-5">
      <div class="flex items-center space-x-2">
        <a href="javascript:history.back()">
          <img src="/images/back-button.png" alt="Back" class="h-10 mx-3">
        </a>
        <h1 class="text-xl">Riwayat</h1>
      </div>
      <div class="flex items-center gap-3">
        <div class="relative w-60">
          <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder-black placeholder:text-sm border border-black rounded-md focus:outline-none">
          <img src="/images/icon-search.png" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
        </div>
        <a href="/penyewa/akun">
          <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
        </a>
      </div>
    </div>

        <hr class="w-full border-t-2 border-black opacity-20 mb-8">

        <div class="space-y-6">
            <h2 class="text-lg font-medium">Informasi Membership</h2>
            <div class="text-sm space-y-4">
                <div>
                    <p class="text-md font-bold">Status</p>
                    <p id="status" class="text-md">-</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="font-semibold">Venue</p>
                        <p id="venue">-</p>
                    </div>
                    <div>
                        <p class="font-semibold">ID Transaksi</p>
                        <p id="id-transaksi">-</p>
                    </div>
                    <div>
                        <p class="font-semibold">Tanggal Pemesanan</p>
                        <p id="tgl-pemesanan">-</p>
                    </div>
                </div>
            </div>
            <hr class="border-t border-gray-300 my-4">

            <h3 class="text-md font-semibold">Detail Membership</h3>
            <div class="grid grid-cols-2 gap-y-3 text-sm max-w-md">
                <p class="font-semibold">Membership</p>
                <p id="jenis-membership">-</p>

                <p class="font-semibold">Tanggal Mulai</p>
                <p id="tgl-mulai">-</p>

                <p class="font-semibold">Tanggal Selesai</p>
                <p id="tgl-selesai">-</p>

                <p class="font-semibold">Harga</p>
                <p id="harga">-</p>
            </div>
        </div>
    </main>

    <script>
        const token = localStorage.getItem("token");

        function getIdFromURL() {
            const parts = window.location.pathname.split('/');
            return parts[parts.length - 1];
        }

        function formatDate(dateStr) {
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            return new Date(dateStr).toLocaleDateString("id-ID", options);
        }

        function formatRupiah(angka) {
            return angka ? `Rp ${angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")}` : "-";
        }

        document.addEventListener("DOMContentLoaded", async () => {
            const id = getIdFromURL();

            try {
                // Ambil detail member
                const resMember = await fetch(`${API_BASE_URL}/member/${id}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                if (!resMember.ok) throw new Error("Gagal memuat data member");
                const memberData = await resMember.json();
                const m = memberData.data;

                // Ambil semua jenis membership
                const resJenis = await fetch(`${API_BASE_URL}/jenismember`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                if (!resJenis.ok) throw new Error("Gagal memuat data jenis membership");
                const jenisData = await resJenis.json();

                // Cari data jenis membership yang sesuai
                const jenis = jenisData.data.find(j => j.nm_membership === m.jenismember_id) || {};

                // Set data ke HTML
                document.getElementById("status").textContent = "Aktif";
                document.getElementById("venue").textContent = m.lapangan_id;
                document.getElementById("id-transaksi").textContent = `INV-${m.id}-MB`;
                document.getElementById("tgl-pemesanan").textContent = formatDate(m.tgl_mulai);
                document.getElementById("tgl-mulai").textContent = formatDate(m.tgl_mulai);
                document.getElementById("tgl-selesai").textContent = formatDate(m.tgl_selesai);
                document.getElementById("jenis-membership").textContent = m.jenismember_id;
                document.getElementById("harga").textContent = formatRupiah(jenis.harga);

            } catch (err) {
                console.error(err);
                alert("Gagal memuat detail membership.");
            }
        });
    </script>
</body>

</html>