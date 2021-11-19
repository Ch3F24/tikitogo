@extends('layouts.main')

@section('header')
    @include('partials.header')
@endsection

@section('content')
    <div id="loading" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-700 bg-opacity-60 z-10">
        <svg class="animate-spin -ml-1 mr-3 h-10 w-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>
    <section class="" id="menu" style="display: none">

        <div class="sm:flex sm:justify-center items-center my-4">
            <button id="currentWeek" class="week-btn uppercase font-bold w-full mb-2 sm:mb-0 sm:w-auto sm:ml-3 inline-flex items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-tiki-celeste cursor-pointer shadow selected">
                Aktuális hét
            </button>
            <button id="nextWeek" class="week-btn uppercase font-bold w-full mb-2 sm:mb-0 sm:w-auto sm:ml-3 inline-flex items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-tiki-celeste cursor-pointer shadow">
                Következő hét
            </button>
        </div>

        @foreach($weeks as $key => $week)
        <div class="hidden @if($loop->first) active @endif" data-week="{{ $key }}">
            @foreach($week as $d)
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
        </div>
        @endforeach
    </section>

    <section class="text-center my-4 mt-12">
        <p class="text-gray-500">Allergének: 1-glutén, 2-tej, laktóz, 3-tojás, 4- hal, 5- szója, 6- diófélék, 7- mustár, 8-zeller, 9- rák, 10- puhatestűek, 11- szezám, 12- földimogyoró, 13- csillagfürt, 14-édesgyökér, 15-kéndioxid-szulfit, 16- mesterséges édesítőszer</p>
    </section>

    <section class="text-center my-8 lg:mt-16" id="order-process">
        <h2 class="text-3xl tracking-tight font-extrabold text-tiki-celeste sm:text-4xl md:text-5xl mb-8 border-b-2 pb-2 border-tiki-celeste inline-block">Rendelés mentete</h2>
        <p class="text-2xl font-bold mb-8 md:mb-14 text-tiki-celeste">Étlapunk két részből áll</p>
        <div class="grid grid-col-1 md:grid-cols-2 gap-4 md:gap-8 lg:gap-x-24 text-left">
            <div class="text-gray-500 border-b border-tiki-celeste pb-4">
                <p>A HETI MENÜben találod hétfőtől-péntekig a napi ajánlatunkat.</p>
                <p>Ebből csak előrendelést tudunk felvenni, legkorábban előző hét csütörtökétől, legkésőbb
                    rendelés előtti nap 16:00 óráig. Itt rendelhetsz egész hétre, vagy egy-egy napra.</p>
            </div>
            <div class="text-gray-500 border-b border-tiki-celeste pb-4">
                <p>Az A’LA CARTE étlapunkat is hetente váltjuk, pár állandó étel mellett. Itt is tudunk
                    előrendelést felvenni a fent említett feltételek szerint, de aznapi rendelést is teljesítünk 10 és
                    16 óra között.</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 my-8 gap-x-4 gap-y-4 lg:gap-x-24 lg:gap-y-8">
            <div class="border-b border-tiki-celeste pb-4">
                <p class="text-xl font-bold mb-4 lg:mb-8 text-tiki-celeste">Honnan tudsz rendelni?</p>
                <ul class="list-disc list-inside text-left">
                    <li class="text-gray-500">A 8. és 9. kerületben tudjuk az ételeket házhoz szállítani.</li>
                    <li class="text-gray-500">A ebéded az üzletünkben is átveheted, így nincs szállítási költség.</li>
                    <li class="text-gray-500">Higiéniai okok miatt, az üzlet előtt tudsz várakozni. Ha előre leadod a rendelésed akkor megkönnyíted a munkákat, és lerövidíted a várakozási idődet.</li>
                </ul>
            </div>
            <div class="border-b border-tiki-celeste pb-4">
                <p class="text-xl font-bold mb-4 lg:mb-8 text-tiki-celeste">Hol tudsz rendelni?</p>
                <ul class="list-disc list-inside text-left">
                    <li class="text-gray-500">Itt az oldalon</li>
                    <li class="text-gray-500">Telefonon: <a href="tel:+36706780302" class="text-gray-500 hover:text-gray-400">+36 70 678 0302</a></li>
                    <li class="text-gray-500">Messengeren: a Tikitogo Facebook oldalon</li>
                    <li class="text-gray-500">Rendelés leadásakor, kérjük add meg a telefonszámodat!</li>
                </ul>
            </div>
            <div class="border-b border-tiki-celeste pb-4">
                <p class="text-xl font-bold mb-4 lg:mb-8 text-tiki-celeste">Fizetés</p>
                <p class="text-gray-500 text-left">Futárnál:</p>
                <ul class="list-disc list-inside text-left ml-2 mb-4">
                    <li class="text-gray-500">készpénzzel</li>
                    <li class="text-gray-500">bankkártyával</li>
                    <li class="text-gray-500">SZÉP kártyával</li>
                </ul>
                <p class="text-gray-500 text-left">Előreutalással:</p>
                <ul class="list-disc list-inside text-left ml-2">
                    <li class="text-gray-500">Bankszámlaszámunk: 10101339-29002200-01005005</li>
                    <li class="text-gray-500">Tiki Beach Kft.</li>
                    <li class="text-gray-500">Közlemény rovatba, kérlek írd be a neved és címed!</li>
                </ul>
            </div>
            <div class="border-b border-tiki-celeste pb-4">
                <p class="text-xl font-bold mb-4 lg:mb-8 text-tiki-celeste">Szállítás</p>
                <ul class="list-disc list-inside text-left">
                    <li class="text-gray-500">A kiszállítási díj 400 Ft /cím.</li>
                    <li class="text-gray-500">8000 Ft felett a kiszállítás ingyenes.</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="text-center my-8 lg:mt-16" id="introduction">
        <h2 class="text-3xl tracking-tight font-extrabold text-tiki-celeste sm:text-4xl md:text-5xl mb-8 border-b-2 pb-2 border-tiki-celeste inline-block">Bemutatkozás</h2>
        <p class="text-gray-500">A Tiki Beach Bisztró már öt éve Zamárdi kedvenc bisztró étterme.</p>
        <p class="text-gray-500">Számos elismerésben részesültünk. Így elnyertük a We Love Balaton év felfedezettje díját 2018-ban és az Év Strandétele verseny első helyezését 2019-ben.</p>
        <p class="text-gray-500">A Dining Guide három éve a 10 legjobb vidéki alternatív éttermei között tart számon minket. Idén elérkezettnek láttuk az időt, hogy a fővárosba költözzünk.</p>
        <p class="text-gray-500">Célunk, hogy a bisztró konyhát a hétköznapokban otthon és a munkahelyeden is élvezhesd.</p>
        <p class="text-gray-500">Étlapunk összeállításakor a legfontosabb szempontok a változatosság, minőségi alapanyagok és frissen készült ételek. Mindig gondolunk a laktóz és glutén érzékeny, vegán vagy vegetáriánus vendégeinkre is.</p>
        <p class="text-gray-500">Ha kíváncsi vagy a nyári életünkre nézd meg a Tiki Beach Bisztró facebook oldalát!</p>
    </section>
@endsection
