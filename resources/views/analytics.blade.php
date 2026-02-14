@extends('layouts.app')

@section('title', 'Analytics - ElectroTech')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Analytics</h1>
    <p class="text-slate-500">Insights into your store's performance.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Revenue Chart Placeholder -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <h2 class="text-lg font-bold text-slate-900 mb-6">Revenue Overview</h2>
        <div class="h-64 flex items-end justify-between gap-2 px-4 border-b border-slate-100">
            <!-- Simulated Chart Bars -->
            <div class="group relative flex-1 flex flex-col items-center">
                <div class="w-full bg-brand-100 rounded-t-lg transition-all group-hover:bg-brand-500" style="height: 30%;"></div>
                <span class="text-[10px] text-slate-400 mt-2">Mon</span>
            </div>
            <div class="group relative flex-1 flex flex-col items-center">
                <div class="w-full bg-brand-100 rounded-t-lg transition-all group-hover:bg-brand-500" style="height: 55%;"></div>
                <span class="text-[10px] text-slate-400 mt-2">Tue</span>
            </div>
            <div class="group relative flex-1 flex flex-col items-center">
                <div class="w-full bg-brand-100 rounded-t-lg transition-all group-hover:bg-brand-500" style="height: 45%;"></div>
                <span class="text-[10px] text-slate-400 mt-2">Wed</span>
            </div>
            <div class="group relative flex-1 flex flex-col items-center">
                <div class="w-full bg-brand-200 rounded-t-lg transition-all group-hover:bg-brand-500" style="height: 85%;"></div>
                <span class="text-[10px] text-slate-400 mt-2 font-bold">Thu</span>
            </div>
            <div class="group relative flex-1 flex flex-col items-center">
                <div class="w-full bg-brand-100 rounded-t-lg transition-all group-hover:bg-brand-500" style="height: 65%;"></div>
                <span class="text-[10px] text-slate-400 mt-2">Fri</span>
            </div>
            <div class="group relative flex-1 flex flex-col items-center">
                <div class="w-full bg-brand-100 rounded-t-lg transition-all group-hover:bg-brand-500" style="height: 40%;"></div>
                <span class="text-[10px] text-slate-400 mt-2">Sat</span>
            </div>
            <div class="group relative flex-1 flex flex-col items-center">
                <div class="w-full bg-brand-100 rounded-t-lg transition-all group-hover:bg-brand-500" style="height: 25%;"></div>
                <span class="text-[10px] text-slate-400 mt-2">Sun</span>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-center gap-6">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-brand-500 rounded-full"></div>
                <span class="text-xs text-slate-500 font-medium">This Week</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-slate-200 rounded-full"></div>
                <span class="text-xs text-slate-500 font-medium">Last Week</span>
            </div>
        </div>
    </div>

    <!-- Stats Breakdown -->
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-slate-500 text-sm font-medium mb-4 uppercase tracking-wider">Top Category</h3>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-slate-900">Electronics</p>
                    <p class="text-xs text-green-600 font-bold mt-1">+12.4% from last month</p>
                </div>
                <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-slate-500 text-sm font-medium mb-4 uppercase tracking-wider">Customer Satisfaction</h3>
            <div class="flex items-center gap-4 mb-2">
                <p class="text-2xl font-bold text-slate-900">4.8</p>
                <div class="flex items-center text-amber-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" /></svg>
                </div>
            </div>
            <p class="text-xs text-slate-500 font-medium tracking-wide">Based on 1,245 reviews</p>
        </div>
    </div>
</div>
@endsection
