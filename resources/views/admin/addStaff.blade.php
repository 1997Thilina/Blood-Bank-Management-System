<x-app-layout>


    <x-slot name="header">
        {{-- <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
            
        </div> --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Add Staff Members
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
        <div style="margin: 50px">
            @php
                $staffType = [['label' => 'Blood Bank Staff', 'value' => 'Blood_Bank_Staff'], ['label' => ' Lab Technician', 'value' => 'Lab_Technician'],
                ['label' => ' Auditor', 'value' => 'Auditor']];
                $gender = [['label' => 'male', 'value' => 'male'], ['label' => ' female', 'value' => 'female']];

            @endphp
            <form method="POST"  action="{{ route('storeStaffMember') }}" class="signup-form">
                @csrf

                {{-- <h1 class="my-2 text-2xl font-light text-blue-900/80">Create Account</h1> --}}
                

                <x-form.input id="full_name" class="block w-full" type="text" name="full_name" :value="old('full_name')"
                    placeholder="{{ __('full name') }}" required autofocus />
                <br>
                <x-form.input id="email" class="block w-full" type="text" name="email" :value="old('email')"
                    placeholder="{{ __('Email (this email will be used for login)') }}" required autofocus />
                <br>
                <x-form.input id="password" class="block w-full" type="text" name="password" :value="old('password')"
                    placeholder="{{ __('Password') }}" required autofocus />
                <br>

                
                <x-form.label for="gender" :value="__('Gender')" />
                <x-bladewind.select name="gender" id="gender" :data="$gender" required='true' />

                <br>
                <div class="flex gap-4">

                    <x-form.input id="age" class="block w-full" type="number" name="age" :value="old('age')"
                        placeholder="{{ __('age') }}" required autofocus />


                    <x-form.input id="phone" class="block w-full" type="phone" name="phone" :value="old('phone')"
                        placeholder="{{ __('contact number') }}" required autofocus />
                </div>

                <br>
                <x-form.input id="nic" class="block w-full" type="text" name="nic" :value="old('nic')"
                    placeholder="{{ __('NIC Number') }}" required autofocus />
                <br>
                <x-form.label for="position" :value="__('Position')" />
                <x-bladewind.select name="possition" id="possition" :data="$staffType" required='true' />

                <br>
                {{-- <input type="hidden" name="userEmail" value={{ Auth::user()->email }}> --}}
                {{-- <input type="hidden" name="userId" value={{ Auth::user()->id }}> --}}

                <div class="text-center">


                    <x-bladewind.button name="btn-save" has_spinner="true" type="primary" can_submit="true"
                        class="mt-3">
                        Add Member
                    </x-bladewind.button>

                </div>

            </form>
        </div>

    </x-slot>

    {{-- <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{ __("You're logged in!") }}
    </div> --}}
    <x-bladewind.notification />






</x-app-layout>
