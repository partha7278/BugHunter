@extends('component.master')

@section('content')

    @push('title')
        DashBoard-Testing
    @endpush


    {{-- Sidebar include --}}
    @include('component/sidebar',['page' => 'testing','item'=> $item])


    <div class="main-content">

        <center><h5>Please Select an URL for Testing in <a href="{{ route('p_view') }}">Project View</a></h5></center>

        <br/><br/><br/><br/><br/><br/><br/><br/>
    </div>


@endsection
