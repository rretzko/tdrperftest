<?php

namespace App\Http\Livewire\Students;

use App\Models\Userconfig;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class Biographycomponent extends Component
{
    use WithFileUploads;

    public $user = null;
    public $username = '';
    public $photo = null;
    public $photooriginalname = '';
    public $tab = '';

    protected $rules = [
        'photo' => ['image','max:1024',],
    ];

    public function deleteProfilePhoto()
    {
        if ($this->user->profile_photo_path) {
            Storage::disk('public')->delete($this->user->profile_photo_path);
            $this->user->profile_photo_path = null;
            $this->user->save();
        }

        $this->emit('profile-photo-removed');
    }

    public function mount()
    {
        $this->tab = Userconfig::getValue('studenttab', auth()->id());
        $this->username = $this->user->username;
    }

    public function render()
    {
        return view('livewire.students.biographycomponent');
    }

    /**
     * NOTES:
     * 1.
     * $this->photo->storePublicly('public/profile-photos') cannot be used inside
     * $this->user->update(['profile_photo_path' => $path]) but
     * must be declared separately with result saved to $path and then that $path
     * can be used inside the *update([]) method
     *
     * 2.
     * storePublicly('public/profile-photos') stores the image in:
     * /storage/app/public/photos and a symbolic link at
     * public/storage/profile-photos
     */
    public function savePhoto()
    {
        $path = $this->photo->storePublicly('public/profile-photos');

        $this->user->update([
            'profile_photo_path' => substr($path,6), //remove "public" prefix from  $path
        ]);

        $this->emit('profile-photo-saved');
    }

    public function save()
    {
        $this->user->update([
            'username' => $this->username,
        ]);

        $this->emit('biography-saved');
    }

    public function username()
    {
        $this->username = $this->user->username;
    }

    public function xupdatedUsername()
    {
        $this->user->username = $this->username;
        $this->user->refresh();
        dd($this->username.': '.$this->user->username);
    }

    public function updatedTab()
    {
        Userconfig::setValue('studenttab', auth()->id(), $this->tab);
    }
}
