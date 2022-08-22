<?php

namespace App\Exports;

use App\Models\Ensemble;
use App\Models\Ensemblemember;
use App\Models\Instrumentation;
use App\Models\Schoolyear;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MembersExport implements FromCollection, WithHeadings, WithMapping
{
    private $members;

    public function __construct($members)
    {
        $this->members = $members;
    }

    /**
    * @return Collection
    */
    public function collection()
    {
        return $this->members;
    }

    public function headings(): array
    {
        return [
            'First',
            'Middle',
            'Last',
            'Ensemble',
            'Voice Part',
            'School year'
        ];
    }

    public function map($ensemblemember): array
    {
        $e = Ensemblemember::find($ensemblemember['id']);

        $a = [
            $e->person->first,
            $e->person->middle,
            $e->person->last,
            Ensemble::find($e->ensemble_id)->name,
            Instrumentation::find($e->instrumentation_id)->formattedDescr(),
            Schoolyear::find($e->schoolyear_id)->descr,
        ];

        return $a;
    }
}
