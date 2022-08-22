<?php

namespace App\Http\Controllers\Libraries\Librarymedia;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\Librarymediatype;
use App\Models\Userconfig;
use Illuminate\Http\Request;

class CompilationController extends Controller
{
    private $libraries;
    private $library;
    private $librarymediatypes;
    private $librarymediatype_id;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->makeLibraries();

        return view('libraries.compilations.create',
            [
                'libraries' => $this->libraries,
                'library' => $this->library,
                'librarymediatypes' => $this->librarymediatypes,
                'librarymediatype_id' => $this->librarymediatype_id,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function makeLibraries()
    {
        $this->libraries = Library::where('user_id', auth()->id())->get();
        $this->library = Library::find(Userconfig::getValue('library', auth()->id()));
        $this->librarymediatypes = Librarymediatype::all();
        $this->librarymediatype_id = Librarymediatype::COMPILATION;
    }
}
