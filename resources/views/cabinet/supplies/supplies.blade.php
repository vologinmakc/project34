@extends('layouts.cabinet')

@section('content')
    <div class="container block-supplies">
        @if($tasks->count() > 0)

            {{--модальное окно для добавление позиции subtask--}}
            <div class="modal fade" id="updateStatus" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Изменить статус задачи</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="updateStatus" method="post"
                                  action="{{ URL::route('cabinet.task.update') }}">
                                @csrf
                                <div class="form-group">
                                    <small class="form-text text-muted">
                                        Выбирите статус
                                    </small>
                                    <select class="custom-select" name="status">
                                        <option value="WORK">В работе</option>
                                        <option value="CLOSE">Отменена</option>
                                        <option value="SUCCESS">Выполнена</option>
                                        <option value="PAYMENT">На оплате</option>
                                        <option value="CREATED">Создана</option>
                                    </select>
                                    <input type="hidden" name="task_id" id="task_id" value="">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Закрыть</button>
                            <button type="button" class="btn btn-primary btn-sm"
                                    onclick="document.forms['updateStatus'].submit();">Изменить</button>
                        </div>
                    </div>
                </div>
            </div>
            {{----}}

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

            {{--Блок задач--}}
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
                            <h5>
                                <span><i>{{$task->title}}</i></span>
                                @if($task->priority == 'HIGH')
                                    <i style="color:indianred">(Важно)</i>
                                @endif
                            </h5>
                        </a>
                        <small>Статус:
                            <button class="btn btn-sm block-task-status-title js-status-modal" data-toggle="modal"
                                  data-target="#updateStatus" data="{{$task->id}}">
                                @if($task->status == 'WORK')
                                    В работе
                                @elseif($task->status == 'SUCCESS')
                                    Выполнена
                                @elseif($task->status == 'PAYMENT')
                                    На оплате
                                @endif
                            </button>
                        </small>
                    </div>

                    {{--Блок комментариев--}}
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

