# Tutorial CRUD SIMRS - CodeIgniter 4 (Monolith)

Berikut adalah tutorial lengkap pembangunan aplikasi pendaftaran pasien SIMRS menggunakan arsitektur **Monolith** (Backend dan Frontend menyatu) di CodeIgniter 4.

---

### 1. Struktur Folder Project Akhir

Nantinya, file-file yang akan kita modifikasi dan buat akan berada di struktur seperti ini:

```text
/simrs-app
├── app/
│   ├── Config/
│   │   └── Routes.php            # (Langkah 6) Mengatur URL
│   ├── Controllers/
│   │   └── PasienController.php  # (Langkah 4) Logika CRUD
│   ├── Database/
│   │   └── Migrations/           # (Langkah 2) Skema Tabel Database
│   ├── Models/
│   │   └── PasienModel.php       # (Langkah 3) Interaksi Database
│   └── Views/
│       └── pasien/               # (Langkah 5) File UI/HTML
│           ├── index.php
│           ├── create.php
│           └── edit.php
├── public/                       # Titik masuk aplikasi
└── .env                          # (Langkah 1) Konfigurasi Database
```

---

### Langkah 1: Instalasi & Konfigurasi Lingkungan

1. Buka terminal, masuk ke folder workspace kamu (misal `htdocs`), lalu jalankan:
   ```bash
   composer create-project codeigniter4/appstarter simrs-app
   ```

2. Masuk ke dalam folder project:
   ```bash
   cd simrs-app
   ```

3. Ubah nama file `env` menjadi `.env`.
4. Buka file `.env`. Ubah pengaturan environment dan database. Pastikan kamu sudah membuat database kosong bernama `db_simrs` di MySQL.

   ```env
   CI_ENVIRONMENT = development

   database.default.hostname = localhost
   database.default.database = db_simrs
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   ```

---

### Langkah 2: Membuat Tabel Database (Migration)

Menggunakan migration sangat disarankan saat tes koding karena menunjukkan kamu terbiasa dengan standar *development* modern.

1. Di terminal, jalankan:
   ```bash
   php spark make:migration Pasien
   ```

2. Buka file migration yang baru terbuat di `app/Database/Migrations/xxxx-xx-xx-xxxxxx_Pasien.php`. Isi kodenya:

   ```php
   <?php

   namespace App\Database\Migrations;
   use CodeIgniter\Database\Migration;

   class Pasien extends Migration
   {
       public function up()
       {
           $this->forge->addField([
               'id_pasien' => [
                   'type'           => 'INT',
                   'constraint'     => 11,
                   'unsigned'       => true,
                   'auto_increment' => true,
               ],
               'nomor_rm' => [
                   'type'       => 'VARCHAR',
                   'constraint' => '20',
                   'unique'     => true,
               ],
               'nama' => [
                   'type'       => 'VARCHAR',
                   'constraint' => '100',
               ],
               'alamat' => [
                   'type' => 'TEXT',
                   'null' => true,
               ],
               'created_at' => [
                   'type' => 'DATETIME',
                   'null' => true,
               ],
               'updated_at' => [
                   'type' => 'DATETIME',
                   'null' => true,
               ]
           ]);
           $this->forge->addKey('id_pasien', true);
           $this->forge->createTable('pasien');
       }

       public function down()
       {
           $this->forge->dropTable('pasien');
       }
   }
   ```

3. Eksekusi ke database:
   ```bash
   php spark migrate
   ```

---

### Langkah 3: Membuat Model

1. Jalankan perintah:
   ```bash
   php spark make:model PasienModel
   ```

2. Buka `app/Models/PasienModel.php` dan sesuaikan:

   ```php
   <?php

   namespace App\Models;
   use CodeIgniter\Model;

   class PasienModel extends Model
   {
       protected $table            = 'pasien';
       protected $primaryKey       = 'id_pasien';
       protected $useAutoIncrement = true;
       protected $allowedFields    = ['nomor_rm', 'nama', 'alamat'];
       protected $useTimestamps    = true; // Otomatis mengisi created_at & updated_at
   }
   ```

---

### Langkah 4: Membuat Controller (CRUD & Validasi)

Di sini kita tambahkan validasi agar aplikasi tidak *error* jika user memasukkan data kosong. Ini akan menjadi poin plus yang besar di mata *reviewer*!

1. Jalankan perintah:
   ```bash
   php spark make:controller PasienController
   ```

