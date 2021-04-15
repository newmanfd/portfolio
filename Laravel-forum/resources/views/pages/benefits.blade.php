@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>  
    <!-- Check for the benefits to find and bring in the benefit reasons (see PagesContoller@benefits) -->
    @if(count($benefitReasons) > 0)
        <ul class="list-group">
            @foreach($benefitReasons as $benefitReason)
                <li class="list-group-item">{{ $benefitReason }}</li>
            @endforeach
        </ul>
    @endif
@endsection