<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Edit Venue - LokaRaga</title>
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

    input,
    textarea,
    select {
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
      <a href="/pemilik/beranda" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition"><img src="/images/beranda-white.png" class="h-5"><span>Beranda</span></a>
      <a href="/pemilik/kelola" class="flex items-center space-x-3 px-4 py-2 bg-[#CCDBED] text-black rounded-lg font-semibold"><img src="/images/pesan-black.png" class="h-5"><span>Kelola</span></a>
      <a href="/pemilik/riwayat" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition"><img src="/images/riwayat-white.png" class="h-5"><span>Riwayat</span></a>
      <a href="/pemilik/membership" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition"><img src="/images/membership-white.png" class="h-5"><span>Membership</span></a>
      <a href="/pemilik/akun" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition"><img src="/images/akun-white.png" class="h-5"><span>Akun</span></a>
    </nav>
  </aside>

  <main class="flex-1 p-8">
    <div class="flex justify-between items-center mb-5">
      <h1 class="text-xl">Edit Lapangan</h1>
    </div>
    <hr class="w-full border-t-2 border-black opacity-20 mb-8">

    <form id="form-edit">
      <div class="grid grid-cols-12 gap-x-8 gap-y-6 mb-6">
        <div class="col-span-6">
          <label class="block mb-1">Nama Venue</label>
          <input type="text" id="nama" class="w-full rounded-md px-3 py-2" required />
        </div>

        <div class="col-span-6">
          <label class="block mb-1">Jam Operasional</label>
          <div class="flex items-center gap-4">
            <span class="text-gray-400">Buka</span>
            <input type="time" id="jam-buka" class="w-24 rounded-md px-2 py-1" required />
            <span class="text-gray-400">Tutup</span>
            <input type="time" id="jam-tutup" class="w-24 rounded-md px-2 py-1" required />
          </div>
        </div>

        <div class="col-span-6">
          <label class="block mb-1">Alamat Venue</label>
          <input type="text" id="alamat" class="w-full rounded-md px-3 py-2" required />
        </div>

        <div class="col-span-6">
          <label class="block mb-1">Jenis Olahraga</label>
          <select id="olahraga" class="w-full rounded-md px-3 py-2 mb-4" required></select>

          <label class="block mb-1">Fasilitas</label>
          <div id="fasilitas-list" class="grid grid-cols-2 gap-x-4 gap-y-2 mb-4"></div>
          <div class="flex">
            <input type="text" id="fasilitas-input" class="flex-1 rounded-l-md px-3 py-2 border" placeholder="Tambah fasilitas..." />
            <button type="button" id="fasilitas-tambah" class="bg-blue text-white px-4 rounded-r-md hover:bg-[#0d3f86] transition">Tambah</button>
          </div>
        </div>

        <div class="col-span-12 md:col-span-6">
          <label class="block mb-1">Foto Venue</label>
          <img id="foto-preview" src="" alt="Foto Venue" class="w-full rounded-xl shadow mb-2" />
          <input type="file" id="foto" accept="image/*" />
        </div>
      </div>

      <div class="flex justify-center">
        <button type="submit" class="bg-blue text-white px-10 py-2 rounded-full font-medium shadow-md hover:bg-[#0d3f86] transition mt-5 w-72">
          Simpan
        </button>
      </div>
    </form>
  </main>

  <script>
    const token = localStorage.getItem("token");
    let lapanganId = null;
    let userId = null;
    let fasilitasData = [];

    const fasilitasInput = document.getElementById("fasilitas-input");
    const fasilitasList = document.getElementById("fasilitas-list");
    const fasilitasTambah = document.getElementById("fasilitas-tambah");

    fasilitasTambah.addEventListener("click", () => {
      const text = fasilitasInput.value.trim();
      if (text !== "") {
        fasilitasData.push(text);
        fasilitasInput.value = "";
        renderFasilitas();
      }
    });

    function renderFasilitas() {
      fasilitasList.innerHTML = fasilitasData.map(f => `
      <div class="flex items-center gap-2 bg-gray-100 rounded px-2 py-1">
        <span class="text-sm">${f}</span>
        <button type="button" class="text-red-500 text-sm" onclick="hapusFasilitas('${f}')">&times;</button>
      </div>
    `).join("");
    }

    window.hapusFasilitas = function(f) {
      fasilitasData = fasilitasData.filter(item => item !== f);
      renderFasilitas();
    }

    async function getDataLapangan() {
      try {
        const profile = await fetch(`${API_BASE_URL}/profile`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        }).then(res => res.json());
        userId = profile.id;

        const lapangan = await fetch(`${API_BASE_URL}/lapangan?user_id=${userId}`, {
          headers: {
            Authorization: `Bearer ${token}`
          }
        }).then(res => res.json());

        const data = lapangan.data?.[0];

        if (!data) {
          alert("Kamu belum memiliki data lapangan.");
          document.getElementById("form-edit").style.display = "none";
          return;
        }

        lapanganId = data.id;
        document.getElementById("nama").value = data.nm_lapangan ?? "";
        document.getElementById("alamat").value = data.alamat ?? "";
        document.getElementById("jam-buka").value = data.jam_buka_operasional?.slice(0, 5) ?? "";
        document.getElementById("jam-tutup").value = data.jam_tutup_operasional?.slice(0, 5) ?? "";
        document.getElementById("foto-preview").src = `/storage/${data.foto}`;
        fasilitasData = data.fasilitas ? data.fasilitas.split(",").map(f => f.trim()) : [];
        renderFasilitas();
        await loadJenisOlahraga(data.jenis_olahraga_id);
      } catch (err) {
        console.error(err);
        alert("Gagal memuat data lapangan.");
      }
    }


    async function loadJenisOlahraga(selectedId = null) {
      try {
        const res = await fetch(`${API_BASE_URL}/jenisolahraga`);
        const data = await res.json();
        const select = document.getElementById("olahraga");

        select.innerHTML = data.data.map(j => `
        <option value="${j.id}" ${j.id == selectedId ? "selected" : ""}>${j.nm_jenisolahraga}</option>
      `).join("");
      } catch (err) {
        console.error("Gagal memuat jenis olahraga:", err);
      }
    }

    document.addEventListener("DOMContentLoaded", getDataLapangan);

    document.getElementById("form-edit").addEventListener("submit", async (e) => {
      e.preventDefault();

      const formData = new FormData();
      formData.append("_method", "PUT");
      formData.append("user_id", userId);
      formData.append("nm_lapangan", document.getElementById("nama").value);
      formData.append("alamat", document.getElementById("alamat").value);
      formData.append("jam_buka_operasional", document.getElementById("jam-buka").value);
      formData.append("jam_tutup_operasional", document.getElementById("jam-tutup").value);
      formData.append("jenis_olahraga_id", document.getElementById("olahraga").value);
      formData.append("fasilitas", fasilitasData.join(", "));
      formData.append("harga", "60000");

      const fotoFile = document.getElementById("foto").files[0];
      if (fotoFile) formData.append("foto", fotoFile);

      try {
        const res = await fetch(`${API_BASE_URL}/Updatelapangan/${lapanganId}`, {
          method: "POST",
          headers: {
            Authorization: `Bearer ${token}`,
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: formData
        });

        if (res.ok) {
          alert("Berhasil update data lapangan!");
          window.location.href = "/pemilik/kelola";
        } else {
          const err = await res.json();
          console.log("RESPON ERROR:", err);
          alert("Gagal update: " + (err.message || JSON.stringify(err.errors)));
        }
      } catch (err) {
        console.error(err);
        alert("Terjadi kesalahan saat update.");
      }
    });
  </script>

</body>

</html>