<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
            <a href="{{ route('orders.create') }}" style="text-decoration: underline">Create</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="tableOrders" class="display">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>price</th>
                            <th>Date order</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->telephone }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ date('d-m-Y', strtotime($order->date_order)) }}</td>
                                    <td>
                                        <a href="{{route('orders.show', $order->id)}}">Show</a>
                                        <a href="{{route('orders.edit', $order->id)}}">Edit</a>
                                        <form method="post" action="{{ route('orders.destroy', $order->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button align="right" width="48">
                                                Delete
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
