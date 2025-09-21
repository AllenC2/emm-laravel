<?php

namespace App\Http\Controllers;

use App\Models\ExperienciaMatrimonio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ExperienciaMatrimonioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ExperienciaMatrimonioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $experienciaMatrimonios = ExperienciaMatrimonio::paginate();

        return view('experiencia-matrimonio.index', compact('experienciaMatrimonios'))
            ->with('i', ($request->input('page', 1) - 1) * $experienciaMatrimonios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $experienciaMatrimonio = new ExperienciaMatrimonio();

        return view('experiencia-matrimonio.create', compact('experienciaMatrimonio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienciaMatrimonioRequest $request): RedirectResponse
    {
        ExperienciaMatrimonio::create($request->validated());

        return Redirect::route('experiencia-matrimonios.index')
            ->with('success', 'ExperienciaMatrimonio created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $experienciaMatrimonio = ExperienciaMatrimonio::find($id);

        return view('experiencia-matrimonio.show', compact('experienciaMatrimonio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $experienciaMatrimonio = ExperienciaMatrimonio::find($id);

        return view('experiencia-matrimonio.edit', compact('experienciaMatrimonio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienciaMatrimonioRequest $request, ExperienciaMatrimonio $experienciaMatrimonio): RedirectResponse
    {
        $experienciaMatrimonio->update($request->validated());

        return Redirect::route('experiencia-matrimonios.index')
            ->with('success', 'ExperienciaMatrimonio updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        ExperienciaMatrimonio::find($id)->delete();

        return Redirect::route('experiencia-matrimonios.index')
            ->with('success', 'ExperienciaMatrimonio deleted successfully');
    }
}
