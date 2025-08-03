<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Daftar Pemilik - LokaRaga</title>
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
    <main class="flex-1 flex flex-col p-8 min-h-screen">
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center space-x-2">
                <h1 class="text-xl">Daftar Pemilik</h1>
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
        <hr class="w-full border-t-2 border-black opacity-20">
        <div class="flex justify-between items-center mt-5 mb-4">
            <h2 class="text-lg">Daftar Pemilik</h2>
            <a href="/admin/tambah-pemilik" class="bg-[#0F4BA1] text-white px-4 py-2 rounded-md font-semibold text-sm flex items-center gap-2 shadow-md hover:bg-[#0d3f86] transition">
                <span class="font-semibold text-xl">+</span> Tambah Pemilik
            </a>
        </div>

        <div class="flex-1 overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-md">
                <thead class="bg-gray-100">
                    <tr class="text-left text-sm font-semibold text-black">
                        <th class="py-3 px-4 border-b">Nama Pemilik</th>
                        <th class="py-3 px-4 border-b">Email</th>
                        <th class="py-3 px-4 border-b">Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody id="owner-table-body" class="text-black text-sm">
                    <tr>
                        <td colspan="3" class="py-3 px-4 text-center text-gray-500">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="pagination" class="flex justify-center items-center gap-2 mt-6 text-sm"></div>
    </main>
    <script>
        let currentPage = 1;

        async function loadUserProfile() {
            const token = localStorage.getItem('token');
            try {
                const res = await fetch(`${API_BASE_URL}/profile`, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                const data = await res.json();
                document.getElementById('welcome').textContent = `Halo, ${data.nama}`;
            } catch (e) {
                console.error('Gagal ambil profil:', e);
            }
        }

        async function loadOwners(page = 1) {
            const tbody = document.getElementById('owner-table-body');
            const token = localStorage.getItem('token');

            try {
                const response = await fetch(`${API_BASE_URL}/user/role/pemilik?page=${page}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });

                console.log('Status:', response.status);

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Response error:', errorText);
                    throw new Error('Gagal mengambil data');
                }

                const data = await response.json();
                renderOwnerTable(data);
                renderPagination(data);
                currentPage = data.current_page;
            } catch (error) {
                console.error(error);
                tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="py-3 px-4 text-center text-red-500">Gagal memuat data</td>
                </tr>`;
            }
        }

        function renderOwnerTable(owners) {
            const tbody = document.getElementById('owner-table-body');
            if (!owners.length) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="py-3 px-4 text-center">Tidak ada data pemilik</td>
                </tr>`;
                return;
            }

            tbody.innerHTML = owners.map(owner => `
            <tr class="odd:bg-white even:bg-gray-50">
                <td class="py-3 px-4 border-b">${owner.nama}</td>
                <td class="py-3 px-4 border-b">${owner.email}</td>
                <td class="py-3 px-4 border-b">${owner.no_telp || '-'}</td>
            </tr>
        `).join('');
        }

        function renderPagination(currentPage, totalPages) {
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            // Tombol Previous
            const prevBtn = document.createElement('button');
            prevBtn.textContent = 'Previous';
            prevBtn.className = `text-gray-400 hover:text-gray-600 transition ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''}`;
            prevBtn.disabled = currentPage === 1;
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    loadOwners(currentPage - 1);
                }
            });
            pagination.appendChild(prevBtn);

            // Tombol nomor halaman
            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.textContent = i;
                pageBtn.className = `
            w-8 h-8 flex items-center justify-center rounded-full font-semibold
            ${i === currentPage ? 'bg-blue-800 text-white' : 'bg-gray-200 text-black hover:bg-gray-300 transition'}
        `;
                pageBtn.addEventListener('click', () => {
                    if (i !== currentPage) {
                        loadOwners(i);
                    }
                });
                pagination.appendChild(pageBtn);
            }

            // Tombol Next
            const nextBtn = document.createElement('button');
            nextBtn.textContent = 'Next';
            nextBtn.className = `text-gray-400 hover:text-gray-600 transition ${currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''}`;
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    loadOwners(currentPage + 1);
                }
            });
            pagination.appendChild(nextBtn);
        }


        document.addEventListener('DOMContentLoaded', () => {
            loadUserProfile();
            loadOwners();
        });
    </script>
</body>

</html>