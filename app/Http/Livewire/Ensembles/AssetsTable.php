<?php

namespace App\Http\Livewire\Ensembles;

use App\Models\Asset;
use App\Models\Ensemble;
use App\Models\Schoolyear;
use App\Models\Userconfig;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class AssetsTable extends Component
{
    use AuthorizesRequests;
    /**
     * @todo add Edit and Delete buttons to views/livewire/ensembles/assets-table.blade.php
     * - Can edit/delete when asset was added by auth()->id() AND no-one other than auth()->id() has used it
     * - On delete: Cascading delete if ensemblemembers have been assigned the asset
     */
    public $assets = null;
    public $assetsupdated = false;
    public $assettypes = [];
    public $confirmingdelete = 0;
    public $editasset = null;
    public $editassetdescr = '';
    public $ensemble = null;
    public $ensembleassets; //passed from @livewire('AssetsTable', ['ensembleassets' => $ensembleassets])
    public $initialassets; //array of assets at the beginning of process
    public $mssg = '';
    public $schoolyear = null;
    public $showeditmodal = false;
    public $tbl = '';

    protected $rules = [
        'assets.*' => ['nullable','numeric'],
        'editassetdescr' => ['string', 'required', 'min:3'],
    ];

    protected $validationAttributes = [
        'editassetdescr' => 'asset name',
    ];

    public function mount()
    {
        $this->assets = Asset::orderBy('descr')->get();
        $this->ensemble = Ensemble::find(Userconfig::getValue('ensemble_id', auth()->id()));
        $this->ensembleassets = $this->ensemble->assets;
        $this->initialassets = $this->ensembleassets;
        $this->setAssettypes();
        $this->mssg = $this->setMssg();
        $this->schoolyear = Schoolyear::find(Userconfig::getValue('schoolyear_id', auth()->id()));
    }

    public function render()
    {
        return view('livewire.ensembles.assets-table');
    }

    /**
     * @todo detach student/person/user assignments to asset
     */
    public function delete($id)
    {
        $asset = Asset::find($id);

        if($this->authorize('edit-asset', [$asset])) {

            if ($id === $this->confirmingdelete) {

                Asset::find($id)->ensembles()->detach();
                Asset::find($id)->delete();
                //TBD: Asset::find(id)->users()->detach();

                $this->ensemble->refresh();
                $this->ensembleassets = $this->ensemble->assets;
                $this->assets = Asset::orderBy('descr')->get();
                $this->assetsupdated = true;


            } else {
                $this->confirmingdelete = $id;
            }
        }
    }

    public function edit($id)
    {
        $this->editasset = Asset::find($id);
        $this->editassetdescr = $this->editasset->descr;

        $this->showeditmodal = true;
    }

    public function save()
    {
        $this->validate([
            'editassetdescr' => ['string', 'required', 'min:3']
        ]);

        if(! $this->duplicateDescr()){

            $asset = Asset::create([
                'descr' => $this->editassetdescr,
                'created_by' => auth()->id(),
            ]);

            $this->ensemble->assets()->attach($asset);

            $this->ensemble->refresh();
            $this->ensembleassets = $this->ensemble->assets;
            $this->assets = Asset::orderBy('descr')->get();
            $this->assettypes[] = strval($asset->id);

            $this->assetsupdated = true;
            $this->showeditmodal = false;

            $this->emit('asset-saved');
        }
    }

    public function update()
    {
        if($this->authorize('edit-asset', $this->editasset)) {

            $this->validate([
                'editassetdescr' => ['string', 'required', 'min:3']
            ]);

            $this->editasset->update([
                'descr' => $this->editassetdescr,
                'created_by' => auth()->id(),
            ]);

            $this->ensemble->refresh();
            $this->ensembleassets = $this->ensemble->assets;
            $this->assets = Asset::orderBy('descr')->get();

            $this->assetsupdated = true;
            $this->showeditmodal = false;

            $this->emit('asset-saved');
        }
    }

    public function updatedShoweditmodal()
    {
        $this->reset(['editasset', 'editassetdescr']);
    }

    public function updatedAssettypes()
    {
        $this->ensemble->assets()->sync($this->assettypes);
        $this->ensemble->refresh();
        $this->ensembleassets = $this->ensemble->assets;
        $this->mssg = $this->setMssg();
        $this->assetsupdated = true;

    }

    private function duplicateDescr()
    {
        return (bool)Asset::where('descr', $this->editassetdescr)->first();
    }

    private function setAssettypes()
    {
        foreach($this->ensembleassets AS $ensembleasset){

            //NOTE: MUST be strval; integers fail
            $this->assettypes[] = strval($ensembleasset->id);
        }
    }

    private function setMssg()
    {
        if($this->ensemble->assets->count()) {
            $str = 'The asset'.(($this->ensembleassets->count() > 1) ? 's' : '').' for <b>' . $this->ensemble->name . '</b>';
            $str .= (($this->ensembleassets->count() > 1) ? ' are: ' : ' is: ');
            $str .= '<ul class="ml-10 list-disc">';
            foreach($this->ensembleassets AS $ensembleasset){
                $str .= '<li>'.$ensembleasset->descr.'</li>';
            }
            $str .= '</ul>';
        }else{
            $str = 'No assets found for <b>'.$this->ensemble->name.'</b>';
        }

        return $str;

    }
}
