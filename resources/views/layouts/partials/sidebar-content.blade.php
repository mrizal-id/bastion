<div class="flex items-center flex-shrink-0 px-4">
    <span class="text-2xl font-bold text-white tracking-wider">BASTION</span>
</div>
<nav class="flex-1 px-2 mt-8 space-y-1 bg-indigo-700">
    <a href="/app" class="flex items-center px-2 py-2 text-sm font-medium text-white bg-indigo-800 rounded-md group">
        <svg class="w-6 h-6 mr-3 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Overview
    </a>

    @if(auth()->user()->hasRole('brand'))
    <div class="pt-4 pb-2 text-xs font-semibold text-indigo-200 uppercase px-2">Brand Space</div>
    <a href="/app/portfolio" class="flex items-center px-2 py-2 text-sm font-medium text-indigo-100 rounded-md hover:bg-indigo-600 group">
        <svg class="w-6 h-6 mr-3 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        My Portfolio
    </a>
    @endif

    <a href="/app/projects" class="flex items-center px-2 py-2 text-sm font-medium text-indigo-100 rounded-md hover:bg-indigo-600 group">
        <svg class="w-6 h-6 mr-3 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        Projects
    </a>

    <a href="/app/wallet" class="flex items-center px-2 py-2 text-sm font-medium text-indigo-100 rounded-md hover:bg-indigo-600 group">
        <svg class="w-6 h-6 mr-3 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Wallet
    </a>
</nav>