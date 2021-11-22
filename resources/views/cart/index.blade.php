@extends('layouts.main')


@section('content')
   <section class="my-8">
   @if($cart && count($cart))
           @if ($errors->any())
               <div>
                   <div class="font-medium text-red-600">
                       {{ __('Whoops! Something went wrong.') }}
                   </div>

                   <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                       @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                   </ul>
               </div>
           @endif

           <form @auth() action="{{ route('cart.checkout') }}" method="POST" @endauth class="items-start flex flex-wrap lg:flex-nowrap">
            @csrf
            <div class="w-full lg:w-1/2">
                @auth()
                    @include('cart.form')
                @else
                    <div class="text-center">
                        <p class="text-xl font-bolt mb-4"> Jelentkezz be előbb</p>
                        <a href="{{ route('login') }}" class="inline-flex max-w-xs justify-center py-2 px-4 w-full border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-tiki-celeste hover:bg-tiki-blue focus:outline-none">
                            {{ __('Login') }}
                        </a>
                    </div>
                @endauth
            </div>
            <div class="w-full lg:w-1/2 shadow p-6 mt-4 lg:mt-0 lg:ml-4">
               @if($total)
                    <div class="my-4 mb-8">
                        @foreach($cart as $key => $item)
                           <div class="border-b border-gray-300 flex mb-4 text-gray-700 pb-2">
                               <div>
                                   <p>{{ $item['name'] }}</p>
                                   <p>{{ $item['price'] }} Ft</p>
                                   @if($item['option'])
                                       <p class="text-sm text-gray-700">+ {{ $item['option']['title'] }} {{ $item['option']['gross_price'] }} Ft</p>
                                   @endif
                               </div>
                              <div class="ml-auto">
                                  <input type="hidden" name="item" value="{{ $key }}">
                                  <p class="inline-flex justify-center text-gray-700 remove-cart-item hover:text-gray-500 cursor-pointer">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                      </svg>
                                  </p>
                              </div>
                           </div>
                        @endforeach
                    </div>
                    <div class="flex justify-between my-4">
                        @if($shipping)
                            <ul>
                                <li><p class="text-lg"><span class="text-gray-500">Összesen:</span> {{ $total }} Ft</p></li>
                                <li><p class="text-lg"><span class="text-gray-500">Szállítás:</span> {{ $shipping['UnitPrice'] }} Ft</p></li>
                                <li><p class="text-lg"><span class="text-gray-500">Végösszeg:</span> {{ $total + $shipping['UnitPrice'] }} Ft</p></li>
                            </ul>
                        @else
                            <p class="text-xl">Végösszeg</p>
                            <p class="text-xl">{{ $total }} Ft</p>
                        @endif
                    </div>
                    @auth()
                        <button type="submit" class="inline-flex justify-center py-2 px-4 w-full border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-tiki-celeste hover:bg-opacity-90 focus:outline-none">
                            Fizetés
                        </button>
                    @endauth
               @endif
                <div class="mt-4">
                    <img src="{{asset('img/barion-card300px.png')}}" alt="Barion">
                </div>
            </div>
        </form>
    @else
       <div class="bg-tiki-celeste w-full rounded p-4 text-center">
           <p class="text-5xl text-white">Jelenleg üres a kosár.</p>
       </div>
   @endif
   </section>
@endsection
