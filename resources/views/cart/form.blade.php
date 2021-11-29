<div class="mt-10 sm:mt-0">
    <div class="md:grid md:gap-6">
        <div class="mt-5 md:mt-0">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <legend class="text-lg font-medium text-gray-900 mb-4">{{ __('Shipping') }}</legend>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-5">
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" value="{{ isset($user->address->name) ? $user->address->name : old('name') ?? '' }}" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-tiki-celeste block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6 sm:col-span-5">
                            <label for="phone" class="block text-sm font-medium text-gray-700">{{ __('Phone') }}</label>
                            <input type="tel" name="phone" id="phone" value="{{ isset($user->address->phone) ? $user->address->phone : old('phone') ?? '' }}" autocomplete="tel" placeholder="+36301234567" class="mt-1 focus:ring-indigo-500 focus:border-tiki-celeste block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700">{{ __('Postal code') }}</label>
                            <input type="number" name="shipping_postal_code" id="shipping_postal_code" value="{{ isset($user->address->shipping_postal_code) ? $user->address->shipping_postal_code : old('shipping_postal_code') ?? '' }}" autocomplete="postal-code" class="mt-1 focus:ring-indigo-500 focus:border-tiki-celeste block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700">{{ __('Address') }}</label>
                            <input type="text" name="shipping_address" id="shipping_address" autocomplete="street-address" value="{{ isset($user->address->shipping_address) ? $user->address->shipping_address : old('shipping_address') ?? '' }}" class="mt-1 focus:ring-indigo-500 focus:border-tiki-celeste block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <legend class="text-lg font-medium text-gray-900 my-4">{{ __('Billing') }}</legend>
                    <div x-data="{ open: true }">
                        <div class="flex items-start mb-4">
                            <div class="flex items-center h-5">
                                <input @click="open = ! open" id="same_as_shipping" name="same_as_shipping" type="checkbox" class="focus:outline-none focus:ring-transparent h-4 w-4 text-tiki-celeste border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="same_as_shipping" class="font-medium text-gray-700">{{ __('Same as shipping information') }}</label>
                            </div>
                        </div>

                        <div class="grid grid-cols-6 gap-6" id="shipping-container" x-show="open">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="billing_name" class="block text-sm font-medium text-gray-700">{{ __('Billing name') }}</label>
                                <input type="text" name="billing_name" id="billing_name" value="{{ isset($user->address->billing_name) ? $user->address->billing_name : old('billing_name') ?? '' }}" autocomplete="name" class="mt-1 focus:ring-indigo-500 focus:border-tiki-celeste block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="vat_number" class="block text-sm font-medium text-gray-700">{{ __('Vat number') }}</label>
                                <input type="text" name="vat_number" id="vat_number" value="{{ isset($user->address->vat_number) ? $user->address->vat_number : old('vat_number') ?? '' }}" autocomplete="vat_number" class="mt-1 focus:ring-indigo-500 focus:border-tiki-celeste block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label for="billing_city" class="block text-sm font-medium text-gray-700">{{ __('City') }}</label>
                                <input type="text" name="billing_city" id="billing_city" value="{{ isset($user->address->billing_city) ? $user->address->billing_city : old('billing_city') ?? '' }}" autocomplete="address-line2" class="mt-1 focus:ring-indigo-500 focus:border-tiki-celeste block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label for="billing_postal_code" class="block text-sm font-medium text-gray-700">{{ __('Postal code') }}</label>
                                <input type="text" name="billing_postal_code" id="billing_postal_code" value="{{ isset($user->address->billing_postal_code) ? $user->address->billing_postal_code : old('billing_postal_code') ?? '' }}" autocomplete="postal-code" class="mt-1 focus:ring-indigo-500 focus:border-tiki-celeste block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                                <label for="billing_address" class="block text-sm font-medium text-gray-700">{{ __('Address') }}</label>
                                <input type="text" name="billing_address" id="billing_address" value="{{ isset($user->address->billing_address) ? $user->address->billing_address : old('billing_address') ?? '' }}" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-tiki-celeste block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
