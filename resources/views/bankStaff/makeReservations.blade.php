<x-app-layout>
    <x-slot name="header">
        

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between" >
            <h2 class="text-xl font-semibold leading-tight">
                View And Manage Blood Requests 
            </h2>
             
        </div>
        @if (session('success'))
            <div id="flash_message">
                <x-bladewind.alert type="success">
                    {{ session('success') }}
                </x-bladewind.alert>
            </div>
        @endif 
            <div style="overflow-x: auto; margin:50px">
                <x-bladewind.table 
                searchable="true"
                
                >
                    <x-slot name="header">
                        <th>Request Id</th>
                        <th>user email</th>
                        <th>blood type</th>
                        <th>units</th>
                        <th>user type</th>
                        <th>status</th>
                        <th>message</th>
                        <th>created at</th>
                        <th>Actions</th>
                        
                    </x-slot>
                    @foreach ($request_history as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->userEmail}}</td>
                        <td>{{$item->bloodType}}</td>
                        <td>{{$item->units}}</td>
                        <td>{{$item->userType}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->message}}</td>
                        <td>{{$item->created_at}}</td>
                        <form method="POST" action="{{ route('changeBloodRequestStatus') }}">
                            @csrf
                            <td>
                                <div>
                                <select name="status" id="status" style="border-radius: 5px; height:35px; width:80px; background-color: rgb(107, 156, 172); color: rgb(39, 35, 35);">
                                    <option value="" disabled selected> Select</option>
                                    <option value="Reserved"> Reserved</option>
                                    <option value="Cancelled">Cancel</option>
        
                                  </select>
                                 <x-bladewind.button size="tiny" can_submit="true">update</x-bladewind.button>
                                {{-- <x-bladewind.button.circle icon="trash" size="tiny" color="red" /> --}}
                            </div>
                            </td>
                                <input type="hidden" name="cancel" value={{ $item->id }}>
                        </form>
                        
                       
                    </tr>
                    @endforeach
                    
                </x-bladewind.table>
        </div>
    </x-slot>


</x-app-layout>
