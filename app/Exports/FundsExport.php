<?php

namespace App\Exports;

use App\Models\UserInfo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FundsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $funds = null;
    public function __construct($funds)
    {
        $this->funds = $funds;
    }

    public function collection()
    {
        return collect($this->funds);
    }

    public function headings(): array
    {
        return [
            "ID",
            "Email",
            "Phone number",
            "Received from",
            "Company name",
            "Bank name",
            "Amount",
            "Deposited by",
            "Amount type",
            "Date",
            "Cheque pay order no",
            "Address",
        ];
    }
}
