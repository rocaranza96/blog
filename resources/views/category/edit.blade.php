<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Edit Category')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-12">
                        <form method="POST" action="{{ route('admin.category.update', strtolower($category->name)) }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            @include('category._form')

                            <div class="border-t border-gray-900/10 pt-4 mt-6 grid grid-cols-2 gap-4">
                                <div class="max-sm:grid max-sm:grid-cols-1 auto-rows-max max-sm:px-6 flex gap-2">
                                    @if ($category->deleted_at)
                                        <x-success-button form="restore-category-form">@lang('Restore')</x-success-button>
                                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-category-force-deletion')">@lang('Delete')</x-danger-button>
                                    @else
                                        <x-danger-button class="" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-category-deletion')">@lang('Delete')</x-danger-button>
                                    @endif
                                </div>
                                <div class="max-sm:grid max-sm:grid-cols-1 max-sm:px-6 auto-rows-max flex flex-row-reverse gap-2">
                                    <x-primary-button>@lang('Save')</x-primary-button>
                                    <x-secondary-link href="{{ route('admin.category.index') }}">@lang('Cancel')</x-secondary-link>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form id="restore-category-form" action="{{ route('admin.category.restore', strtolower($category->name)) }}" method="POST">
                        @csrf
                        @method('PATCH')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="confirm-category-deletion">
        <form method="POST" action="{{ route('admin.category.soft-delete', strtolower($category->name)) }}" class="p-6">
            @csrf
            @method('PATCH')

            <h2 class="text-lg font-medium text-gray-900">
                @lang('Are you sure you want to delete this category?')
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                @lang('Once this category is deleted, would not allow for post with this resource.')
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">@lang('Cancel')</x-secondary-button>

                <x-danger-button class="ml-3">@lang('Delete Category')</x-danger-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="confirm-category-force-deletion">
        <form method="POST" action="{{ route('admin.category.destroy', strtolower($category->name)) }}" class="p-6">
            @csrf
            @method('DELETE')

            <h2 class="text-lg font-medium text-gray-900">
                @lang('Are you sure you want to permanently delete this category?')
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                @lang('Once this category is permanently deleted, all of its resources and data will be permanently deleted.')
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">@lang('Cancel')</x-secondary-button>

                <x-danger-button class="ml-3">@lang('Delete Category')</x-danger-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
