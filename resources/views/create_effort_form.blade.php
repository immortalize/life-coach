@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create an effort for {{ $goal->name }}!</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/efforts') }}">
                        {{ csrf_field() }}
                        <input name="goal_id" type="hidden" value="{{ $goal->id }}">

                        <div class="form-group{{ $errors->has('effort_desc') ? ' has-error' : '' }}">
                            <label for="effort_desc" class="col-md-4 control-label">Effort Description</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="effort_desc" value="{{ old('effort_desc') }}" required autofocus>

                                @if ($errors->has('effort_desc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
