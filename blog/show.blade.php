@extends('theme-default-clean::layouts.app')

@section('title', $translation?->meta_title ?? $translation?->title ?? '')
@section('meta_description', $translation?->meta_description ?? $translation?->summary ?? '')

@section('content')
<article class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-6"
         data-cms-edit-url="{{ route('admin.blog.posts.edit', $post->id) }}"
         data-cms-edit-label="{{ __('Editar Artículo') }}">
    @include('components.breadcrumbs', ['trail' => $breadcrumbs ?? []])
    <header class="space-y-3">
        <h1 class="text-3xl font-bold">{{ $translation?->title }}</h1>
        <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500">
            @if($post->published_at)
                <time datetime="{{ $post->published_at->toAtomString() }}">{{ $post->published_at->copy()->locale(app()->getLocale())->isoFormat('LL') }}</time>
            @endif
            @if($post->author?->name)
                <span>{{ $post->author->name }}</span>
            @endif
            <span>{{ $post->reading_time_minutes }} min</span>
        </div>
        @if($translation?->summary)
            <p class="text-lg text-slate-600">{{ $translation->summary }}</p>
        @endif
    </header>
    @if($post->featured_image)
        <img src="{{ $post->featured_image }}" alt="{{ $translation?->title }}" class="w-full rounded-xl" loading="eager" decoding="async">
    @endif
    @if(!empty($renderedSections))
        @foreach($renderedSections as $sectionHtml)
            {!! $sectionHtml !!}
        @endforeach
    @else
        <div class="prose max-w-none">{!! app(\DbCms\Core\Services\Media\MarkdownRendererService::class)->render((string) $translation?->content) !!}</div>
    @endif
    @include('blog::partials.comments')
</article>
@endsection
