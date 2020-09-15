@extends('layouts.app')

@section('content')
    <change-password user_email="{{request()->get('email')}}" reset_token="{{request()->token}}"/>
@endsection
