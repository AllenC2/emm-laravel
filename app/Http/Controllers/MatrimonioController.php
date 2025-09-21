<?php

namespace App\Http\Controllers;

use App\Models\Matrimonio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MatrimonioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MatrimonioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $matrimonios = Matrimonio::with('comunidade')->paginate();

        return view('matrimonio.index', compact('matrimonios'))
            ->with('i', ($request->input('page', 1) - 1) * $matrimonios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $matrimonio = new Matrimonio();
        $comunidades = \App\Models\Comunidade::all();

        return view('matrimonio.create', compact('matrimonio', 'comunidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatrimonioRequest $request): RedirectResponse
    {
        Matrimonio::create($request->validated());

        return Redirect::route('matrimonios.index')
            ->with('success', 'Matrimonio created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $matrimonio = Matrimonio::with('comunidade')->find($id);

        return view('matrimonio.show', compact('matrimonio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $matrimonio = Matrimonio::find($id);
        $comunidades = \App\Models\Comunidade::all();

        return view('matrimonio.edit', compact('matrimonio', 'comunidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatrimonioRequest $request, Matrimonio $matrimonio): RedirectResponse
    {
        $matrimonio->update($request->validated());

        return Redirect::route('matrimonios.index')
            ->with('success', 'Matrimonio updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Matrimonio::find($id)->delete();

        return Redirect::route('matrimonios.index')
            ->with('success', 'Matrimonio deleted successfully');
    }
}
