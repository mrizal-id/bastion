@extends('layouts.guest')

@section('content')

<!-- Hero -->
<section class="page-transition">
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-6 py-24 text-center">
        <span class="px-4 py-2 bg-indigo-50 text-indigo-600 rounded-full text-sm font-bold uppercase tracking-widest mb-6 inline-block">Satu Atap untuk Kreativitas</span>
        <h1 class="text-5xl md:text-7xl font-extrabold mb-8 leading-tight">Ubah Ide Anda Menjadi <br><span class="gradient-text">Karya Digital</span> yang Nyata</h1>
        <p class="text-slate-600 text-xl max-w-2xl mx-auto mb-10 leading-relaxed">Kami membantu startup dan perusahaan besar membangun produk digital yang user-centric dengan kecepatan eksekusi tinggi.</p>
        <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
            <button onclick="navigateTo('portfolio')" class="btn-primary text-white px-8 py-4 rounded-full font-bold text-lg">Lihat Pekerjaan Kami</button>
            <button onclick="navigateTo('services')" class="bg-white text-slate-900 border border-slate-200 px-8 py-4 rounded-full font-bold text-lg hover:bg-slate-50 transition">Layanan Kami</button>
        </div>
    </div>

    <!-- Client Logos -->
    <div class="max-w-7xl mx-auto px-6 pb-24 border-b border-slate-200">
        <p class="text-center text-slate-400 font-medium mb-10">DIPERCAYA OLEH TIM DIBALIK BRAND TERKEMUKA</p>
        <div class="flex flex-wrap justify-center gap-12 opacity-50 grayscale">
            <i class="fab fa-apple text-4xl"></i>
            <i class="fab fa-google text-4xl"></i>
            <i class="fab fa-amazon text-4xl"></i>
            <i class="fab fa-microsoft text-4xl"></i>
            <i class="fab fa-spotify text-4xl"></i>
        </div>
    </div>
</section>
<section class="page-transition py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Layanan Spesialis Kami</h2>
            <p class="text-slate-600 max-w-xl mx-auto">Kami tidak hanya membangun website, kami membangun identitas bisnis Anda di dunia digital.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 card-hover">
                <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 text-2xl">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">UI/UX Design</h3>
                <p class="text-slate-500">Desain antarmuka yang intuitif dan fokus pada pengalaman pengguna untuk konversi maksimal.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 card-hover">
                <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 mb-6 text-2xl">
                    <i class="fas fa-code"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Web Development</h3>
                <p class="text-slate-500">Pengembangan web modern menggunakan stack terbaru (React, Vue, Tailwind) yang responsif dan cepat.</p>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 card-hover">
                <div class="w-14 h-14 bg-pink-50 rounded-2xl flex items-center justify-center text-pink-600 mb-6 text-2xl">
                    <i class="fas fa-rocket"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Growth Marketing</h3>
                <p class="text-slate-500">Meningkatkan visibilitas brand Anda melalui strategi konten dan SEO yang terukur.</p>
            </div>
        </div>
    </div>
</section>

<section class="page-transition py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16">
            <div>
                <h2 class="text-4xl font-bold mb-4">Karya Pilihan Kami</h2>
                <p class="text-slate-600">Beberapa proyek terbaik yang telah kami selesaikan dengan penuh dedikasi.</p>
            </div>
            <div class="hidden md:flex space-x-4">
                <button class="px-6 py-2 rounded-full bg-slate-900 text-white font-medium">Semua</button>
                <button class="px-6 py-2 rounded-full bg-white text-slate-600 font-medium hover:bg-slate-100 transition">Web</button>
                <button class="px-6 py-2 rounded-full bg-white text-slate-600 font-medium hover:bg-slate-100 transition">Design</button>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="group cursor-pointer">
                <div class="overflow-hidden rounded-3xl mb-6 aspect-video bg-slate-200">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="SaaS Dashboard">
                </div>
                <h3 class="text-2xl font-bold mb-2">Fintech Dashboard</h3>
                <p class="text-slate-500">UI/UX Design • Web Application</p>
            </div>
            <div class="group cursor-pointer">
                <div class="overflow-hidden rounded-3xl mb-6 aspect-video bg-slate-200">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="E-Learning Platform">
                </div>
                <h3 class="text-2xl font-bold mb-2">Edutech Platform</h3>
                <p class="text-slate-500">Branding • Development</p>
            </div>
        </div>
    </div>
</section>

