<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Add New Blood Stock
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
        <form method="POST" action="{{ route('storeBloodStock') }}">
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

                <x-form.label for="from" :value="__('From the Hospital :')" />
                <x-bladewind.select name="from" id="from" data="manual" required='true' searchable="true" >
                    @foreach ($hospitals as $item)
                    <x-bladewind.select-item label="{{$item->hospital_name}}" value="{{$item->id}}" />
                    @endforeach
                </x-bladewind.select>
                <br>

                <x-form.label for="et" :value="__('Expire Date')" />
                <input type="date" class="inpt" id="et" name="expireDate" required
                    style="border-radius: 5px; background-color: lightblue; color: rgb(39, 35, 35);">
                <br>
                

                    {{-- <input type="hidden" id="staffMemberEmail" name="staffMemberEmail" value={{ Auth::user()->email }}> --}}
                    <div id="saveButton">
                        <br>
                        <input type="submit" value="Save"
                            style="padding: 10px 20px; background-color: #1a9aef; color: white; border: none; border-radius: 10px; cursor: pointer;">
                    </div>
         

            </div>
        </form>
    </x-slot>

</x-app-layout>
