<nav class="fixed top-0 w-full z-50 glass-nav">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="flex items-center space-x-2 cursor-pointer" onclick="navigateTo('home')">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">R</div>
            <span class="text-xl font-extrabold tracking-tight">RainWorks<span class="text-indigo-600">.</span></span>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center space-x-8">
            <button onclick="navigateTo('home')" class="nav-link font-medium hover:text-indigo-600 transition">Beranda</button>
            <button onclick="navigateTo('services')" class="nav-link font-medium hover:text-indigo-600 transition">Layanan</button>
            <button onclick="navigateTo('portfolio')" class="nav-link font-medium hover:text-indigo-600 transition">Portofolio</button>
            <button onclick="navigateTo('pricing')" class="nav-link font-medium hover:text-indigo-600 transition">Harga</button>
            <button onclick="navigateTo('contact')" class="px-6 py-2.5 btn-primary text-white rounded-full font-semibold">Mulai Proyek</button>
        </div>

        <!-- Mobile Toggle -->
        <button class="md:hidden text-2xl" id="mobile-menu-btn">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>