2. Buka `app/Controllers/PasienController.php` dan isi dengan:

   ```php
   <?php

   namespace App\Controllers;
   use App\Models\PasienModel;

   class PasienController extends BaseController
   {
       protected $pasienModel;

       public function __construct()
       {
           $this->pasienModel = new PasienModel();
       }

       public function index()
       {
           $data = [
               'title' => 'Manajemen Data Pasien',
               'pasien' => $this->pasienModel->orderBy('id_pasien', 'DESC')->findAll()
           ];
           return view('pasien/index', $data);
       }

       public function create()
       {
           // session() dikirim untuk menampilkan error validasi
           $data = [
               'title' => 'Tambah Pasien Baru',
               'validation' => \Config\Services::validation()
           ];
           return view('pasien/create', $data);
       }

       public function store()
       {
           // Validasi Input
           if (!$this->validate([
               'nomor_rm' => [
                   'rules' => 'required|is_unique[pasien.nomor_rm]',
                   'errors' => [
                       'required' => 'Nomor RM harus diisi.',
                       'is_unique' => 'Nomor RM sudah terdaftar.'
                   ]
               ],
               'nama' => [
                   'rules' => 'required',
                   'errors' => ['required' => 'Nama pasien harus diisi.']
               ]
           ])) {
               return redirect()->to('/pasien/create')->withInput();
           }

           // Simpan Data
           $this->pasienModel->save([
               'nomor_rm' => $this->request->getPost('nomor_rm'),
               'nama'     => $this->request->getPost('nama'),
               'alamat'   => $this->request->getPost('alamat')
           ]);

           return redirect()->to('/pasien')->with('pesan', 'Data pasien berhasil ditambahkan.');
       }

       public function edit($id)
       {
           $data = [
               'title' => 'Edit Data Pasien',
               'validation' => \Config\Services::validation(),
               'pasien' => $this->pasienModel->find($id)
           ];
           return view('pasien/edit', $data);
       }

       public function update($id)
       {
           // Validasi sederhana untuk update
           if (!$this->validate([
               'nama' => 'required'
           ])) {
               return redirect()->to('/pasien/edit/' . $id)->withInput();
           }

           $this->pasienModel->save([
               'id_pasien' => $id,
               'nomor_rm'  => $this->request->getPost('nomor_rm'),
               'nama'      => $this->request->getPost('nama'),
               'alamat'    => $this->request->getPost('alamat')
           ]);

           return redirect()->to('/pasien')->with('pesan', 'Data pasien berhasil diubah.');
       }

       public function delete($id)
       {
           $this->pasienModel->delete($id);
           return redirect()->to('/pasien')->with('pesan', 'Data pasien berhasil dihapus.');
       }
   }
   ```

---

### Langkah 5: Membuat Tampilan (Views)

Buat folder baru bernama `pasien` di dalam direktori `app/Views/`. Di dalamnya, buat 3 file HTML/PHP berikut. Kita gunakan CDN Bootstrap 5 agar UI langsung terlihat profesional.

#### 1. `app/Views/pasien/index.php`

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Daftar Pasien SIMRS</h4>
            <a href="/pasien/create" class="btn btn-light btn-sm fw-bold">+ Tambah Pasien</a>
        </div>
        <div class="card-body">
            <?php if(session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?= session()->getFlashdata('pesan'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">No. RM</th>
                            <th width="25%">Nama Pasien</th>
                            <th width="35%">Alamat</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($pasien as $p) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><span class="badge bg-secondary"><?= $p['nomor_rm']; ?></span></td>
                            <td><?= $p['nama']; ?></td>
                            <td><?= $p['alamat']; ?></td>
                            <td>
                                <a href="/pasien/edit/<?= $p['id_pasien']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="/pasien/delete/<?= $p['id_pasien']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pasien ini?');">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

#### 2. `app/Views/pasien/create.php`

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Pasien Baru</h5>
                </div>
                <div class="card-body">
                    <form action="/pasien/store" method="post">
                        <?= csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Nomor Rekam Medis (RM)</label>
                            <input type="text" name="nomor_rm" class="form-control <?= ($validation->hasError('nomor_rm')) ? 'is-invalid' : ''; ?>" value="<?= old('nomor_rm'); ?>" autofocus>
                            <div class="invalid-feedback"><?= $validation->getError('nomor_rm'); ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" value="<?= old('nama'); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3"><?= old('alamat'); ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/pasien" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
```

#### 3. `app/Views/pasien/edit.php`

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Edit Data Pasien</h5>
                </div>
                <div class="card-body">
                    <form action="/pasien/update/<?= $pasien['id_pasien']; ?>" method="post">
                        <?= csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Nomor Rekam Medis (RM)</label>
                            <input type="text" name="nomor_rm" class="form-control" value="<?= old('nomor_rm', $pasien['nomor_rm']); ?>" readonly>
                            <small class="text-muted">Nomor RM tidak dapat diubah.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" value="<?= old('nama', $pasien['nama']); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3"><?= old('alamat', $pasien['alamat']); ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/pasien" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
```

---

### Langkah 6: Konfigurasi Routing

Terakhir, kita atur jalurnya agar URL bisa diakses.
Buka `app/Config/Routes.php` dan pastikan kodenya seperti ini:

```php
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PasienController::index'); 
$routes->get('/pasien', 'PasienController::index');
$routes->get('/pasien/create', 'PasienController::create');
$routes->post('/pasien/store', 'PasienController::store');
$routes->get('/pasien/edit/(:num)', 'PasienController::edit/$1');
$routes->post('/pasien/update/(:num)', 'PasienController::update/$1');
$routes->get('/pasien/delete/(:num)', 'PasienController::delete/$1');
```

---

### Selesai! Jalankan Aplikasi

Buka terminal, pastikan kamu berada di folder `simrs-app`, lalu jalankan:

```bash
php spark serve
```

Buka browser kamu dan akses: **http://localhost:8080**

Aplikasi CRUD Pendaftaran Pasien SIMRS yang kokoh, dilengkapi validasi, dan desain rapi siap menemani tes koding kamu besok. Silakan langsung dicoba di-run malam ini ya, bro!
