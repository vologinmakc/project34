@extends('layouts.cabinet')

@section('content')
    <div class="container block-supplies">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header mb-2">
                        <h4 class="text-body">Group -- <i class="text-info">{{$group->name}}</i></h4>
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <h5 class="text-title">Ваши задачи</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col p-2">
                        @if($tasks->count() > 0)
                            @foreach($tasks as $task)
                                <div class="col p-1 @if($task->status == 'SUCCESS')
                                                        supplies-status-success
                                                       @endif">
                                    <h5 class="card-title text-title">
                                        <a href="{{ URL::route('cabinet.task.detail',['task'=>$task]) }}">
                                            <h4 class="@if($task->priority == 'HIGH')
                                                    priority-high
                                            @elseif($task->priority == 'NORMAL')
                                            @elseif($task->priority == 'LOW')
                                            @endif">{{substr($task->title, 0, 50)}}</h4>
                                        </a>
                                    </h5>
                                    <p>
                                    {{ \Carbon\Carbon::parse($task->created_at)->format('d.m.Y')}}
                                    <h6><i class="text-info">Status:</i>
                                        @if($task->status == 'WORK')
                                            В работе</h6>
                                    @elseif($task->status == 'CLOSE')
                                        Закрыта</h5>
                                    @elseif($task->status == 'SUCCESS')
                                        Выполнена</h5>
                                    @elseif($task->status == 'PAYMENT')
                                        На оплате</h5>
                                    @elseif($task->status == 'CREATED')
                                        Не назначена</h6>
                                        @endif
                                        </p>
                                        <hr>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
