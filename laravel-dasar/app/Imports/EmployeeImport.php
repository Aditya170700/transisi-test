<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;

class EmployeeImport implements ToModel, WithBatchInserts, WithChunkReading
{
    use RemembersRowNumber;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        $currentRowNumber = $this->getRowNumber();

        return new Employee([
            'nama' => $row[0],
            'email' => $row[1],
            'company_id' => $row[2]
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
