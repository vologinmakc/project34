@extends('layouts.cabinet')

@section('content')
    <div class="container block-supplies">
        @if($tasks->count() > 0)
            <form name="sort_index" class="form-group" method="post" action="{{URL::route('cabinet.index.sort')}}">
                @csrf
                <label for="selectsorttask">Сортировать по:</label>
                <select name="sort" class="form-control" onchange="document.forms['sort_index'].submit()">
                    <option selected>@lang("supplies.$sort")</option>
                    <option value="priority">Приоритет</option>
                    <option value="created_at">Дата</option>
                    <option value="status">Статус</option>
                </select>
            </form>

            @foreach($tasks as $task)
                <div class="row block-task
                    @if($task->status == 'WORK')
                        block-task-status-work
                    @elseif($task->status == 'SUCCESS')
                        block-task-status-success
                    @elseif($task->status == 'PAYMENT')
                        block-task-status-payment
                    @endif">
                    <div class="col-10">
                        <a href="{{ URL::route('cabinet.task.detail',['task'=>$task]) }}">
                            <h4>
                                {{$task->title}}
                                @if($task->priority == 'HIGH')
                                    <i style="color:indianred">!</i>
                                @endif
                            </h4>
                        </a>
                        <div class="block-task-attribute">
                            <span>Date:</span>
                            <span style="color: #761b18;">
                            {{ \Carbon\Carbon::parse($task->created_at)->format('d.m.Y')}}
                            </span>
                            <br>
                            <span>Status:</span>
                            <i style="color: #1b4b72;text-decoration: underline;cursor: pointer">
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
                            @endif</i>
                        </div>
                    </div>
                    <div class="col-2">
                        @if($task->comments->count() > 0)
                            <div class="block-task-img">
                                <img class="img-fluid"
                                      src="{{asset('images/comment.png')}}" alt="">
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

        @else
            <h5 class="alert alert-warning">Задач не найдено</h5>
        @endif
    </div>
@endsection

