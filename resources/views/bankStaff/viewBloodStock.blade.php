<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Blood Stock Entry Details 
            </h2>

        </div>
        <div>
            <br>
            <a href="{{ route('generateBloodReport') }}">
                <x-bladewind.button size="tiny">Generate Report</x-bladewind.button>
            </a>
        </div>

        <div class="py-6">
            <x-bladewind.tab-group name="free-pics">

                <x-slot name="headings">
                    <x-bladewind.tab-heading name="unsplash-1" active="true" label="All Stock Details" />

                    <x-bladewind.tab-heading name="unsplash-2" label="60 Days To Expire" />

                    <x-bladewind.tab-heading name="unsplash-3" label="Expired" />

                </x-slot>

                <x-bladewind.tab-body>
                    @php
                        $action_icons = ["icon:chat-bubble-left | tip:send user a message | color:green | click:sendMessage('{first_name}', '{last_name}')", "icon:pencil | click:redirect('/user/{id}')", "icon:trash | color:red | click:deleteUser({id}, '{first_name}', '{last_name}')"];

                    @endphp

                    <x-bladewind.tab-content active="true" name="unsplash-1">
                        <div style="overflow-x: auto">
                            <x-bladewind.table searchable="true">
                                <x-slot name="header">
                                    <th>Id</th>
                                    <th>Blood Type</th>
                                    <th>units</th>
                                    <th>status</th>
                                    <th>expire Date</th>
                                    <th>hospital id</th>
                                    <th>created at</th>
                                    {{-- <th>Actions</th> --}}

                                </x-slot>
                                @foreach ($bloodStock_details_1 as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->bloodType }}</td>
                                        <td>{{ $item->units }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->expireDate }}</td>
                                        <td>{{ $item->hospital_id }}</td>
                                        <td>{{ $item->created_at }}</td>

                                    </tr>
                                @endforeach

                            </x-bladewind.table>

                        </div>
                    </x-bladewind.tab-content>

                    <x-bladewind.tab-content name="unsplash-2">
                        <div style="overflow-x: auto">
                            <x-bladewind.table searchable="true">
                                <x-slot name="header">
                                    <th>Id</th>
                                    <th>Blood Type</th>
                                    <th>units</th>
                                    <th>status</th>
                                    <th>expire Date</th>
                                    <th>hospital id</th>
                                    <th>created at</th>
                                    {{-- <th>Actions</th> --}}

                                </x-slot>
                                @foreach ($bloodStock_details_2 as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->bloodType }}</td>
                                        <td>{{ $item->units }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->expireDate }}</td>
                                        <td>{{ $item->hospital_id }}</td>
                                        <td>{{ $item->created_at }}</td>

                                    </tr>
                                @endforeach

                            </x-bladewind.table>

                        </div>
                    </x-bladewind.tab-content>

                    <x-bladewind.tab-content name="unsplash-3">
                        <div style="overflow-x: auto">
                            <x-bladewind.table searchable="true">
                                <x-slot name="header">
                                    <th>Id</th>
                                    <th>Blood Type</th>
                                    <th>units</th>
                                    <th>status</th>
                                    <th>expire Date</th>
                                    <th>hospital id</th>
                                    <th>created at</th>
                                    {{-- <th>Actions</th> --}}

                                </x-slot>
                                @foreach ($bloodStock_details_3 as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->bloodType }}</td>
                                        <td>{{ $item->units }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->expireDate }}</td>
                                        <td>{{ $item->hospital_id }}</td>
                                        <td>{{ $item->created_at }}</td>

                                    </tr>
                                @endforeach

                            </x-bladewind.table>

                        </div>
                    </x-bladewind.tab-content>


                </x-bladewind.tab-body>

            </x-bladewind.tab-group>
        </div>
    </x-slot>


</x-app-layout>
