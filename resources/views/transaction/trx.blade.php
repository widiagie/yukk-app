<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
            {{ __('Top Up') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto md:px-6 lg:px-8 space-y-6">
            <div class="p-4 md:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-md">
                    @include('transaction.topup-form')
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
