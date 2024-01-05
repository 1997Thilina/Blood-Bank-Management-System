<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{-- {{ __('Dashboard') }} --}}
                Update Working Hours
            </h2>
        </div>
        <div>
            @if (session('success'))
                <div id="flash_message">
                    <x-bladewind.alert type="success">
                        {{ session('success') }}
                    </x-bladewind.alert>
                </div>
            @endif
        </div>


        <div>
            <form method="POST" action="{{ route('storeWorkingHours') }}" id="workingHoursForm">
                @csrf
                <div style="overflow-x: auto; padding: 50px; padding-Top:20px">
                    <x-bladewind.table searchable="false">
                        <x-slot name="header">
                            <th>Day</th>
                            <th>Is open</th>
                            <th>Opening Time</th>
                            <th>Closing Time</th>

                        </x-slot>

                        @php
                            $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                        @endphp

                        @foreach ($daysOfWeek as $item)
                            <tr>
                                <td>
                                    <label id="label_day">{{ $item }}</label>
                                    <input type="hidden" name="day[]" id="day" value="">
                                </td>
                                <td>
                                    <input type="checkbox" id="isOpen" class="isOpenClass">
                                </td>
                                <td>
                                    <input type="time" class="inpt" id="st"
                                        style="border-radius: 5px; background-color: lightblue; color: rgb(39, 35, 35);">
                                </td>
                                <td>
                                    <input type="time" class="inpt" id="et"
                                        style="border-radius: 5px; background-color: lightblue; color: rgb(39, 35, 35);">
                                </td>
                                <input type="hidden" id='isOpenSet' name='isOpen[]'>
                                <input type="hidden" id='start_time' name='start_time[]'>
                                <input type="hidden" id='end_time' name='end_time[]'>
                            </tr>
                        @endforeach
                    </x-bladewind.table>
                    



                </div>
                <div style="text-align: right; margin-Right: 70px">
                    <label>
                        Check this to change time Status :
                        <input type="checkbox" id="disableCheckbox" onchange="toggleInput()">
                    </label>
                    <br>
                    <div id="saveButton">
                        <input type="submit" value="Save"
                            style="padding: 10px 20px; background-color: #1a9aef; color: white; border: none; border-radius: 10px; cursor: pointer;">
                        {{-- <x-bladewind.button id="saveButton" onclick="saveWorkingHours()"
                            size="small">Save</x-bladewind.button> --}}
                    </div>
                </div>
            </form>
        </div>
    </x-slot>




    <script>
        function toggleInput() {

            const isDisabled = document.getElementById('disableCheckbox').checked;
            var elements = document.getElementsByClassName('inpt');
            var elements2 = document.getElementsByClassName('isOpenClass');

            for (var i = 0; i < elements.length; i++) {
                elements[i].disabled = !isDisabled;
            }
            for (var i = 0; i < elements2.length; i++) {
                elements2[i].disabled = !isDisabled;
            }
        }
        toggleInput();

        //const currentTime = new Date();
        //console.log(currentTime);
        // const currentHours = currentTime.getHours().toString().padStart(2, '0');
        // const currentMinutes = currentTime.getMinutes().toString().padStart(2, '0');
        // const currentTimeString = `${currentHours}:${currentMinutes}`;
    </script>

    {{-- <script>
        document.getElementById('flash_message').style.display = 'none';

        function saveWorkingHours() {
            var formDataArray = [];

            @foreach ($daysOfWeek as $item)
                var dayObject = {};
                dayObject['day'] = '{{ $item }}';
                dayObject['isOpen'] = document.querySelector("#st_{{ $item }}").closest('tr').querySelector(
                    'input[name="isOpen[]"]').checked;
                dayObject['startTime'] = document.querySelector("#st_{{ $item }}").value;
                dayObject['endTime'] = document.querySelector("#et_{{ $item }}").value;

                formDataArray.push(dayObject);
            @endforeach

            axios.post('{{ route('storeWorkingHours') }}', {
                    workingHours:JSON.stringify(formDataArray)
                })
                .then(response => {
                    console.log('this is resp');
                    console.log(response.data);

                    document.getElementById('flash_message').style.display = 'block';
                    setTimeout(function() {
                        document.getElementById('flash_message').style.display = 'none';
                        window.location.reload();

                    }, 8000);

                })
                .catch(error => {
                    console.error(error);
                    if (error.response) {
                        console.error('Response data:', error.response.data);
                    }
                });

            console.log(formDataArray);
        }
    </script> --}}

    <script>
        //////////////////////////////start time///////////////////////////////////////////
        const inputFieldsSt = document.querySelectorAll('#st');

        for (const inputField of inputFieldsSt) {


            inputField.addEventListener('input', function(event) {
                const targetInput = event.target;
                const parentRow = targetInput.closest('tr');
                const set_start_time = parentRow.querySelector('#start_time');
                const min_end_time = parentRow.querySelector('#et');
                const set_day = parentRow.querySelector('#day');
                const day = parentRow.querySelector('#label_day').textContent;
                const isOpen = parentRow.querySelector('#isOpen');
                const set_isOpen = parentRow.querySelector('#isOpenSet');

                // targetInput.min = currentTimeString;
                const inputValue = targetInput.value; // Get the current entry quantity
                set_start_time.value = inputValue;
                min_end_time.min = inputValue; //.toString();
                set_day.value = day;
                set_isOpen.checked = isOpen.checked;

            });
        }
        //////////////////////end time////////////////////////////////////////////
        const inputFieldsEt = document.querySelectorAll('#et');

        for (const inputField of inputFieldsEt) {

            inputField.addEventListener('input', function(event) {
                const targetInput = event.target;
                const parentRow = targetInput.closest('tr');
                const set_end_time = parentRow.querySelector('#end_time');
                const set_day = parentRow.querySelector('#day');
                const day = parentRow.querySelector('#label_day').textContent;
                const isOpen = parentRow.querySelector('#isOpen');
                const set_isOpen = parentRow.querySelector('#isOpenSet');

                const inputValue = targetInput.value; // Get the current entry quantity
                set_end_time.value = inputValue;
                set_day.value = day;
                set_isOpen.checked = isOpen.checked;
            });
        }
        ////////////////////// open/active status////////////////////////////
        const inputFieldsIsOpen = document.querySelectorAll('#isOpen');

        for (const inputField of inputFieldsIsOpen) {

            inputField.addEventListener('input', function(event) {
                const targetInput = event.target;
                const parentRow = targetInput.closest('tr');
                const set_isOpen = parentRow.querySelector('#isOpenSet');
                const set_day = parentRow.querySelector('#day');
                const day = parentRow.querySelector('#label_day').textContent;

                const inputValue = targetInput.checked; // Get the current entry quantity

                set_isOpen.value = inputValue;
                set_day.value = day;
                // if (inputValue) {
                //     set_day.value = day;
                // }else{
                //     set_day.value = "";
                // }
                // console.log(inputValue);
            });
        }
        ////////////////////////////////////show saved values/////////////////////////

        document.addEventListener('DOMContentLoaded', function() {
            const inputFieldsAll = document.querySelectorAll('#label_day');
            const hours_data = @JSON($hours_data);
            //console.log(hours_data);
            //console.log(hours_data[0].day);

            for (const inputField of inputFieldsAll) {

                const parentRow = inputField.closest('tr');
                const default_start_time = parentRow.querySelector('#st');
                const default_end_time = parentRow.querySelector('#et');
                const default_isOpen = parentRow.querySelector('#isOpen');

                for (let i = 0; i < hours_data.length; i++) {

                    if (hours_data[i].day == inputField.textContent) {
                        //console.log('matched');
                        default_start_time.value = hours_data[i].startTime;
                        default_end_time.value = hours_data[i].endTime; //.toString();
                        default_isOpen.checked = hours_data[i].isOpen;
                    }
                }
            }
        });
    </script>


</x-app-layout>
