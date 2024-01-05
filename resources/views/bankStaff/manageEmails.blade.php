<x-app-layout>


    <x-slot name="header">

        <style>
            .error {
                color: red;
            }
        </style>

        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Send Emails To Donors
            </h2>

        </div>
        @if (session('success'))
            <div id="flash_message">
                <x-bladewind.alert type="success">
                    {{ session('success') }}
                </x-bladewind.alert>
            </div>
        @endif
        @if (session('error'))
            <div id="flash_message">
                <x-bladewind.alert type="error">
                    {{ session('error') }}
                </x-bladewind.alert>
            </div>
        @endif


        <div style="margin: 50px">

            <form method="POST" action="{{ route('sendMails') }}" id="sendMails" class="signup-form">
                @csrf

                <label for="">Select blood types of donors</label>
                <ul
                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @foreach ($bloodTypes as $item)
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="{{ $item->bloodType }}" type="checkbox" value="{{ $item->bloodType }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="{{ $item->bloodType }}"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $item->bloodType }}</label>
                            </div>
                        </li>
                        <input type="hidden" id="setBloodType_{{ $item->bloodType }}" name="bloodType[]"
                            value="">
                        <br>
                    @endforeach
                </ul>

                <br>

                <textarea id="Description" rows="4" name="content"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Email content" required></textarea>

                <br>
                <div class="text-center">
                    <x-bladewind.button name="btn-save" has_spinner="true" type="primary" class="mt-3"
                        can_submit="true">
                        SEND
                    </x-bladewind.button>
                </div>
            </form>

        </div>


    </x-slot>


    <script>
        const inputFields = document.querySelectorAll('[id^="setBloodType_"]');

        for (const inputField of inputFields) {
            const bloodTypeCheckbox = document.getElementById(inputField.id.replace('setBloodType_', ''));

            inputField.value = bloodTypeCheckbox.checked ? bloodTypeCheckbox.value : 'false';
            bloodTypeCheckbox.addEventListener('change', function() {

                inputField.value = bloodTypeCheckbox.checked ? bloodTypeCheckbox.value : 'false';
                //console.log(bloodTypeCheckbox.checked ? true : false);
            });
        }
    </script>

</x-app-layout>
