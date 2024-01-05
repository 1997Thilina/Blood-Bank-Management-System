<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Make An Appointment
            </h2>

        </div>
        <div>
            <br>
            <p>Your kindness has the power to save lives. By making a blood donation, you're taking a
                crucial step towards making a difference in someone's life.</p>
        </div>
        @if (session('success'))
            <div id="flash_message">
                <x-bladewind.alert type="success">
                    {{ session('success') }}
                </x-bladewind.alert>
            </div>
        @endif
        <form method="POST" action="{{ route('storeAppointment') }}">
            @csrf
            <div style="border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 16px; margin: 16px;">

                <br>
                <input type="date" class="inpt" id="et" name="date" required
                    style="border-radius: 5px; background-color: lightblue; color: rgb(39, 35, 35);">

                <div class='content'>
                    <div id="div1"
                        style="margin: 20px; display:flex; flex-direction:row; justify-content:space-evenly; flex-wrap:wrap ">
                    </div>

                    <input type="hidden" id="donorId" name="donorId" value={{ Auth::user()->id }}>
                    <input type="hidden" id="donorEmail" name="donorEmail" value={{ Auth::user()->email }}>
                    <input type="hidden" id="appointmentStatus" name="appointmentStatus" value="Pending">
                    <input type="hidden" id="NearestHospital" name="NearestHospital" value={{$NearestHospital[0]->hospital}}>

                    <div id="saveButton">
                        <input type="submit" value="Save"
                            style="padding: 10px 20px; background-color: #1a9aef; color: white; border: none; border-radius: 10px; cursor: pointer;">
                    </div>

                </div>

            </div>
        </form>

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between" >
            <h2 class="text-xl font-semibold leading-tight">
                View my appointments
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
                    @foreach ($my_appointments as $item)
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
                            <td> <x-bladewind.button size="tiny" can_submit="true">Cancel</x-bladewind.button>
                                {{-- <x-bladewind.button.circle icon="trash" size="tiny" color="red" /> --}}
                            </td>
                                <input type="hidden" name="cancel" value={{ $item->id }}>
                                <input type="hidden" name="status" value="Cancelled">
                                <input type="hidden" name="userEmail" value={{ $item->donorEmail }}>
                        </form>
                        
                       
                    </tr>
                    @endforeach
                    
                </x-bladewind.table>
        </div>
    </x-slot>
    <script>
        const dateElement = document.getElementById('et');
        const myDiv = document.getElementById('div1');
        const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const hours_data = @JSON($hours_data);
        const stored_appointment = @JSON($stored_appointment);

        const currentDate = new Date().toISOString().split('T')[0];
        //console.log(currentDate);
        dateElement.min = currentDate;

        dateElement.addEventListener('input', function(event) {
            console.log(dateElement.value);

            const selectedDate = new Date(dateElement.value);
            const dayOfWeek = daysOfWeek[selectedDate.getDay()];
            //console.log(dayOfWeek);
            const intervalMinutes = 30;
            myDiv.innerHTML = '';


            for (let i = 0; i < hours_data.length; i++) {

                if (hours_data[i].day == dayOfWeek && hours_data[i].isOpen) {

                    const startTime = new Date(`1970-01-01T${hours_data[i].startTime}`);
                    const endTime = new Date(`1970-01-01T${hours_data[i].endTime}`);
                    // console.log(hours_data[i].startTime);

                    // default_isOpen.checked =hours_data[i].isOpen;
                    for (let currentTime = startTime; currentTime <= endTime; currentTime.setMinutes(currentTime
                            .getMinutes() + intervalMinutes)) {
                        // const intervalItem = document.createElement('li');
                        intervalItem = currentTime.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        console.log(currentTime);
                        const hours = currentTime.getHours();
                        const minutes = currentTime.getMinutes();
                        // const seconds = currentTime.getSeconds();
                        const formattedHours = hours < 10 ? `0${hours}` : hours;
                        const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;

                        const intervalItem2 = `${formattedHours}:${formattedMinutes}:00`;

                        const labelElement = document.createElement('label');
                        let color;
                        let dis;

                        for (let i = 0; i < stored_appointment.length; i++) {

                            if (stored_appointment[i].date == dateElement.value && stored_appointment[i].time ==
                                intervalItem2 && stored_appointment[i].appointmentStatus !="Cancelled") {
                                color = 'red';
                                dis = 'disabled';
                            } else {

                                color = 'green';
                                dis = '';
                            }

                        }


                        labelElement.innerHTML =
                            `<label style="color:${color}"><input type="radio" class="option-input radio" id="time" style="margin:30px" name="time" value=${intervalItem2} required ${dis}/> ${intervalItem}</label>`;

                        myDiv.appendChild(labelElement);

                    }
                } else {
                    // const labelElement = document.createElement('label');

                    // labelElement.innerHTML =
                    //     `<div>
                //         <h2 style="margin:50px">No Available Appointments</h2></div>`;

                    // myDiv.appendChild(labelElement);
                    // break;
                }
            }


        });
    </script>

</x-app-layout>
