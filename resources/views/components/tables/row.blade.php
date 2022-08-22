{{--
-- Important note:
--
-- This template is from caleb porzio's livewire/surge example by way of tailwind/ui
-- MFRHOLDINGS, LLC is a sponsor of caleb porzio's work and has puchased TailwindUI Application and Marketing products
--
-- Purchase here: https://tailwindui.com/
--}}
@props([
    'altcolor' => 0,
])

<tr {{ $attributes->merge(['class' => ($altcolor) ? 'bg-yellow-100' : 'bg-white'])}}>
    {{ $slot }}
</tr>
