<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Top Up') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl md:px-6 lg:px-8 space-y-6">
            <div class="p-4 md:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-md">
                    @include('transaction.topup-form')
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-md md:px-6 lg:px-8 space-y-6">
        <div class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology acquisitions 2021</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>
        </div>
    </div>

    
</x-app-layout>
