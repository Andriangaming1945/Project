<?php

namespace App\Imports;

use App\Models\NamaModel;
use Maatwebsite\Excel\Concerns\ToModel;

class NamaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new NamaModel([
            //
        ]);
    }
}
