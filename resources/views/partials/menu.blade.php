@if($d['menu'])
    @if($d['menu']->foods->count() or $d['menu']->alacarte->count())<h1 class="text-4xl font-bold text-tiki-celeste">Étel</h1>@endif
    @if($d['menu']->foods->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-4 my-4 menu">
            @each('partials.foods', $d['menu']->foods, 'food')
        </div>
    @else
        <div class="my-8 lg:my-16 text-center menu">
            <p class="text-4xl font-bold text-tiki-celeste">Erre a napra még nincs elérhető menünk</p>
            <p class="text-4xl font-bold text-tiki-celeste">Kérjük gyere vissza késöbb.</p>
        </div>
    @endif
    @if($d['menu']->alacarte->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-4 my-4 alacarte hidden">
            @each('partials.foods', $d['menu']->alacarte, 'food')
        </div>
    @else
        <div class="my-8 lg:my-16 text-center alacarte hidden">
            <p class="text-4xl font-bold text-tiki-celeste">Erre a napra még nincs elérhető menünk</p>
            <p class="text-4xl font-bold text-tiki-celeste">Kérjük gyere vissza késöbb.</p>
        </div>
    @endif

    @if($d['menu']->drinks->count())
        <h1 class="text-4xl font-bold text-tiki-celeste mt-8">Ital</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-4 my-4">
            @each('partials.foods', $d['menu']->drinks, 'food')
        </div>
    @endif
@else
    <div class="my-8 lg:my-16 text-center">
        <p class="text-4xl font-bold text-tiki-celeste">Erre a napra még nincs elérhető menünk</p>
        <p class="text-4xl font-bold text-tiki-celeste">Kérjük gyere vissza késöbb.</p>
    </div>
@endif
