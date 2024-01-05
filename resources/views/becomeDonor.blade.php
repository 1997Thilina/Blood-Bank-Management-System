<x-app-layout>


    <x-slot name="header">
        {{-- <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
            
        </div> --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Become a Donor
            </h2>

        </div>
        <div style="margin: 50px">
            @php
                $bloodType = [['label' => 'A+', 'value' => 'A+'], ['label' => ' B+', 'value' => 'B+'], ['label' => ' AB+', 'value' => 'AB+'], ['label' => ' O+', 'value' => 'O+'],
            ['label' => 'A-', 'value' => 'A-'], ['label' => ' B-', 'value' => 'B-'], ['label' => ' AB-', 'value' => 'AB-'], ['label' => ' O-', 'value' => 'O-']];
                $gender = [['label' => 'male', 'value' => 'male'], ['label' => ' female', 'value' => 'female']];

            @endphp
            <form method="POST" action="{{ route('StoreDonor') }}" class="signup-form">
                @csrf

                {{-- <h1 class="my-2 text-2xl font-light text-blue-900/80">Create Account</h1> --}}
                <p class="mt-3 mb-6 text-blue-900/80 text-sm">
                    Your kindness has the power to save lives. By registering for blood donation, you're taking a
                    crucial step towards making a difference in someone's life.
                </p>
                <div>
                    @if (session('success'))
                        <div id="flash_message">
                            <x-bladewind.alert type="success">
                                {{ session('success') }}
                            </x-bladewind.alert>
                        </div>
                    @endif
                </div>

                <x-form.input id="full_name" class="block w-full" type="text" name="full_name" :value="old('full_name')"
                    placeholder="{{ __('full name') }}" required autofocus />
                <br>

                <x-form.label for="bloodType" :value="__('Blood Type')" />
                <x-bladewind.select name="bloodType" id="bloodType" data="manual" required='true' searchable="true" >
                    @foreach ($bloodTypes as $item)
                    <x-bladewind.select-item label="{{$item->bloodType}}" value="{{$item->bloodType}}" />
                    @endforeach   
                </x-bladewind.select>
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
                <x-form.label for="hospital" :value="__('Nearest Hospital')" />
                <x-bladewind.select name="hospital" id="hospital" data="manual" required='true' searchable="true" >
                    @foreach ($hospitals as $item)
                    <x-bladewind.select-item label="{{$item->hospital_name}}" value="{{$item->hospital_name}}" />
                    @endforeach
                    
                </x-bladewind.select>
                <x-bladewind.textarea required="true" name="bio"
                    label="Health history and any recent illnesses or infections">

                </x-bladewind.textarea>

                <input type="hidden" name="userEmail" value={{ Auth::user()->email }}>
                <input type="hidden" name="userId" value={{ Auth::user()->id }}>

                <div class="text-center">


                    <x-bladewind.button name="btn-save" has_spinner="true" type="primary" can_submit="true"
                        class="mt-3">
                        Sign Up Today
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
