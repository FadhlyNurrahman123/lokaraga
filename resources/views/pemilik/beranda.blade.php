<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Beranda Pemilik - LokaRaga</title>
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
      <a href="/pemilik/beranda" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
        <img src="/images/beranda-black.png" class="h-5" alt="Home">
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
      <div class="flex items-center space-x-2">
        <h1 class="text-xl" id="welcome">Selamat Datang, ...</h1>
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
    <hr class="w-full border-t-2 border-black opacity-20">

    <div class="gap-8 mt-6">
      <div class="bg-blue text-white rounded-2xl p-8 flex justify-between items-center">
        <div>
          <p class="text-2xl font-bold">Total Pendapatan</p>
          <p class="text-lg" id="venueName">...</p>
        </div>
        <h2 class="text-4xl font-bold" id="totalPendapatan">Rp ...</h2>
      </div>
    </div>
    <div class="grid grid-cols-2 gap-8 mt-10">
      <div>
        <div class="flex justify-between mb-3">
          <h2 class="text-lg">Riwayat Pesanan</h2>
          <a href="/pemilik/riwayat" class="w-10 h-10 flex items-center justify-center">
            <img src="/images/arrow-rounded.png" class="w-5 h-5">
          </a>
        </div>
        <div id="pesananContainer" class="space-y-4"></div>
      </div>
      <div>
        <div class="flex justify-between mb-3">
          <h2 class="text-lg">Daftar Membership</h2>
          <a href="/pemilik/membership" class="w-10 h-10 flex items-center justify-center">
            <img src="/images/arrow-rounded.png" class="w-5 h-5">
          </a>
        </div>
        <div id="membershipContainer" class="space-y-4"></div>
      </div>
    </div>
    <div id="addVenueContainer" class="mt-6 hidden flex flex-col items-center">
      <a href="/pemilik/kelola" class="w-[300px] inline-block bg-[#FFE500] text-black px-6 py-3 rounded-2xl hover:bg-[#FFD700] transition flex flex-col items-center">
        <img src="/images/add.png" alt="Tambah" class="w-7 h-7 mb-1" />
        Daftarkan Venue Anda
      </a>
    </div>

  </main>
  <script>
    const token = localStorage.getItem("token");
    const userId = parseInt(localStorage.getItem("user_id"));
    const pesananContainer = document.getElementById("pesananContainer");
    const membershipContainer = document.getElementById("membershipContainer");
    const addVenueContainer = document.getElementById("addVenueContainer");

    document.getElementById("welcome").textContent =
      `Selamat Datang, ${localStorage.getItem("user_name") || "Pengguna"}`;

    async function cekVenueSaya() {
      try {
        const res = await fetch(`${API_BASE_URL}/lapangan`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        const result = await res.json();
        const myVenue = result.data.filter(v => v.user_id == userId);
        if (myVenue.length === 0) {
          addVenueContainer.classList.remove("hidden");
        }
      } catch (e) {
        console.error("Gagal cek venue:", e);
      }
    }

    async function loadPesanan() {
      try {
        const [lapanganRes, pesananRes] = await Promise.all([
          fetch(`${API_BASE_URL}/lapangan`, {
            headers: {
              Authorization: `Bearer ${token}`
            }
          }),
          fetch(`${API_BASE_URL}/pesanan`, {
            headers: {
              Authorization: `Bearer ${token}`
            }
          })
        ]);

        const lapanganData = await lapanganRes.json();
        const myLapangans = lapanganData.data.filter(l => l.user_id == userId);
        const myLapanganIds = myLapangans.map(l => l.id);
        const myLapanganNames = myLapangans.map(l => l.nm_lapangan);
        const pesananData = await pesananRes.json();
        const filteredPesanan = pesananData.data.filter(p =>
          myLapanganNames.includes(p.lapangan_id)
        );

        pesananContainer.innerHTML = '';

        if (filteredPesanan.length === 0) {
          const emptyCard = document.createElement("div");
          emptyCard.className = "bg-white rounded-2xl p-20 flex items-center justify-center shadow-md";
          emptyCard.innerHTML = `<p class="italic text-center">Belum ada data pesanan</p>`;
          pesananContainer.appendChild(emptyCard);
        } else {
          filteredPesanan.forEach(item => {
            const card = document.createElement("div");
            card.className = "bg-white rounded-2xl p-4 shadow-md";
            card.innerHTML = `
          <div class="flex justify-between items-center mb-2">
            <p class="font-semibold text-md">ID transaksi: INV-${item.id}-FT</p>
            <span class="text-[#1BE387] font-bold text-xl">${item.total_harga}</span>
          </div>
          <div class="flex justify-between items-start">
            <div class="space-y-1">
              <p class="text-sm text-gray-700">${item.lapangan_id}</p>
              <p class="text-sm text-gray-700">${item.tanggal}</p>
            </div>
            <a href="/pemilik/detail-riwayat/${item.id}" class="bg-[#FFE500] text-black px-4 py-1 text-sm rounded-full font-medium h-fit">Detail</a>
          </div>
        `;
            pesananContainer.appendChild(card);
          });
        }
      } catch (e) {
        console.error("Gagal ambil pesanan:", e);
      }
    }

    function getMembershipDurationLabel(startDateStr, endDateStr) {
      const startDate = new Date(startDateStr);
      const endDate = new Date(endDateStr);
      const diffInMonths = (endDate.getFullYear() - startDate.getFullYear()) * 12 +
        (endDate.getMonth() - startDate.getMonth());
      if (diffInMonths >= 11) {
        return "1 Tahun";
      } else {
        return `${diffInMonths} Bulan`;
      }
    }

    let jenisMemberMap = {};

    async function loadJenisMemberList() {
      const res = await fetch(`${API_BASE_URL}/jenismember`, {
        headers: {
          Authorization: `Bearer ${token}`
        },
      });
      const result = await res.json();
      result.data.forEach(jm => {
        jenisMemberMap[jm.nm_membership] = jm;
      });
      loadMembership();
    }


    async function loadMembership() {
      try {
        // Ambil semua lapangan milik user login
        const lapanganRes = await fetch(`${API_BASE_URL}/lapangan`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        const lapanganData = await lapanganRes.json();
        const myLapangans = lapanganData.data.filter(l => l.user_id == userId);
        const myLapanganNames = myLapangans.map(l => l.nm_lapangan); // karena lapangan_id di membership berupa nama

        // Ambil semua data membership
        const memberRes = await fetch(`${API_BASE_URL}/member`, {
          headers: {
            Authorization: `Bearer ${token}`
          },
        });
        const memberData = await memberRes.json();

        // Filter hanya membership yang match dengan lapangan user ini
        const myMemberships = memberData.data.filter(m => myLapanganNames.includes(m.lapangan_id));

        membershipContainer.innerHTML = '';

        if (myMemberships.length === 0) {
          const emptyCard = document.createElement("div");
          emptyCard.className = "bg-white rounded-2xl p-20 flex items-center justify-center shadow-md";
          emptyCard.innerHTML = `<p class="italic text-center">Belum ada data membership</p>`;
          membershipContainer.appendChild(emptyCard);
          return;
        }

        // Tampilkan list membership
        myMemberships.forEach(item => {
          const jenis = jenisMemberMap[item.jenismember_id]; // key-nya nama: "Membership Tahunan"
          const nama = item.jenismember_id;
          const harga = jenis?.harga ? `Rp ${Number(jenis.harga).toLocaleString("id-ID")}` : "-";

          const card = document.createElement("div");
          card.className = "bg-white rounded-2xl p-4 shadow-md";
          card.innerHTML = `
        <div class="flex justify-between items-center mb-2">
          <p class="font-semibold text-md">${nama}</p>
          <span class="text-[#1BE387] font-bold text-xl">${harga}</span>
        </div>
        <div class="flex justify-between items-start">
          <div class="space-y-1">
            <p class="text-sm text-gray-700">${item.user_id}</p>
            <p class="text-sm text-gray-700">${getMembershipDurationLabel(item.tgl_mulai, item.tgl_selesai)}</p>
          </div>
          <a href="/pemilik/detail-membership/${item.id}" class="bg-[#FFE500] text-black px-4 py-1 text-sm rounded-full font-medium h-fit">Detail</a>
        </div>
      `;
          membershipContainer.appendChild(card);
        });
      } catch (e) {
        console.error("Gagal ambil data membership:", e);
      }
    }

    async function loadPendapatan() {
      try {
        // Ambil data lapangan milik user
        const lapanganRes = await fetch(`${API_BASE_URL}/lapangan`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        const lapanganData = await lapanganRes.json();
        const myLapangans = lapanganData.data.filter(l => l.user_id == userId);

        if (myLapangans.length === 0) {
          document.getElementById("venueName").textContent = "Belum ada venue";
          document.getElementById("totalPendapatan").textContent = "Rp 0";
          return;
        }

        const namaVenue = myLapangans[0].nm_lapangan;
        const myLapanganNames = myLapangans.map(l => l.nm_lapangan); // Karena lapangan_id di membership bentuknya nama

        document.getElementById("venueName").textContent = namaVenue;

        // Ambil data pesanan
        const pesananRes = await fetch(`${API_BASE_URL}/pesanan`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        const pesananData = await pesananRes.json();

        let totalPesanan = 0;
        pesananData.data.forEach(pesanan => {
          if (myLapangans.some(l => l.id === pesanan.lapangan_id)) {
            const cleanHarga = parseInt(pesanan.total_harga.toString().replace(/[^\d]/g, ""));
            totalPesanan += cleanHarga;
          }
        });

        // Ambil jenis membership
        const jenisRes = await fetch(`${API_BASE_URL}/jenismember`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        const jenisData = await jenisRes.json();
        const jenisMap = {};
        jenisData.data.forEach(j => {
          jenisMap[j.nm_membership] = parseInt(j.harga.toString().replace(/[^\d]/g, ""));
        });

        // Ambil data membership
        const memberRes = await fetch(`${API_BASE_URL}/member`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        });
        const memberData = await memberRes.json();

        let totalMembership = 0;
        memberData.data.forEach(m => {
          // Cuma tambahkan kalau membership ini milik lapangan user
          if (myLapanganNames.includes(m.lapangan_id)) {
            const harga = jenisMap[m.jenismember_id];
            if (harga) {
              totalMembership += harga;
            }
          }
        });

        const totalGabungan = totalPesanan + totalMembership;

        document.getElementById("totalPendapatan").textContent = `Rp ${totalGabungan.toLocaleString("id-ID")}`;

      } catch (err) {
        console.error("Gagal hitung total pendapatan:", err);
      }
    }

    cekVenueSaya();
    loadPesanan();
    loadJenisMemberList();
    loadPendapatan();
  </script>
</body>

</html>