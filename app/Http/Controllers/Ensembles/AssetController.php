<?php

namespace App\Http\Controllers\Ensembles;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetRequest;
use App\Models\Ensemble;
use App\Models\Asset;
use App\Models\Schoolyear;
use App\Models\Userconfig;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Ensemble $ensemble
     * @return Response
     */
    public function index(Ensemble $ensemble)
    {
        $schoolyear = Schoolyear::find(Userconfig::getValue('schoolyear_id', auth()->id()));

        Userconfig::setValue('ensemble_id', auth()->id(), $ensemble->id);

        return view('ensembles.assets.index',
            [
                'assets' => Asset::orderBy('descr')->get(),
                'ensemble' => $ensemble,
                'schoolyear' => $schoolyear,
                'schoolyears' => Schoolyear::orderBy('descr', 'desc')->get(),
                'schoolyear_id' => $schoolyear->id,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Ensemble $ensemble
     * @param Schoolyear $schoolyear
     * @return Response
     */
    public function create(Ensemble $ensemble, Schoolyear $schoolyear)
    {
        return view('ensembles.assets.create',
            [
                'ensemble' => $ensemble,
                'schoolyear' => $schoolyear,
                'schoolyears' => Schoolyear::orderBy('descr', 'desc')->get(),
                'schoolyear_id' => $schoolyear->id,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\StoreAssetRequest  $request
     * @return Response
     */
    public function store(StoreAssetRequest $request)
    {
        $asset = Asset::create([
            'created_by' => auth()->id(),
            'descr' => $request['descr'],
        ]);

        $ensemble = Userconfig::getValue('ensemble_id', auth()->id());

        $asset->ensembles()->attach($ensemble);

        return redirect()->route('ensemble.assets.index', [$ensemble]);
    }

    /**
     * Display the specified resource.
     *
     * @param Asset $ensembleasset
     * @return Response
     */
    public function show(Asset $ensembleasset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Asset $ensembleasset
     * @return Response
     */
    public function edit(Asset $ensembleasset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Ensemble $ensemble
     * @return Response
     */
    public function update(Request $request, Ensemble $ensemble)
    {
        dd($request->input());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Asset $ensembleasset
     * @return Response
     */
    public function destroy(Asset $ensembleasset)
    {
        //
    }
}
