@extends('layouts.app')

@section('title', 'Ana Sayfa - AKAĞİTİM')

@section('content')
    @include('sections.hero-slider')
    @include('sections.stats-section')
    @include('sections.banner-cta')
    @include('sections.values-section')
    @include('sections.why-section')
    @include('sections.contact-section')
    @include('sections.features-section')
    @include('sections.instagram-section')
    @include('sections.faq-section')
@endsection
