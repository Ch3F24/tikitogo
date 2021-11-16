@extends('layouts.main')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section class="sm:flex sm:justify-center relative" id="menu">
        @foreach($days as $d)
            <div class="menu-container">
                <input type="radio" name="menu" id="{{ $d['date'] }}" class="hidden" @if( $d['date'] === now()->format('Y-m-d')) checked @elseif($d['date'] < now()->format('Y-m-d')) disabled @endif>
                <label for="{{ $d['date'] }}" class="uppercase font-bold w-full mb-2 sm:mb-0 sm:w-auto sm:ml-3 inline-flex items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white menu-color_{{ $loop->index }} cursor-pointer shadow">
                    {{$d['day_name']}}
                </label>

                <div class="relative sm:absolute my-4 sm:mt-0 left-0 w-full" data-date="{{ $d['date'] }}">
                    @if($d['menu'])

                            @if($d['menu']->foods->count())
                                <h1 class="text-4xl font-bold text-tiki-celeste">Étel</h1>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-4 my-4">
                                    @foreach($d['menu']->foods as $food)
                                        <div class="food border shadow p-4">
                                            <form action="{{ route('cart.add') }}" method="POST" class="flex">
                                                @csrf
                                                <div class="w-2/3">
                                                    <p class="text-xl mb-2">{{ $food->title }}</p>
                                                    <p class="text-sm text-gray-500 mb-4">{{ $food->description }}</p>
                                                    <input type="hidden" name="name" value="{{ $food->title }}">
                                                    <input type="hidden" name="product" value="{{ $food->id }}">
                                                    <input type="hidden" name="price" value="{{ $food->gross_price }}">
                                                    @if($food->options->count())
                                                        <fieldset class="ml-4">
{{--                                                            <legend class="text-base font-medium text-gray-900">Feltet</legend>--}}
                                                            <div class="mb-2 space-y-2">
                                                                @foreach($food->options as $option)
                                                                <div class="flex items-center text-gray-500">
{{--                                                                    <input id="option-{{ $option->title }}" value="{{ $option->id }}" name="option_id" type="radio" class="focus:outline-none focus:ring-0 focus:ring-transparent h-4 w-4 text-tiki-celeste">--}}
                                                                    <input value="{{ $option->id }}" name="option_id" type="radio" class="focus:outline-none focus:ring-0 focus:ring-transparent h-4 w-4 text-tiki-celeste">
{{--                                                                    <input type="hidden" name="option_price" value="{{ $option->gross_price }}">--}}
{{--                                                                    <input type="hidden" name="option_name" value="{{ $option->title }}">--}}
                                                                    <label for="push-{{ $option->title }}" class="ml-3 block text-sm">
                                                                        {{ $option->title }} +{{ $option->gross_price }} Ft
                                                                    </label>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    @endif
                                                    @if($food->allergens)
                                                        <div class="text-gray-500">
                                                            <p class="inline">Allergének:</p>
                                                            @foreach($food->allergens as $allergens)
                                                                <span>{{ $allergens['id'] }} @if(!$loop->last),@endif</span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="text-right sm:px-6 w-1/3">
                                                    <p class="text-xl mb-2">{{ $food->gross_price }} FT</p>
                                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-tiki-blue hover:bg-tiki-celeste focus:outline-none">
                                                        {{ __('Add to cart') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if($d['menu']->drinks->count())
                                <h1 class="text-4xl font-bold text-tiki-celeste mt-8">Ital</h1>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-4 my-4">
                                    @foreach($d['menu']->drinks as $food)
                                    <div class="food border shadow p-4">
                                            <form action="{{ route('cart.add') }}" method="POST" class="flex">
                                                @csrf
                                                <div class="w-2/3">
                                                    <p class="text-xl mb-2">{{ $food->title }}</p>
                                                    <input type="hidden" name="name" value="{{ $food->title }}">
                                                    <input type="hidden" name="product" value="{{ $food->id }}">
                                                    <input type="hidden" name="price" value="{{ $food->gross_price }}">
                                                    @if($food->options->count())
                                                        <fieldset class="ml-4">
                                                            <div class="mb-2 space-y-2">
                                                                @foreach($food->options as $option)
                                                                    <div class="flex items-center text-gray-500">
                                                                        <input value="{{ $option->id }}" name="option_id" type="radio" class="focus:outline-none focus:ring-0 focus:ring-transparent h-4 w-4 text-tiki-celeste">
                                                                        <label for="push-{{ $option->title }}" class="ml-3 block text-sm">
                                                                            {{ $option->title }} +{{ $option->gross_price }} Ft
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </fieldset>
                                                    @endif
                                                </div>
                                                <div class="text-right sm:px-6 w-1/3">
                                                    <p class="text-xl mb-2">{{ $food->gross_price }} FT</p>
                                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-tiki-blue hover:bg-tiki-celeste focus:outline-none">
                                                        {{ __('Add to cart') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                    @else
                        <div class="my-8 lg:my-16 text-center">
                            <p class="text-4xl font-bold text-tiki-celeste">Erre a napra még nincs elérhető menünk</p>
                            <p class="text-4xl font-bold text-tiki-celeste">Kérjük gyere vissza késöbb.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </section>

    <section class="text-center my-4 mt-12">
        <p class="text-gray-500">Allergének: 1-glutén, 2-tej, laktóz, 3-tojás, 4- hal, 5- szója, 6- diófélék, 7- mustár, 8-zeller, 9- rák, 10- puhatestűek, 11- szezám, 12- földimogyoró, 13- csillagfürt, 14-édesgyökér, 15-kéndioxid-szulfit, 16- mesterséges édesítőszer</p>
    </section>

    <section class="text-center my-8 lg:mt-16">
        <h2 class="text-3xl tracking-tight font-extrabold text-tiki-celeste sm:text-4xl md:text-5xl mb-4 border-b-2 pb-2 border-tiki-celeste inline-block">Ismerj meg minket</h2>
        <p class="mb-2 text-gray-500">A Tiki To Go-val elérkezettnek láttuk az időt, hogy a fővárosba költözzünk. Célunk, hogy a bisztró konyhát a hétköznapokban, otthon és a munkahelyeden is élvezhesd.</p>
        <p class="mb-2 text-gray-500">Étlapunk összeállításakor a legfontosabb szempontok a változatosság, minőségi alapanyagok és frissen készült ételek. Mindig gondolunk a laktóz és glutén érzékeny,vegán vagy vegetáriánus Vendégeinkre is.</p>
        <p class="mb-2 text-gray-500">A Tiki Beach Bisztró már öt éve Zamárdi kedvenc bisztró étterme. Számos elismerésben részesültünk. Többek között elnyertük a We Love Balaton Év Felfedezettje díját 2018-ban, és az Év Strandétele Verseny I. helyezését 2019ben. A Dining Guide 3 éve a 10 legjobb vidéki alternatív éttermei között tart számon minket. </p>
    </section>
@endsection
