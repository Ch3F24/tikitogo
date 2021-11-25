@if(isset($product->alacarte))
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-4 my-4">
        <h1 class="text-4xl font-bold text-tiki-celeste col-span-full">Étel</h1>
        @foreach($product->alacarte as $food )
            @include('partials.foods',['closed' => $closed])
        @endforeach
    </div>
@else
    <div class="my-8 lg:my-16 text-center">
        <p class="text-4xl font-bold text-tiki-celeste">Erre a hétre még nincs elérhető étlapunk</p>
        <p class="text-4xl font-bold text-tiki-celeste">Kérjük gyere vissza késöbb.</p>
    </div>
@endif
