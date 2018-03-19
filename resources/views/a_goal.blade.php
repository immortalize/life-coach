@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $goal->name }}</div>
                    <div class="panel-body">
                        {{ $goal->desc }}
                    </div>
                </div>

                {{-- Reasons Begin--}}
                <div class="panel panel-default">
                    <div class="panel-heading">Reasons</div>
                    <div class="panel-body">
                        @if (count($reasons) > 0)
                            <table class="table table-striped user-table">

{{--
                                <thead>
                                <th>No</th>
                                <th>description</th>
                                <th>&nbsp;</th>
                                </thead>
--}}
                                <tbody>
                                @foreach ($reasons as $reason)
                                    <tr>
                                        <td class="table-text"><div>{{ $reason->desc }}</div></td>
                                        <!-- user Delete Button -->
                                        <td>
                                            <form action="{{ url('reasons/'.$reason->id) . '/goal/' .$goal->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <a href="{{ url('/reasons/create/goal/'.$goal->id) }}">Add a reason </a>

                        @else
                            There is no reasons yet. <a href="{{ url('/reasons/create/goal/'.$goal->id) }}">Add a reason! </a>
                        @endif
                    </div>
                </div>
                {{-- Reasons End  --}}

                {{-- Efforts Begin--}}
                <div class="panel panel-default">
                    <div class="panel-heading">Efforts</div>
                    <div class="panel-body">
                        @if (count($efforts) > 0)
                            <table class="table table-striped user-table">

{{--
                                <thead>
                                <th>No</th>
                                <th>description</th>
                                <th>&nbsp;</th>
                                </thead>
--}}
                                <tbody>
                                @foreach ($efforts as $effort)
                                    <tr>
                                        <td class="table-text">
                                            <a href="{{ url('efforts/'.$effort->id) }}">                                            
                                                <div>{{ $effort->desc }}</div>
                                            </a>
                                        </td>
                                        <!-- Effort Delete Button -->
                                        <td>
                                            <form action="{{ url('efforts/'.$effort->id) . '/goal/' .$goal->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <a href="{{ url('/efforts/create/goal/'.$goal->id) }}">Add a effort </a>

                        @else
                            There is no efforts yet. <a href="{{ url('/efforts/create/goal/'.$goal->id) }}">Add a effort! </a>
                        @endif
                    </div>
                </div>
                {{-- Efforts End  --}}

                {{-- Steps Begin--}}
                <div class="panel panel-default">
                    <div class="panel-heading">Steps</div>
                    <div class="panel-body">
                        @if (count($steps) > 0)
                            <table class="table table-striped user-table">

                                <thead>
                                <th>Step Name</th>
                                <th>Step State</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                @foreach ($steps as $step)
                                    <tr>
                                        <td class="table-text"><div>{{ $step->desc }}</div></td>
                                        <td class="table-text"><div>{{ $step->state }}</div></td>
                                        <!-- Step Edit Button -->
                                        <td>
                                            <form action="{{ url('steps/'.$step->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}

                                                <input type="hidden" name="goal_id" value="{{ $goal->id }}">

                                                @if ($step->state == 'pending')

                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Mark It Done
                                                    </button>
                                                    <input type="hidden" name="state" value="done">
                                                @elseif ($step->state == 'done')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-btn fa-trash"></i>Mark It Pending
                                                    </button>
                                                    <input type="hidden" name="state" value="pending">
                                                @endif
                                            </form>
                                        </td>
                                        <!-- Step Delete Button -->
                                        <td>
                                            <form action="{{ url('steps/'.$step->id) . '/goal/' .$goal->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <a href="{{ url('/steps/create/goal/'.$goal->id) }}">Add another step</a>

                        @else
                            There is no steps yet. <a href="{{ url('/steps/create/goal/'.$goal->id) }}">Add a step! </a>
                        @endif
                    </div>
                </div>
                {{-- Steps End  --}}

                {{-- Motivators Begin--}}
                <div class="panel panel-default">
                    <div class="panel-heading">Motivators</div>
                    <div class="panel-body">
                        @if (count($motivators) > 0)
                            <table class="table table-striped user-table">

                                {{--
                                                                <thead>
                                                                <th>No</th>
                                                                <th>description</th>
                                                                <th>&nbsp;</th>
                                                                </thead>
                                --}}
                                <tbody>
                                @foreach ($motivators as $motivator)
                                    <tr>
                                        <td class="table-text">
                                            <a href="{{ url('motivators/'.$motivator->id) }}">
                                                <div>{{ $motivator->name }}</div>
                                            </a>
                                        </td>
                                        <!-- user Delete Button -->
                                        <td>
                                            <form action="{{ url('motivators/'.$motivator->id) . '/goal/' .$goal->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <a href="{{ url('/motivators/create/goal/'.$goal->id) }}">Add a motivator </a>

                        @else
                            There is no motivators yet. <a href="{{ url('/motivators/create/goal/'.$goal->id) }}">Add a motivator! </a>
                        @endif
                    </div>
                </div>
                {{-- motivators End  --}}

                {{-- Sub Goals Begin--}}
                <div class="panel panel-default">
                    <div class="panel-heading">Sub Goals</div>
                    <div class="panel-body">
                        @if (count($sub_goals) > 0)
                            <table class="table table-striped user-table">
                                <thead>
                                <th>name</th>
                                <th>description</th>
                                <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                @foreach ($sub_goals as $subgoal)
                                    <tr>
                                        <td class="table-text"><a href="{{ url('goals/'.$subgoal->id) }}"><div>{{ $subgoal->name }}</div></a></td>
                                        <td class="table-text"><a href="{{ url('goals/'.$subgoal->id) }}"><div>{{ $subgoal->desc }}</div></a></td>

                                        <!-- subgoal delete Button -->
                                        <td>
                                            <form action="{{ url('goals/'.$goal->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <a href="{{ url('goal/create-sub/'.$goal->id) }}">Create a sub-goal </a>
                            <br>
                            or <a href="{{ url('goal/associate/select-sub/'.$goal->id) }}"> select from existing goals!</a>
                        @else
                            There is no sub-goals yet. <a href="{{ url('goal/create-sub/'.$goal->id) }}">Create a sub-goal </a>
                            <br>
                            or <a href="{{ url('goal/associate/select-sub/'.$goal->id) }}"> select from existing goals!</a>
                        @endif
                    </div>
                </div>

                {{-- Sub Goals End  --}}
            </div>
        </div>
    </div>
@endsection
