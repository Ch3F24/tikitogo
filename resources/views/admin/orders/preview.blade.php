@extends('twill::layouts.free')

@push('extra_css')
{{--    <link href="{{ asset('chunk-common.css') }}" rel="stylesheet" crossorigin/>--}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

@endpush

@section('content')
    <section class="container">
        <section class="col col--primary mx-auto">
            <div class="fieldset">
                <div class="fieldset__content grid grid-col-1 gap-y-4 bg-white p-8">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-500">Rendelésszám</p>
                            <p>{{ $order->order_number }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Fizetési azonosító</p>
                            <p>{{ $order->payment_id }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Név</p>
                            <p>{{ $order->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Email</p>
                            <p>{{ $order->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Telefon</p>
                            <p>{{ $order->phone }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Irányítószám</p>
                            <p>{{ $order->shipping_postal_code }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Cím</p>
                            <p>{{ $order->shipping_address }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Számlázási név</p>
                            <p>{{ $order->billing_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Adószám</p>
                            <p>{{ $order->vat_number }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Város</p>
                            <p>{{ $order->billing_city }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Számlázási Irányítószám</p>
                            <p>{{ $order->billing_postal_code }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Számlázási Cím</p>
                            <p>{{ $order->billing_address }}</p>
                        </div>
                    </div>


                    @foreach($order->products as $product)
                        <div class="shadow p-4">
                            <p>Termék: {{ $product->products->title }}</p>
                            <p>Melyik napra: {{ \Carbon\Carbon::create($product->menu_date)->format('Y-m-d') }}</p>
                            @if(isset($product->options->title))
                                <p>Extra: {{ $product->options->title }}</p>
                            @endif
                        </div>
                    @endforeach
                    <div class="shadow p-4">
                        <p>Összesen fizetve: {{ $order->total_gross_price }} Ft</p>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
