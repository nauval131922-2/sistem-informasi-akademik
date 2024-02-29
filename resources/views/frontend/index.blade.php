@extends('frontend.main')

<link href="{{ asset('frontend/assets/img/icons8-school-96.png') }}" rel="icon">

@section('title')
    MI NU Nurul Ulum | Home
@endsection

<!-- ======= Hero Section ======= -->
@include('frontend.hero')
<!-- End Hero -->

@section('main')
    <!-- ======= About Us Section ======= -->
    @include('frontend.home.about')
    <!-- End About Us Section -->
    
    {{-- visi dan misi start --}}
    @include('frontend.home.visi_misi')
    {{-- visi dan misi end --}}
@endsection