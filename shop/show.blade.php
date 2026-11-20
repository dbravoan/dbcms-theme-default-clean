@extends('theme-default-clean::layouts.app')

@section('title', $translation?->meta_title ?? $translation?->name ?? '')
@section('meta_description', $translation?->meta_description ?? $translation?->summary ?? '')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-10"
     data-cms-edit-url="{{ route('admin.shop.products.edit', $product->id) }}"
     data-cms-edit-label="{{ __('Editar Producto') }}">
    @include('components.breadcrumbs', ['trail' => $breadcrumbs ?? []])
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="space-y-4" x-data="{ activeImage: @js($product->featured_image ?? '') }">
            <template x-if="activeImage">
                <img :src="activeImage" alt="{{ $translation?->name }}" class="w-full rounded-2xl object-cover" loading="eager" decoding="async">
            </template>
            @if(!empty($product->gallery_images))
                <div class="flex flex-wrap gap-3">
                    @foreach(array_filter([$product->featured_image, ...$product->gallery_images]) as $image)
                        <button type="button" @click="activeImage = @js($image)" class="w-20 h-20 border rounded-lg overflow-hidden" aria-label="{{ __('Ver imagen de producto') }} {{ $loop->iteration }}">
                            <img src="{{ $image }}" alt="" class="w-full h-full object-cover" loading="lazy" decoding="async">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="space-y-5">
            <header class="space-y-2">
                <h1 class="text-3xl font-bold">{{ $translation?->name }}</h1>
                <p class="text-sm text-slate-500">SKU: {{ $product->sku }}</p>
                @if($translation?->summary)<p>{{ $translation->summary }}</p>@endif
            </header>
            @include('shop::partials.product-offer')
            @include('shop::partials.product-specifications')
        </div>
    </div>
    @if(!empty($renderedSections))
        @foreach($renderedSections as $sectionHtml)
            {!! $sectionHtml !!}
        @endforeach
    @elseif($translation?->description)
        <div class="prose max-w-none">{!! app(\DbCms\Core\Services\Media\MarkdownRendererService::class)->render((string) $translation->description) !!}</div>
    @endif
    @if($relatedProducts->isNotEmpty())
        <section class="space-y-4">
            <h2 class="text-xl font-bold">{{ __('Productos relacionados') }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                @foreach($relatedProducts as $related)
                    @php
                        $relatedTranslation = public_translation($related, $currentLocale, $currentMarket);
                        $prefix = $localization->getModulePrefix('shop', $currentLocale);
                    @endphp
                    <a href="{{ $localization->url('/'.$prefix.'/'.$relatedTranslation?->slug, $currentMarket, $currentLocale) }}" class="block border rounded-xl p-4 space-y-3">
                        <h3 class="font-semibold">{{ $relatedTranslation?->name }}</h3>
                        @include('shop::partials.product-price', ['product' => $related])
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
