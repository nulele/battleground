<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sort = $request->sort ?: 'name';
        $direction = $request->direction ?: 'desc';

        return view('heroes.index', [
            'heroes' => Hero::query()
                ->orderBy($sort, $direction)
                ->paginate(5)
                ->appends(['sort' => $sort, 'direction' => $direction]),
            'direction' => $request->direction == 'desc' ? 'asc' : 'desc',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('heroes.create', [

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
        Hero::query()->create([
            'name' => $request->name,
            'energy' => $request->energy,
            'attack' => $request->attack,
            'defense' => $request->defense,
        ]);

        return redirect()->route('heroes.index')->with([
            'status' => 'success',
            'message' => 'Eroe creato',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if(!$hero = Hero::query()->find($id)) {
            return back()->with([
                'status' => 'error',
                'message' => 'Eroe non trovato',
            ]);
        }

        return view('heroes.edit', [
            'hero' => $hero,
        ]);
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
        if(!$hero = Hero::query()->find($id)) {
            return back()->with([
                'status' => 'error',
                'message' => 'Eroe non trovato',
            ]);
        }

        $hero->update([
            'name' => $request->name,
            'energy' => $request->energy,
            'attack' => $request->attack,
            'defense' => $request->defense,
        ]);

        return redirect()->route('heroes.index')->with([
            'status' => 'success',
            'message' => 'Eroe modificato',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$hero = Hero::query()->find($id)) {
            return back()->with([
                'status' => 'error',
                'message' => 'Eroe non trovato',
            ]);
        }

        $hero->delete($id);

        return back()->with([
            'status' => 'success',
            'message' => 'Eroe eliminato',
        ]);
    }
}
