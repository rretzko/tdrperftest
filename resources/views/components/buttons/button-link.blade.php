{{--
-- Important note:
--
-- This template is from caleb porzio's livewire/surge example by way of tailwind/ui
-- MFRHOLDINGS, LLC is a sponsor of caleb porzio's work and has puchased TailwindUI Application and Marketing products
--
-- Purchase here: https://tailwindui.com/
--}}

<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'text-cool-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-cool-gray-800 focus:underline transition duration-150 ease-in-out' . ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : ''),
    ]) }}
>
    {{ $slot }}
</button>
