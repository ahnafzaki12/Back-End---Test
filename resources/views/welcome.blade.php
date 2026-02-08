<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API Documentation - Aksamedia Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        code {
            font-family: ui-monospace, monospace;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-indigo-600">Aksamedia <span
                    class="text-slate-500 text-base font-normal">API Docs</span></h1>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-6 py-12">

        <section class="mb-12">
            <h2 class="text-3xl font-extrabold mb-4">Base URL</h2>
            <div class="bg-slate-900 text-slate-300 p-4 rounded-lg flex items-center justify-between">
                <code id="baseUrl">https://back-end-test-production-4bef.up.railway.app/api</code>
            </div>
            <p class="mt-4 text-slate-600 italic leading-relaxed">
                Semua endpoint di bawah ini (kecuali login) memerlukan Header: <br>
                <span class="font-semibold text-slate-800 tracking-wide">Authorization: Bearer {your_token}</span>
            </p>
        </section>

        <section class="mb-12">
            <h3 class="text-xl font-bold mb-6 flex items-center">
                <span class="bg-indigo-600 w-2 h-6 rounded mr-3"></span> Authentication
            </h3>
            <div class="space-y-4">
                @component('components.api-item', [
                    'method' => 'POST',
                    'url' => '/login',
                    'desc' => 'Login untuk mendapatkan token akses.',
                ])
                @endcomponent
                @component('components.api-item', [
                    'method' => 'POST',
                    'url' => '/logout',
                    'desc' => 'Menghapus sesi token saat ini.',
                    'auth' => true,
                ])
                @endcomponent
            </div>
            <div class="mt-4 p-4 bg-amber-50 border border-amber-200 rounded-lg text-sm">
                <p class="font-bold text-amber-800 mb-2 italic">Test Account (Development/Demo):</p>
                <ul class="space-y-1 text-amber-700">
                    <li><strong>Username:</strong> <code class="bg-amber-100 px-1 rounded">admin</code></li>
                    <li><strong>Password:</strong> <code class="bg-amber-100 px-1 rounded">admin</code></li>
                </ul>
            </div>
        </section>

        <section class="mb-12">
            <h3 class="text-xl font-bold mb-6 flex items-center">
                <span class="bg-amber-500 w-2 h-6 rounded mr-3"></span> Divisions
            </h3>
            <div class="space-y-4">
                @component('components.api-item', [
                    'method' => 'GET',
                    'url' => '/divisions',
                    'desc' => 'Mengambil daftar seluruh divisi.',
                    'auth' => true,
                ])
                @endcomponent
            </div>
        </section>

        <section class="mb-12">
            <h3 class="text-xl font-bold mb-6 flex items-center">
                <span class="bg-green-500 w-2 h-6 rounded mr-3"></span> Employees (CRUD)
            </h3>
            <div class="space-y-4">
                @component('components.api-item', [
                    'method' => 'GET',
                    'url' => '/employees',
                    'desc' => 'List data karyawan (mendukung filter search, division_id, dan pagination).',
                    'auth' => true,
                ])
                @endcomponent
                @component('components.api-item', [
                    'method' => 'POST',
                    'url' => '/employees',
                    'desc' => 'Menambah karyawan baru (mendukung upload gambar).',
                    'auth' => true,
                ])
                @endcomponent
                @component('components.api-item', [
                    'method' => 'PUT',
                    'url' => '/employees/{id}',
                    'desc' => 'Mengupdate data karyawan. Gunakan _method: PUT jika via FormData.',
                    'auth' => true,
                ])
                @endcomponent
                @component('components.api-item', [
                    'method' => 'DELETE',
                    'url' => '/employees/{id}',
                    'desc' => 'Menghapus data karyawan.',
                    'auth' => true,
                ])
                @endcomponent
            </div>
        </section>

        <section class="mb-12">
            <h3 class="text-xl font-bold mb-6 flex items-center">
                <span class="bg-rose-500 w-2 h-6 rounded mr-3"></span> Bonus Endpoints
            </h3>
            <div class="space-y-4">
                @component('components.api-item', [
                    'method' => 'GET',
                    'url' => '/nilaiRT',
                    'desc' => 'Endpoint khusus untuk Nilai RT.',
                    'auth' => true,
                ])
                @endcomponent
                @component('components.api-item', [
                    'method' => 'GET',
                    'url' => '/nilaiST',
                    'desc' => 'Endpoint khusus untuk Nilai ST.',
                    'auth' => true,
                ])
                @endcomponent
            </div>
        </section>

    </main>

    <footer class="bg-white border-t border-slate-200 py-8 text-center text-slate-500 text-sm">
        &copy; 2026 Aksamedia Fullstack Developer Test. All Rights Reserved.
    </footer>

</body>

</html>
