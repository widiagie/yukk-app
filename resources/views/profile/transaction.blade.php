<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
            {{ __('My Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 mb-20 text-gray-900">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">

                            <div class="relative">
                                <form method="get" action="{{ route('profile.transaction') }}">
                                    <select id="table-search" name="t"
                                        class="z-10 max-md-100 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                        <option value="">Filter By Type</option>
                                        <option value="topup" @if($filter == 'topup') selected @endif>
                                            Top Up</option>
                                        <option value="pay" @if($filter == 'pay') selected @endif>
                                            Pay</option>
                                    </select>
                                    <button type="submit" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Filter</button>
                                </form>
                            </div>
                            
                            <div class="relative ml-48">
                                <div class="inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none text-green-700">
                                    Balance Rp. {{ number_format($balance) }}
                                </div>
                            </div>
                            <div class="relative">
                                <a href="{{ route('topup.form') }}" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Top Up</a>
                            </div>
                            
                            
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                </div>
                                <form method="get" action="{{ route('profile.transaction') }}">
                                    <input type="text" name="q" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search by code or description">
                                </form>
                            </div>
                        </div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Code
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right">
                                        Amount (Rp. )
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (count($transaction) > 0)
                            @foreach ($transaction as $trx)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $trx->trx_code }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ strtoupper($trx->trx_type) }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        {{ number_format($trx->trx_amount) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $trx->trx_description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $trx->created_at }}
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"> 
                                    <th scope="row" class="px-18 py-16 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center" colspan="5">
                                        No Transaction Data
                                        <br /><br />
                                        <a href="{{ route('topup.form') }}" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Top Up</a>

                                    </th>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="p-15 my-10">
                        {{ $transaction->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
