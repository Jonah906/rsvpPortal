<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ExportBooking implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected Collection $data;

    public function __construct($data)
    {
        // Ensure it's wrapped as a Collection
        $this->data = collect($data);
    }
    public function collection()
    {
        return $this->data; // Now safe!

    }

    public function headings(): array
    {
        return [
          'SN','NAME','EMAIL','PHONE','HOTEL NAME','ROOM TYPE','NO OF ROOM', 
          'CHECK IN DATE','CHECK OUT DATE','ARRIVAL FROM','ARRIVAL AIRLINE', 
          'ARRIVAL DATE','ARRIVAL TIME','DEPARTURE FROM','DEPARTURE AIRLINE',
          'DEPARTURE DATE','DEPARTURE TIME'
        ];
    }
}
