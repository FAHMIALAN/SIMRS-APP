<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PasienModel
 * 
 * Manages the data storage and retrieval for the 'pasien' table.
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

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Logic for auto-incrementing / validation could go here
}
