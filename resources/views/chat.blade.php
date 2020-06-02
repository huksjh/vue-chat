@extends('layouts.app')

@section('content')
   
    <chat-component :current-user="{{ auth()->id() }}" />
        
@endsection
