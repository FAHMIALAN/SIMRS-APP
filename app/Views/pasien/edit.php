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