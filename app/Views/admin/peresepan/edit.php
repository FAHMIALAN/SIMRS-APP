<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="card p-8">
    <div class="mb-8 border-b border-slate-100 pb-6">
        <h2 class="text-2xl font-bold text-slate-800">Edit Peresepan</h2>
        <p class="text-slate-500 mt-1">Perbarui data resep nomor #PRS-<?= str_pad($peresepan['id'], 5, '0', STR_PAD_LEFT) ?></p>
    </div>
    
    <form action="<?= base_url('admin/peresepan/update/'.$peresepan['id']) ?>" method="POST" id="form-peresepan" class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                <label class="block text-sm font-bold text-slate-700 mb-2">Pasien</label>
                <div class="relative group">
                    <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <select name="pasien_id" class="input-field pl-11 bg-slate-50 appearance-none" required>
                        <?php foreach($pasien as $p): ?>
                            <option value="<?= $p['id_pasien'] ?>" <?= $peresepan['pasien_id'] == $p['id_pasien'] ? 'selected' : '' ?>>
                                <?= $p['nama'] ?> (<?= $p['nomor_rm'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="md:col-span-1">
                <label class="block text-sm font-bold text-slate-700 mb-2">Dokter Pemeriksa</label>
                <div class="relative group">
                    <i class="fas fa-user-md absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <select name="dokter_id" class="input-field pl-11 bg-slate-50 appearance-none" required>
                        <?php foreach($dokter as $d): ?>
                            <option value="<?= $d['id'] ?>" <?= $peresepan['dokter_id'] == $d['id'] ? 'selected' : '' ?>>
                                <?= $d['nama'] ?> (<?= $d['spesialis'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="md:col-span-1">
                <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal</label>
                <div class="relative group">
                    <i class="fas fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="date" name="tanggal" class="input-field pl-11" value="<?= $peresepan['tanggal'] ?>" required>
                </div>
            </div>
        </div>

        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
            <h4 class="text-sm font-bold text-slate-800 mb-4 uppercase tracking-wider flex items-center gap-2">
                <i class="fas fa-pills text-blue-500"></i> Daftar Obat & Dosis
            </h4>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-xs font-bold text-slate-400 uppercase tracking-widest border-b border-slate-200">
                            <th class="py-3 px-4">Pilih Obat</th>
                            <th class="py-3 px-4 w-40 text-right">Harga</th>
                            <th class="py-3 px-4 w-32 text-center">Jumlah</th>
                            <th class="py-3 px-4 w-48 text-right">Subtotal</th>
                            <th class="py-3 px-4 w-20 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="obat-container" class="divide-y divide-slate-100">
                        <?php foreach($details as $detail): ?>
                        <tr class="obat-row">
                            <td class="py-4 px-4">
                                <select name="obat_id[]" class="input-field obat-select bg-white py-2" required>
                                    <option value="" data-harga="0" data-stok="0">-- Pilih Obat --</option>
                                    <?php foreach($obat as $o): ?>
                                        <option value="<?= $o['id'] ?>" 
                                            data-harga="<?= $o['harga'] ?>" 
                                            data-stok="<?= $o['stok'] ?>"
                                            <?= $detail['obat_id'] == $o['id'] ? 'selected' : '' ?>>
                                            <?= $o['nama_obat'] ?> (<?= $o['jenis'] ?>) - Stok: <?= $o['stok'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="py-4 px-4 text-right">
                                <span class="harga-text text-sm font-semibold text-slate-600 italic">Rp <?= number_format($detail['harga_satuan'], 0, ',', '.') ?></span>
                            </td>
                            <td class="py-4 px-4">
                                <input type="number" name="jumlah[]" class="input-field jumlah-input bg-white py-2 text-center" value="<?= $detail['jumlah'] ?>" min="0.01" step="any" required>
                            </td>
                            <td class="py-4 px-4 text-right">
                                <span class="subtotal-text text-sm font-bold text-slate-800">Rp <?= number_format($detail['subtotal'], 0, ',', '.') ?></span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <button type="button" class="w-9 h-9 flex items-center justify-center bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all btn-hapus">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center gap-6 pt-6 border-t border-slate-200">
                <button type="button" id="btn-tambah-obat" class="px-5 py-2 bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white rounded-xl transition-all text-xs font-bold flex items-center gap-2">
                    <i class="fas fa-plus-circle"></i> Tambah Obat Lain
                </button>
                <div class="flex flex-col items-end">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Estimasi Tagihan</span>
                    <span id="total-semua" class="text-3xl font-black text-blue-600 tracking-tight">Rp <?= number_format($peresepan['total_harga'], 0, ',', '.') ?></span>
                </div>
            </div>
        </div>
        
        <div class="pt-8 flex items-center justify-end gap-4">
            <a href="<?= base_url('admin/peresepan') ?>" class="px-8 py-3 text-slate-500 font-bold hover:bg-slate-100 rounded-2xl transition-all">
                Batal
            </a>
            <button type="submit" class="px-10 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-200 transition-all active:scale-[0.98]">
                <i class="fas fa-save mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Template Row for Cloning -->
<table class="hidden">
    <tbody id="row-template">
        <tr class="obat-row">
            <td class="py-4 px-4">
                <select name="obat_id[]" class="input-field obat-select bg-white py-2" required>
                    <option value="" data-harga="0" data-stok="0">-- Pilih Obat --</option>
                    <?php foreach($obat as $o): ?>
                        <option value="<?= $o['id'] ?>" data-harga="<?= $o['harga'] ?>" data-stok="<?= $o['stok'] ?>">
                            <?= $o['nama_obat'] ?> (<?= $o['jenis'] ?>) - Stok: <?= $o['stok'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td class="py-4 px-4 text-right">
                <span class="harga-text text-sm font-semibold text-slate-600 italic">Rp 0</span>
            </td>
            <td class="py-4 px-4">
                <input type="number" name="jumlah[]" class="input-field jumlah-input bg-white py-2 text-center" value="1" min="0.01" step="any" required>
            </td>
            <td class="py-4 px-4 text-right">
                <span class="subtotal-text text-sm font-bold text-slate-800">Rp 0</span>
            </td>
            <td class="py-4 px-4 text-center">
                <button type="button" class="w-9 h-9 flex items-center justify-center bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all btn-hapus">
                    <i class="fas fa-trash-alt text-sm"></i>
                </button>
            </td>
        </tr>
    </tbody>
</table>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('obat-container');
    const btnTambah = document.getElementById('btn-tambah-obat');
    const totalSemuaSpan = document.getElementById('total-semua');
    const rowTemplate = document.getElementById('row-template').querySelector('tr');
    
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    }
    
    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.obat-row').forEach(row => {
            const select = row.querySelector('.obat-select');
            const jumlah = row.querySelector('.jumlah-input').value;
            const option = select.options[select.selectedIndex];
            
            if (option.value) {
                const harga = option.getAttribute('data-harga');
                const subtotal = harga * jumlah;
                total += subtotal;
                
                row.querySelector('.harga-text').textContent = formatRupiah(harga);
                row.querySelector('.subtotal-text').textContent = formatRupiah(subtotal);
            } else {
                row.querySelector('.harga-text').textContent = 'Rp 0';
                row.querySelector('.subtotal-text').textContent = 'Rp 0';
            }
        });
        totalSemuaSpan.textContent = formatRupiah(total);
    }
    
    function attachEvents(row) {
        const select = row.querySelector('.obat-select');
        const jumlah = row.querySelector('.jumlah-input');
        const btnHapus = row.querySelector('.btn-hapus');
        
        select.addEventListener('change', hitungTotal);
        jumlah.addEventListener('input', hitungTotal);
        
        if(btnHapus) {
            btnHapus.addEventListener('click', function() {
                if(document.querySelectorAll('.obat-row').length > 1) {
                    row.remove();
                    hitungTotal();
                    updateHapusButtons();
                }
            });
        }
    }
    
    function updateHapusButtons() {
        const rows = document.querySelectorAll('.obat-row');
        const btns = document.querySelectorAll('.btn-hapus');
        if(rows.length === 1) {
            btns[0].disabled = true;
            btns[0].classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            btns.forEach(btn => {
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
            });
        }
    }
    
    btnTambah.addEventListener('click', function() {
        const row = rowTemplate.cloneNode(true);
        container.appendChild(row);
        attachEvents(row);
        updateHapusButtons();
    });
    
    // Inisialisasi baris yang sudah ada
    document.querySelectorAll('.obat-row').forEach(attachEvents);
    updateHapusButtons();
});
</script>

<?= $this->endSection() ?>
