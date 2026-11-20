@extends('theme-default-clean::layouts.app')

@section('title', __('shop::public.cart_title'))

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6">
    <div class="flex items-center justify-between gap-4">
        <h1 class="text-3xl font-bold">{{ __('shop::public.cart_title') }}</h1>
        <a href="{{ route('shop.index', ['market' => $currentMarket->code, 'locale' => $currentLocale]) }}">{{ __('shop::public.continue_shopping') }}</a>
    </div>
    @if(empty($items))
        <p class="text-slate-500">{{ __('shop::public.empty_cart') }}</p>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 border border-slate-200 rounded-lg overflow-hidden">
                @include('shop::partials.cart-items', [
                    'items' => $items,
                    'currentMarket' => $currentMarket,
                    'currentLocale' => $currentLocale,
                ])
            </div>
            <div class="border border-slate-200 rounded-lg p-6 h-fit">
                @include('shop::partials.cart-summary', [
                    'subtotal' => $subtotal,
                    'taxTotal' => $taxTotal,
                    'grandTotal' => $grandTotal,
                    'currentMarket' => $currentMarket,
                    'currentLocale' => $currentLocale,
                ])
            </div>
        </div>
    @endif
</div>
@endsection
