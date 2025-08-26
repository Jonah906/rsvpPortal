<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;



class ExportTotalRsvp implements FromCollection, WithHeadings
{
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
        return ['SN', 'NAME', 'EMAIL', 'PHONE', 'REF TAG', 'CREATED AT', 'CONTACT EMAIL'];
    }
}
