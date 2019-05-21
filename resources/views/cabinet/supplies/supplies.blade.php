@extends('layouts.cabinet')

@section('content')
    <div class="container block-supplies">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header mb-2">
                        <h5>Задачи ({{$group->name}})</h5>
                    </div>

                    <div class="col">
                        @if($tasks->count() > 0)
                            @foreach($tasks as $task)
                                @if($task->status != 'SUCCESS')
                                <div class="row">
                                    <div class="col-2">
                                        <div class="block-img-priority">
                                            @if($task->priority == 'HIGH')
                                                <img class="img-fluid" src="{{asset('images/warning.png')}}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-10 pl-2">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="card-title text-title">
                                                    <a href="{{ URL::route('cabinet.task.detail',['task'=>$task]) }}">
                                                        <div class="text-title">
                                                            {{substr($task->title, 0, 50)}}
                                                            @if($task->status == 'PAYMENT')
                                                                <div class="block-img-status">
                                                                    <img class="img-fluid"
                                                                         src="{{asset('images/na_oplate.png')}}" alt="">
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="block-status">
                                            <div class="block-task-date">
                                                <span>Дата создания:</span>
                                                {{ \Carbon\Carbon::parse($task->created_at)->format('d.m.Y')}}
                                            </div>
                                            <span class="block-task-status">Состояние задачи --></span>
                                            @if($task->status == 'WORK')
                                                В работе</h6>
                                            @elseif($task->status == 'CLOSE')
                                                Закрыта</h5>
                                            @elseif($task->status == 'SUCCESS')
                                                Выполнена</h5>
                                            @elseif($task->status == 'PAYMENT')
                                                На оплате</h5>
                                            @elseif($task->status == 'CREATED')
                                                Не назначена
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
