@extends('layouts.app')
@section('body_scripts')
    <script src="{{mix('js/make-your-test.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <question-counter></question-counter>
                <br>

                <question></question>

            </div>
        </div>
    </div>
@endsection
