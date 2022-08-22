<?php

use App\Http\Controllers\Registrants\FileapprovalController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Redirect /login request */
Route::get('login', [App\Http\Controllers\Authtdrs\LoginController::class, 'show'])->name('login');

/* Custom login route */
Route::get('login/tdr', [App\Http\Controllers\Authtdrs\LoginController::class, 'show'])->name('login.tdr.show');
Route::post('login/tdr/update', [App\Http\Controllers\Authtdrs\LoginController::class, 'update'])->name('login.tdr.update');
//Route::get('logout/tdr', [App\Http\Controllers\Authtdrs\LoginController::class, 'destroy'])->name('login.tdr.destroy');

/* Custom password route */
Route::post('forgot-password/tdr', [App\Http\Controllers\Authtdrs\ForgotPasswordController::class, 'update'])
    ->middleware('guest')
    ->name('password.email-tdr');
Route::get('reset-password/tdr/{user}', [App\Http\Controllers\Authtdrs\ResetPasswordController::class, 'show'])
    ->name('resetpassword.tdr');
Route::post('reset-password/tdr/update', [App\Http\Controllers\Authtdrs\ResetPasswordController::class, 'update'])
    ->name('resetpassword.tdr.update');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/** SPROUT VIDEO CONFIRMATIONS */
Route::get('fileserver/confirmation/{registrant}/{filecontenttype}/{person}/{folder_id}', [App\Http\Controllers\Fileservers\FileserverController::class, 'store']);

/** GENERAL ACCESS PITCH FILES */
Route::get('pitchfiles/{eventversion}', [App\Http\Controllers\Pitchfiles\PitchfilesController::class, 'index'])->name('pitchfiles');

