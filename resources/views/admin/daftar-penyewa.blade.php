<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Daftar Penyewa - LokaRaga</title>
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
            <a href="/admin/daftar-pemilik" class="flex items-center space-x-3 px-4 py-2 hover:bg-[#4A5D7B] rounded-lg transition">
                <img src="/images/pemilik-white.png" class="h-5" alt="Pemilik">
                <span>Daftar Pemilik</span>
            </a>
            <a href="/admin/daftar-penyewa" class="flex items-center space-x-3 bg-[#CCDBED] text-black rounded-lg px-4 py-2 font-semibold">
                <img src="/images/penyewa-black.png" class="h-5" alt="Penyewa">
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
                <h1 class="text-xl">Daftar Penyewa</h1>
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
            <h2 class="text-lg">Daftar Penyewa</h2>
        </div>

        <div class="flex-1 overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-md">
                <thead class="bg-gray-100">
                    <tr class="text-left text-sm font-semibold text-black">
                        <th class="py-3 px-4 border-b">Nama Penyewa</th>
                        <th class="py-3 px-4 border-b">Email</th>
                        <th class="py-3 px-4 border-b">Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody id="tenant-table-body" class="text-black text-sm">
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

        async function loadTenants(page = 1) {
            const tbody = document.getElementById('tenant-table-body');
            const token = localStorage.getItem('token');

            try {
                const response = await fetch(`${API_BASE_URL}/user/role/penyewa?page=${page}`, {
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
                renderTenantTable(data);
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

        function renderTenantTable(tenants) {
            const tbody = document.getElementById('tenant-table-body');
            if (!tenants.length) {
                tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="py-3 px-4 text-center">Tidak ada data penyewa</td>
                </tr>`;
                return;
            }

            tbody.innerHTML = tenants.map(tenant => `
            <tr class="odd:bg-white even:bg-gray-50">
                <td class="py-3 px-4 border-b">${tenant.nama}</td>
                <td class="py-3 px-4 border-b">${tenant.email}</td>
                <td class="py-3 px-4 border-b">${tenant.no_telp || '-'}</td>
            </tr>
        `).join('');
        }

        function renderPagination(data) {
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            const { current_page, last_page } = data;

            const prevBtn = document.createElement('button');
            prevBtn.textContent = 'Previous';
            prevBtn.className = `text-gray-400 hover:text-gray-600 transition ${current_page === 1 ? 'opacity-50 cursor-not-allowed' : ''}`;
            prevBtn.disabled = current_page === 1;
            prevBtn.addEventListener('click', () => {
                if (current_page > 1) {
                    loadTenants(current_page - 1);
                }
            });
            pagination.appendChild(prevBtn);

            for (let i = 1; i <= last_page; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.textContent = i;
                pageBtn.className = `
                    w-8 h-8 flex items-center justify-center rounded-full font-semibold
                    ${i === current_page ? 'bg-blue-800 text-white' : 'bg-gray-200 text-black hover:bg-gray-300 transition'}
                `;
                pageBtn.addEventListener('click', () => {
                    if (i !== current_page) {
                        loadTenants(i);
                    }
                });
                pagination.appendChild(pageBtn);
            }

            const nextBtn = document.createElement('button');
            nextBtn.textContent = 'Next';
            nextBtn.className = `text-gray-400 hover:text-gray-600 transition ${current_page === last_page ? 'opacity-50 cursor-not-allowed' : ''}`;
            nextBtn.disabled = current_page === last_page;
            nextBtn.addEventListener('click', () => {
                if (current_page < last_page) {
                    loadTenants(current_page + 1);
                }
            });
            pagination.appendChild(nextBtn);
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadUserProfile();
            loadTenants();
        });
    </script>
</body>

</html>
