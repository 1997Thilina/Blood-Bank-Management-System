<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Request For Blood Units
            </h2>

        </div>
      
        @if (session('success'))
            <div id="flash_message">
                <x-bladewind.alert type="success">
                    {{ session('success') }}
                </x-bladewind.alert>
            </div>
        @endif

        @php
            $bloodType = [['label' => 'A+', 'value' => 'A+'], ['label' => ' B+', 'value' => 'B+'], ['label' => ' AB+', 'value' => 'AB+'], ['label' => ' O+', 'value' => 'O+'],
            ['label' => 'A-', 'value' => 'A-'], ['label' => ' B-', 'value' => 'B-'], ['label' => ' AB-', 'value' => 'AB-'], ['label' => ' O-', 'value' => 'O-']];
        @endphp
        <form method="POST" action="{{ route('storeRequestBloodUnits') }}">
            @csrf
            <div style="border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 16px; margin: 16px;">

                <x-form.label for="bloodType" :value="__('Blood Type')" />
                <x-bladewind.select name="bloodType" id="bloodType" data="manual" required='true' searchable="true" >
                    @foreach ($bloodTypes as $item)
                    <x-bladewind.select-item label="{{$item->bloodType}}" value="{{$item->bloodType}}" />
                    @endforeach   
                </x-bladewind.select>
                <br>

                <x-form.input id="units" class="block w-full" type="number" name="units" :value="old('units')"
                    placeholder="{{ __('Number of blood units') }}" required autofocus />
                <br>

                <textarea id="Description" rows="4" name="message" 
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="message"></textarea>
                

                    {{-- <input type="hidden" id="staffMemberEmail" name="staffMemberEmail" value={{ Auth::user()->email }}> --}}
                    <div id="saveButton">
                        <br>
                        <input type="submit" value="Send"
                            style="padding: 10px 20px; background-color: #1a9aef; color: white; border: none; border-radius: 10px; cursor: pointer;">
                    </div>
         

            </div>
        </form>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between" >
            <h2 class="text-xl font-semibold leading-tight">
                Request History
            </h2>
             
        </div> 
            <div style="overflow-x: auto; margin:50px">
                <x-bladewind.table 
                searchable="true"
                
                >
                    <x-slot name="header">
                        <th>Request Id</th>
                        <th>user email</th>
                        <th>user type</th>
                        <th>blood type</th>
                        <th>units</th>
                        <th>Status</th>
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
                                    @if ($item->status == 'Pending')
                                    <option value="" disabled selected> Select</option>
                                    <option value="Cancelled">Cancel</option>
                                    @else 
                                    <option value="" disabled selected>{{$item->status}}</option>
                                    @endif
                                   
                                    
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
