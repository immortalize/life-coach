@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Select a sub-goal for {{$parent_goal->name }}</div>
                    <div class="panel-body">
                        @if (count($goals) > 0)
                            <table class="table table-striped user-table">
                                <thead>
                                <th>name</th>
                                <th>description</th>
                                <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                @foreach ($goals as $goal)
                                    <tr>
                                        <td class="table-text"><a href="{{ url('goals/'.$goal->id) }}"><div>{{ $goal->name }}</div><a/></td>
                                        <td class="table-text"><a href="{{ url('goals/'.$goal->id) }}"><div>{{ $goal->desc }}</div></a></td>
                                        <!-- user Delete Button -->
                                        <td>
                                            <form action="{{ url('goal/associate/store-sub/'.$parent_goal->id) . '/sub/'. $goal->id }}" method="POST">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fa fa-btn fa-plus"></i>Add
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <a href="{{ url('/goals/create') }}">Create another goal!</a>
                        @else
                            There is no goals yet. <a href="{{ url('/goals/create') }}">Create a goal!</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
