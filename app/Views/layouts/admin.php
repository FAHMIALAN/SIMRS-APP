<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Dashboard') ?> - SIMRS</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS v3 -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#0f172a',
                        secondary: '#3b82f6',
                        accent: '#10b981',
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            body { @apply bg-slate-50 text-slate-900; }
        }
        @layer components {
            .sidebar-link {
                @apply flex items-center px-4 py-3 text-slate-400 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-200 font-medium;
            }
            .sidebar-link.active {
                @apply text-white bg-white/10;
            }
            .btn {
                @apply inline-flex items-center justify-center px-4 py-2 rounded-lg font-medium transition-all duration-200 gap-2;
            }
            .btn-primary { @apply bg-blue-600 text-white hover:bg-blue-700; }
            .btn-success { @apply bg-emerald-600 text-white hover:bg-emerald-700; }
            .btn-danger { @apply bg-rose-600 text-white hover:bg-rose-700; }
            .btn-warning { @apply bg-amber-500 text-white hover:bg-amber-600; }
            .card { @apply bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden; }
            .input-field { @apply w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all; }
        }
    </style>
</head>
<body class="font-sans antialiased">

    <!-- Mobile Navigation Toggle -->
    <div class="lg:hidden fixed top-4 left-4 z-[100]">
        <button id="sidebarToggle" class="p-2 bg-primary text-white rounded-lg shadow-lg">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-primary text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 flex flex-col">
        <div class="h-20 flex items-center px-6 border-b border-white/10">
            <span class="text-xl font-bold tracking-wider text-white">SIMRS<span class="text-blue-500">Pro</span></span>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-link <?= url_is('admin/dashboard') ? 'active' : '' ?>">
                <i class="fas fa-home w-6"></i> Dashboard
            </a>
            <a href="<?= base_url('pasien') ?>" class="sidebar-link <?= url_is('pasien*') ? 'active' : '' ?>">
                <i class="fas fa-users w-6"></i> Pasien
            </a>
            <a href="<?= base_url('admin/dokter') ?>" class="sidebar-link <?= url_is('admin/dokter*') ? 'active' : '' ?>">
                <i class="fas fa-user-md w-6"></i> Dokter
            </a>
            <a href="<?= base_url('admin/obat') ?>" class="sidebar-link <?= url_is('admin/obat*') ? 'active' : '' ?>">
                <i class="fas fa-pills w-6"></i> Obat
            </a>
            <a href="<?= base_url('admin/peresepan') ?>" class="sidebar-link <?= (url_is('admin/peresepan*') && !url_is('admin/peresepan/report*')) ? 'active' : '' ?>">
                <i class="fas fa-file-prescription w-6"></i> Peresepan
            </a>
            <a href="<?= base_url('admin/peresepan/report') ?>" class="sidebar-link <?= url_is('admin/peresepan/report*') ? 'active' : '' ?>">
                <i class="fas fa-chart-bar w-6"></i> Laporan
            </a>
            <a href="<?= base_url('admin/user') ?>" class="sidebar-link <?= url_is('admin/user*') ? 'active' : '' ?>">
                <i class="fas fa-user-cog w-6"></i> Manajemen User
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <a href="<?= base_url('logout') ?>" class="flex items-center px-4 py-3 text-rose-400 hover:bg-rose-500/10 rounded-lg transition-all">
                <i class="fas fa-sign-out-alt w-6"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="lg:ml-64 flex flex-col min-h-screen">
        <!-- Top Header -->
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-40">
            <h1 class="text-lg font-semibold text-slate-800 lg:ml-0 ml-12">
                <?= esc($title ?? 'Dashboard') ?>
            </h1>
            
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex flex-col items-end">
                    <span class="text-sm font-semibold text-slate-800"><?= session()->get('username') ?></span>
                    <span class="text-xs text-slate-500 capitalize"><?= session()->get('role') ?></span>
                </div>
                <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-500">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="p-8 flex-1">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-6 flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                    <span class="font-medium"><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-6 flex items-center gap-3 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl">
                    <i class="fas fa-exclamation-circle text-rose-500"></i>
                    <span class="font-medium"><?= session()->getFlashdata('error') ?></span>
                </div>
            <?php endif; ?>

            <div class="animate-in fade-in slide-in-from-bottom-4 duration-500">
                <?= $this->renderSection('content') ?>
            </div>
        </main>

        <!-- Footer -->
        <footer class="p-8 border-t border-slate-200 text-center text-sm text-slate-500">
            &copy; <?= date('Y') ?> SIMRS Pro System. All rights reserved.
        </footer>
    </div>

    <!-- Sidebar Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebarToggle');
        
        toggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024 && !sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>
</html>
