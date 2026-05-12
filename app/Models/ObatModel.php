<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * ObatModel
 * 
 * Mengelola data inventaris obat medis.
 */
class ObatModel extends Model
{
    protected $table            = 'obat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_obat', 'jenis', 'stok', 'harga'];

    // Tanggal
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
