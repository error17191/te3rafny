@extends('layouts.app')
@section('body_scripts')
    <script src="{{mix('js/dashboard.js')}}"></script>
@endsection
@section('content')
    <div class="container" id="dashboard">
        <div class="row justify-content-center">
            <div class="col-md-10 col-12">
                <div class="card">
                    <div class="card-body">
                        <nav class="nav nav-pills nav-justified">
                            <a class="nav-item nav-link active" href="#">New</a>
                            <a class="nav-item nav-link" href="#">Public</a>
                            <a class="nav-item nav-link" href="#">Private</a>
                        </nav>
                        <br>
                        <h1 class="display-4">Hello, world!</h1>
                        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                        <hr class="my-4">
                        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
