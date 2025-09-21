<?php

namespace App\Http\Controllers;

use App\Models\Comunidade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ComunidadeRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ComunidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $comunidades = Comunidade::paginate();

        return view('comunidade.index', compact('comunidades'))
            ->with('i', ($request->input('page', 1) - 1) * $comunidades->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $comunidade = new Comunidade();
        $sacerdotes = \App\Models\Sacerdote::all();

        return view('comunidade.create', compact('comunidade', 'sacerdotes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComunidadeRequest $request): RedirectResponse
    {
        Comunidade::create($request->validated());

        return Redirect::route('comunidades.index')
            ->with('success', 'Comunidade created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $comunidade = Comunidade::with('matrimonios')->find($id);

        return view('comunidade.show', compact('comunidade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $comunidade = Comunidade::find($id);
        $sacerdotes = \App\Models\Sacerdote::all();

        return view('comunidade.edit', compact('comunidade', 'sacerdotes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComunidadeRequest $request, Comunidade $comunidade): RedirectResponse
    {
        $comunidade->update($request->validated());

        return Redirect::route('comunidades.index')
            ->with('success', 'Comunidade updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Comunidade::find($id)->delete();

        return Redirect::route('comunidades.index')
            ->with('success', 'Comunidade deleted successfully');
    }
}
