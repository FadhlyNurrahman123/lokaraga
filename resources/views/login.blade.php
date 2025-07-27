<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <title>Login - LokaRaga</title>
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
  <div class="bg-white rounded-2xl p-24 shadow-lg w-full max-w-xl">
    <div class="mb-6">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-20 mb-6">
      <h2 class="text-xl font-bold text-black">Hi,</h2>
      <h3 class="text-xl font-semibold text-black">Masuk sekarang</h3>
    </div>

    <form id="loginForm" class="space-y-5">
      <div>
        <label class="block text-sm font-medium text-[#0F4BA1] mb-1">Email</label>
        <input type="email" name="email" id="email" class="w-full px-4 py-3 border border-blue-200 rounded-md bg-blue-50 text-black focus:outline-none focus:ring-2 focus:ring-blue-400" required />
      </div>
      <div>
        <label class="block text-sm font-medium text-[#0F4BA1] mb-1">Kata Sandi</label>
        <input type="password" name="kata_sandi" id="kata_sandi" class="w-full px-4 py-3 border border-blue-200 rounded-md bg-blue-50 text-black focus:outline-none focus:ring-2 focus:ring-blue-400" required />
      </div>
      <div class="pt-4 text-center">
        <button type="submit" style="width: 300px;" class="w-[300px] py-3 text-white text-base font-semibold rounded-full btn-primary hover:bg-blue-900 transition duration-200">
          Masuk
        </button>
      </div>
    </form>

    <p class="text-center text-sm text-black mt-6">
      Belum punya akun?
      <a href="/register" class="text-blue-700 font-semibold hover:underline">Buat akun</a>
    </p>
  </div>

  <script>
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', async function(e) {
      e.preventDefault();

      const email = document.getElementById('email').value;
      const password = document.getElementById('kata_sandi').value;

      try {
        const response = await fetch(`${API_BASE_URL}/login`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            email: email,
            kata_sandi: password
          })
        });

        if (response.ok) {
          const token = await response.text();
          localStorage.setItem('token', token);
          alert('Login berhasil!');
          window.location.href = '/beranda';
        } else {
          const error = await response.text();
          alert('Login gagal. ' + error);
        }
      } catch (error) {
        alert('Terjadi kesalahan jaringan. Coba lagi nanti.');
        console.error(error);
      }
    });
  </script>
</body>

</html>