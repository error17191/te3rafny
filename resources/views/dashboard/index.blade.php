@extends('layouts.app')
@section('body_scripts')
    <script src="{{mix('js/dashboard.js')}}"></script>
@endsection
@section('content')
    <div class="container" id="dashboard">
        <div class="row justify-content-center">
            <div class="col-md-10 col-12">
                <dashboard></dashboard>
            </div>
        </div>
    </div>
@endsection
