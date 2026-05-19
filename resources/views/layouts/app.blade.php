<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>titipiin.id — Jastip Oleh-oleh Nusantara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { DEFAULT: '#1D9E75', dark: '#0F6E56', light: '#E1F5EE' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="/" class="flex flex-col leading-tight">
                <span class="text-lg font-semibold text-brand">🧳 titipiin.id</span>
                <span class="text-xs text-gray-400">jastip oleh-oleh nusantara</span>
            </a>
            <div class="flex items-center gap-3">
                <span class="text-xs bg-brand-light text-brand px-3 py-1 rounded-full font-medium">
                    📍 {{ $currentCity->name ?? '' }}
                </span>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <main class="max-w-4xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-100 mt-12 py-6 text-center text-xs text-gray-400">
        © 2026 titipiin.id · Jastip oleh-oleh asli nusantara
    </footer>

</body>
</html>