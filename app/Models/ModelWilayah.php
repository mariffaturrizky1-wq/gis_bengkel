<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelWilayah extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_wilayah')
                ->get()->getResultArray();
    }

}