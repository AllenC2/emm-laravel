<?php

namespace App\Http\Controllers;

use App\Models\Sacerdote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SacerdoteRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SacerdoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sacerdotes = Sacerdote::paginate();

        return view('sacerdote.index', compact('sacerdotes'))
            ->with('i', ($request->input('page', 1) - 1) * $sacerdotes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sacerdote = new Sacerdote();

        return view('sacerdote.create', compact('sacerdote'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SacerdoteRequest $request): RedirectResponse
    {
        Sacerdote::create($request->validated());

        return Redirect::route('sacerdotes.index')
            ->with('success', 'Sacerdote created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $sacerdote = Sacerdote::find($id);

        return view('sacerdote.show', compact('sacerdote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $sacerdote = Sacerdote::find($id);

        return view('sacerdote.edit', compact('sacerdote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SacerdoteRequest $request, Sacerdote $sacerdote): RedirectResponse
    {
        $sacerdote->update($request->validated());

        return Redirect::route('sacerdotes.index')
            ->with('success', 'Sacerdote updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Sacerdote::find($id)->delete();

        return Redirect::route('sacerdotes.index')
            ->with('success', 'Sacerdote deleted successfully');
    }
}
