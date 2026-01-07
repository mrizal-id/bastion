<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RainWorks')</title>
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Social Meta -->
    <meta property="og:title" content="@yield('og_title', 'My Website')" />
    <meta property="og:description" content="@yield('og_description', 'Deskripsi website Anda di sini')" />
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body class="font-sans text-gray-800">
    <div class="sticky top-0 z-30 w-full bg-white">
        <div class="border-b border-b-gray-200 md:py-3">
            <div class="container px-0 md:px-8 relative flex items-center justify-between md:gap-x-4 text-gray-500 pl-2 pr-4 gap-x-2">
                <div class="flex items-center gap-x-6 md:hidden">
                    <a class="py-3 px-4" href="/">
                        a
                    </a>
                    <a class="group hidden items-center gap-x-1 transition-colors py-3 px-4" href="/user/cart">
                        <div class="relative"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 28.857" class="size-6">
                                <g fill="currentColor">
                                    <path d="M24.995 23.182 23.252 6.439a2.88 2.88 0 0 0-2.868-2.587H17.21a4.809 4.809 0 0 0-9.425 0H4.611a2.877 2.877 0 0 0-2.866 2.586l-1.75 16.744v.1a5.585 5.585 0 0 0 5.573 5.578h13.854A5.585 5.585 0 0 0 25 23.282a1 1 0 0 0-.005-.1m-12.5-21.254a2.89 2.89 0 0 1 2.721 1.923H9.777a2.89 2.89 0 0 1 2.718-1.923m6.924 25H5.573a3.655 3.655 0 0 1-3.654-3.603L3.657 6.641a.96.96 0 0 1 .954-.866h15.773a.96.96 0 0 1 .962.866l1.731 16.685a3.655 3.655 0 0 1-3.655 3.607Z"></path>
                                    <path d="M16.345 9.622a.96.96 0 0 0-.962.962 2.885 2.885 0 1 1-5.77 0 .962.962 0 0 0-1.923 0 4.809 4.809 0 1 0 9.617 0 .96.96 0 0 0-.962-.962"></path>
                                </g>
                            </svg></div><span class="text-sm">(<!-- -->0<!-- -->)</span>
                    </a><a class="hidden py-3 px-4 text-gray-400" href="/user/dashboard"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 51.721 51.721" class="size-6 mx-auto">
                            <path fill="currentColor" d="M40.946 0H10.775A10.78 10.78 0 0 0 0 10.775v30.17a10.78 10.78 0 0 0 10.775 10.776h30.17a10.78 10.78 0 0 0 10.776-10.775V10.775A10.78 10.78 0 0 0 40.946 0M10.775 4.31h30.17a6.484 6.484 0 0 1 6.465 6.465v6.487H4.31v-6.487a6.484 6.484 0 0 1 6.465-6.465M4.31 40.946V21.572h13.038v25.839h-6.573a6.484 6.484 0 0 1-6.465-6.465m36.635 6.465H21.658V21.572h25.753v19.374a6.484 6.484 0 0 1-6.465 6.465Z"></path>
                        </svg></a>
                    <div class="items-center gap-x-6 hidden"><a class="hover:text-black transition-colors" href="/themes">Themes</a><a class="hover:text-black transition-colors" href="/pricing">Pricing</a></div>
                </div>
                <div class="relative z-10 items-center gap-x-4 md:gap-x-6 flex lg:gap-x-10"><a class="hover:text-black transition-colors" href="/themes">Themes</a><a class="hover:text-black transition-colors" href="/pricing">Pricing</a></div>
                <div class="absolute inset-x-0 hidden items-center justify-center md:flex"><a href="/"><img alt="SatuLove" loading="lazy" width="150" height="10" decoding="async" data-nimg="1" style="color:transparent" srcset="/_next/image?url=%2Fcustomer-satulove%2F_next%2Fstatic%2Fmedia%2Flogo.8872fc31.png&amp;w=256&amp;q=75 1x, /_next/image?url=%2Fcustomer-satulove%2F_next%2Fstatic%2Fmedia%2Flogo.8872fc31.png&amp;w=384&amp;q=75 2x" src="/_next/image?url=%2Fcustomer-satulove%2F_next%2Fstatic%2Fmedia%2Flogo.8872fc31.png&amp;w=384&amp;q=75"></a></div>
                <div class="relative z-10 flex items-center gap-x-4 md:gap-x-10"><a class="transition-colors hover:text-black hidden md:block" href="/register">Get Started</a><a class="rounded-full bg-red-500 px-5 py-2 md:py-[6px] text-white transition-colors hover:bg-red-600 text-xs md:text-base flex-none" href="/login">Sign in</a></div>
            </div>
        </div>
        <div class="hidden border-b border-b-gray-200 md:block">
            <div class="container flex items-center justify-center gap-x-8 overflow-x-auto overflow-y-hidden py-2 text-sm scrollbar-none"><a class="text-gray-700 hover:text-black transition-colors flex-none" href="/themes?category=0194f58d-ad45-7d91-aca1-749734b13011">Weddings</a><a class="text-gray-700 hover:text-black transition-colors flex-none" href="/themes?category=0194f58d-ad45-7d91-aca1-74b44167f667">Birthday Party</a><a class="text-gray-700 hover:text-black transition-colors flex-none" href="/themes?category=0194f58d-ad45-7d91-aca1-74d1c5f24497">Baby Shower</a><a class="text-gray-700 hover:text-black transition-colors flex-none" href="/themes?category=0194f5fc-e8a5-7843-a782-1bfe3dab4bea">Business</a><a class="text-gray-700 hover:text-black transition-colors flex-none" href="/themes?category=0194f5fd-0bd8-7ee3-a835-dbd1aec469cf">Event</a></div>
        </div>
    </div>


    <main>
        @yield('content')
    </main>


    <div class="bg-gray-100">
        <div class="container w-full grid lg:grid-cols-2 justify-between lg:justify-center grid-cols-1 gap-6 py-10 px-4">
            <div class="grid place-items-center lg:place-items-start lg:block">
                <!-- logo -->

                <p class="text-sm text-gray-500/80 mb-2 text-center md:text-left">Invitation with thousand of<!-- -->
                    <a class="underline hover:text-gray-500 transition-colors" href="/themes">ready-to-use themes</a>.
                </p>

                <div class="flex items-center gap-x-2">
                    <a target="_blank" href="https://www.instagram.com//">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" class="size-7 text-gray-400">
                            <g fill="currentColor">
                                <path d="M36.287 16.337a10.4 10.4 0 0 0-.66-3.444 6.95 6.95 0 0 0-1.636-2.513 6.96 6.96 0 0 0-2.513-1.636 10.4 10.4 0 0 0-3.443-.658C26.522 8.016 26.039 8 22.186 8s-4.336.016-5.849.085a10.4 10.4 0 0 0-3.444.66 6.95 6.95 0 0 0-2.512 1.636 6.95 6.95 0 0 0-1.637 2.512 10.4 10.4 0 0 0-.658 3.444C8.016 17.85 8 18.333 8 22.186s.016 4.336.086 5.849a10.4 10.4 0 0 0 .659 3.444 6.95 6.95 0 0 0 1.636 2.513 6.95 6.95 0 0 0 2.513 1.636 10.4 10.4 0 0 0 3.444.66c1.513.069 2 .085 5.849.085s4.336-.016 5.849-.085a10.4 10.4 0 0 0 3.444-.66 7.25 7.25 0 0 0 4.149-4.149 10.4 10.4 0 0 0 .66-3.444c.069-1.513.085-2 .085-5.849s-.016-4.336-.085-5.849Zm-2.554 11.582a7.9 7.9 0 0 1-.488 2.634 4.7 4.7 0 0 1-2.692 2.692 7.9 7.9 0 0 1-2.634.488c-1.5.068-1.944.083-5.732.083s-4.237-.014-5.733-.083a7.9 7.9 0 0 1-2.634-.488 4.4 4.4 0 0 1-1.631-1.061 4.4 4.4 0 0 1-1.061-1.631 7.9 7.9 0 0 1-.488-2.634c-.068-1.5-.083-1.945-.083-5.732s.015-4.237.083-5.733a7.9 7.9 0 0 1 .487-2.634 4.4 4.4 0 0 1 1.061-1.632 4.4 4.4 0 0 1 1.631-1.061 7.9 7.9 0 0 1 2.634-.489c1.5-.068 1.944-.083 5.732-.083s4.237.015 5.733.083a7.9 7.9 0 0 1 2.634.488 4.4 4.4 0 0 1 1.631 1.061 4.4 4.4 0 0 1 1.062 1.633 7.8 7.8 0 0 1 .489 2.634c.068 1.5.083 1.944.083 5.732s-.014 4.237-.083 5.733Zm0 0"></path>
                                <path d="M22.186 14.901a7.285 7.285 0 1 0 7.285 7.285 7.285 7.285 0 0 0-7.285-7.285m0 12.014a4.729 4.729 0 1 1 4.729-4.729 4.73 4.73 0 0 1-4.729 4.729M31.461 14.614a1.7 1.7 0 1 1-1.7-1.7 1.7 1.7 0 0 1 1.7 1.7m0 0"></path>
                            </g>
                        </svg>
                    </a>
                    <a target="_blank" href="https://www.tiktok.com/@">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" class="size-7 text-gray-400">
                            <path fill="currentColor" d="M33.859 8H11.133A3.133 3.133 0 0 0 8 11.133v22.726a3.133 3.133 0 0 0 3.133 3.133h22.726a3.133 3.133 0 0 0 3.133-3.133V11.133A3.133 3.133 0 0 0 33.859 8m-2.42 12.63a8.4 8.4 0 0 1-4.925-1.584v7.193a6.546 6.546 0 1 1-5.637-6.451V23.4a3 3 0 0 0-.877-.136 2.974 2.974 0 0 0-1.38 5.608 2.968 2.968 0 0 0 4.349-2.521l.006-14.184h3.539a4.93 4.93 0 0 0 4.925 4.923Z"></path>
                        </svg></a>
                    <a target="_blank" href="https://www.youtube.com/@"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" class="size-7 text-gray-400">
                            <path fill="currentColor" d="M36.164 15.237a3.7 3.7 0 0 0-2.6-2.6c-2.312-.633-11.56-.633-11.56-.633s-9.248 0-11.56.609a3.78 3.78 0 0 0-2.6 2.628 39 39 0 0 0-.616 7.102 39 39 0 0 0 .608 7.106 3.7 3.7 0 0 0 2.6 2.6c2.336.633 11.56.633 11.56.633s9.248 0 11.56-.609a3.7 3.7 0 0 0 2.6-2.6 39 39 0 0 0 .608-7.106 37 37 0 0 0-.6-7.13M19.056 26.772v-8.858l7.69 4.429Zm0 0"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 text-gray-500/80 text-center lg:text-left">
                <div class="space-y-2 hidden">
                    <div class="font-semibold">Earn</div>
                    <div class="flex flex-col gap-y-2"><a class="text-sm hover:text-gray-500 transition-colors lg:w-max" target="_blank" href="/partner">Affiliate Partner</a><a class="text-sm hover:text-gray-500 transition-colors lg:w-max" target="_blank" href="/creator">Become Creator</a></div>
                </div>
                <div class="space-y-2">
                    <div class="font-semibold">Resources</div>
                    <div class="flex flex-col gap-y-2"><a class="text-sm hover:text-gray-500 transition-colors lg:w-max" target="_blank" href="https://blog.satu.love/tutorial/">User guidelines</a><a class="text-sm hover:text-gray-500 transition-colors lg:w-max hidden" target="_blank" href="/help-center">Help Center</a><a class="text-sm hover:text-gray-500 transition-colors lg:w-max hidden" target="_blank" href="/pricing">Licenses</a></div>
                </div>
                <div class="space-y-2">
                    <div class="font-semibold">About us</div>
                    <div class="flex flex-col gap-y-2"><a class="text-sm hover:text-gray-500 transition-colors lg:w-max" target="_blank" href="https://docs.satu.love/legal/tentang-kami">Who we are</a><a class="text-sm hover:text-gray-500 transition-colors lg:w-max" target="_blank" href="https://wa.me/+6282275060600">Customer Support</a><a class="text-sm hover:text-gray-500 transition-colors lg:w-max hidden" target="_blank" href="/careers">Careers</a></div>
                </div>
            </div>

        </div>
    </div>

    <div class="lg:border-t lg:border-t-gray-400 py-6 text-[13px] bg-gray-100">
        <div class="container flex items-center lg:justify-between justify-center gap-x-4 text-gray-500/80 px-4">
            <div class="items-center gap-x-12 lg:flex hidden"><button class="inline-flex items-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input hover:bg-accent hover:text-accent-foreground size-max justify-between bg-transparent border-none p-0" role="combobox" type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-:R2uflkq:" data-state="closed">English</button><button type="button" class="hidden">IDR</button></div>
            <div class="flex items-center gap-x-10 lg:flex-row flex-col gap-y-3"><a target="_blank" href="https://docs.satu.love/legal">Privacy Policy</a><a target="_blank" href="https://docs.satu.love/legal/syarat-dan-ketentuan">Terms and Conditions</a><span>© <!-- -->2026<!-- --> PT. SatuLove Kreasi Indonesia</span></div>
        </div>
    </div>

    <footer>
        <!-- Footer content here -->
    </footer>

    <!-- Optional JS -->
    <!-- <script src="{{ mix('js/app.js') }}"></script> -->
    <!-- Mobile Menu Toggle Script -->
    <script>
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>