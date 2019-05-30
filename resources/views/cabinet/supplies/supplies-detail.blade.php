@extends('layouts.cabinet')

@section('content')
    {{--модальное окно для добавление позиции subtask--}}
    <div class="modal fade" id="addSubTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Новая позиция</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="addSubTask" method="post"
                          action="{{ URL::route('cabinet.task.subtask.add', ['task' => $task]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Потребность:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Примечание:</label>
                            <textarea class="form-control" id="message-text" name="notice"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary btn-sm"
                            onclick="document.forms['addSubTask'].submit();">Добавить</button>
                </div>
            </div>
        </div>
    </div>
    {{----}}
    <div class="container block-supplies">
        <div class="row">
            <div class="col">
                @if($task)
                    <div class="card">
                        <div class="card-header bg-dark mb-2">
                            <h4 class="text-white">{{$task->title}}</h4>
                        </div>
                        <div class="block-task-title">
                            <div class="">
                                <h5 class="card-text text-title mb-4">{{$task->task_body}}</h5>
                            </div>
                        </div>
                        {{--Комментарии--}}
                        {{--<div class="card-body">
                            @if($task->comments->count() > 0)
                                <div class="card">
                                    @foreach($task->comments as $comment)
                                        <div class="card-body text-title">
                                            @dd($comment)
                                            <p><b>{{$comment->users()->first()->name}}:</b>
                                                {{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y')}}
                                            </p>
                                            <p></p>
                                            <h6>{{$comment->comment}}</h6>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>--}}
                        <div class="row pl-2">
                            <div class="col-12">@if($task->sub_tasks()->count() > 0)
                                    <form action="{{ URL::route('cabinet.task.subtask.store')}}" method="post">
                                        @csrf
                                        @php($i = 1)
                                        @foreach($task->sub_tasks as $sub_task)

                                            <div class="">
                                                <input type="checkbox" class="checkbox-size js-checkbox" id="customSwitch{{ $sub_task->id }}"
                                                    data="id-{{ $sub_task->id }}"
                                                    @if($sub_task->complete)
                                                        checked
                                                    @endif>
                                                <label class="form-check-label" for="exampleCheck1">{{ $i }}.<span class="alert-link"> {{$sub_task->title }}</span></label>
                                                <input type="hidden" id="id-{{ $sub_task->id }}" value="">
                                                {{--<label class="custom-control-label" for="customSwitch{{ $sub_task->id }}">{{ $sub_task->title }}</label>
                                                --}}
                                            </div>

                                            {{--Блок примечания к позиции--}}
                                            <a class="alert-link" data-toggle="collapse" href="#notice-block{{ $sub_task->id }}"
                                               role="button" aria-expanded="false"><small>Паказать примечание</small></a>
                                            <div class="bg-light border col-10 col-sm-8 pb-2 collapse" id="notice-block{{ $sub_task->id }}">
                                                <div class="">
                                                    <label for="notice"><small>Примечание:</small></label>
                                                    <input type="text" class="form-control" id="notice" name="notice-{{ $sub_task->id }}"
                                                        value="{{ $sub_task->notice }}">
                                                </div>
                                            </div>
                                            <hr>
                                            {{--Блок примечания к позиции end--}}
                                            @php($i++)
                                        @endforeach
                                        <button type="button" class="btn btn-outline-dark btn-sm mt-2" data-toggle="modal"
                                                data-target="#addSubTask" data-whatever="@mdo">Добавить позицию</button>
                                        <hr>
                                        <input type="submit" class="btn btn-sm btn-primary mt-2" value="Сохранить">

                                    </form>
                                @endif
                            </div>
                        </div>

                        @if(isset($images))
                        <div class="row">
                            <div class="col-10 col-sm-8">
                                <div class="w-100 m-2 p-2 bg-light border">
                                    <h6>Прикрепленные изображения</h6>
                                    <a class="btn btn-dark btn-sm text-white" data-toggle="collapse" href="#task-detail-img"
                                       role="button" aria-expanded="false">Паказать</a>
                                </div>

                                <div class="card ml-2 collapse" id="task-detail-img">
                                    <div class="card-body">

                                            @foreach($images as $image)
                                                <div id="{{ $image->id }}">
                                                    <div>
                                                        <img class="img-fluid"
                                                             src="{{ asset('storage/'.$image->url) }}">
                                                    </div>
                                                    <div>
                                                        <div data="{{ $image->id }}"
                                                             class="btn btn-sm btn-danger js-delete-image">Удалить
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            @endforeach

                                            <form action="{{ URL::route('cabinet.task.image.add', ['task'=> $task]) }}" method="post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <small class="form-text text-muted">
                                                        Выбирете файлы изображения для загрузки
                                                    </small>
                                                    <input type="file" min="1" max="9999" name="task_images[]" multiple="true"
                                                           accept="image/*,image/jpeg/">
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-primary">Добавить
                                                </button>
                                            </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        {{--<div class="row">
                            <div class="col m-3">
                                <a class="btn btn-outline-info btn-sm text-title"
                                   href="{{ URL::route('cabinet.task.comment.create',['task'=>$task]) }}">
                                    Написать комментарий
                                </a>
                            </div>
                        </div>--}}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
