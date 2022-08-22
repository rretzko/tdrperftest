{{--
-- Important note:
--
-- This template is from caleb porzio's livewire/surge example by way of tailwind/ui
-- MFRHOLDINGS, LLC is a sponsor of caleb porzio's work and has puchased TailwindUI Application and Marketing products
--
-- Purchase here: https://tailwindui.com/
--}}

<div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
    <table class="min-w-full divide-y divide-cool-gray-200 shadow border border-gray-200 sm:rounded-lg">
        <thead>
        <tr class="bg-gray-100">
            {{ $head }}
        </tr>
        </thead>

        <tbody class="bg-white divide-y divide-cool-gray-200">
            {{ $body }}
        </tbody>
    </table>
</div>
