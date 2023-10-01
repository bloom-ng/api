<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.participants.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Participant::class)
                            <a
                                href="{{ route('participants.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.participants.inputs.church_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.participants.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.participants.inputs.email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.participants.inputs.phone')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.participants.inputs.type')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.participants.inputs.group')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.participants.inputs.gender')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($participants as $participant)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $participant->church_id ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $participant->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $participant->email ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $participant->phone ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $participant->type ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $participant->group ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $participant->gender ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $participant)
                                        <a
                                            href="{{ route('participants.edit', $participant) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $participant)
                                        <a
                                            href="{{ route('participants.show', $participant) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $participant)
                                        <form
                                            action="{{ route('participants.destroy', $participant) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <div class="mt-10 px-4">
                                        {!! $participants->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
