<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeroRequest;
use App\Models\Clan;
use App\Models\Hero;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class HeroController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Hero::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sort = $request->sort ?: 'name';
        $direction = $request->direction ?: 'asc';
        $search = $request->search;

        return view('heroes.index', [
            'heroes' => Hero::query()
                ->select('heroes.*')
                ->when(!auth()->user()->admin, function ($query) {
                    $query->ofUser(auth()->user());
                })
                ->leftJoin('clans', 'clans.id', '=', 'heroes.clan_id')
                ->search($search)
                ->orderBy($sort, $direction)
                ->paginate(5)
                ->appends(['sort' => $sort, 'direction' => $direction, 'search' => $search]),
            'direction' => $request->direction == 'desc' ? 'asc' : 'desc',
            'search' => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        if (!Gate::allows('create-hero-at-even-minutes', Carbon::now()->minute)) {
//            abort(403);
//        }

        $users = User::query()->where('admin', false)->orderBy('name')->get();
        $clans = Clan::query()->orderBy('name')->get();

        return view('heroes.create', [
            'clans' => $clans,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HeroRequest $request)
    {
        $hero = Hero::query()->create([
            'user_id' => $request->user_id,
            'clan_id' => $request->clan_id,
            'name' => $request->name,
            'energy' => $request->energy,
            'attack' => $request->attack,
            'defense' => $request->defense,
        ]);

        Log::info('Creato eroe ' . $hero->id);
        Log::info('Creato eroe', ['id' => $hero->id]);

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
     * @param Hero $hero
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Hero $hero)
    {
//        if (!Gate::allows('edit-hero-with-attack-five', $hero)) {
//            abort(403);
//        }

        $users = User::query()->where('admin', false)->orderBy('name')->get();
        $clans = Clan::query()->orderBy('name')->get();

        return view('heroes.edit', [
            'hero' => $hero,
            'clans' => $clans,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HeroRequest $request
     * @param Hero $hero
     * @return \Illuminate\Http\Response
     */
    public function update(HeroRequest $request, Hero $hero)
    {
        $hero->update([
            'user_id' => $request->user_id,
            'clan_id' => $request->clan_id,
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
     * @param Hero $hero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hero $hero)
    {
        $hero->delete();

        return back()->with([
            'status' => 'success',
            'message' => 'Eroe eliminato',
        ]);
    }
}
