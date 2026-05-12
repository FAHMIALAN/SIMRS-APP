<?php

namespace App\Models;

use CodeIgniter\Model;

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

    public function getPeresepanWithDetails($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('peresepan.*, pasien.nama as nama_pasien, dokter.nama as nama_dokter, users.username as nama_admin');
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
