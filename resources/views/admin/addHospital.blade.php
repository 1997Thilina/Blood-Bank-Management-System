<x-app-layout>


    <x-slot name="header">
        {{-- <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
            
        </div> --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Add a new Hospital
            </h2>

        </div>
        @if (session('success'))
            <div id="flash_message">
                <x-bladewind.alert type="success">
                    {{ session('success') }}
                </x-bladewind.alert>
            </div>
        @endif
        <div style="margin: 50px">
            {{-- @php
                $bloodType = [['label' => 'Benin', 'value' => 'bj'], ['label' => 'Burkina Faso', 'value' => 'bf']];
                $gender = [['label' => 'male', 'value' => 'male'], ['label' => ' female', 'value' => 'female']];
                $hospital = [['label' => 'h1', 'value' => 'h1'], ['label' => ' h2', 'value' => 'h2']];
            @endphp --}}
            <form method="POST" action="{{ route('storeHospitals') }}" class="signup-form">
                @csrf

                <x-form.input id="hospital_name" class="block w-full" type="text" name="hospital_name" :value="old('hospital_name')"
                    placeholder="{{ __('Hospital name (Ex-: Cancer Hospital, Maharagama)') }}" required autofocus />
                <br>
                <x-form.input id="hospital_address" class="block w-full" type="text" name="hospital_address" :value="old('hospital_address')"
                    placeholder="{{ __('Hospital address (Ex-: City, Distric, providence)') }}" required autofocus />
                <br>
                <x-form.input id="hospital_email" class="block w-full" type="text" name="hospital_email" :value="old('hospital_email')"
                    placeholder="{{ __('Hospital Email') }}" required autofocus />
                <br>

                <div class="flex gap-4">

                    <x-form.input id="co0rdinator_name" class="block w-full" type="text" name="coordinator_name" :value="old('coordinator_name')"
                        placeholder="{{ __('Cordinator Name') }}" required autofocus />


                    <x-form.input id="phone" class="block w-full" type="phone" name="coordinator_phone" :value="old('coordinator_phone')"
                        placeholder="{{ __('contact number') }}" required autofocus />
                </div>
                <br>
                <div class="text-center">
                    <x-bladewind.button name="btn-save" has_spinner="true" type="primary" can_submit="true"
                        class="mt-3">
                        Add
                    </x-bladewind.button>
                </div>
            </form>

        </div>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between" >
            <h2 class="text-xl font-semibold leading-tight">
                View Registered Hospitals
            </h2>
             
        </div>
        
            <div style="overflow-x: auto; margin:50px">
                <x-bladewind.table 
                searchable="true"
                
                >
                    <x-slot name="header">
                        <th>id</th>
                        <th>hospital name</th>
                        <th>hospital address</th>
                        <th>hospital email</th>
                        <th>coordinator name</th>
                        <th>coordinator phone</th>
                        <th>created at</th>
                        <th>Actions</th>
                        
                    </x-slot>
                    @foreach ($hospitals as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->hospital_name}}</td>
                        <td>{{$item->hospital_address}}</td>
                        <td>{{$item->hospital_email}}</td>
                        <td>{{$item->coordinator_name}}</td>
                        <td>{{$item->coordinator_phone}}</td>
                        <td>{{$item->created_at}}</td>
                        <td> <x-bladewind.button size="tiny">remove</x-bladewind.button>
                            <x-bladewind.button.circle icon="trash" size="tiny" color="red" /></td>
                       
                    </tr>
                    @endforeach
                    
                </x-bladewind.table>
        </div>

    </x-slot>

</x-app-layout>
