@extends('layouts.main')


@section('content')
    @if (session('order'))
        <section class="order-confirmation lg:my-8 w-1/2 mx-auto">
            @if(session('order')->Status == 'Succeeded')
                <div class="border-b border-gray-300 pb-4 mb-4">
                    <p class="text-gray-700 mb-2">Köszönjük a rendelését!</p>
                    <h1 class="text-4xl font-bold text-tiki-celeste mb-2">Rendelése feldolgozás alatt van.</h1>
                    <p class="text-gray-700">Rendelésszám: #{{ session('order')->OrderNumber }}</p>
                </div>
            @else
                <div class="border-b border-gray-300 pb-4 mb-4">
                    <h1 class="text-4xl font-bold text-tiki-orange mb-2">Sajnos valami hiba történt a rendelésnél!</h1>
                </div>
            @endif
        </section>
    @endif
@endsection
