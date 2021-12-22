@extends('layouts.main')

@section('script')
    <script src="{{ mix('js/front.js') }}"></script>
@endsection
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
            <button id="currentWeek" class="week-btn uppercase font-bold w-full mb-2 sm:mb-0 sm:w-auto sm:ml-3 inline-flex items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-tiki-celeste cursor-pointer shadow">
                Aktuális hét
            </button>
            <button id="nextWeek" class="week-btn uppercase font-bold w-full mb-2 sm:mb-0 sm:w-auto sm:ml-3 inline-flex items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-tiki-celeste cursor-pointer shadow">
                Következő hét
            </button>
        </div>

        <div class="flex hidden flex-col sm:flex-row sm:justify-center items-center my-4" id="menu-type-container">
            <button id="alacarteBtn" class="uppercase font-bold w-full mb-2 sm:mb-0 sm:w-auto sm:ml-3 inline-flex items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-tiki-celeste cursor-pointer shadow">
                À la carte
            </button>
            <button id="menuBtn" class="uppercase font-bold w-full mb-2 sm:mb-0 sm:w-auto sm:ml-3 inline-flex items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-tiki-celeste cursor-pointer shadow">
                Heti menü
            </button>
        </div>
        @foreach($weeks as $key => $week)
        <div class="hidden" data-week="{{ $key }}">

        {{-- Closed content--}}
        @if($week[0]['date'] == '2021-12-27')
            <div class="my-8 lg:my-16 text-center">
                    <p class="text-4xl font-bold text-tiki-celeste">Kedves Vendégeink!</p>
                    <p class="text-4xl font-bold text-tiki-celeste">December utolsó hetében zárva vagyunk. Január 3-tól várunk Benneteket szeretettel!</p>
                    <p class="text-4xl font-bold text-tiki-celeste">Boldog, békés Ünnepeket kívánunk</p>
                </div>
        @endif
        {{-- Closed content end --}}

            @foreach($week as $d)
                {{-- Closed content--}}
                @if($week[0]['date'] != '2021-12-27')

                    <div class="menu-container">
                        <input type="radio" name="menu" id="{{ $d['date'] }}" data-date="{{ $d['date'] }}" class="hidden">
                        <label for="{{ $d['date'] }}" class="uppercase font-bold w-full mb-2 sm:mb-0 sm:w-auto sm:ml-3 inline-flex items-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white menu-color_{{ $loop->index }} cursor-pointer shadow">
                            {{$d['day_name']}}
                        </label>

                        <div class="relative sm:absolute my-4 sm:mt-0 left-0 w-full" data-date="{{ $d['date'] }}">
                            @if($d['date'] <= now()->format('Y-m-d'))
                                @include('partials.menu',['closed' => true])
                            @elseif(\Carbon\Carbon::create($d['date'])->isTomorrow())
                                @if(now()->format('H') < 16)
                                    @include('partials.menu',['closed' => false])
                                @else
                                    @include('partials.menu',['closed' => true])
                                @endif
                            @else
                                @include('partials.menu',['closed' => false])
                            @endif
                        </div>
                    </div>
                @endif
                {{-- Closed content end--}}
            @endforeach
        </div>
        @endforeach
        @foreach($alacarte as $key => $product)
            <div class="relative sm:absolute my-4 sm:mt-0 left-0 w-full hidden alacarte-container" data-alacarte-week="{{ $key }}">

                {{-- Closed content--}}
                @if(is_null($product))
{{--                    @if(\Carbon\Carbon::now()->week == 52)--}}
                        <div class="my-8 lg:my-16 text-center">
                            <p class="text-4xl font-bold text-tiki-celeste">Kedves Vendégeink!</p>
                            <p class="text-4xl font-bold text-tiki-celeste">December utolsó hetében zárva vagyunk. Január 3-tól várunk Benneteket szeretettel!</p>
                            <p class="text-4xl font-bold text-tiki-celeste">Boldog, békés Ünnepeket kívánunk</p>
                        </div>
{{--                    @endif--}}
                @else
                    @if($d['date'] === now()->startOfWeek()->addDays(4)->format('Y-m-d') && now()->format('H') >= 16)
                        @include('partials.alacarte',['closed' => true,'alacarteDate' => $key === 'currentWeek' ? $currentWeekPeriod : $nextWeekPeriod])
                    @else
                        @include('partials.alacarte',['closed' => false, 'alacarteDate' => $key === 'currentWeek' ? $currentWeekPeriod : $nextWeekPeriod])
                    @endif
                @endif
                {{-- Closed content end--}}
            </div>
        @endforeach
    </section>

    <section class="text-center my-4 mt-12">
        <p class="text-gray-500">Allergének: 1-glutén, 2-tej, laktóz, 3-tojás, 4- hal, 5- szója, 6- diófélék, 7- mustár, 8-zeller, 9- rák, 10- puhatestűek, 11- szezám, 12- földimogyoró, 13- csillagfürt, 14-édesgyökér, 15-kéndioxid-szulfit, 16- mesterséges édesítőszer</p>
    </section>

    <section class="text-center my-8 lg:mt-16" id="order-process">
        <h2 class="text-3xl tracking-tight font-extrabold text-tiki-celeste sm:text-4xl md:text-5xl mb-8 border-b-2 pb-2 border-tiki-celeste inline-block">Rendelés menete</h2>
{{--        <p class="text-2xl font-bold mb-8 md:mb-14 text-tiki-celeste">Étlapunk két részből áll</p>--}}
{{--        <div class="grid grid-col-1 md:grid-cols-2 gap-4 md:gap-8 lg:gap-x-24 text-left">--}}
{{--            <div class="text-gray-500 border-b border-tiki-celeste pb-4">--}}
{{--                <p class="mb-4">A HETI MENÜben találod hétfőtől-péntekig a NAPI ajánlatunkat</p>--}}
{{--                <p class="text-gray-500 text-left">Előrendelés:</p>--}}
{{--                <ul class="list-disc list-inside text-left ml-2 mb-4">--}}
{{--                    <li class="text-gray-500">Az előrendelést munkanapokon 10-12 között szállítjuk.</li>--}}
{{--                    <li class="text-gray-500">Legkésőbb rendelés előtti munkanapon 16 óráig</li>--}}
{{--                    <li class="text-gray-500">Rendelhetsz egész hétre, vagy egy-egy napra</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="text-gray-500 border-b border-tiki-celeste pb-4">--}}
{{--                <p class="mb-4">Az A'LA CARTE étlapunkat is hetente frissítjük.</p>--}}
{{--                <p class="text-gray-500 text-left">Előrendelés:</p>--}}
{{--                <ul class="list-disc list-inside text-left ml-2 mb-4">--}}
{{--                    <li class="text-gray-500">Legkorábban megelőző hét csütörtökétől</li>--}}
{{--                    <li class="text-gray-500">Legkésőbb rendelés előtti munkanapon 16 óráig</li>--}}
{{--                </ul>--}}
{{--                <p class="text-gray-500 text-left">Azonnali rendelés:</p>--}}
{{--                <ul class="list-disc list-inside text-left ml-2 mb-4">--}}
{{--                    <li class="text-gray-500">Munkanapokon 10 és 16 óra között</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="grid grid-cols-1 md:grid-cols-2 my-8 gap-x-4 gap-y-4 lg:gap-x-24 lg:gap-y-8">
            <div class="border-b border-tiki-celeste pb-4">
                <p class="text-xl font-bold mb-4 lg:mb-8 text-tiki-celeste">Rendelés:</p>
                <ul class="list-disc list-inside text-left ml-2 mb-4">
                    <li class="text-gray-500">A HETI menüből, itt az oldalon, csak előrendelést tudunk felvenni. Ha aznap szeretnél, akkor hívj minket telefonon!</li>
                    <li class="text-gray-500">Az előrendelést megelőző munkanapokon 16 óráig adhatod le.</li>
                    <li class="text-gray-500">Ha kiszállítást kérsz, az előrendelést 10 és 12 óra között szállítjuk.</li>
                    <li class="text-gray-500">Ha az üzletünkben szeretnéd átvenni az ebédet, akkor azt a megjegyzés rovatban jelezd.Ide írd be az időpontot,hogy mikorra készüljünk el vele.</li>
                    <li class="text-gray-500">Az A'LA CARTE étlapunkból aznap is tudsz rendelni.</li>
                </ul>
            </div>
            <div class="border-b border-tiki-celeste pb-4">
                <p class="text-xl font-bold mb-4 lg:mb-8 text-tiki-celeste">Szállítás</p>
                <ul class="list-disc list-inside text-left">
                    <li class="text-gray-500">Kiszállítást a 8. és 9. kerületben vállalunk.</li>
                    <li class="text-gray-500">Rendelésed üzletünkben is átveheted, ebben az esetben nincs kiszállítási díj.</li>
                    <li class="text-gray-500">A kiszállítási díj 400 Ft /cím.</li>
                    <li class="text-gray-500">8000 Ft felett a kiszállítás ingyenes.</li>
                </ul>
            </div>
            <div class="border-b border-tiki-celeste pb-4">
                <p class="text-xl font-bold mb-4 lg:mb-8 text-tiki-celeste">Hol tudsz rendelni?</p>
                <ul class="list-disc list-inside text-left">
                    <li class="text-gray-500">Itt az oldalon</li>
                    <li class="text-gray-500">Telefonon: <a href="tel:+36706780302" class="text-gray-500 hover:text-gray-400">+36 70 678 0302</a></li>
                </ul>
            </div>
            <div class="border-b border-tiki-celeste pb-4">
                <p class="text-xl font-bold mb-4 lg:mb-8 text-tiki-celeste">Fizetés</p>
                <p class="text-gray-500 text-left mb-4">Itt a weboldalunkon.</p>
                <p class="text-gray-500 text-left">Futárnál:</p>
                <ul class="list-disc list-inside text-left ml-2 mb-4">
                    <li class="text-gray-500">Készpénzzel</li>
                    <li class="text-gray-500">Bankkártyával</li>
                    <li class="text-gray-500">SZÉP kártyával</li>
                </ul>
                <p class="text-gray-500 text-left">Előreutalással:</p>
                <ul class="list-disc list-inside text-left ml-2">
                    <li class="text-gray-500">Bankszámlaszámunk: 10101339-29002200-01005005</li>
                    <li class="text-gray-500">Tiki Beach Kft.</li>
                    <li class="text-gray-500">Közlemény rovatba, kérlek írd be a neved és címed!</li>
                </ul>
            </div>
{{--            <div class="border-b border-tiki-celeste pb-4">--}}
{{--                <p class="text-xl font-bold mb-4 lg:mb-8 text-tiki-celeste">Szállítás</p>--}}
{{--                <ul class="list-disc list-inside text-left">--}}
{{--                    <li class="text-gray-500">A kiszállítási díj 400 Ft /cím.</li>--}}
{{--                    <li class="text-gray-500">8000 Ft felett a kiszállítás ingyenes.</li>--}}
{{--                </ul>--}}
{{--            </div>--}}
        </div>
    </section>

    <section class="text-center my-8 lg:mt-16" id="introduction">
        <h2 class="text-3xl tracking-tight font-extrabold text-tiki-celeste sm:text-4xl md:text-5xl mb-8 border-b-2 pb-2 border-tiki-celeste inline-block">Bemutatkozás</h2>
        <p class="text-gray-500">A Tiki Beach Bisztró már öt éve Zamárdi kedvenc bisztró étterme.</p>
        <p class="text-gray-500">Számos elismerésben részesültünk. Így elnyertük a We Love Balaton év felfedezettje díját 2018-ban és az Év Strandétele verseny első helyezését 2019-ben.</p>
        <p class="text-gray-500">A Dining Guide három éve a 10 legjobb vidéki alternatív éttermei között tart számon minket.  Idén elérkezettnek láttuk az időt, hogy a Tiki To Go-val a fővárosba költözzünk.</p>
        <p class="text-gray-500">Célunk, hogy a bisztró konyhát a hétköznapokban otthon és a munkahelyeden is élvezhesd.</p>
        <p class="text-gray-500">Étlapunk összeállításakor a legfontosabb szempontok a változatosság, minőségi alapanyagok és frissen készült ételek. Mindig gondolunk a laktóz és glutén érzékeny, vegán vagy vegetáriánus vendégeinkre is.</p>
        <p class="text-gray-500">Ha kíváncsi vagy a nyári életünkre nézd meg a Tiki Beach Bisztró facebook oldalát!</p>
        <p><a class="text-gray-500 hover:text-gray-400" href="https://diningguide.hu/pesti-bazison-bukkant-fel-a-zamardi-kulthely-a-tiki-beach-bisztro/?sponsor=samsung">Dining guide megjelenés</a></p>
    </section>
@endsection
