<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Profile - LokaRaga</title>
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
            <a href="/beranda" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/beranda-white.png" class="h-5" alt="Home">
                <span>Beranda</span>
            </a>
            <a href="/pesan" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/pesan-white.png" class="h-5" alt="Pesan">
                <span>Pesan</span>
            </a>
            <a href="/riwayat" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="{{ asset('images/riwayat-white.png') }}" class="h-5" alt="Riwayat">
                <span>Riwayat</span>
            </a>
            <a href="/akun" class="flex items-center space-x-3 text-black bg-[#CCDBED] px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition font-semibold">
                <img src="{{ asset('images/akun-black.png') }}" class="h-5" alt="Akun">
                <span>Akun</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl">Profile</h1>
            <div class="flex items-center gap-3">
                <div class="relative w-60">
                    <input type="text" placeholder="Search..."
                        class="w-full py-2 pl-4 pr-10 text-black placeholder-black text-sm border border-black rounded-md focus:outline-none" />
                    <img src="/images/icon-search.png" alt="Search"
                        class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5" />
                </div>
                <a href="/akun">
                    <img src="/images/icon-profile.png" class="h-10 cursor-pointer" alt="Profile" />
                </a>
            </div>
        </div>
        <hr class="w-full border-t-2 border-black opacity-20">
        <div class="bg-blue text-white rounded-2xl py-6 px-8 flex flex-row items-center gap-4 mb-8 justify-center mt-8">
            <img src="/images/profpic.png" class="w-16 h-16 rounded-full" alt="User Avatar" />
            <h2 class="text-xl font-semibold" id="namaUser">Loading...</h2>
        </div>
        <div class="flex flex-col md:flex-row justify-center gap-4 mb-8">
            <a href="#" id="btnEdit"
                class="bg-[#E4EEF9] px-6 py-4 rounded-xl w-full md:w-64 flex items-center justify-center gap-2">
                <img src="/images/profile-blue.png" class="h-6" alt="Atur Profile" />
                <span class="font-semibold">Atur Profile</span>
            </a>
            <a href="#" id="btnPanduan"
                class="bg-[#E4EEF9] px-6 py-4 rounded-xl w-full md:w-64 flex items-center justify-center gap-2">
                <img src="/images/panduan.png" class="h-6" alt="Panduan" />
                <span class="font-semibold">Panduan Pengguna</span>
            </a>
            <a href="#" id="btnFaq"
                class="bg-[#E4EEF9] px-6 py-4 rounded-xl w-full md:w-64 flex items-center justify-center gap-2">
                <img src="/images/bantuan.png" class="h-6" alt="FAQ" />
                <span class="font-semibold">FAQ</span>
            </a>
        </div>

        <!-- Form Edit -->
        <div id="formProfile" class="hidden flex flex-col items-center mt-8">
            <form id="formEditProfile">
                <div class="flex flex-row items-start gap-8">
                    <img src="/images/profpic.png" class="w-64 h-64 rounded-full mt-2" alt="Avatar" />
                    <div class="w-[400px] space-y-4">
                        <div>
                            <label class="block text-[#0F4BA1] font-semibold mb-1">Nama</label>
                            <input id="inputNama" type="text"
                                class="w-full px-4 py-2 rounded-md bg-[#E4F1FC] focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-[#0F4BA1] font-semibold mb-1">Email</label>
                            <input id="inputEmail" type="email"
                                class="w-full px-4 py-2 rounded-md bg-[#E4F1FC] focus:outline-none" />
                        </div>
                        <div>
                            <label class="block text-[#0F4BA1] font-semibold mb-1">No. Telepon</label>
                            <input id="inputTelp" type="text"
                                class="w-full px-4 py-2 rounded-md bg-[#E4F1FC] focus:outline-none" />
                        </div>
                    </div>
                </div>

                <!-- Tombol simpan -->
                <div class="text-center mt-6">
                    <button type="submit"
                        class="bg-[#0F4BA1] text-white font-semibold py-2 px-12 rounded-full hover:bg-blue-800 transition">Simpan</button>
                </div>
            </form>
        </div>

        <!-- Panduan Section -->
        <div id="panduanSection" class="hidden mt-8 text-[#0F4BA1] text-sm leading-relaxed">
            <h2 class="text-xl font-bold mb-2">PANDUAN PENGGUNAAN</h2>
            <p class="mb-4 text-black">Berikut adalah panduan penggunaan untuk aplikasi booking lapangan LokaRaga:</p>

            <h3 class="text-base font-semibold">Langkah 1: Unduh dan Instal Aplikasi</h3>
            <ul class="list-disc list-inside mb-4 text-black">
                <li>Buka toko aplikasi di perangkat mobile Anda (Google Play Store untuk Android, App Store untuk iOS).</li>
                <li>Cari aplikasi booking lapangan yang diinginkan.</li>
                <li>Ketuk tombol "Unduh" atau "Dapatkan" untuk mengunduh aplikasi.</li>
                <li>Setelah unduhan selesai, ikuti petunjuk untuk menginstal aplikasi di perangkat Anda.</li>
            </ul>

            <h3 class="text-base font-semibold">Langkah 2: Buat Akun Pengguna</h3>
            <ul class="list-disc list-inside mb-4 text-black">
                <li>Buka aplikasi yang telah diinstal.</li>
                <li>Pilih opsi "Buat Akun" atau "Daftar" untuk membuat akun baru.</li>
                <li>Isi informasi seperti nama lengkap, alamat email, nomor telepon, dan kata sandi.</li>
                <li>Ikuti langkah verifikasi seperti memasukkan kode dari email atau SMS.</li>
                <li>Setelah berhasil, masuk dengan email dan kata sandi Anda.</li>
            </ul>

            <h3 class="text-base font-semibold">Langkah 3: Telusuri dan Pilih Lapangan</h3>
            <ul class="list-disc list-inside mb-4 text-black">
                <li>Masuk ke aplikasi dan akses halaman beranda atau pencarian.</li>
                <li>Cari lapangan berdasarkan jenis olahraga, lokasi, tanggal, atau waktu.</li>
                <li>Lihat detail lapangan seperti fasilitas, harga, dan ulasan.</li>
            </ul>

            <h3 class="text-base font-semibold">Langkah 4: Pilih Tanggal dan Waktu</h3>
            <ul class="list-disc list-inside mb-4 text-black">
                <li>Pilih lapangan yang diinginkan.</li>
                <li>Tentukan tanggal dan waktu pemesanan.</li>
                <li>Beberapa aplikasi menampilkan ketersediaan dalam kalender atau daftar jam.</li>
            </ul>

            <h3 class="text-base font-semibold">Langkah 5: Pilih Jenis Pemesanan</h3>
            <ul class="list-disc list-inside mb-4 text-black">
                <li>Pilih antara pemesanan per jam atau paket berlangganan.</li>
                <li>Periksa harga dan kebijakan pembatalan sebelum melanjutkan.</li>
            </ul>

            <h3 class="text-base font-semibold">Langkah 6: Lakukan Pembayaran</h3>
            <ul class="list-disc list-inside mb-4 text-black">
                <li>Ikuti proses pembayaran sesuai metode yang dipilih (kartu, transfer, e-wallet).</li>
                <li>Pastikan informasi benar dan periksa kebijakan refund.</li>
            </ul>

            <h3 class="text-base font-semibold">Langkah 7: Konfirmasi Pemesanan</h3>
            <ul class="list-disc list-inside mb-4 text-black">
                <li>Setelah pembayaran, Anda akan menerima konfirmasi via aplikasi/email/SMS.</li>
                <li>Periksa kembali detail pemesanan Anda.</li>
                <li>Simpan nomor pemesanan atau bukti transaksi sebagai referensi.</li>
            </ul>
        </div>

        <!-- FAQ Section -->
        <div id="faqSection" class="hidden mt-8 text-sm leading-relaxed">
            <h2 class="text-xl font-bold mb-2 text-[#0F4BA1]">FAQ</h2>
            <p class="mb-4 text-black">Berikut adalah FAQ untuk aplikasi booking lapangan LokaRaga:</p>

            <ol class="list-decimal list-inside text-[#0F4BA1] space-y-4">
                <li>
                    <span class="font-semibold">Apa itu aplikasi LokaRaga?</span><br />
                    <span class="text-black">LokaRaga adalah aplikasi mobile untuk booking lapangan olahraga yang memudahkan pengguna untuk mencari, memilih, dan memesan lapangan olahraga di berbagai lokasi.</span>
                </li>
                <li>
                    <span class="font-semibold">Bagaimana cara mengunduh LokaRaga?</span><br />
                    <span class="text-black">Untuk mengunduh LokaRaga, buka toko aplikasi di perangkat mobile Anda (Google Play Store untuk Android, App Store untuk iOS), cari "LokaRaga" dan ketuk tombol "Unduh" atau "Dapatkan" untuk mengunduh dan menginstal aplikasi.</span>
                </li>
                <li>
                    <span class="font-semibold">Bagaimana cara membuat akun di LokaRaga?</span><br />
                    <span class="text-black">Setelah mengunduh LokaRaga, buka aplikasi dan pilih opsi "Buat Akun". Isi informasi yang diperlukan, seperti nama lengkap, alamat email, nomor telepon, dan buat kata sandi. Ikuti petunjuk verifikasi yang mungkin diperlukan untuk menyelesaikan proses pendaftaran.</span>
                </li>
                <li>
                    <span class="font-semibold">Bagaimana cara mencari lapangan olahraga di LokaRaga?</span><br />
                    <span class="text-black">Setelah masuk ke aplikasi, Anda dapat menggunakan fitur pencarian pada halaman utama untuk mencari lapangan olahraga. Anda dapat mencari berdasarkan jenis olahraga, lokasi, tanggal, atau jam tertentu.</span>
                </li>
                <li>
                    <span class="font-semibold">Bagaimana cara memesan lapangan di LokaRaga?</span><br />
                    <span class="text-black">Setelah menemukan lapangan yang diinginkan, pilih tanggal dan waktu yang tersedia. Pilih jenis pemesanan yang sesuai dengan kebutuhan Anda, seperti pemesanan per jam atau paket berlangganan. Setelah itu, lakukan pembayaran dan Anda akan menerima konfirmasi pemesanan melalui aplikasi dan email.</span>
                </li>
                <li>
                    <span class="font-semibold">Apa metode pembayaran yang dapat saya gunakan di LokaRaga?</span><br />
                    <span class="text-black">LokaRaga menyediakan berbagai metode pembayaran yang termasuk transfer bank dan dompet digital. Anda dapat memilih metode pembayaran yang paling nyaman bagi Anda saat melakukan pembayaran melalui aplikasi.</span>
                </li>
                <li>
                    <span class="font-semibold">Apakah saya bisa membatalkan pemesanan di LokaRaga?</span><br />
                    <span class="text-black">Ya, Anda dapat membatalkan pemesanan di LokaRaga. Namun, pastikan untuk memeriksa kebijakan pembatalan yang berlaku dan perhatikan bahwa ada kemungkinan dikenakan biaya pembatalan sesuai dengan kebijakan yang ditetapkan.</span>
                </li>
                <li>
                    <span class="font-semibold">Bagaimana cara menghubungi tim dukungan LokaRaga?</span><br />
                    <span class="text-black">Jika Anda memiliki pertanyaan atau masalah, Anda dapat menghubungi tim dukungan LokaRaga melalui fitur "Hubungi Kami" yang tersedia di dalam aplikasi. Anda juga dapat mencari informasi kontak mereka pada halaman "Bantuan" di aplikasi.</span>
                </li>
                <li>
                    <span class="font-semibold">Bisakah saya memberikan ulasan tentang lapangan yang saya gunakan?</span><br />
                    <span class="text-black">Ya, setelah menggunakan lapangan yang Anda pesan melalui LokaRaga, Anda dapat memberikan ulasan dan penilaian tentang pengalaman Anda di halaman ulasan aplikasi. Ulasan Anda dapat membantu pengguna lain dalam memilih lapangan yang tepat.</span>
                </li>
                <li>
                    <span class="font-semibold">Apakah LokaRaga menyediakan promosi atau diskon khusus?</span><br />
                    <span class="text-black">LokaRaga sering kali menawarkan promosi dan diskon khusus kepada pengguna mereka. Pastikan untuk memeriksa bagian "Promosi" di aplikasi atau mengikuti akun media sosial LokaRaga untuk mendapatkan informasi terbaru tentang penawaran spesial yang tersedia.</span>
                </li>
            </ol>
        </div>

        <div id="btnLogout" class="flex justify-center px-8 mt-4">
            <button id="showLogoutModal" class="w-[400px] bg-[#0F4BA1] text-white font-semibold py-2 rounded-full hover:bg-blue-800 transition">
                Keluar
            </button>
        </div>

        <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-40 flex justify-start items-end z-50 hidden pb-10 pl-[45%]">
            <div class="bg-[#E4F1FC] px-6 py-6 rounded-2xl text-center w-[90%] max-w-md">
                <p class="text-lg mb-4">Apakah anda yakin ingin keluar aplikasi?</p>
                <div class="flex justify-center gap-6">
                    <a href="/" class="text-black font-bold mt-1">Ya</a>
                    <button id="batalLogout" class="bg-red-600 text-white font-bold px-4 py-1 rounded-md hover:bg-red-700">Tidak</button>
                </div>
            </div>
        </div>
    </main>
    <script>        
        const token = localStorage.getItem("token");
        const API = `${API_BASE_URL}/profile`;
        const namaUser = document.getElementById("namaUser");
        const inputNama = document.getElementById("inputNama");
        const inputEmail = document.getElementById("inputEmail");
        const inputTelp = document.getElementById("inputTelp");
        const formProfile = document.getElementById("formProfile");
        const btnLogout = document.getElementById("btnLogout");
        const btnEdit = document.getElementById("btnEdit");
        const formEdit = document.getElementById("formEditProfile");

        const btnPanduan = document.getElementById("btnPanduan");
        const btnFaq = document.getElementById("btnFaq");
        const panduanSection = document.getElementById("panduanSection");
        const faqSection = document.getElementById("faqSection");

        let isFormShown = false;
        let isPanduanShown = false;
        let isFaqShown = false;
        let userId = null;

        async function loadProfile() {
            try {
                const res = await fetch(API, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });

                if (!res.ok) throw new Error("Gagal ambil profil");

                const result = await res.json();
                userId = result.id;

                namaUser.textContent = result.nama || "Pengguna";

                // Edit Profile click
                btnEdit.addEventListener("click", (e) => {
                    e.preventDefault();

                    // Sembunyikan panduan dan FAQ
                    panduanSection.classList.add("hidden");
                    faqSection.classList.add("hidden");
                    isPanduanShown = false;
                    isFaqShown = false;

                    isFormShown = !isFormShown;

                    if (isFormShown) {
                        formProfile.classList.remove("hidden");
                        btnLogout.classList.add("hidden");

                        inputNama.value = result.nama || "";
                        inputEmail.value = result.email || "";
                        inputTelp.value = result.no_telp || "";
                    } else {
                        formProfile.classList.add("hidden");
                        btnLogout.classList.remove("hidden");
                    }
                });

            } catch (err) {
                console.error("Gagal memuat profil:", err);
                namaUser.textContent = "Pengguna";
            }
        }

        // Form submit
        formEdit.addEventListener("submit", async function(e) {
            e.preventDefault();

            try {
                const res = await fetch(`${API_BASE_URL}/Updateuser/${userId}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: `Bearer ${token}`,
                    },
                    body: JSON.stringify({
                        nama: inputNama.value,
                        email: inputEmail.value,
                        no_telp: inputTelp.value,
                    }),
                });

                if (!res.ok) throw new Error("Gagal menyimpan");

                alert("Profil berhasil diperbarui!");
                namaUser.textContent = inputNama.value;

                formProfile.classList.add("hidden");
                btnLogout.classList.remove("hidden");
                isFormShown = false;
            } catch (err) {
                console.log("User ID:", userId);
                console.log("Endpoint:", `${API_BASE_URL}/Updateuser/${userId}`);
                console.log("Token:", token);
                console.error(err);
                alert("Terjadi kesalahan saat menyimpan profil.");
            }
        });

        // Panduan
        btnPanduan.addEventListener("click", (e) => {
            e.preventDefault();

            isPanduanShown = !isPanduanShown;
            isFaqShown = false;
            isFormShown = false;

            if (isPanduanShown) {
                panduanSection.classList.remove("hidden");
                faqSection.classList.add("hidden");
                formProfile.classList.add("hidden");
                btnLogout.classList.add("hidden");
            } else {
                panduanSection.classList.add("hidden");
                btnLogout.classList.remove("hidden");
            }
        });

        // FAQ
        btnFaq.addEventListener("click", (e) => {
            e.preventDefault();

            isFaqShown = !isFaqShown;
            isPanduanShown = false;
            isFormShown = false;

            if (isFaqShown) {
                faqSection.classList.remove("hidden");
                panduanSection.classList.add("hidden");
                formProfile.classList.add("hidden");
                btnLogout.classList.add("hidden");
            } else {
                faqSection.classList.add("hidden");
                btnLogout.classList.remove("hidden");
            }
        });

        loadProfile();

        const logoutModal = document.getElementById('logoutModal');
        const showLogoutModal = document.getElementById('showLogoutModal');
        const batalLogout = document.getElementById('batalLogout');

        showLogoutModal.addEventListener('click', (e) => {
            e.preventDefault();
            logoutModal.classList.remove('hidden');
        });

        batalLogout.addEventListener('click', () => {
            logoutModal.classList.add('hidden');
        });
    </script>
</body>

</html>