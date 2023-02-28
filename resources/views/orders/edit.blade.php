<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order item edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('orders.update', $order->id) }}">
                        @csrf
                        @method('PATCH')

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

                        <!-- Produects -->
                        <div>
                            <x-input-label for="" :value="__('products')" />
                            <x-text-input id="productsList" class="block mt-1 w-full" type="text" list="products" name="productsList" :value="old('productsList')" required autofocus autocomplete="productsList" onchange="addProduct()" />
                            <x-input-error :messages="$errors->get('productsList')" class="mt-2" />
                            <x-text-input id="products_id" class="block mt-1 w-full" type="hidden" name="products" value="" />
                        </div>

                        <datalist id="products">
                            @foreach ($products as $product)
                                <option data-id="{{$product->id}}" data-title="{{$product->title}}" data-cost="{{$product->cost}}" label="Cost: {{ $product->cost }}" value="{{ $product->title }}">
                            @endforeach
                        </datalist>

                        <div id="groupProduct">

                            @foreach ($order->products as $product)
                            <div id="product_card_{{ $product->id }}">
                                <br>
                                <x-input-label for="product-title" value="Products title: {{ $product->title }}" style="font-size: 16px"/>
                                <x-text-input id="product_id" class="product-id block mt-1 w-full" type="hidden" name="product_id" value="{{ $product->id }}" />
                                <x-text-input id="product-cost" class="block mt-1 w-full" type="hidden" name="product-cost" value="{{ $product->cost }}"  autofocus autocomplete="product-cost" />
                                <br>
                            </div>
                        @endforeach
                        </div>

                        <!-- Price -->
                        <div>
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{ $order->price }}" required autofocus autocomplete="price" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Date order -->
                        <div>
                            <x-input-label for="date_order" :value="__('Date order')" />
                            <x-text-input id="date_order" class="block mt-1 w-full" type="date" name="date_order" value="{{ date('Y-m-d', strtotime($order->date_order)) }}" required autofocus autocomplete="date_order" />
                            <x-input-error :messages="$errors->get('date_order')" class="mt-2" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
