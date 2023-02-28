<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order item show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form>
                        <!-- Telephone -->
                        <div>
                            <x-input-label for="telephone" :value="__('Telephone')" />
                            <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" value="{{ $order->telephone }}" required autofocus autocomplete="telephone" />
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $order->email }}" required autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $order->address }}" required autofocus autocomplete="address" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Products -->

                        @foreach ($order->products as $product)
                            <div>
                                <x-input-label for="address" :value="__('Products title')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $product->title }}" required autofocus autocomplete="address" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="address" :value="__('Products cost')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $product->cost }}" required autofocus autocomplete="address" />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                        @endforeach

                        <!-- Price -->
                        <div>
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{ $order->price }}" required autofocus autocomplete="price" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Date order -->
                        <div>
                            <x-input-label for="date_order" :value="__('Date order')" />
                            <x-text-input id="date_order" class="block mt-1 w-full" type="text" name="date_order" value="{{ date('d-m-Y', strtotime($order->date_order)) }}" required autofocus autocomplete="date_order" />
                            <x-input-error :messages="$errors->get('date_order')" class="mt-2" />
                        </div>

                            <a href="{{ route('orders') }}">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