//Route::middleware(['auth:sanctum', 'verified'])->group(function() {
Route::middleware('auth', 'verified')->group(function() {
    /** SITE ADMINISTRATOR */
    Route::get('sa/', [App\Http\Controllers\Siteadministration\SiteadministratorController::class, 'index'])->name('siteadministrator.index');
    Route::post('impersonation/{user_id}', [App\Http\Controllers\Siteadministration\ImpersonationController::class, 'index'])->name('impersonate.login');
    Route::get('impersonation/destroy', [App\Http\Controllers\Siteadministration\ImpersonationController::class, 'destroy']);
    Route::get('sa/emails/dump/{offset?}/{length?}', [App\Http\Controllers\Siteadministration\EmailsCsvController::class, 'export'])->name('siteadministrator.emailsdump');
    Route::get('sa/participatingstudents', [App\Http\Controllers\Siteadministration\ParticipatingstudentstableController::class, 'index'])->name('siteadministration.participatingstudentstable.index');
    Route::get('sa/teachertable', [App\Http\Controllers\Siteadministration\TeachertableController::class, 'index'])->name('siteadministration.teachertable.index');
    Route::get('sa/teachertable/email', [App\Http\Controllers\Siteadministration\TeachertablebyemailController::class, 'index'])->name('siteadministration.teachertable.byemail.index');

    /** AUDITION RESULTS */
    Route::get('auditionresults/{eventversion}', [App\Http\Controllers\Auditionresults\AuditionresultsController::class, 'index'])
        ->name('auditionresults.index');
    Route::get('auditionresults/detail/{registrant}', [App\Http\Controllers\Auditionresults\AuditionresultsController::class, 'show'])
        ->name('auditionresults.detail.show');
    Route::get('auditionresults/mydetails/pdf/{eventversion}', [App\Http\Controllers\Auditionresults\AuditionresultsController::class, 'pdf'])
        ->name('auditionresults.mydetails.pdf');

    /** DASHBOARD */
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard');
    Route::get('dashboard/gettingstarted', [App\Http\Controllers\DashboardController::class, 'update'])
        ->name('dashboard.gettingstarted');

    /** SUPERUSER */
    Route::post('dashboard/impersonation', [App\Http\Controllers\ImpersonationController::class, 'show'])->name('impersonation.show');

    /** MEMBERSHIP MANAGER */
    Route::get('membership/approval/{id}', [App\Http\Controllers\Organizations\MembershipmanagerController::class, 'approval'])->name('membership.approval');


    /** AUTHENTICATED USER */
    //Route::get('/students', [App\Http\Controllers\Students\StudentController::class, 'show'])->name('students');
    Route::get('/students', [App\Http\Controllers\Students\StudentController::class, 'index'])->name('students.index');
    Route::get('/xstudents', [App\Http\Controllers\Students\StudentTabbedController::class, 'show'])->name('xstudents');

    /** LIBRARY */
    Route::get('/libraries', [App\Http\Controllers\Libraries\LibraryController::class,'index'])->name('library.index');

    /** ENSEMBLES */
    Route::get('/ensembles', [App\Http\Controllers\Ensembles\EnsembleController::class,'index'])->name('ensembles.index');
    //Route::get('/ensemble/new', [App\Http\Controllers\Ensembles\EnsembleController::class,'create'])->name('ensemble.create');
    //Route::get('/ensemble/{ensemble}', [App\Http\Controllers\Ensembles\EnsembleController::class,'edit'])->name('ensemble.edit');
    //Route::get('/ensemble/{ensemble}/delete', [App\Http\Controllers\Ensembles\EnsembleController::class,'destroy'])->name('ensemble.destroy');
    //Route::post('/ensemble', [App\Http\Controllers\Ensembles\EnsembleController::class,'store'])->name('ensemble.store');
    //Route::post('/ensemble/{ensemble}/update', [App\Http\Controllers\Ensembles\EnsembleController::class,'update'])->name('ensemble.update');

    /** ENSEMBLE MEMBERS */
    Route::get('/ensemble/{ensemble}/members', [App\Http\Controllers\Ensembles\MembersController::class, 'index'])->name('ensemblemembers.index');
    Route::post('/ensemble/members/import', [App\Http\Controllers\Ensembles\MembersController::class, 'import'])->name('ensemblemembers.import');
    //Route::get('/ensemble/{ensemble}/{schoolyear}/members/new', [App\Http\Controllers\Ensembles\MembersController::class, 'create'])->name('ensemble.members.create');
    //Route::get('/ensemble/member/{ensemblemember}', [App\Http\Controllers\Ensembles\MembersController::class, 'edit'])->name('ensemble.members.edit');
    //Route::get('/ensemble/ensemblemember/delete', [App\Http\Controllers\Ensembles\MembersController::class, 'destroy'])->name('ensemble.members.destroy');
    //Route::post('/ensemble/member/store', [App\Http\Controllers\Ensembles\MembersController::class,'store'])->name('ensemble.members.store');
    //Route::post('/ensemble/member/{ensemblemember}/update', [App\Http\Controllers\Ensembles\MembersController::class,'update'])->name('ensemble.members.update');

    /** ENSEMBLE ASSETS */
    Route::get('/ensemble/{ensemble}/assets', [App\Http\Controllers\Ensembles\AssetController::class, 'index'])->name('ensemble.assets.index');
    Route::get('/ensemble/{ensemble}/{schoolyear}/assets/new', [App\Http\Controllers\Ensembles\AssetController::class, 'create'])->name('ensemble.assets.create');
    //Route::get('/ensemble/assets/{asset}', [App\Http\Controllers\Ensembles\AssetController::class, 'edit'])->name('ensemble.assets.edit');
    //Route::get('/ensemble/assets/{asset}/destroy', [App\Http\Controllers\Ensembles\AssetController::class, 'destroy'])->name('ensemble.assets.destroy');
    Route::post('/ensemble/asset/store', [App\Http\Controllers\Ensembles\AssetController::class,'store'])->name('ensemble.assets.store');
    //Route::post('/ensemble/asset/{ensemble}/update', [App\Http\Controllers\Ensembles\AssetController::class,'update'])->name('ensemble.assets.update');

    /** EVENTVERSIONS */
    //NOTE: using "/events" as friendlier designation
    Route::get('/events', [App\Http\Controllers\Eventversions\EventversionsController::class, 'index'])->name('eventversions.index');
    Route::get('/event/{eventversion}', [App\Http\Controllers\Eventversions\EventversionsController::class, 'show'])->name('eventversion.show');
    Route::get('/event/obligations/update', [App\Http\Controllers\Eventversions\ObligationsController::class, 'create'])->name('eventversion.obligations.update');

    /** ORGANIZATIONS */
    Route::get('/organizations', [App\Http\Controllers\Organizations\OrganizationController::class, 'index'])->name('organizations.index');
    Route::get('/organization/membershipcard/{organization}', [App\Http\Controllers\Organizations\MembershipcardController::class,'show'])
        ->name('organization.membershipcard');
    Route::post('/organization/membershipcard/create', [App\Http\Controllers\Organizations\MembershipcardController::class,'create'])
        ->name('organization.membershipcard.create');
    Route::post('organization/membershipcard/{membership?}/update', [App\Http\Controllers\Organizations\MembershipcardController::class,'update'])
        ->name('organization.membershipcard.update');

    /** REGISTRANTS */
    Route::get('/registrant/{registrant}/application/show',[App\Http\Controllers\Registrants\RegistrantApplicationController::class, 'show'])->name('registrant.application.show');
    Route::get('/registrant/{registrant}/application',[App\Http\Controllers\Registrants\RegistrantApplicationController::class, 'create'])->name('registrant.application.create');
    Route::get('/registrant/{registrant}/download',[App\Http\Controllers\Registrants\RegistrantApplicationController::class, 'download'])->name('registrant.application.download');
    Route::post('/registrant/{registrant}/eapplication',[App\Http\Controllers\Registrants\RegistrantApplicationController::class,'update'])->name('registrant.eapplication');
    Route::get('registrant/profile/{eventversion}/{registrant}/inperson', [App\Http\Controllers\Registrants\InpersonauditionController::class, 'update'])->name('registrant.profile.store.inperson');
    Route::get('/registrant/register/{registrant}',[App\Http\Controllers\Registrants\RegisterController::class, 'update'])->name('registrant.register');

    Route::get('/registrants/{eventversion}',[App\Http\Controllers\Registrants\RegistrantsController::class, 'index'])->name('registrants.index');
    Route::get('/registrant/{registrant}',[App\Http\Controllers\Registrants\RegistrantController::class, 'show'])->name('registrant.show');
    Route::post('/registrant/update/{registrant}',[App\Http\Controllers\Registrants\RegistrantController::class, 'update'])->name('registrant.update');

    Route::get('/registrants/adjudication/{eventversion}',[App\Http\Controllers\Registrants\RegistrantAdjudicationController::class, 'index'])
        ->name('registrants.adjudication');
    Route::get('registrants/adjudication/registrant/{registrant}',[App\Http\Controllers\Registrants\RegistrantAdjudicationController::class, 'show'])
        ->name('registrants.adjudication.show');
    Route::post('registrants/adjudication/registrant/update/{registrant}',[App\Http\Controllers\Registrants\RegistrantAdjudicationController::class, 'update'])
        ->name('registrants.adjudication.update');


    Route::get('/registrant/approve/{registrant}/{filecontenttype}', [FileapprovalController::class,'approve'])->name('fileupload.approve');
    Route::get('/registrant/reject/{registrant}/{filecontenttype}', [FileapprovalController::class,'reject'])->name('fileupload.reject');

    Route::get('/registrant/{registrant}/signatures', [App\Http\Controllers\Registrants\RegistrantSignaturesController::class,'update'])->name('registrant.signatures');

    Route::get('/registrant/estimateform/{eventversion}', [App\Http\Controllers\Registrants\RegistrantEstimateFormController::class,'show'])->name('registrant.estimateform');
    Route::get('/registrant/estimateform/{eventversion}/download', [App\Http\Controllers\Registrants\RegistrantEstimateFormController::class,'download'])->name('registrant.estimateform.download');
    Route::post('/registrant/estimateform/county', [App\Http\Controllers\Registrants\RegistrantEstimateFormController::class, 'update'])->name('school.county');

    /** MEDIA UPLOADS */
    Route::post('/registrant/mediaupload/{registrant}/{filecontenttype}', [App\Http\Controllers\Registrants\MediauploadController::class, 'update'])
        ->name('registrant.mediaupload.update');

    Route::get('/registrant/payments/{eventversion}', [App\Http\Controllers\Registrants\RegistrantPaymentsController::class,'index'])->name('registrant.payments');
    Route::get('/registrant/payments/for/{registrant}', [App\Http\Controllers\Registrants\RegistrantPaymentsController::class,'show'])->name('registrant.payments.show');
    Route::post('/registrant/payment/new', [App\Http\Controllers\Registrants\RegistrantPaymentsController::class,'store'])->name('registrant.payments.store');
    Route::post('/registrant/payment/update/{payment}', [App\Http\Controllers\Registrants\RegistrantPaymentsController::class,'update'])->name('registrant.payments.update');

    Route::get('/paypal/registrants', [App\Http\Controllers\Registrants\PaypalController::class,'index'])->name('registrant.paypal');

    /** SCHOOLS */
    Route::get('/schools', [App\Http\Controllers\Schools\SchoolController::class, 'index'])->name('schools');
    Route::get('/schools/remove/{school}', [App\Http\Controllers\Schools\SchoolController::class, 'destroy'])->name('schools.destroy');

    /** TEACHER EVENTVERSION CONFIGURATIONS */
    Route::get('/registrants/configs/{eventversion}',[App\Http\Controllers\Eventversions\EventversionteacherconfigsController::class,'update'])->name('eventversionteacherconfig.update');

});

