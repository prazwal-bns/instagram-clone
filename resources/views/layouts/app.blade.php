<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Instagram Clone') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <link rel="icon" type="image/svg" href="{{ asset('assets/favicon.svg') }}">
        <!-- Swiper Styles -->

        <style>
            [x-cloak]{
                display: none !important;
            }
            .swiper-button-prev {
                    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.8' stroke='currentColor' class='w-4 h-4'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M15.75 19.5L8.25 12l7.5-7.5'/%3E%3C/svg%3E") !important;
                    background-repeat: no-repeat;
                    background-size: 16px;
                    background-position: center;
                    background-color: rgba(255, 255, 255, 0.75);
                    border: 1px solid #d1d5db;
                    border-radius: 9999px;
                    padding: 6px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 32px;
                    width: 32px;
                }
        
                .swiper-button-next {
                    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='2.8' stroke='currentColor' class='w-4 h-4'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M8.25 4.5l7.5 7.5-7.5 7.5'/%3E%3C/svg%3E") !important;
                    background-repeat: no-repeat;
                    background-size: 16px;
                    background-position: center;
                    background-color: rgba(255, 255, 255, 0.75);
                    border: 1px solid #d1d5db;
                    border-radius: 9999px;
                    padding: 6px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 32px;
                    width: 32px;
                }
        
                .swiper-button-next::after,
                .swiper-button-prev::after {
                    display: none;
                }
        </style>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    </head>
    <body class="font-sans antialiased">
          <div class="drawer lg:drawer-open">
            <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col items-start"> 
                <!-- Page content here -->
                {{-- <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
                    Open drawer
                </label> --}}
                <label for="my-drawer-2" class="drawer-button lg:hidden p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke-width="2" 
                        stroke="currentColor" 
                        class="w-8 h-8 text-gray-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </label>
                <div class="w-full h-full"> 
                    {{ $slot }}
                </div>
            </div>
            <div class="drawer-side fixed inset-0 z-50"> <!-- Fixed positioning with z-index -->
                <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
                @include('layouts.sidebar')
            </div>
        </div>
        
    @livewire('wire-elements-modal')
    </body>
</html>
