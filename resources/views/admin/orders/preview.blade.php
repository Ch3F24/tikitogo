@extends('twill::layouts.free')

@push('extra_css')
{{--    <link href="{{ asset('chunk-common.css') }}" rel="stylesheet" crossorigin/>--}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

@endpush

@section('content')
    <section class="lg:container mx-auto">
        <section class="col min-w-full xl:min-w-0 col--primary mx-auto">
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
                        <div>
                            <p class="text-gray-500">Megjegyzés</p>
                            <p>{{ $order->note }}</p>
                        </div>
                    </div>

                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg" style="border: 1px solid rgb(229, 231, 235)">
                                        <table class="min-w-full divide-y divide-gray-200 table-auto">
                                            <thead class="bg-gray-200 hidden md:table-header-group">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Name
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Melyik napra
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Extra
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($order->products as $product)
                                                <tr class="flex flex-col md:table-row @if($loop->iteration % 2 == 0) bg-gray-200 @endif" style="border-top: 1px solid rgb(229, 231, 235);">
                                                    <td class="px-2 lg:px-6 py-2 lg:py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="lg:ml-4">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ $product->products->title }}
                                                                    <div class="text-sm text-gray-500">{{ $product->products->gross_price }}Ft</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-2 lg:px-6 py-2 lg:py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500 lg:hidden">Melyik napra:</div>
                                                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::create($product->menu_date)->format('Y-m-d') }}</div>
                                                    </td>
                                                    <td class="px-2 lg:px-6 py-2 lg:py-4 whitespace-nowrap">
                                                        @if(!is_null($product->productOptions))
                                                            @foreach($product->productOptions as $option)
                                                                <div class="text-sm font-medium text-gray-900">{{ $option->title }}</div>
                                                                <div class="text-sm text-gray-500 pb-2">{{ $option->pivot->gross_price }}Ft</div>
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @if($order->shipping_type == 1)
                        <div class="shadow p-4 bg-yellow-100 sm:rounded-lg">
                            <p>Személyesen veszi át!</p>
                            <p>Ekkor: {{ \Carbon\Carbon::create($order->pickup_date)->format('h:i') }}</p>
                        </div>
                    @endif
                    <div class="shadow p-4 bg-green-200 sm:rounded-lg">
                        <p>Összesen fizetve: {{ $order->total_gross_price }} Ft</p>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
