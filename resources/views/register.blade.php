<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Daftar - LokaRaga</title>
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

    .btn-primary {
      background-color: #0F4BA1;
    }
  </style>
</head>

<body class="bg-blue flex items-center justify-center min-h-screen">
  <div class="bg-white rounded-2xl p-12 sm:p-16 shadow-lg w-full max-w-xl text-center">
    <h2 class="text-2xl font-bold text-black mb-8">Buat Akun</h2>

    <form id="registerForm" class="space-y-5 text-left">
      <div>
        <label class="block text-sm font-medium mb-1 text-[#0F4BA1]">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" class="w-full px-4 py-3 border border-blue-200 rounded-md bg-blue-50 text-black focus:outline-none focus:ring-2 focus:ring-blue-400" />
      </div>
      <div>
        <label class="block text-sm font-medium mb-1 text-[#0F4BA1]">Email</label>
        <input type="email" name="email" id="email" class="w-full px-4 py-3 border border-blue-200 rounded-md bg-blue-50 text-black focus:outline-none focus:ring-2 focus:ring-blue-400" />
      </div>
      <div>
        <label class="block text-sm font-medium mb-1 text-[#0F4BA1]">No. Telepon</label>
        <input type="tel" name="no_telp" id="no_telp" class="w-full px-4 py-3 border border-blue-200 rounded-md bg-blue-50 text-black focus:outline-none focus:ring-2 focus:ring-blue-400" />
      </div>
      <div>
        <label class="block text-sm font-medium mb-1 text-[#0F4BA1]">Buat Kata Sandi</label>
        <input type="password" name="kata_sandi" id="kata_sandi" class="w-full px-4 py-3 border border-blue-200 rounded-md bg-blue-50 text-black focus:outline-none focus:ring-2 focus:ring-blue-400" />
      </div>
      <div class="pt-4 text-center">
        <button type="submit" style="width: 300px;" class="py-3 text-white text-base font-semibold rounded-full btn-primary hover:bg-blue-900 transition duration-200">
          Daftar
        </button>
      </div>
    </form>

    <p class="text-center text-sm text-black mt-6">
      Sudah punya akun?
      <a href="/login" class="text-blue-700 font-semibold hover:underline">Masuk</a>
    </p>
  </div>

  <script>
    document.getElementById('registerForm').addEventListener('submit', async function (e) {
      e.preventDefault();

      const data = {
        nama: document.getElementById('nama').value,
        email: document.getElementById('email').value,
        no_telp: document.getElementById('no_telp').value,
        kata_sandi: document.getElementById('kata_sandi').value,
        role_id: 3
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
          alert('Pendaftaran berhasil! Silakan login.');
          window.location.href = '/login';
        } else {
          alert('Pendaftaran gagal: ' + (result.message || 'Periksa kembali input Anda.'));
        }
      } catch (error) {
        alert('Terjadi kesalahan jaringan. Coba lagi nanti.');
        console.error(error);
      }
    });
  </script>
</body>

</html>