<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'User Dashboard') ?> - SIMRS</title>
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
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased">

    <!-- Top Nav -->
    <header class="h-20 bg-primary text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
            <div class="flex items-center gap-8">
                <span class="text-xl font-bold tracking-wider">SIMRS<span class="text-emerald-500">User</span></span>
                <nav class="hidden md:flex gap-6">
                    <a href="<?= base_url('user/dashboard') ?>" class="text-white font-medium hover:text-emerald-400 transition-colors">Beranda</a>
                </nav>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-semibold"><?= session()->get('username') ?></div>
                        <div class="text-xs text-slate-400">Pasien Terdaftar</div>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center border border-white/20">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                </div>
                <a href="<?= base_url('logout') ?>" class="px-4 py-2 bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white rounded-lg transition-all text-sm font-medium">
                    <i class="fas fa-sign-out-alt"></i> <span class="hidden sm:inline">Logout</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Content Area -->
    <main class="max-w-7xl mx-auto px-6 py-10 min-h-[calc(100vh-160px)]">
        <?php if(session()->getFlashdata('success')): ?>
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-3">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
            <div class="mb-8 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl flex items-center gap-3">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="animate-in fade-in slide-in-from-bottom-4 duration-500">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-10">
        <div class="max-w-7xl mx-auto px-6 text-center text-slate-500 text-sm">
            <p>&copy; <?= date('Y') ?> SIMRS Pro. Melayani dengan hati dan teknologi.</p>
        </div>
    </footer>

</body>
</html>
