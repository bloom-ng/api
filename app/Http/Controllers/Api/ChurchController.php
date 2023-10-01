<?php

namespace App\Http\Controllers\Api;

use App\Models\Church;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChurchResource;
use App\Http\Resources\ChurchCollection;
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
        // $this->authorize('view-any', Church::class);

        $search = $request->get('search', '');

        $churches = Church::search($search)
            ->latest()
            ->paginate(50);

        return new ChurchCollection($churches);
    }

    /**
     * @param \App\Http\Requests\ChurchStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChurchStoreRequest $request)
    {
        // $this->authorize('create', Church::class);

        $validated = $request->validated();

        $church = Church::create($validated);

        return new ChurchResource($church);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Church $church
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Church $church)
    {
        $this->authorize('view', $church);

        return new ChurchResource($church);
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

        return new ChurchResource($church);
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

        return response()->noContent();
    }
}
