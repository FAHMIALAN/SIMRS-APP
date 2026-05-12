<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * PeresepanModel
 * 
 * Mengelola data inti peresepan dan melakukan join dengan entitas terkait.
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

    // Tanggal
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Mengambil data peresepan detail termasuk nama Pasien, Dokter, dan Admin
     * 
     * @param int|null $id ID peresepan spesifik
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
