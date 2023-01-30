<div>

    <div class="py-12 flex">
        filters:
        <div>
            <select wire:model="filters.platforms" class="form-select" multiple id="platforms">
                <option value="all">All</option>
                <option value="mercari">mercari</option>
                <option value="ebay">ebay</option>
                <option value="poshmark">poshmark</option>
            </select>
        </div>
        <div>
            {{-- create label for start date --}}
            Start Date

            <input type='date' wire:model="filters.dateStart" class="form-select" multiple id="dateStart">
            End Date
            <input type='date' wire:model="filters.dateEnd" class="form-select" multiple id="dateStart">


            {{-- <select wire:model="filters.platforms" class="form-select" multiple id="platforms">
                <option value="all">All</option>
                <option value="mercari">mercari</option>
                <option value="ebay">ebay</option>
                <option value="poshmark">poshmark</option>
            </select> --}}
        </div>
    </div>

    Be like water.
    <table>
        <thead>
            <td class="text-bold text-2xl text-center">
                customer_id
            </td>
            <td class="text-bold text-2xl text-center">
                total
            </td>
            {{-- <td class="text-bold text-2xl text-center">
                date
            </td> --}}
            <td class="text-bold text-2xl text-center">
                status
            </td>
            {{-- <td class="text-bold text-2xl px-2 text-center">
                activeListingMercari
            </td>
            <td class="text-bold text-2xl px-2 text-center">
                activeListingEbay
            </td>
            <td class="text-bold text-2xl px-2 text-center">
                activeListingPoshmark
            </td> --}}
        </thead>
        {{-- {{dd($customers)}} --}}
        @foreach($customers as $customer)

        {{-- {{dd($customer)}} --}}
        <tr class="bg-white border-b hover:bg-gray-100">
            {{-- <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{$customer->id }}
            </td> --}}
            <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ $customer->customer_id }}
            </td>
            {{-- <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ $customer->date }}
            </td> --}}
            <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap border-2 border-red-500 ">
                {{$customer?->total_active_listing}}

            </td>
            <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap border-2 border-red-500 ">
                {{$customer?->statusName}}
            </td>

            {{-- <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ $customer->activeListingMercari }}
            </td>

            <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ $customer->activeListingEbay }}
            </td>
            <td class="px-4 py-2 text-sm font-medium text-gray-500 whitespace-nowrap">
                {{ $customer->activeListingPoshmark }}
            </td> --}}
        </tr>
        @endforeach
    </table>


</div>
