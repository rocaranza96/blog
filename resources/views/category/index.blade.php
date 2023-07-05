<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Category List')
        </h2>
    </x-slot>

    <div class="flex justify-center pt-6">
        <x-primary-link href="{{ route('admin.category.create') }}">@lang('Create')</x-primary-link>
    </div>
    <div class="pt-6 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul role="list" class="divide-y divide-gray-100">
                        @forelse ($categories as $category)
                        <a href="{{ route('admin.category.edit', strtolower($category->name)) }}">
                            <li class="flex justify-between gap-x-6 py-5 cursor-pointer">
                                <div class="flex gap-x-4">
                                    <img class="w-20 h-20 flex-none rounded-full bg-gray-50" src="{{ Storage::url($category->cover_path) }}" alt="cover {{ $category->name }}">
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900 mt-3">{{ $category->name }}</p>
                                    </div>
                                </div>
                                <div class="hidden sm:flex sm:items-center space-x-1">
                                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                                        <p class="text-sm leading-6 text-gray-900">@lang('Created On') <time datetime="{{ $category->created_at }}">{{ $category->created_at->format('Y/m/d') }}</time></p>
                                        <p class="mt-1 text-xs leading-5 text-gray-500">@lang('Last Update') <time datetime="{{ $category->updated_at }}">{{ $category->updated_at->format('Y/m/d') }}</time></p>
                                        @if (!$category->deleted_at)
                                            <div class="mt-1 flex items-center gap-x-1.5">
                                                <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                                    <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                                                </div>
                                                <p class="text-xs leading-5 text-gray-500">@lang('Available')</p>
                                            </div>
                                        @else
                                            <div class="mt-1 flex items-center gap-x-1.5">
                                                <div class="flex-none rounded-full bg-red-500/20 p-1">
                                                <div class="h-1.5 w-1.5 rounded-full bg-red-500"></div>
                                                </div>
                                                <p class="text-xs leading-5 text-gray-500">@lang('Deleted')</p>
                                            </div>
                                        @endif
                                    </div>
                                    <svg class="fill-gray-400" width="23" height="23" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m8.295 16.59 4.58-4.59-4.58-4.59L9.705 6l6 6-6 6-1.41-1.41Z"></path>
                                    </svg>
                                </div>
                            </li>
                        </a>
                        @empty
                            @lang('Categories are empty.')
                        @endforelse
                        <div class="mt-3">
                            {{ $categories->links() }}
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
