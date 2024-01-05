<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">

                @if (Auth::user()->userType == 'admin')
                    Administrator Dashboard
                @else
                    {{ __('Dashboard') }}
                @endif
            </h2>
            <div>
                You're logged in as {{ Auth::user()->userType }}
            </div>
    </x-slot>
    @if (Auth::user()->userType == 'donor')
        <form method="POST" action="{{route('changeAvailabilityStatus')}}">
            @csrf
            <div>

                <x-bladewind.toggle checked={{$availability}} name="availability" label="Change Availability Status" />
                <x-bladewind.button size="tiny" can_submit='true'>Save</x-bladewind.button>
            </div>
            <br>
        </form>
    @endif


    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <h3 class="text-x2 font-semibold leading-tight">
            Blood Availability Information
        </h3>

        
        <div id="div1" class="flex space-x-4 space-y-4"
            style="margin: 20px; display:flex; flex-direction:row;  flex-wrap:wrap ">

            <x-bladewind.statistic label_position="bottom" :number="$a_p" label="A+" />

            <x-bladewind.statistic label_position="bottom" :number="$b_p" label="B+" />

            <x-bladewind.statistic label_position="bottom" :number="$ab_p" label="AB+" />
            <x-bladewind.statistic label_position="bottom" :number="$o_p" label="O+" />
            <x-bladewind.statistic label_position="bottom" :number="$a_m" label="A-" />

            <x-bladewind.statistic label_position="bottom" :number="$b_m" label="B-" />

            <x-bladewind.statistic label_position="bottom" :number="$ab_m" label="AB-" />
            <x-bladewind.statistic label_position="bottom" :number="$o_m"  label="O-" />
        </div>

        <h3 class="text-x2 font-semibold leading-tight">
            User Information
        </h3>

        <div id="div2"
            style="margin: 20px; display:flex; flex-direction:row; justify-content:space-evenly; flex-wrap:wrap ">

            <x-bladewind.statistic label_position="bottom" :number="$total_users" label="Total Users" />

            <x-bladewind.statistic label_position="bottom" :number="$total_donors" label="Total Donors" />

            <x-bladewind.statistic label_position="bottom" :number="$total_staff" label="Total Bank Staff" />
            <x-bladewind.statistic label_position="bottom" :number="$total_hospitals" label="Total Hospitals" />
        </div>

    </div>



</x-app-layout>
