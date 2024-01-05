<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                Feedbacks
            </h2>
        </div>
        <br>
        <p>
            Share Your Experience with our system with others
        </p>

        @if (session('success'))
            <div id="flash_message">
                <x-bladewind.alert type="success">
                    {{ session('success') }}
                </x-bladewind.alert>
            </div>
        @endif
        <form method="POST" action="{{ route('storeRatings') }}">
            @csrf
            <div style="border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 16px; margin: 16px;">

                <br>

                <div>

                    <!-- Rating -->
                    <div class="flex flex-row-reverse justify-end items-center">
                        <input id="hs-ratings-readonly-1" type="radio"
                            class="peer -ms-5 w-5 h-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="hs-ratings-readonly" value="1">
                        <label for="hs-ratings-readonly-1"
                            class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-600 dark:text-gray-600">
                            <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-2" type="radio"
                            class="peer -ms-5 w-5 h-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="hs-ratings-readonly" value="2">
                        <label for="hs-ratings-readonly-2"
                            class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-600 dark:text-gray-600">
                            <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-3" type="radio"
                            class="peer -ms-5 w-5 h-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="hs-ratings-readonly" value="3">
                        <label for="hs-ratings-readonly-3"
                            class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-600 dark:text-gray-600">
                            <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-4" type="radio"
                            class="peer -ms-5 w-5 h-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="hs-ratings-readonly" value="4">
                        <label for="hs-ratings-readonly-4"
                            class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-600 dark:text-gray-600">
                            <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </label>
                        <input id="hs-ratings-readonly-5" type="radio"
                            class="peer -ms-5 w-5 h-5 bg-transparent border-0 text-transparent cursor-pointer appearance-none checked:bg-none focus:bg-none focus:ring-0 focus:ring-offset-0"
                            name="hs-ratings-readonly" value="5">
                        <label for="hs-ratings-readonly-5"
                            class="peer-checked:text-yellow-400 text-gray-300 pointer-events-none dark:peer-checked:text-yellow-600 dark:text-gray-600">
                            <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                        </label>
                    </div>
                    <!-- End Rating -->
                    <input type="hidden" id="rating" name="rating" value="0">
                </div>
                <br>


                <textarea id="Description" rows="4" name="message"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="feedback message"></textarea>


                {{-- <input type="hidden" id="staffMemberEmail" name="staffMemberEmail" value={{ Auth::user()->email }}> --}}
                <div id="saveButton">
                    <br>
                    <input type="submit" value="Send"
                        style="padding: 10px 20px; background-color: #1a9aef; color: white; border: none; border-radius: 10px; cursor: pointer;">
                </div>


            </div>
        </form>
        <br>
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                User Feedbacks
            </h2>

        </div>
        <br>
        <div style="border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 16px; margin: 16px;">

            @foreach ($ratings as $item)
                <article>
                    <div class="flex items-center mb-4">

                    </div>
                    <div class="flex items-center mb-1 space-x-1 rtl:space-x-reverse">

                        <h3 class="ms-2 text-sm font-semibold text-gray-900 dark:text-white">{{ $item->userName }}
                        </h3>
                    </div>
                    <div>
                        <x-bladewind.rating type="star" name="small-rating-{{ $item->id }}"
                            rating="{{ $item->rating }}" clickable="false" />
                    </div>
                    <footer class="mb-5 text-sm text-gray-500 dark:text-gray-400">
                        <p>Reviewed at <time datetime="2017-03-03 19:00">{{ $item->created_at }}</time></p>
                    </footer>
                    <p class="mb-2 text-gray-500 dark:text-gray-400"> {{ $item->message }}</p>



                </article>
            @endforeach

        </div>

    </x-slot>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all radio buttons with the name 'hs-ratings-readonly'
            const radioButtons = document.querySelectorAll('input[name="hs-ratings-readonly"]');

            // Add an event listener to each radio button
            radioButtons.forEach(function(radioButton) {
                radioButton.addEventListener('change', function() {
                    // Get the value of the selected radio button
                    const selectedValue = this.value;

                    // Print the selected value to the console
                    console.log('Selected Value:', selectedValue);
                    document.getElementById('rating').value = 6 - selectedValue;
                });
            });
        });
    </script>


</x-app-layout>
