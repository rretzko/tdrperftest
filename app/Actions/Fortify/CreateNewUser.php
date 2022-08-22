<?php

namespace App\Actions\Fortify;

use App\Models\Emailtype;
use App\Models\Geostate;
use App\Models\Person;
use App\Models\Role;
use App\Models\School;
use App\Models\Searchable;
use App\Models\Studio;
use App\Models\Subscriberemail;
use App\Models\Teacher;
use App\Models\Tenure;
use App\Models\User;
use App\Models\Username;
use App\Rules\FirstnameLastnameRule;
use App\Rules\UniqueSubscriberemail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     * input:
     * array:5 [▼
     * "_token" => "JpADnr8N71kf8tmtyZ3gzSx3fntz7HQagPpwGaCn"
     * "name" => "Rick Retzko"
     * "email" => "rick@mfrholdings.com"
     * "password" => "password"
     * "password_confirmation" => "password"
     * ]
     *
     * @param array $input
     * @return User
     */
    public function create(array $input)
    {
        /**
         * Customized Password Rules
         */
        $this->requireUppercase = true;

        $clean = Validator::make($input, [
            'name' => ['required', 'string', 'min:4','max:255',new FirstnameLastnameRule()],
            'email' => ['required', 'string', 'email', 'max:255', new UniqueSubscriberemail],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user = $this->createUser($input);

        $this->createPerson($input, $user);

        $this->createEmail($input, $user);

        $this->createSearchables($user);

        $this->createStudio($user);

        $this->createTeacher($user);

        $this->addRole($user, 'subscriber');

        return $user;
    }
/** END OF PUBLIC FUNCTIONS **************************************************/

    private function addRole(User $user, string $descr)
    {
        $role = new Role;
        $role->add($user->id, $descr);
    }

    private function createEmail(array $input, User $user)
    {
        $email = Subscriberemail::firstOrCreate(
            [
                'user_id' => $user->id,
                'email' => $input['email']
            ],
            [
                'emailtype_id' => Emailtype::where('descr', 'other')->first()->id,
            ],
        );
    }

    private function createPerson(array $input, User $user)
    {
        $parts = explode(' ', $input['name']);

        $first = $parts[0];
        $middle = (array_key_exists(2, $parts)) ? $parts[1] : '';
        $last = $parts[1]; //default expects $input['name'] = 'firstname lastname'
        //just in case a multipart lastname was input
        for ($i = 2; $i < count($parts); $i++) {
            $last .= $parts[$i];
        }

        Person::firstOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'first' => $first,
                'middle' => $middle,
                'last' => $last,
            ]
        );

    }

    private function createSearchables(User $user)
    {
        $this->createSearchableName($user);

        $this->createSearchableEmail($user);
    }

    private function createSearchableEmail(User $user)
    {
        $s = new Searchable;

        foreach($user->person->subscriberemails AS $email){

            $s->add($user, 'email_other', $email->email);
        }

    }

    private function createSearchableName(User $user)
    {
        $person = $user->person; //shorthand

        $s = new Searchable;

        $s->add($user, 'name', sprintf("%s%s%s", $person->first, $person->middle, $person->last));
    }

    /**
     * NOTE: Studio is a school
     * @param User $user
     */
    private function createStudio(User $user)
    {
        $school = School::create(
            [
                'name' => 'Studio '.$user->person->last,
                'geostate_id' => Geostate::where('abbr', 'NJ')->first()->id,
            ]
        );

        $school->refresh();

        $user->schools()->attach($school);

        Tenure::create(
            [
                'user_id' => $user->id,
                'school_id' => $school->id,
                'startyear' > date('Y'),
            ]
        );
    }

    private function createTeacher(User $user)
    {
        Teacher::create(['user_id' => $user->id]);
    }

    private function createUser(array $input): User
    {
        $username = new Username(['fullname' => $input['name']]);

        return  User::create([
            'username' => $username->newUsername(),
            'password' => Hash::make($input['password']),
        ]);
    }
}
