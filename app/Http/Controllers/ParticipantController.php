<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Requests\ParticipantStoreRequest;
use App\Http\Requests\ParticipantUpdateRequest;

class ParticipantController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Participant::class);

        $search = $request->get('search', '');

        $participants = Participant::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.participants.index',
            compact('participants', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Participant::class);

        return view('app.participants.create');
    }

    /**
     * @param \App\Http\Requests\ParticipantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipantStoreRequest $request)
    {
        $this->authorize('create', Participant::class);

        $validated = $request->validated();

        $participant = Participant::create($validated);

        return redirect()
            ->route('participants.edit', $participant)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Participant $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Participant $participant)
    {
        $this->authorize('view', $participant);

        return view('app.participants.show', compact('participant'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Participant $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Participant $participant)
    {
        $this->authorize('update', $participant);

        return view('app.participants.edit', compact('participant'));
    }

    /**
     * @param \App\Http\Requests\ParticipantUpdateRequest $request
     * @param \App\Models\Participant $participant
     * @return \Illuminate\Http\Response
     */
    public function update(
        ParticipantUpdateRequest $request,
        Participant $participant
    ) {
        $this->authorize('update', $participant);

        $validated = $request->validated();

        $participant->update($validated);

        return redirect()
            ->route('participants.edit', $participant)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Participant $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Participant $participant)
    {
        $this->authorize('delete', $participant);

        $participant->delete();

        return redirect()
            ->route('participants.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
