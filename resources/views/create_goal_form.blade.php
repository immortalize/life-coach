@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a goal!</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/goals') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('goal_name') ? ' has-error' : '' }}">
                            <label for="goal_name" class="col-md-4 control-label">Goal Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="goal_name" value="{{ old('goal_name') }}" required autofocus>

                                @if ($errors->has('goal_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('goal_desc') ? ' has-error' : '' }}">
                            <label for="goal_desc" class="col-md-4 control-label">Goal Description</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="goal_desc" value="{{ old('goal_desc') }}" required autofocus>

                                @if ($errors->has('goal_desc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('goal_desc') }}</strong>
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
