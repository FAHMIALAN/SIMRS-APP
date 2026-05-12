<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PasienModel
 * 
 * Mengelola penyimpanan dan pengambilan data untuk tabel 'pasien'.
 */
class PasienModel extends Model
{
    protected $table            = 'pasien';
    protected $primaryKey       = 'id_pasien';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nomor_rm', 'nama', 'alamat', 'user_id'];

    // Tanggal
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Logika untuk auto-incrementing / validasi bisa ditambahkan di sini
}
