@if($d['menu'])
    @if($closed)
        <div class="my-8 text-center">
            <p class="text-4xl font-bold text-tiki-celeste">Mai napra a rendelést lezártuk.</p>
            <p class="text-4xl font-bold text-tiki-celeste">Várunk vissza holnap!</p>
        </div>
    @endif
    @if($d['menu']->foods->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-4 my-4 menu">
            <h1 class="text-4xl font-bold text-tiki-celeste col-span-full">Ételek</h1>
            @foreach($d['menu']->foods as $food)
                @include('partials.foods',['closed' => $closed])
            @endforeach
{{--            @each('partials.foods', $d['menu']->foods, 'food')--}}
        </div>
    @else
        <div class="my-8 lg:my-16 text-center menu">
            <p class="text-4xl font-bold text-tiki-celeste">Erre a napra még nincs elérhető menünk</p>
            <p class="text-4xl font-bold text-tiki-celeste">Kérjük gyere vissza késöbb.</p>
        </div>
    @endif
{{--    @if($d['menu']->alacarte->count())--}}
{{--        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-4 my-4 alacarte hidden">--}}
{{--            <h1 class="text-4xl font-bold text-tiki-celeste col-span-full">Étel</h1>--}}
{{--            @each('partials.foods', $d['menu']->alacarte, 'food')--}}
{{--            @foreach($d['menu']->alacarte as $food)--}}
{{--                @include('partials.foods',['closed' => $closed])--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    @else--}}
{{--        <div class="my-8 lg:my-16 text-center alacarte hidden">--}}
{{--            <p class="text-4xl font-bold text-tiki-celeste">Erre a napra még nincs elérhető menünk</p>--}}
{{--            <p class="text-4xl font-bold text-tiki-celeste">Kérjük gyere vissza késöbb.</p>--}}
{{--        </div>--}}
{{--    @endif--}}

    @if($d['menu']->drinks->count())
        <h1 class="text-4xl font-bold text-tiki-celeste mt-8">Italok</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-4 my-4">
{{--            @each('partials.foods', $d['menu']->drinks, 'food')--}}
            @foreach($d['menu']->drinks as $food)
                @include('partials.foods',['closed' => $closed])
            @endforeach
        </div>
    @endif
@else
    <div class="my-8 lg:my-16 text-center">
        <p class="text-4xl font-bold text-tiki-celeste">Erre a napra még nincs elérhető menünk</p>
        <p class="text-4xl font-bold text-tiki-celeste">Kérjük gyere vissza késöbb.</p>
    </div>
@endif
