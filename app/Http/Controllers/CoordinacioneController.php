<?php

namespace App\Http\Controllers;

use App\Models\Coordinacione;
use App\Models\Matrimonio;
use App\Models\Comunidade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CoordinacioneRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CoordinacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // Obtener coordinaciones agrupadas por matrimonio con sus relaciones
        $coordinacionesGrouped = Coordinacione::with(['matrimonio', 'comunidade'])
            ->get()
            ->groupBy('matrimonio_id');

        return view('coordinacione.index', compact('coordinacionesGrouped'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $coordinacione = new Coordinacione();
        $matrimonios = Matrimonio::orderBy('nombre')->get();
        $comunidades = Comunidade::orderBy('nombre')->get();

        return view('coordinacione.create', compact('coordinacione', 'matrimonios', 'comunidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoordinacioneRequest $request): RedirectResponse
    {
        Coordinacione::create($request->validated());

        return Redirect::route('coordinaciones.index')
            ->with('success', 'Coordinacione created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $coordinacione = Coordinacione::find($id);

        return view('coordinacione.show', compact('coordinacione'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $coordinacione = Coordinacione::find($id);
        $matrimonios = Matrimonio::orderBy('nombre')->get();
        $comunidades = Comunidade::orderBy('nombre')->get();

        return view('coordinacione.edit', compact('coordinacione', 'matrimonios', 'comunidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoordinacioneRequest $request, Coordinacione $coordinacione): RedirectResponse
    {
        $coordinacione->update($request->validated());

        return Redirect::route('coordinaciones.index')
            ->with('success', 'Coordinacione updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Coordinacione::find($id)->delete();

        return Redirect::route('coordinaciones.index')
            ->with('success', 'Coordinacione deleted successfully');
    }
}
