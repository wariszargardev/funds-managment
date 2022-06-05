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
            "Phone number",
            "Received from",
            "Date",
            "Company name",
            "Email",
            "Payment in",
            "Amount",
            "Reference by",
            "Deposited by",
            "Bank name",
            "Cheque pay order no",
            "Amount type",
            "Street",
            "Province",
            "City",
            "Country",
            "Address",
        ];
    }
}
