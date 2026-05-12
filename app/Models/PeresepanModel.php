<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PeresepanModel
 * 
 * Manages core prescription data and joins with related entities.
 */
class PeresepanModel extends Model
{
    protected $table            = 'peresepan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pasien_id', 'dokter_id', 'user_id', 'tanggal', 'total_harga'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get detailed prescription data including Patient, Doctor, and Admin names
     * 
     * @param int|null $id Specific prescription ID
     * @return array|object
     */
    public function getPeresepanWithDetails($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('peresepan.*, pasien.nama as nama_pasien, pasien.nomor_rm, dokter.nama as nama_dokter, users.username as nama_admin');
        $builder->join('pasien', 'pasien.id_pasien = peresepan.pasien_id');
        $builder->join('dokter', 'dokter.id = peresepan.dokter_id');
        $builder->join('users', 'users.id = peresepan.user_id', 'left');
        
        if ($id) {
            $builder->where('peresepan.id', $id);
            return $builder->get()->getRowArray();
        }

        return $builder->get()->getResultArray();
    }
}
