@extends('layouts.layout')

@section('content')
    <div class="min-h-screen w-full text-white pt-24 md:pt-20 pb-16 md:pb-20 overflow-x-clip relative">
        <!-- Background subtle grid -->
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.02)_1px,transparent_1px)] bg-size-[40px_40px] mask-[radial-gradient(ellipse_60%_60%_at_50%_50%,#000_10%,transparent_100%)] pointer-events-none"></div>

        <x-portfolio.hero :portfolio="$portfolio" />
        
        <x-portfolio.core-stacks :portfolio="$portfolio" :coreStacks="$coreStacks" />

        <x-portfolio.skill-radar :portfolio="$portfolio" />

        <x-portfolio.github-matrix :portfolio="$portfolio" />

        <x-portfolio.projects :portfolio="$portfolio" :projects="$projects" />

        <x-portfolio.contact :portfolio="$portfolio" />

    </div>

    @vite(['resources/js/portfolio.js'])
@endsection