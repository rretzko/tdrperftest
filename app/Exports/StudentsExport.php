<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    private $students;

    public function __construct($students) {
        $this->students = $students;
    }

   public function headings(): array
    {
        return [
            'Username',
            'First',
            'Middle',
            'Last',
            'Class',
            'Birthday',
            'Email-School',
            'Email-Personal',
            'Phone-Cell',
            'Phone-Home',
            'Instrumentation',
            'Guardian.1.first',
            'Guardian.1.middle',
            'Guardian.1.last',
            'Guardian.1.EmailPrimary',
            'Guardian.1.EmailAlternate',
            'Guardian.1.PhoneCell',
            'Guardian.1.PhoneWork',
            'Guardian.1.PhoneHome',
            'Guardian.2.first',
            'Guardian.2.middle',
            'Guardian.2.last',
            'Guardian.2.EmailPrimary',
            'Guardian.2.EmailAlternate',
            'Guardian.2.PhoneCell',
            'Guardian.2.PhoneWork',
            'Guardian.2.PhoneHome',
            'Guardian.3.first',
            'Guardian.3.middle',
            'Guardian.3.last',
            'Guardian.3.EmailPrimary',
            'Guardian.3.EmailAlternate',
            'Guardian.3.PhoneCell',
            'Guardian.3.PhoneWork',
            'Guardian.3.PhoneHome',

        ];
    }

    public function map($student): array
    {
        $s = Student::find($student['user_id']);

        $a = [
                $s->person->user->username,
                $s->person->first,
                $s->person->middle,
                $s->person->last,
                $s->classof,
                $s->birthday,
                $s->emailSchool->email,
                $s->emailPersonal->id ? $s->emailPersonal->email : '',
                $s->phoneMobile->id ? $s->phoneMobile->phone : '',
                $s->phoneHome->id ? $s->phoneHome->phone : '',
                $s->person->user->instrumentations->first()->formattedDescr(),
            ];

        foreach($s->guardians AS $guardian){
            $a[] = $guardian->person->first;
            $a[] = $guardian->person->middle;
            $a[] = $guardian->person->last;
            $a[] = $guardian->emailPrimary->id ? $guardian->emailPrimary->email : '';
            $a[] = $guardian->emailAlternate->id ? $guardian->emailAlternate->email : '';
            $a[] = $guardian->phoneMobile->id ? $guardian->phoneMobile->phone : '';
            $a[] = $guardian->phoneWork->id ? $guardian->phoneWork->phone : '';
            $a[] = $guardian->phoneHome->id ? $guardian->phoneHome->phone : '';
        }

        return $a;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->students;
    }
}
