<?php

namespace App\Models;

use CodeIgniter\Model;

class PeresepanDetailModel extends Model
{
    protected $table            = 'peresepan_detail';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['peresepan_id', 'obat_id', 'jumlah', 'subtotal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getDetailsByPeresepanId($peresepanId)
    {
        return $this->db->table($this->table)
            ->select('peresepan_detail.*, obat.nama_obat, obat.harga as harga_satuan')
            ->join('obat', 'obat.id = peresepan_detail.obat_id')
            ->where('peresepan_id', $peresepanId)
            ->get()->getResultArray();
    }
}
