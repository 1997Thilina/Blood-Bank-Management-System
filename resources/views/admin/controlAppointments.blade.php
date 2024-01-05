<x-app-layout>
    <x-slot name="header">
        

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between" >
            <h2 class="text-xl font-semibold leading-tight">
                View Available appointments
            </h2>
             
        </div> 
            <div style="overflow-x: auto; margin:50px">
                <x-bladewind.table 
                searchable="true"
                
                >
                    <x-slot name="header">
                        <th>appointment Id</th>
                        <th>Donor email</th>
                        <th>Date</th>
                        <th>time</th>
                        <th>Status</th>
                        <th>Hospital</th>
                        <th>created at</th>
                        <th>Actions</th>
                        
                    </x-slot>
                    @foreach ($stored_appointments as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->donorEmail}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->time}}</td>
                        <td>{{$item->appointmentStatus}}</td>
                        <td>{{$item->NearestHospital}}</td>
                        <td>{{$item->created_at}}</td>
                        <form method="POST" action="{{ route('changeAppointmentStatus') }}">
                            @csrf
                            <td>
                                <div>
                                <select name="status" id="status" style="border-radius: 5px; height:35px; width:80px; background-color: rgb(107, 156, 172); color: rgb(39, 35, 35);">
                                    <option value="Pending">Pending</option>
                                    <option value="Scheduled">Scheduled</option>
                                    <option value="Cancelled">Donated</option>
                                    <option value="Cancelled">Cancelled</option>
                                  </select>
                                 <x-bladewind.button size="tiny" can_submit="true">Save</x-bladewind.button>
                                {{-- <x-bladewind.button.circle icon="trash" size="tiny" color="red" /> --}}
                            </div>
                            </td>
                                <input type="hidden" name="cancel" value={{ $item->id }}>
                                {{-- <input type="hidden" name="userEmail" value={{ $item->donorEmail }}> --}}
                        </form>
                        
                       
                    </tr>
                    @endforeach
                    
                </x-bladewind.table>
        </div>
    </x-slot>


</x-app-layout>
