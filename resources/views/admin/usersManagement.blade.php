<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Users Management
            </h2>

        </div>
    </x-slot>

    {{-- <p class="py-4 text-gray-600 dark:text-gray-400">Users Management.</p> --}}



    <div class="py-6">
        <x-bladewind.tab-group name="free-pics">

            <x-slot name="headings">
                <x-bladewind.tab-heading name="unsplash-1" active="true" label="All Users" />

                <x-bladewind.tab-heading name="unsplash-2" label="Blood Bank Staff" />

                <x-bladewind.tab-heading name="unsplash-3" label="Donors" />

                <x-bladewind.tab-heading name="unsplash-4" label="Hospital And Clinic Staff" />
            </x-slot>

            <x-bladewind.tab-body>
                @php
                    $action_icons = ["icon:chat-bubble-left | tip:send user a message | color:green | click:sendMessage('{first_name}', '{last_name}')", "icon:pencil | click:redirect('/user/{id}')", "icon:trash | color:red | click:deleteUser({id}, '{first_name}', '{last_name}')"];

                @endphp

                <x-bladewind.tab-content active="true" name="unsplash-1">
                    <div style="overflow-x: auto">
                        <x-bladewind.table searchable="true">
                            <x-slot name="header">
                                <th>id</th>
                                <th>name</th>
                                <th>email</th>
                                <th>userType</th>
                                <th>created_at</th>
                                <th>Actions</th>

                            </x-slot>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->userType }}</td>
                                    <td>{{ $item->created_at }}</td>

                                    {{-- <x-bladewind.button size="tiny">remove</x-bladewind.button>
                                <x-bladewind.button.circle icon="trash" size="tiny" color="red" /> --}}
                                    <form method="POST" id="deleteForm" action="{{ route('deleteUsers') }}">
                                        @csrf
                                        <td>
                                            <div>
                                                <x-bladewind.button size="tiny" can_submit='true'
                                                    onclick="confirmDelete(event, '{{ $item->email }}', '{{ $item->userType }}')">Delete</x-bladewind.button>
                                            </div>
                                        </td>
                                        <br>
                                    

                                    <input type="hidden" name="userEmail" id="userEmail" >
                                    <input type="hidden" name="tableType" value="users">
                                    <input type="hidden" name="userType"  id="userType">

                                </form>
                                </tr>
                            @endforeach

                        </x-bladewind.table>
                        <br>
                        <div class="pagination">
                            {{ $users->links() }}
                        </div>
                    </div>
                </x-bladewind.tab-content>

                <x-bladewind.tab-content name="unsplash-2">
                    <div style="overflow-x: auto">
                        <x-bladewind.table searchable="true">
                            <x-slot name="header">
                                <th>id</th>
                                <th>name</th>
                                <th>email</th>
                                <th>userType</th>
                                <th>created_at</th>
                                <th>Actions</th>

                            </x-slot>
                            @foreach ($users as $item)
                            @if ($item->userType =='Blood_Bank_Staff')
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->userType }}</td>
                                    <td>{{ $item->created_at }}</td>

                                    {{-- <x-bladewind.button size="tiny">remove</x-bladewind.button>
                                <x-bladewind.button.circle icon="trash" size="tiny" color="red" /> --}}
                                    <form method="POST" id="deleteForm" action="{{ route('deleteUsers') }}">
                                        @csrf
                                        <td>
                                            <div>
                                                <x-bladewind.button size="tiny" can_submit='true'
                                                    onclick="confirmDelete(event, '{{ $item->email }}', '{{ $item->userType }}')">Delete</x-bladewind.button>
                                            </div>
                                        </td>
                                        <br>
                                    

                                    <input type="hidden" name="userEmail" id="userEmail" >
                                    <input type="hidden" name="tableType" value="Blood_Bank_Staff">
                                    <input type="hidden" name="userType"  id="userType">

                                </form>
                                </tr>
                                @endif
                            @endforeach

                        </x-bladewind.table>
                        <br>
                        <div class="pagination">
                            {{ $users->links() }}
                        </div>
                    </div>
                </x-bladewind.tab-content>

                <x-bladewind.tab-content name="unsplash-3">
                    <div style="overflow-x: auto">
                        <x-bladewind.table searchable="true">
                            <x-slot name="header">
                                <th>id</th>
                                <th>name</th>
                                <th>email</th>
                                <th>userType</th>
                                <th>created_at</th>
                                <th>Actions</th>

                            </x-slot>
                            @foreach ($users as $item)
                            @if ($item->userType =='donor')
                                
                            
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->userType }}</td>
                                    <td>{{ $item->created_at }}</td>

                                    {{-- <x-bladewind.button size="tiny">remove</x-bladewind.button>
                                <x-bladewind.button.circle icon="trash" size="tiny" color="red" /> --}}
                                    <form method="POST" id="deleteForm" action="{{ route('deleteUsers') }}">
                                        @csrf
                                        <td>
                                            <div>
                                                <x-bladewind.button size="tiny" can_submit='true'
                                                    onclick="confirmDelete(event, '{{ $item->email }}', '{{ $item->userType }}')">Delete</x-bladewind.button>
                                            </div>
                                        </td>
                                        <br>
                                    

                                    <input type="hidden" name="userEmail" id="userEmail" >
                                    <input type="hidden" name="tableType" value="donor">
                                    <input type="hidden" name="userType"  id="userType">

                                </form>
                                </tr>
                                @endif
                            @endforeach

                        </x-bladewind.table>
                        <br>
                        <div class="pagination">
                            {{ $users->links() }}
                        </div>
                    </div>
                </x-bladewind.tab-content>

                <x-bladewind.tab-content name="unsplash-4">
                    <div style="overflow-x: auto">
                        <x-bladewind.table searchable="true">
                            <x-slot name="header">
                                <th>id</th>
                                <th>name</th>
                                <th>email</th>
                                <th>userType</th>
                                <th>created_at</th>
                                <th>Actions</th>

                            </x-slot>
                            @foreach ($users as $item)
                            @if ($item->userType =='HcStaff')
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->userType }}</td>
                                    <td>{{ $item->created_at }}</td>

                                    {{-- <x-bladewind.button size="tiny">remove</x-bladewind.button>
                                <x-bladewind.button.circle icon="trash" size="tiny" color="red" /> --}}
                                    <form method="POST" id="deleteForm" action="{{ route('deleteUsers') }}">
                                        @csrf
                                        <td>
                                            <div>
                                                <x-bladewind.button size="tiny" can_submit='true'
                                                    onclick="confirmDelete(event, '{{ $item->email }}', '{{ $item->userType }}')">Delete</x-bladewind.button>
                                            </div>
                                        </td>
                                        <br>
                                    

                                    <input type="hidden" name="userEmail" id="userEmail" >
                                    <input type="hidden" name="tableType" value="HcStaff">
                                    <input type="hidden" name="userType"  id="userType">

                                </form>
                                </tr>
                                @endif
                            @endforeach

                        </x-bladewind.table>
                        <br>
                        <div class="pagination">
                            {{ $users->links() }}
                        </div>
                        
                    </div>
                </x-bladewind.tab-content>

            </x-bladewind.tab-body>

        </x-bladewind.tab-group>
    </div>

    <script>
        function confirmDelete(event,userEmail, userType) {
            console.log(userType);
            event.preventDefault();
            document.getElementById('userEmail').value = userEmail;
            document.getElementById('userType').value = userType;

            if (confirm('Are you sure you want to delete?')) {
                document.getElementById('deleteForm').submit();
            } else {
                // User clicked Cancel
            }
        }
    </script>
</x-app-layout>
