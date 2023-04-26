@extends('layouts.newapp')

@section('title', 'Open Ticket')

@section('content')

    <div class="row text-center">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Open New Ticket</div>

                <div class="panel-body">


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST">
                        {!! csrf_field() !!}


                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="problem_description" class="col-md-4 control-label">Problem Description</label>

                            <div class="col-md-6">
                                <textarea rows="10" id="problem_description" class="form-control" name="problem_description"></textarea>

                                @if ($errors->has('problem_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('problem_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Open Ticket
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
