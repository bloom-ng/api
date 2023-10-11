<?php

namespace App\Http\Controllers\Api;

use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantResource;
use App\Http\Resources\ParticipantCollection;
use App\Http\Requests\ParticipantStoreRequest;
use App\Http\Requests\ParticipantUpdateRequest;

class ParticipantController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $type = null, $group = null)
    {
        $search = $request->get('search', '');

        $query = Participant::search($search)
            ->latest();

        // Check if the 'type' parameter is provided and filter by type if it is
        if ($type !== null) {
            $typeValues = explode(',', $type); // You can pass type values as a comma-separated list
            $query->whereIn('type', $typeValues);
        }

        // Check if the 'group' parameter is provided and filter by group if it is
        if ($group !== null) {
            $groupValues = explode(',', $group); // You can pass group values as a comma-separated list
            $query->whereIn('group', $groupValues);
        }

        $participants = $query->paginate(50);

        return new ParticipantCollection($participants);
    }

    /**
     * @param \App\Http\Requests\ParticipantStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParticipantStoreRequest $request)
    {
        // Check if a participant with the same request number and email exists
        $existingParticipant = Participant::where('phone', $request->input('phone'))
            ->where('email', $request->input('email'))
            ->first();

        if ($existingParticipant) {
            // If an existing participant is found, return its data
            return new ParticipantResource($existingParticipant);
        }

        // No existing participant found, continue to create a new participant
        // $this->authorize('create', Participant::class);

        // Get the last participant
        $participant = Participant::latest()->first();

        // Get the next group
        $next = empty($participant) ? Participant::getNext(null) : Participant::getNext($participant->group);

        // Get the validated data from the request
        $validated = $request->validated();
        $validated['image'] = $request->image->store('images');

        if ($validated['type'] == 0) {
            $validated['group'] = $next;
        }

        // Create a new participant
        $participant = Participant::create($validated);

        return new ParticipantResource($participant);
    }


    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Participant $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Participant $participant)
    {
        // $this->authorize('view', $participant);

        return new ParticipantResource($participant);
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
        // $this->authorize('update', $participant);

        $validated = $request->validated();

        $participant->update($validated);

        return new ParticipantResource($participant);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Participant $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Participant $participant)
    {
        // $this->authorize('delete', $participant);

        $participant->delete();

        return response()->noContent();
    }

    public function registerAsChurch(Request $request){

        $validated = $request->validated();
        $number_of_participants = $validated['number_of_participants'];
    
        $participants = [];
    
        // Loop to create participants
        for ($i = 0; $i < $number_of_participants; $i++) {
            $participant = Participant::create($validated);
            $participants[] = new ParticipantResource($participant);
        }
    
        return $participants;
    }
    
}
