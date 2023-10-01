<?php

namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;
use App\Http\Requests\ChurchStoreRequest;
use App\Http\Requests\ChurchUpdateRequest;

class ChurchController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Church::class);

        $search = $request->get('search', '');

        $churches = Church::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.churches.index', compact('churches', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Church::class);

        return view('app.churches.create');
    }

    /**
     * @param \App\Http\Requests\ChurchStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChurchStoreRequest $request)
    {
        $this->authorize('create', Church::class);

        $validated = $request->validated();

        $church = Church::create($validated);

        return redirect()
            ->route('churches.edit', $church)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Church $church
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Church $church)
    {
        $this->authorize('view', $church);

        return view('app.churches.show', compact('church'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Church $church
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Church $church)
    {
        $this->authorize('update', $church);

        return view('app.churches.edit', compact('church'));
    }

    /**
     * @param \App\Http\Requests\ChurchUpdateRequest $request
     * @param \App\Models\Church $church
     * @return \Illuminate\Http\Response
     */
    public function update(ChurchUpdateRequest $request, Church $church)
    {
        $this->authorize('update', $church);

        $validated = $request->validated();

        $church->update($validated);

        return redirect()
            ->route('churches.edit', $church)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Church $church
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Church $church)
    {
        $this->authorize('delete', $church);

        $church->delete();

        return redirect()
            ->route('churches.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
