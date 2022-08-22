<?php

namespace App\Http\Controllers\Ensembles;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnsembleRequest;
use App\Models\Ensemble;
use App\Models\Ensembletype;
use App\Models\Gradetype;
use App\Models\Schoolyear;
use App\Models\Userconfig;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsembleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('/ensembles/index', [
            'ensembles' => $this->ensembles(),
            'schoolyear' => Schoolyear::find(Userconfig::getValue('schoolyear_id', auth()->id())),
            'types' => Ensembletype::all(),
            'gradetypes' => $this->gradetypes(),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('/ensembles/create', [
                'ensembles' => $this->ensembles(),
                'types' => Ensembletype::all(),
                'gradetypes' => $this->gradetypes(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreEnsembleRequest $request)
    {
        $validated = $request->validated();

        $validated['school_id'] = Userconfig::getValue('school_id', auth()->id());

        //Ensemble::create($attributes);
        $ensemble = auth()->user()->ensembles()->create($validated);

        $ensemble->gradetypes()->sync($validated['gradetypes']);

        Userconfig::setValue('ensemble_id', auth()->id(), $ensemble->id);

        return redirect()->route('ensembles.index');

    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        return view('ensembles.show', [
            'request' => $request,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ensemble $ensemble
     * @return Response
     */
    public function edit(Ensemble $ensemble)
    {
        Userconfig::setValue('ensemble_id', auth()->id(), $ensemble->id);

        return view('/ensembles/edit', [
                'gradetypeidsarray' => $ensemble->gradetypeIdsArray(),
                'ensemble' => $ensemble,
                'ensembles' => $this->ensembles(),
                'types' => Ensembletype::all(),
                'gradetypes' => $this->gradetypes(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Ensemble $ensemble
     * @return Response
     */
    public function update(StoreEnsembleRequest $request, Ensemble $ensemble)
    {
        $validated = $request->validated();

        $validated['school_id'] = Userconfig::getValue('school_id', auth()->id());

        $ensemble->update($validated);

        $ensemble->gradetypes()->sync($validated['gradetypes']);

        return redirect('ensembles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ensemble $ensemble
     * @return Response
     */
    public function destroy(Ensemble $ensemble)
    {
        $ensemble->delete();

        return redirect('ensembles');
    }

    /** END OF PUBLIC FUNCTIONS  *********************************************/

    private function ensembles()
    {
        return Ensemble::with('ensembletype', 'ensembletype.instrumentations','ensemblemembers')
            ->where('user_id', auth()->id())
            ->where('school_id', Userconfig::getValue('school', auth()->id()))
            ->orderBy('name')->get();
    }

    private function gradetypes()
    {
        $gradetype = new Gradetype;

        return $gradetype->schoolUser();
    }
}
