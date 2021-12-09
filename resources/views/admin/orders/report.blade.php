@extends('twill::layouts.free')

@push('extra_css')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
@endpush

@section('customPageContent')
    <a17-fieldset>
        <a17-datepicker name="date" label="Melyik nap?" v-on:close="dayReport($event)" initial-value="{{ $date ?? null }}"></a17-datepicker>
    </a17-fieldset>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 sm:rounded-lg" style="border: 1px solid rgb(229, 231, 235)">
                    <table class="min-w-full divide-y divide-gray-200 table-auto">
                        <thead class="bg-gray-200 hidden md:table-header-group">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Termék Neve
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Extra
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @if(isset($orders) && $orders->count())
                            @foreach($orders as $product)
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
                                        @if(!is_null($product->productOptions))
                                            @foreach($product->productOptions as $option)
                                                <div class="text-sm font-medium text-gray-900">{{ $option->title }}</div>
                                                <div class="text-sm text-gray-500 pb-2">{{ $option->pivot->gross_price }}Ft</div>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop

@push('extra_js')
    <script src="{{ mix('js/admin.js') }}" crossorigin></script>
@endpush
