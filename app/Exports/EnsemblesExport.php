<?php

namespace App\Exports;

use App\Models\Ensemble;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EnsemblesExport implements FromCollection, WithHeadings, WithMapping
{
    private $ensembles;

    public function __construct($ensembles) {
        $this->ensembles = $ensembles;
    }

    /**
    * @return Collection
    */
    public function collection()
    {
        return $this->ensembles;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Type',
            'Since',
            'Members',
        ];
    }

    public function map($ensemble): array
    {
        $e = Ensemble::find($ensemble['id']);

        $a = [
            $e->name,
            $e->ensembletype->descr,
            $e->startyear,
            $e->members()->count(),
        ];

        return $a;
    }

}
