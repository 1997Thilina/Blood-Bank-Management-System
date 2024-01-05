<x-app-layout>


    <x-slot name="header">
        {{-- <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
            
        </div> --}}

        <style>
            .error {
                color: red;
            }
        </style>

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Add Blood Type Info
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

            <form method="POST" action="{{ route('storeBloodTypes') }}" id="bloodTypeForm" class="signup-form">
                @csrf

                {{-- <x-form.input id="BloodType" class="block w-full" type="text" name="BloodType" :value="old('BloodType')"
                    placeholder="{{ __('Blood Type') }}" required autofocus /> --}}
                    
                    
                    <div>
                        <label for="BloodType" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                        <input type="text" id="BloodType" name="BloodType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter blood type.." required>
                    </div>
                   
                    <span id="bloodTypeError" class="error"></span>
                    <br>

                <textarea id="Description" rows="4" name="Description"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="description" required></textarea>


                <input type="hidden" name="TotalUnits" value="">
                <br>
                <div class="text-center">
                    <x-bladewind.button name="btn-save" has_spinner="true" type="primary" 
                        class="mt-3" onclick="validateBloodType()">
                        ADD
                    </x-bladewind.button>
                </div>
            </form>

        </div>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                View Available Blood Types
            </h2>

        </div>
        <div>
            <div style="overflow-x: auto; padding:50px">
                <x-bladewind.table searchable="false">
                    <x-slot name="header">
                        <th>id</th>
                        <th>Blood Type</th>
                        <th>Description</th>
                        <th>Total Units</th>
                        <th>Actions</th>

                    </x-slot>
                    @foreach ($bloodTypes as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->bloodType }}</td>
                            <td>{{ $item->Description }}</td>
                            <td>{{ $item->TotalUnits }}</td>

                            <form method="POST" id="deleteForm" action="{{ route('deleteBloodTypes') }}">
                                @csrf
                        
                                <td> <x-bladewind.button size="tiny" can_submit='true'>remove</x-bladewind.button></td>
                            <input type="hidden" name="bloodType"  id="bloodType" value="{{ $item->id }}">

                        </form>
                           

                        </tr>
                    @endforeach

                </x-bladewind.table>
            </div>

    </x-slot>
<script>
    function validateBloodType() {
        var bloodTypeInput = document.getElementById('BloodType').value;
        console.log(bloodTypeInput);
        var bloodTypeError = document.getElementById('bloodTypeError');

        // Use a regular expression to validate blood type
        var bloodTypePattern = /^(A|B|AB|O)[\+\-]$/;

        if (!bloodTypePattern.test(bloodTypeInput)) {
            bloodTypeError.textContent = 'Invalid blood type. Please refresh the page and enter a valid blood type (A, B, AB, O) with positive (+) or negative (-).';
        } else {
            bloodTypeError.textContent = '';
            // Submit the form or perform additional actions
            document.getElementById('bloodTypeForm').submit();
        }
    }
</script>

</x-app-layout>
