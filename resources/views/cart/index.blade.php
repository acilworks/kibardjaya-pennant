@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-8">Your Cart</h1>

    @if(empty($cart))
        <p>Your cart is empty.</p>
    @else
        <table class="w-full border">
            <thead>
                <tr class="border-b">
                    <th class="p-3 text-left">Product</th>
                    <th class="p-3">Qty</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp

                @foreach($cart as $item)
                    @php $total += $item['price'] * $item['qty']; @endphp
                    <tr class="border-b">
                        <td class="p-3">
                            <div class="flex items-center gap-4">
                                @if($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-16">
                                @endif
                                {{ $item['title'] }}
                            </div>
                        </td>

                        <td class="p-3 text-center">
                            <form action="/cart/update/{{ $item['id'] }}" method="POST">
                                @csrf
                                <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="w-16 border p-1">
                                <button class="text-sm underline">Update</button>
                            </form>
                        </td>

                        <td class="p-3 text-center">
                            Rp {{ number_format($item['price'] * $item['qty']) }}
                        </td>

                        <td class="p-3 text-center">
                            <form action="/cart/remove/{{ $item['id'] }}" method="POST">
                                @csrf
                                <button class="text-red-600">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 text-right">
            <p class="text-xl font-bold">
                Total: Rp {{ number_format($total) }}
            </p>

            <a href="/checkout"
                class="inline-block mt-4 px-6 py-3 bg-black text-white hover:bg-white border-2 border-black hover:text-black transition-all duration-300">
                Checkout
            </a>
        </div>
    @endif
@endsection