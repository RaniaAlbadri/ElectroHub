@extends('errors.layout')

@section('page_title', '403 - Access Denied')
@section('error_code', '403')
@section('eyebrow', 'ERROR / ACCESS RESTRICTED')
@section('headline', 'This area is off-limits.')
@section('description', 'You do not have permission to access this page. Company management is reserved for authorized ElectroHub admins. You can still explore our store.')
@section('hint', 'Your account and shopping pages are still available.')
@section('art_title', 'ACCESS DENIED')
@section('art_caption', 'Authorized personnel only')
@section('art_status', '403 · RESTRICTED AREA')

@section('illustration')
    <svg viewBox="0 0 80 80" fill="none" stroke="currentColor" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round">
        <path d="M40 7 65 17v20c0 16-10 27-25 36C25 64 15 53 15 37V17L40 7Z" />
        <rect x="29" y="34" width="22" height="20" rx="4" />
        <path d="M34 34v-6a6 6 0 0 1 12 0v6" />
        <path d="M40 43v4" />
    </svg>
@endsection
