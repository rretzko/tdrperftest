<?php

namespace Database\Seeders;

use App\Models\Filecontenttype;
use App\Models\Organization;
use App\Models\Person;
use App\Models\Subscriberemail;
use App\Models\User;
use Database\Factories\PersonFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //TYPES
         $this->call(CompositiontypeSeeder::class);
         $this->call(CompositioncollectiontypeSeeder::class);
         $this->call(DatetypeSeeder::class);
         $this->call(HonorificsSeeder::class);
         $this->call(EmailtypeSeeder::class);
         $this->call(EnsembletypeSeeder::class);
         $this->call(EventensemblestatustypeSeeder::class);
         $this->call(EventversiontypeSeeder::class);
         $this->call(FilecontenttypeSeeder::class);
         $this->call(GeostateSeeder::class);
         $this->call(GradetypeSeeder::class);
         $this->call(InstrumentationbranchSeeder::class);
         $this->call(EventensembletypeSeeder::class); //required instrumentationbranchSeeded to be loaded
         $this->call(InstrumentationSeeder::class);   //required instrumentationbranchSeeded to be loaded
         $this->call(MembershiptypeSeeder::class);
         $this->call(OrganizationtypeSeeder::class);
         $this->call(PaymenttypeSeeder::class);
         $this->call(PhonetypeSeeder::class);
         $this->call(PronounsSeeder::class);
         $this->call(RegistranttypeSeeder::class);
         $this->call(GuardiantypeSeeder::class); //requires PronounsSeeder to be loaded
         $this->call(RoletypeSeeder::class);
         $this->call(SearchtypeSeeder::class);
         $this->call(SignaturetypeSeeder::class);
         $this->call(StudenttypeSeeder::class);
         $this->call(ShirtsizeSeeder::class);
         $this->call(CountySeeder::class);

         //DATA TABLES
         $this->call(SchoolSeeder::class);
         //$this->call(UserSeeder::class);
         $this->call(UserTeacherSeeder::class);
         $this->call(UserStudent0Seeder::class);
         $this->call(UserStudent1aSeeder::class);
         $this->call(UserStudent1bSeeder::class);
         $this->call(UserStudent2cSeeder::class);
         $this->call(UserStudent2dSeeder::class);
         $this->call(UserStudent2eSeeder::class);
         $this->call(UserStudent2fSeeder::class);
         $this->call(UserGuardianASeeder::class);
         $this->call(UserGuardianBSeeder::class);
         $this->call(UserGuardianCSeeder::class);
         $this->call(UserGuardianDSeeder::class);
         $this->call(UserGuardianESeeder::class);
         $this->call(UserGuardianFSeeder::class);
         $this->call(UserGuardianGSeeder::class);
         $this->call(TeacherSeeder::class);
         $this->call(SubscriberEmailSeeder::class);
         $this->call(PhoneSeeder::class);
         $this->call(StudentSeeder::class);
         $this->call(NonsubscriberEmailSeeder::class);
         $this->call(InstrumentationUserSeeder::class);
         $this->call(AddressSeeder::class);
         $this->call(GuardianSeeder::class);
         $this->call(SchoolyearSeeder::class);
         $this->call(EnsembleSeeder::class);
         $this->call(EnsembletypeInstrumentationSeeder::class);
         $this->call(AssetSeeder::class);
         $this->call(EnsembleassetSeeder::class);
         $this->call(PublisherSeeder::class);
         $this->call(OrganizationSeeder::class);
         $this->call(EventSeeder::class);
         $this->call(EventensembleSeeder::class);
         $this->call(EventversionSeeder::class);
         $this->call(EventensembleEventversionSeeder::class);
         $this->call(EventensembletypeInstrumentationSeeder::class);
         $this->call(EventversionconfigSeeder::class);
         $this->call(EventversionFilecontenttypeSeeder::class);
         $this->call(MembershipSeeder::class);
         $this->call(MembershipAllShoreSeeder::class);
         $this->call(MembershipSJCDASeeder::class);
         $this->call(MembershipRoletypeSeeder::class);
         $this->call(EventversiondateSeeder::class);
         $this->call(RegistrantSeeder::class);
         $this->call(InstrumentationRegistrantSeeder::class);
         $this->call(FileuploadfolderSeeder::class);
         $this->call(PitchfilesSeeder::class);
         $this->call(AfdcSeeder::class);
         $this->call(ProhibitionSeeder::class);

    }
}
