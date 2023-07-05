<div class="mb-3" x-data="{ show: false }">
    <div class="flex justify-center gap-x-5 text-center">
        <div class="flex justify-center space-x-8">
            @if (request()->routeIs('admin.category.edit'))
                <div>
                    @lang('Actual Cover')
                    <img class="w-24 h-24 flex-none rounded-full bg-gray-50" id="actual_cover" src="{{ Storage::url($category->cover_path) }}" alt="cover {{ $category->name }}">
                </div>
            @endif
            <div x-show="show">
                @lang('New Cover')
                <img class="w-24 h-24 rounded-full" id="new_cover" alt="new cover">
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-x-6 gap-y-4">
        <div class="col-span-full">
            <label for="cover" class="inline-block text-sm font-medium leading-6 text-gray-900">
                <div class="cursor-pointer mt-4 flex items-center gap-x-3">
                    <div
                        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        @lang('Change Cover')
                    </div>
                </div>
            </label>
            <x-text-input class="hidden" x-on:change="show = true" onchange="document.getElementById('new_cover').src = window.URL.createObjectURL(this.files[0])" type="file" name="cover" id="cover" />
        </div>
        <div class="grid grid-cols-1 gap-x-6">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $category->name ?? null)" required autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
        </div>

    </div>
</div>
