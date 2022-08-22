<?php

namespace App\Exports;

use App\Models\School;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SchoolsExport implements FromView
{
    protected $schools;

    public function __construct(Collection $schools =  null)
    {
        $this->schools = $schools ?: School::all();
    }

    public function view(): View
    {
        return view('exports.schools',[
            'schools' => $this->schools,
        ]);
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'address1',
            'address2',
            'city',
            'state',
            'zip code',
            'created_at',
            'updated_at',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->schools;
    }

    public function prepareRows($rows): array
    {
        return array_map(function($school){

            $school->state .= ' (prepared)';

            return $school;
        }, $rows);
    }
}
