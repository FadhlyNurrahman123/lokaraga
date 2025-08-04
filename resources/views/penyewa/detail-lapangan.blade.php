<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Detail Lapangan - LokaRaga</title>
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
            <a href="/penyewa/beranda" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="{{ asset('images/beranda-white.png') }}" class="h-5" alt="Home">
                <span>Beranda</span>
            </a>
            <a href="/penyewa/pesan" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
                <img src="{{ asset('images/pesan-black.png') }}" class="h-5" alt="Pesan">
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
            <div class="flex items-center space-x-2">
                <a href="javascript:history.back()">
                    <img src="{{ asset('images/back-button.png') }}" alt="Back" class="h-10 mx-3">
                </a>
                <h1 class="text-xl">Pesan</h1>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative w-60">
                    <input type="text" placeholder="Search..." class="w-full py-2 pl-4 pr-10 text-black placeholder-black placeholder:text-sm border border-black rounded-md focus:outline-none">
                    <img src="{{ asset('images/icon-search.png') }}" alt="Search" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5">
                </div>
                <a href="/penyewa/akun">
                    <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
                </a>
            </div>
        </div>
        <hr class="w-full border-t-2 border-black opacity-20 mb-8">

        <h2 class="text-lg mb-4">Detail Arena Olahraga</h2>

        <div class="space-y-10" id="detail-container">
        </div>
    </main>

    <script>
        const token = localStorage.getItem("token");
        let jadwalData = [];
        let currentNamaLapangan = "";

        function getIdFromURL() {
            const pathSegments = window.location.pathname.split('/');
            return pathSegments[pathSegments.length - 1];
        }

        function formatTime(timeString) {
            return timeString?.slice(0, 5) || "";
        }

        async function fetchLapanganDetail() {
            const id = getIdFromURL();
            if (!id) return;

            try {
                const res = await fetch(`${API_BASE_URL}/lapangan/${id}`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                if (!res.ok) throw new Error("Gagal fetch lapangan detail");
                const result = await res.json();
                renderDetail(result.data);
                currentNamaLapangan = result.data.nm_lapangan;
                fetchJadwal(); // panggil jadwal setelah ambil nama lapangan
            } catch (error) {
                console.error(error);
            }
        }

        async function fetchJadwal() {
            try {
                const res = await fetch(`${API_BASE_URL}/jadwal`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                if (!res.ok) throw new Error("Gagal fetch jadwal");
                const result = await res.json();
                jadwalData = result.data;
                setupTanggalAndJam();
            } catch (error) {
                console.error("Gagal mengambil jadwal:", error);
            }
        }

        function setupTanggalAndJam() {
            const tanggalInput = document.getElementById("tanggal");
            const jamSelect = document.getElementById("jam");
            const pesanBtn = document.getElementById("pesanBtn");

            const filtered = jadwalData.filter(j => j.lapangan_id === currentNamaLapangan);
            const jamOptions = filtered.map(j => `${formatTime(j.jam_mulai)} - ${formatTime(j.jam_selesai)}`);
            const uniqueJam = [...new Set(jamOptions)];

            jamSelect.innerHTML = "";
            if (uniqueJam.length === 0) {
                jamSelect.innerHTML = `<option>Tidak ada jadwal tersedia</option>`;
            } else {
                jamSelect.innerHTML = [`<option value="">-- Pilih jadwal --</option>`, ...uniqueJam.map(j => `<option>${j}</option>`)].join("");
            }

            const today = new Date().toISOString().split("T")[0];
            tanggalInput.min = today;

            // Aktifkan tombol hanya jika tanggal & jam dipilih
            function validateForm() {
                if (tanggalInput.value && jamSelect.value) {
                    pesanBtn.disabled = false;
                    pesanBtn.classList.remove("bg-gray-400", "cursor-not-allowed");
                    pesanBtn.classList.add("bg-[#0F4BA1]", "hover:bg-blue-800", "transition");
                } else {
                    pesanBtn.disabled = true;
                    pesanBtn.classList.add("bg-gray-400", "cursor-not-allowed");
                    pesanBtn.classList.remove("bg-[#0F4BA1]", "hover:bg-blue-800", "transition");
                }
            }

            tanggalInput.addEventListener("change", validateForm);
            jamSelect.addEventListener("change", validateForm);
        }


        function renderDetail(data) {
            const container = document.getElementById("detail-container");
            localStorage.setItem("lapangan_id", getIdFromURL());
            const hargaFormat = (angka) => {
                return "Rp " + Number(angka).toLocaleString("id-ID");
            };
            container.innerHTML = `
      <div class="relative w-full flex justify-center mt-4">
        <div class="relative w-full max-w-3xl overflow-hidden rounded-xl h-80">
          <div id="carousel" class="flex transition-transform duration-500 ease-in-out w-full h-full">
            <img src="/storage/${data.foto}" class="w-full flex-shrink-0 object-cover h-80" alt="Gambar 1">
            <img src="/storage/${data.foto}" class="w-full flex-shrink-0 object-cover h-80" alt="Gambar 2">
            <img src="/storage/${data.foto}" class="w-full flex-shrink-0 object-cover h-80" alt="Gambar 3">
          </div>
          <button onclick="prevSlide()" class="absolute top-1/2 left-2 transform -translate-y-1/2 text-3xl text-white z-10 bg-black/20 px-2 rounded hover:bg-black/40">‹</button>
          <button onclick="nextSlide()" class="absolute top-1/2 right-2 transform -translate-y-1/2 text-3xl text-white z-10 bg-black/20 px-2 rounded hover:bg-black/40">›</button>
        </div>
      </div>

      <div class="flex flex-col lg:flex-row gap-8 mt-8">
        <div class="w-full lg:w-72 space-y-6">
          <div class="bg-white shadow-md p-4 rounded-xl">
            <h4 class="text-md text-gray-600">Harga</h4>
            <p id="harga-lapangan" data-harga="${data.harga}" class="text-2xl font-bold mt-2">${hargaFormat(data.harga)}</p>
          </div>
          <div class="bg-white shadow-md p-4 rounded-xl space-y-3">
            <h4 class="text-md text-gray-800">Pilih Jadwal</h4>
            <div>
              <label for="tanggal" class="text-sm font-bold block mb-2">Tanggal</label>
              <input type="date" id="tanggal" class="w-full border border-gray-300 rounded-2xl px-3 py-2 text-sm">
            </div>
            <div class="relative">
              <label for="jam" class="text-sm font-bold block mb-1">Jam</label>
              <select id="jam" class="w-full border border-gray-300 rounded-2xl px-3 pr-10 py-2 text-sm appearance-none">
                <option value="">-- Pilih jadwal --</option>
              </select>
              <div class="pointer-events-none absolute right-3 top-10 transform -translate-y-1/2 text-gray-400 text-sm">&#x2304;</div>
            </div>
            <button id="pesanBtn" disabled class="w-full bg-gray-400 text-white py-2 rounded-2xl font-medium mt-3 cursor-not-allowed">
            Pesan
            </button>
          </div>
        </div>

        <div class="flex-1 space-y-5">
          <div class="bg-white shadow-md p-4 rounded-xl flex justify-between items-center">
            <h3 id="nama-lapangan" class="text-2xl font-semibold">${data.nm_lapangan}</h3>
            <a href="/penyewa/membership" class="bg-[#0F4BA1] text-white font-medium px-4 py-2 rounded-full text-sm inline-block">
            Gabung Membership
            </a>
          </div>

          <div class="bg-white shadow-md p-4 rounded-xl">
            <h4 class="text-lg font-semibold mb-1">Alamat</h4>
            <p class="text-md text-gray-700 mb-3">${data.alamat}</p>
            <h4 class="text-lg font-semibold mb-1">Jam Operasional</h4>
            <p class="text-md text-gray-700 mb-3">${formatTime(data.jam_buka_operasional)} - ${formatTime(data.jam_tutup_operasional)}</p>
            <h4 class="text-lg font-semibold mb-1">Fasilitas</h4>
            <ul class="flex flex-row flex-wrap gap-x-4 list-disc list-inside text-md text-gray-700">
              ${data.fasilitas.split(',').map(f => `<li>${f.trim()}</li>`).join('')}
            </ul>
          </div>
        </div>
      </div>
    `;
            document.getElementById("pesanBtn")?.addEventListener("click", () => {
                const tanggal = document.getElementById("tanggal").value;
                const jam = document.getElementById("jam").value;

                if (!tanggal || !jam) return;

                const jadwalCocok = jadwalData.find(j => {
                    const jamFormat = `${formatTime(j.jam_mulai)} - ${formatTime(j.jam_selesai)}`;
                    return jamFormat === jam;
                });

                if (!jadwalCocok) {
                    alert("Jadwal tidak valid.");
                    return;
                }

                const nama = document.getElementById("nama-lapangan")?.textContent || "-";
                const harga = document.getElementById("harga-lapangan")?.dataset.harga || "0";

                localStorage.setItem("nama_lapangan", nama);
                localStorage.setItem("harga", harga);
                localStorage.setItem("tanggal", tanggal);
                localStorage.setItem("jam", jam);
                localStorage.setItem("jadwal_id", jadwalCocok.id);
                localStorage.setItem("lapangan_id", getIdFromURL());

                window.location.href = `/penyewa/konfirm-pesan-lapangan?tanggal=${tanggal}&jam=${encodeURIComponent(jam)}`;
            });
        }

        let currentSlide = 0;

        function updateSlide() {
            const carousel = document.getElementById('carousel');
            carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        function nextSlide() {
            const carousel = document.getElementById('carousel');
            const totalSlides = carousel.children.length;
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlide();
        }

        function prevSlide() {
            const carousel = document.getElementById('carousel');
            const totalSlides = carousel.children.length;
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlide();
        }

        document.addEventListener("DOMContentLoaded", () => {
            fetchLapanganDetail();

            const pesanBtn = document.getElementById("pesanBtn");
            pesanBtn?.addEventListener("click", () => {
                const tanggal = document.getElementById("tanggal").value;
                const jam = document.getElementById("jam").value;

                if (tanggal && jam) {
                    // Redirect ke halaman konfirmasi dengan query string (opsional)
                    window.location.href = `/penyewa/konfirm-pesan-lapangan?tanggal=${tanggal}&jam=${encodeURIComponent(jam)}`;
                }
            });
        });
    </script>
</body>

</html>