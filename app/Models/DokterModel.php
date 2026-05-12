<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * DokterModel
 * 
 * Mengelola data master dokter rumah sakit.
 */
class DokterModel extends Model
{
    protected $table            = 'dokter';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'spesialis', 'no_telp'];

    // Tanggal
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
