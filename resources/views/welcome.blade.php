@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">What is Life Coach?</div>
                    <div class="panel-body">
                        Coaching is a form of development in which a person called a coach supports a learner or client in achieving a specific personal or professional goal by providing training, advice and guidance.
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Create a goal today!</div>
                    <div class="panel-body">
                        Goals are the things you want to achieve in your life. But we need motivation to achieve our goals.
                        <br>
                        <br>
                        <a href="{{ url('/goals') }}">Look at your GOALS!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
