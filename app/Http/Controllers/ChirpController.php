<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('chirps.index', [
		'chirps' => Chirp::with('user')->latest()->get(),
	]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
		'message' => 'required|string|max:255',
	]);

	$request->user()->chirps()->create($validated);

	return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp): View
    {
        $this->authorize('update', $chirp);

	return view('chirps.edit', [
		'chirp' => $chirp,
	]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        $this->authorize('update', $chirp);

	$validated = $request->validate([
		'message' => 'required|string|max:255',
	]);

	$chirp->update($validated);

	return redirect(route('chirps.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        $this->authorize('delete', $chirp);

	$chirp->delete();

	return redirect(route('chirps.index'));
    }

    /**
     * display the chirps from a given amount of days into the past
     * Default to 14 days
     */

    public function recent(Request $request)
     {
        $request->validate([
            'days' => 'nullable|numeric|min:1'
        ]); 
        
        $days = $request->input('days', 14); // Default to 14 days 
        $startDate = Carbon::now()->subDays($days);
        $chirps = Chirp::where('created_at', '>=', $startDate)->get();
     
        return view('chirps.recent', ['chirps' => $chirps, 'days' => $days]);
     }
    }

