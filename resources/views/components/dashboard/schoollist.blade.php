@props([
'dashboard'
])
<div class="dashboardcard">
    <header class="bg-gray-200 border border-black text-center font-bold">
        Schools
    </header>
    <div class="dashboardbody">
        {!! $dashboard->schoolsUl !!}
    </div>
</div>