<section class="page-transition py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Rencana Harga Transparan</h2>
            <p class="text-slate-600">Pilih paket yang paling sesuai dengan skala kebutuhan bisnis Anda.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Starter -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 flex flex-col">
                <span class="font-bold text-slate-400 mb-4 uppercase text-sm">Starter</span>
                <div class="mb-8">
                    <span class="text-4xl font-extrabold">$2,499</span>
                    <span class="text-slate-500">/proyek</span>
                </div>
                <ul class="space-y-4 mb-10 flex-grow">
                    <li class="flex items-center space-x-3 text-slate-600">
                        <i class="fas fa-check-circle text-indigo-500"></i>
                        <span>5 Halaman Kustom</span>
                    </li>
                    <li class="flex items-center space-x-3 text-slate-600">
                        <i class="fas fa-check-circle text-indigo-500"></i>
                        <span>Responsive Design</span>
                    </li>
                    <li class="flex items-center space-x-3 text-slate-600">
                        <i class="fas fa-check-circle text-indigo-500"></i>
                        <span>SEO Dasar</span>
                    </li>
                </ul>
                <button class="w-full py-4 rounded-xl border border-indigo-600 text-indigo-600 font-bold hover:bg-indigo-50 transition">Mulai Paket Starter</button>
            </div>
            <!-- Business -->
            <div class="bg-slate-900 p-8 rounded-3xl shadow-xl border border-slate-800 flex flex-col relative">
                <div class="absolute -top-4 right-8 bg-indigo-600 text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest">Terlaris</div>
                <span class="font-bold text-slate-500 mb-4 uppercase text-sm">Business</span>
                <div class="mb-8">
                    <span class="text-4xl font-extrabold text-white">$4,999</span>
                    <span class="text-slate-400">/proyek</span>
                </div>
                <ul class="space-y-4 mb-10 flex-grow">
                    <li class="flex items-center space-x-3 text-slate-300">
                        <i class="fas fa-check-circle text-indigo-400"></i>
                        <span>Halaman Tak Terbatas</span>
                    </li>
                    <li class="flex items-center space-x-3 text-slate-300">
                        <i class="fas fa-check-circle text-indigo-400"></i>
                        <span>Full CMS Integration</span>
                    </li>
                    <li class="flex items-center space-x-3 text-slate-300">
                        <i class="fas fa-check-circle text-indigo-400"></i>
                        <span>E-commerce Ready</span>
                    </li>
                    <li class="flex items-center space-x-3 text-slate-300">
                        <i class="fas fa-check-circle text-indigo-400"></i>
                        <span>Support 3 Bulan</span>
                    </li>
                </ul>
                <button class="w-full py-4 rounded-xl btn-primary text-white font-bold">Mulai Paket Business</button>
            </div>
            <!-- Agency -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 flex flex-col">
                <span class="font-bold text-slate-400 mb-4 uppercase text-sm">Agency</span>
                <div class="mb-8 text-slate-900">
                    <span class="text-3xl font-extrabold">Kustom</span>
                </div>
                <p class="text-slate-500 mb-8">Solusi lengkap untuk perusahaan besar dengan fitur kustom mendalam.</p>
                <button class="w-full py-4 rounded-xl border border-indigo-600 text-indigo-600 font-bold hover:bg-indigo-50 transition">Hubungi Sales</button>
            </div>
        </div>
    </div>
</section>

<section class="page-transition py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-white rounded-[3rem] shadow-xl overflow-hidden flex flex-col md:flex-row border border-slate-100">
            <div class="w-full md:w-1/2 p-12 lg:p-16">
                <h2 class="text-4xl font-bold mb-6">Ayo Bekerja Sama!</h2>
                <p class="text-slate-600 mb-10 text-lg">Bagikan ide proyek Anda, dan tim kami akan segera menghubungi Anda dalam waktu 24 jam.</p>

                <form onsubmit="event.preventDefault(); showSuccess();" id="contact-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                            <input type="text" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                            <input type="email" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 outline-none">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Layanan yang Dibutuhkan</label>
                        <select class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none">
                            <option>UI/UX Design</option>
                            <option>Web Development</option>
                            <option>Mobile App</option>
                            <option>Branding</option>
                        </select>
                    </div>
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Ceritakan Proyek Anda</label>
                        <textarea rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none"></textarea>
                    </div>
                    <button type="submit" class="btn-primary text-white px-10 py-4 rounded-xl font-bold text-lg w-full md:w-auto">Kirim Pesan</button>
                </form>
                <div id="success-message" class="hidden mt-6 p-4 bg-green-50 text-green-700 rounded-xl font-medium flex items-center">
                    <i class="fas fa-check-circle mr-3 text-xl"></i> Pesan terkirim! Kami akan menghubungi Anda segera.
                </div>
            </div>
            <div class="w-full md:w-1/2 bg-slate-900 p-12 lg:p-16 text-white flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-8 italic">"Nexus benar-benar mengubah cara kami melakukan bisnis online."</h3>
                    <div class="flex items-center space-x-4 mb-12">
                        <div class="w-12 h-12 bg-indigo-500 rounded-full"></div>
                        <div>
                            <p class="font-bold">Budi Santoso</p>
                            <p class="text-slate-400 text-sm">CEO of StartupX</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center text-indigo-400">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm uppercase font-bold tracking-widest">Email</p>
                            <p class="font-bold">hello@nexus-studio.id</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center text-indigo-400">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm uppercase font-bold tracking-widest">WhatsApp</p>
                            <p class="font-bold">+62 812-3456-7890</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection