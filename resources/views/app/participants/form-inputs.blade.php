@php $editing = isset($participant) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="church_id"
            label="Church Id"
            :value="old('church_id', ($editing ? $participant->church_id : ''))"
            maxlength="255"
            placeholder="Church Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $participant->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $participant->email : ''))"
            maxlength="255"
            placeholder="Email"
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone"
            label="Phone"
            :value="old('phone', ($editing ? $participant->phone : ''))"
            maxlength="255"
            placeholder="Phone"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="type"
            label="Type"
            :value="old('type', ($editing ? $participant->type : ''))"
            maxlength="255"
            placeholder="Type"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="group"
            label="Group"
            :value="old('group', ($editing ? $participant->group : ''))"
            max="255"
            placeholder="Group"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="gender" label="Gender">
            @php $selected = old('gender', ($editing ? $participant->gender : '')) @endphp
            <option value="male" {{ $selected == 'male' ? 'selected' : '' }} >Male</option>
            <option value="female" {{ $selected == 'female' ? 'selected' : '' }} >Female</option>
            <option value="other" {{ $selected == 'other' ? 'selected' : '' }} >Other</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
