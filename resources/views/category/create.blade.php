<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Create Category')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-12">
                        <form method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                            @csrf

                            @include('category._form')

                            <div class="border-t border-gray-900/10 pt-4 mt-6 flex items-center justify-end gap-x-6">
                                <div class="place-self-end space-x-1">
                                    <x-secondary-link href="{{ route('admin.category.index') }}">@lang('Cancel')</x-secondary-link>
                                    <x-primary-button>@lang('Save')</x-primary-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
