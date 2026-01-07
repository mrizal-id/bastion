<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Production Ready</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="font-sans text-gray-800">

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-6">Selamat Datang di Produk Kami</h1>
            <p class="text-lg sm:text-xl md:text-2xl mb-8">Solusi modern untuk semua kebutuhan digital Anda</p>
            <a href="#features" class="inline-block bg-white text-blue-600 font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-12">Fitur Unggulan</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-12 lg:gap-18">
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-xl mb-3">Kecepatan Tinggi</h3>
                    <p class="text-gray-600">Sistem kami didesain untuk performa optimal tanpa lag.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-xl mb-3">Keamanan Terjamin</h3>
                    <p class="text-gray-600">Data Anda terlindungi dengan protokol keamanan modern.</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-xl mb-3">Mudah Digunakan</h3>
                    <p class="text-gray-600">Antarmuka intuitif yang bisa dipahami siapa saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-600 text-white text-center">
        <h2 class="text-2xl md:text-3xl font-bold mb-6">Siap Meningkatkan Produktivitas Anda?</h2>
        <p class="text-lg md:text-xl mb-8">Mulai gunakan produk kami sekarang dan rasakan perbedaannya.</p>
        <a href="#contact" class="inline-block bg-white text-blue-600 font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-gray-100 transition">
            Daftar Sekarang
        </a>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8">
        <div class="container mx-auto px-4 text-center">
            &copy; 2026 Produk Kami. All rights reserved.
        </div>
    </footer>

</body>

</html>