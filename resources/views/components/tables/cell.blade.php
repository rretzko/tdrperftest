{{--
-- Important note:
--
-- This template is from caleb porzio's livewire/surge example by way of tailwind/ui
-- MFRHOLDINGS, LLC is a sponsor of caleb porzio's work and has puchased TailwindUI Application and Marketing products
--
-- Purchase here: https://tailwindui.com/
--}}

<td {{ $attributes->merge(['class' => 'px-6 py-4 whitespace-no-wrap text-sm leading-5 text-cool-gray-900']) }}>
    {{ $slot }}
</td>
