<footer class="py-8 bg-gray-800 mt-auto" id="footer">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-4 md:gap-y-0">
            <ul class="flex flex-col items-start">
                <li class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">
                    <a href="/#menu">Menu</a>
                </li>
                <li class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">
                    <a href="/#footer">Kontakt</a>
                </li>
                <li class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">
                    <a href="/#introduction">Bemutatkozás</a>
                </li>
                <li class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">
                    <a href="/#order-process">Rendelés mentete</a>
                </li>
                <li class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">
                    <a href="{{ route('aszf') }}">ASZF</a>
                </li>
{{--                <li class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md">--}}
{{--                    <a href="/#menu">Adatkezelési</a>--}}
{{--                </li>--}}
            </ul>
            <div>
                <ul>
                    <li class="text-gray-300 mb-2">1091 Budapest, Üllőiút 115.b</li>
                    <li class="mb-2"><a href="tel:+36706780302" class="text-gray-300 hover:text-gray-200">+36 70 678 0302</a></li>
                    <li class="mb-2"><a href="https://www.facebook.com/Tikitogo-109586974829011" class="text-gray-300 hover:text-gray-200">Facebook</a></li>
                </ul>
            </div>
            <div class="col-span-2 md:col-span-1 lg:col-span-2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d640.9023845149184!2d19.085312663444004!3d47.479985137209496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dce4f97d5979%3A0x81f6c54263f38a78!2zQnVkYXBlc3QsIMOcbGzFkWkgw7p0IDExNWIsIDEwOTE!5e0!3m2!1sen!2shu!4v1636743906717!5m2!1sen!2shu" class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <div class="mt-8">
            <img src="{{asset('img/barion-card300px.png')}}" alt="Barion" class="mx-auto lg:mx-0">
        </div>

    </div>
</footer>
