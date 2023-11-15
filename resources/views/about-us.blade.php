@extends('layouts.app')

@section('content')
<style>
    
</style>
@php
    $about_text = \App\Models\BusinessSetting::where('key', 'about_text')->first();
@endphp
<section class="about_section">
    <div class="container">
        <div class="home_intro text-center">
            <h1>{{ translate('messages.about_us') }}</h1>
            @if ($about_text)
                {!! $about_text->value !!}
            @endif
            
        </div>
    </div>
</section>

@endsection