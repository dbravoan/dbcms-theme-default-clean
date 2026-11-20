@extends('theme-default-clean::layouts.app')

@section('title', __('shop::public.checkout_title'))

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
    <div class="space-y-2">
        <h1 class="text-3xl font-bold">{{ __('shop::public.checkout_title') }}</h1>
        <p class="text-sm text-slate-500">{{ __('shop::public.checkout_description') }}</p>
    </div>
    <div class="border border-slate-200 rounded-lg p-6">
        @include('shop::partials.checkout-form', [
            'items' => $items,
            'subtotal' => $subtotal,
            'taxTotal' => $taxTotal,
            'grandTotal' => $grandTotal,
            'currentMarket' => $currentMarket,
            'currentLocale' => $currentLocale,
        ])
    </div>
</div>
@endsection
