@extends('layouts.cabinet')

@section('content')
    <div class="container block-supplies">
        <div class="row">
            <div class="col">
                @if($task)
                    <div class="card">
                        <div class="card-header mb-2">
                            <h4 class="text-body"><i class="text-title">{{$task->title}}</i></h4>

                        </div>

                        <div class="card-body">
                            <h5 class="card-text text-title mb-4">{{$task->task_body}}</h5>
                            @if($task->comments->count() > 0)
                                <div class="card">
                                    @foreach($task->comments as $comment)
                                        <div class="card-body text-title">
                                            {{--@dd($comment)--}}
                                            <p><b>{{$comment->users()->first()->name}}:</b>
                                                {{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y')}}
                                            </p>
                                            <p></p>
                                            <h6>{{$comment->comment}}</h6>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col m-3">
                                <a class="btn btn-outline-info btn-sm text-title" href="{{ URL::route('cabinet.task.comment.create',['task'=>$task]) }}">
                                    Написать комментарий
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
