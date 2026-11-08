@extends('errors.layout')

@section('page_title', '404 - Page Not Found')
@section('error_code', '404')
@section('eyebrow', 'ERROR / PAGE NOT FOUND')
@section('headline', 'Oops! This page went missing.')
@section('description', 'The page you are looking for may have been moved, renamed, or never existed. Let us get you back to the good tech.')
@section('hint', 'Try checking the URL or return to our store.')
@section('art_title', 'PAGE NOT FOUND')
@section('art_caption', 'No results found at this address')
@section('art_status', '404 · LINK NOT FOUND')

@section('illustration')
    <svg viewBox="0 0 80 80" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="34" cy="34" r="21" />
        <path d="m50 50 18 18" />
        <path d="M26 34h16" stroke-width="3" opacity=".65" />
    </svg>
@endsection
