@extends($layout ?? 'theme-default-clean::layouts.app')

@section('title', $translation->meta_title ?? $translation->title ?? '')
@section('meta_description', $translation->meta_description ?? '')

@section('content')
<x-cms::content-region theme="default-clean" class="py-12 gap-y-8">
    @if(!empty($renderedSections))
        @foreach($renderedSections as $section)
            {!! $section !!}
        @endforeach
    @else
        <div class="text-center py-16 text-slate-500">
            <p>&gt; {{ __('Content in preparation') }}</p>
        </div>
    @endif
</x-cms::content-region>
@endsection