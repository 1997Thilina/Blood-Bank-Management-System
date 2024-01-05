<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Dashboard"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    {{-- <x-sidebar.dropdown
        title="Buttons"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Text button"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
        <x-sidebar.sublink
            title="Icon button"
            href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')"
        />
        <x-sidebar.sublink
            title="Text with icon"
            href="{{ route('buttons.text-icon') }}"
            :active="request()->routeIs('buttons.text-icon')"
        />
    </x-sidebar.dropdown> --}}
    {{-- @if (Auth::user())
    <div>{{ Auth::user()->userType }}</div>
    @endif --}}
    

    {{-- <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
        Dummy Links
    </div> --}}

    @php
        $links = array_fill(0, 20, '');
         //echo  $hospitals ;
    @endphp

    @foreach ($links as $index => $link)
        {{-- <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" /> --}}
    @endforeach
    
    @if (Auth::user()->userType == 'admin')

    <x-sidebar.link title="User Management" href="{{ route('viewUserManagement') }}" />
    <x-sidebar.link title="Add Staff Members " href="{{ route('viewAddStaff') }}" />
    <x-sidebar.link title="View and Add Hospitals" href="{{ route('viewHospitals') }}" />

    <x-sidebar.link title="Send Emails" href="{{ route('viewManageEmails') }}" />
    
    <x-sidebar.link title="Manage Blood Stocks" href="{{ route('viewAddBloodStock') }}" />
    <x-sidebar.link title="Blood Stock Details" href="{{ route('viewBloodStockDetails') }}" />
    <x-sidebar.link title="Generate Stock Report" href="{{ route('generateBloodReport') }}" />

    <x-sidebar.link title="Manage Blood Requests" href="{{ route('viewMakeReservation') }}" />

    <x-sidebar.link title="Manage Appointments" href="{{ route('ViewControlAppointment') }}" />

    <x-sidebar.link title="Update Working Hours" href="{{ route('viewAddWorkingHours') }}" />
    <x-sidebar.link title="Add Blood Types" href="{{ route('viewAddBloodTypes') }}" />
    
    @endif

    @if (Auth::user()->userType == 'Blood_Bank_Staff')

    {{-- <x-sidebar.link title="Become A Donor" href="{{ route('viewBecomeDonor') }}" /> --}}
    <x-sidebar.link title="Manage Blood Stocks" href="{{ route('viewAddBloodStock') }}" />
    <x-sidebar.link title="Blood Stock Details" href="{{ route('viewBloodStockDetails') }}" />
    <x-sidebar.link title="Generate Stock Report" href="{{ route('generateBloodReport') }}" />

    <x-sidebar.link title="Manage Blood Requests" href="{{ route('viewMakeReservation') }}" />
    <x-sidebar.link title="Manage Appointments" href="{{ route('ViewControlAppointment') }}" />

    <x-sidebar.link title="Send Emails" href="{{ route('viewManageEmails') }}" />

    @endif

    @if (Auth::user()->userType == 'user')

    <x-sidebar.link title="Become A Donor" href="{{ route('viewBecomeDonor') }}" />
    <x-sidebar.link title="Register As Hospital/Clnic Staff " href="{{ route('viewBecomeHcStaff') }}" />

    @endif

    @if (Auth::user()->userType == 'donor')

    <x-sidebar.link title="Make an Appointment" href="{{ route('viewMakeAppointment') }}" />
    {{-- <x-sidebar.link title="Make a Blood Request" href="{{ route('viewRequestBloodUnits') }}" /> --}}

    @endif

    <x-sidebar.link title="Request Blood Units" href="{{ route('viewRequestBloodUnits') }}" />
    <x-sidebar.link title="User Feedbacks" href="{{ route('viewRatings') }}" />


</x-perfect-scrollbar>
