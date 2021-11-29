<div class="food border shadow p-4 @if($closed) bg-gray-400 bg-opacity-30 @endif">

    @if($closed)
        <form class="flex opacity-40">
    @else
        <form action="{{ route('cart.add') }}" method="POST" class="flex h-full">
            @csrf
    @endif
            <div class="w-2/3 flex flex-col">
                <p class="text-xl mb-2">{{ $food->title }}</p>
                <p class="text-sm text-gray-500 mb-4">{{ $food->description }}</p>
                <input type="hidden" name="name" value="{{ $food->title }}">
                <input type="hidden" name="product" value="{{ $food->id }}">
                <input type="hidden" name="price" value="{{ $food->gross_price }}">

                @if($food->options->count())
                    <fieldset class="ml-4">
                        <div class="mb-2 space-y-2">
                            @foreach($food->options as $option)
                                <div class="flex items-center text-gray-500">
                                    <input value="{{ $option->id }}" @if($closed) disabled @endif name="option_id" type="radio" class="focus:outline-none focus:ring-0 focus:ring-transparent h-4 w-4 text-tiki-celeste">
                                    <label for="push-{{ $option->title }}" class="ml-3 block text-sm">
                                        {{ $option->title }} @if($option->gross_price != 0)+{{ $option->gross_price }} Ft @endif
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
                @if(isset($alacarteDate))
                    <div class="col-span-6 sm:col-span-3 mt-auto">
                        <label for="menu_date" class="block font-medium text-gray-500">Melyik napra rendeled?</label>
                        <select id="menu_date" name="menu_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach($alacarteDate as $day)
                                <option @if(\Carbon\Carbon::create($day)->format('Y-m-d') === now('Europe/Budapest')->format('Y-m-d')) selected @endif value="{{ $day }}">{{ \Carbon\Carbon::create($day)->format('m-d') }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <input type="hidden" name="menu_date" value="{{ $d['date'] }}">
                @endif
            </div>
            <div class="text-right sm:px-6 w-1/3">
                <p class="text-xl mb-2">{{ $food->gross_price }} FT</p>
                @if(!$closed)
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-tiki-blue hover:bg-tiki-celeste focus:outline-none">
                        {{ __('Add to cart') }}
                    </button>
                @endif
            </div>
    </form>
</div>
