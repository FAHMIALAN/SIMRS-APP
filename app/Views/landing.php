<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMRS Pro - Digital Hospital Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Outfit', 'sans-serif'] },
                    colors: {
                        primary: '#0f172a',
                        accent: '#2563eb'
                    }
                }
            }
        }
    </script>
    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .hero-gradient {
            background: radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.05) 0%, rgba(255, 255, 255, 0) 50%);
        }
    </style>
</head>
<body class="bg-white text-primary font-sans antialiased overflow-x-hidden">
    
    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-accent text-white rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                    <i class="fas fa-hospital-user text-xl"></i>
                </div>
                <span class="text-2xl font-black tracking-tighter italic">SIMRS <span class="text-accent">PRO</span></span>
            </div>
            
            <div class="hidden md:flex items-center gap-10 text-sm font-bold text-slate-600">
                <a href="#fitur" class="hover:text-accent transition-colors">Fitur Utama</a>
                <a href="#tentang" class="hover:text-accent transition-colors">Tentang Kami</a>
                <a href="#layanan" class="hover:text-accent transition-colors">Layanan Digital</a>
            </div>

            <div class="flex items-center gap-4">
                <a href="<?= base_url('login') ?>" class="px-6 py-2.5 text-sm font-bold text-slate-700 hover:bg-slate-50 rounded-xl transition-all">Login</a>
                <a href="<?= base_url('register') ?>" class="px-7 py-2.5 bg-accent text-white text-sm font-bold rounded-xl shadow-xl shadow-blue-200 hover:scale-105 active:scale-95 transition-all">Daftar Pasien</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-40 pb-32 hero-gradient overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative z-10">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-accent text-xs font-bold rounded-full mb-8 uppercase tracking-widest">
                    <span class="w-2 h-2 bg-accent rounded-full animate-pulse"></span> Generasi Baru SIMRS
                </span>
                <h1 class="text-6xl lg:text-7xl font-black leading-[1.1] tracking-tighter mb-8">
                    Transformasi Digital <span class="text-accent">Layanan Kesehatan</span> Masa Depan.
                </h1>
                <p class="text-lg text-slate-500 font-medium leading-relaxed mb-10 max-w-xl">
                    Optimalkan operasional rumah sakit Anda dengan sistem manajemen terpadu. Mulai dari pendaftaran pasien hingga peresepan obat, semua dalam satu platform cerdas.
                </p>
                <div class="flex flex-wrap gap-5">
                    <a href="<?= base_url('register') ?>" class="px-10 py-4 bg-primary text-white font-bold rounded-2xl shadow-2xl shadow-slate-300 hover:-translate-y-1 transition-all">
                        Mulai Sekarang
                    </a>
                    <div class="flex items-center gap-4 px-6">
                        <div class="flex -space-x-3">
                            <img src="https://i.pravatar.cc/100?u=1" class="w-10 h-10 rounded-full border-2 border-white" alt="">
                            <img src="https://i.pravatar.cc/100?u=2" class="w-10 h-10 rounded-full border-2 border-white" alt="">
                            <img src="https://i.pravatar.cc/100?u=3" class="w-10 h-10 rounded-full border-2 border-white" alt="">
                        </div>
                        <span class="text-sm font-bold text-slate-400">1,200+ Pasien Terdaftar</span>
                    </div>
                </div>
            </div>
            
            <div class="relative">
                <!-- Decorative background decor only -->
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-400/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl"></div>
                
                <!-- Floating Badges or stylized graphics instead of the poster image -->
                <div class="relative z-10 flex flex-col gap-6">
                    <div class="bg-white p-8 rounded-[2rem] shadow-2xl border border-slate-50 flex items-center gap-6 transform hover:scale-105 transition-all">
                        <div class="w-14 h-14 bg-blue-50 text-accent rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Teknologi Terbaru</p>
                            <p class="text-lg font-black">Sistem Cloud Terintegrasi</p>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] shadow-2xl border border-slate-50 flex items-center gap-6 transform translate-x-12 hover:scale-105 transition-all">
                        <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Keamanan Data</p>
                            <p class="text-lg font-black">Enkripsi End-to-End</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-32 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 text-center mb-20">
            <h2 class="text-4xl font-black mb-4">Fitur Unggulan SIMRS Pro</h2>
            <p class="text-slate-500 font-medium">Solusi lengkap untuk manajemen rumah sakit modern.</p>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-all group">
                <div class="w-16 h-16 bg-blue-50 text-accent rounded-2xl flex items-center justify-center text-2xl mb-8 group-hover:bg-accent group-hover:text-white transition-all">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Manajemen Dokter</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Kelola jadwal dan data dokter spesialis dengan mudah dan terintegrasi.</p>
            </div>
            <!-- Feature 2 -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-all group">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl mb-8 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                    <i class="fas fa-pills"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">E-Prescription</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Sistem peresepan obat digital untuk akurasi dosis dan kecepatan layanan farmasi.</p>
            </div>
            <!-- Feature 3 -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/50 hover:-translate-y-2 transition-all group">
                <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-2xl mb-8 group-hover:bg-purple-600 group-hover:text-white transition-all">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="text-xl font-bold mb-4">Laporan Real-time</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Pantau statistik kunjungan dan pendapatan harian secara akurat dan transparan.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary py-20 text-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-white/10 pb-16">
            <div class="col-span-2">
                <div class="flex items-center gap-2 mb-8">
                    <div class="w-10 h-10 bg-accent text-white rounded-xl flex items-center justify-center">
                        <i class="fas fa-hospital-user text-xl"></i>
                    </div>
                    <span class="text-2xl font-black tracking-tighter italic">SIMRS <span class="text-accent">PRO</span></span>
                </div>
                <p class="text-slate-400 max-w-sm font-medium leading-relaxed">
                    Memberikan layanan teknologi terbaik untuk kemajuan sistem kesehatan di Indonesia. Terpercaya, Aman, dan Inovatif.
                </p>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase tracking-widest text-xs text-slate-500">Navigasi</h4>
                <ul class="space-y-4 text-sm font-medium text-slate-300">
                    <li><a href="#" class="hover:text-white">Dashboard</a></li>
                    <li><a href="#" class="hover:text-white">Daftar Pasien</a></li>
                    <li><a href="#" class="hover:text-white">Kontak Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase tracking-widest text-xs text-slate-500">Kontak</h4>
                <p class="text-sm font-medium text-slate-300 mb-2">info@simrspro.com</p>
                <p class="text-sm font-medium text-slate-300">+62 812-3456-7890</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 pt-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-slate-500 text-xs font-bold">&copy; <?= date('Y') ?> SIMRS Pro Team. All Rights Reserved.</p>
            <div class="flex gap-6 text-slate-500">
                <i class="fab fa-facebook hover:text-white transition-colors cursor-pointer"></i>
                <i class="fab fa-twitter hover:text-white transition-colors cursor-pointer"></i>
                <i class="fab fa-linkedin hover:text-white transition-colors cursor-pointer"></i>
            </div>
        </div>
    </footer>

</body>
</html>
