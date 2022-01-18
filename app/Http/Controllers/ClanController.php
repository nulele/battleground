<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Clan::class);
//        if (!Gate::allows('show-clans')) {
//            abort(403);
//        }

        return view('clans.index', [
            'clans' => Clan::query()
                ->orderBy('name', 'desc')
                ->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Clan::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Clan::class);
    }

    /**
     * Display the specified resource.
     *
     * @param Clan $clan
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Clan $clan)
    {
        $this->authorize('show', $clan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Clan $clan
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Clan $clan)
    {
        $this->authorize('show', $clan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Clan $clan
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Clan $clan)
    {
        $this->authorize('update', $clan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Clan $clan
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Clan $clan)
    {
        $this->authorize('delete', $clan);
    }
}
