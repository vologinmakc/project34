@extends('layouts.cabinet')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="post" action="{{ URL::route('cabinet.task.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="taskTitleInput"><h5>Укажите название</h5></label>
                        <input type="text" class="form-control" id="taskTitleInput"
                               placeholder="Название" name="title" required>
                        <small class="form-text text-muted">
                            Это поле будет отображаться в списке задач
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="taskTitleInput"><h5>Опишите суть задачи</h5></label>
                        <textarea name="task_body" class="form-control" id="taskTitleInput"
                                  placeholder="Описание"></textarea>
                        <small class="form-text text-muted">
                            Для более полного понимания задачи
                        </small>
                    </div>

                    <div class="form-group">
                        <small class="form-text text-muted">
                            Выбирите приоритет заявки (по умолчанию Нормальный)
                        </small>
                        <select class="custom-select" name="priority">
                            <option value="HIGH">Высокий</option>
                            <option selected value="NORMAL">Нормальный</option>
                            <option value="LOW">Низкий</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <small class="form-text text-muted">
                            Выбирите исполнителя
                        </small>
                        <select class="custom-select" name="user_id">
                            @if(isset($users) and $users->count() > 0)
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name  }}</option>
                                @endforeach
                            @endif
                        </select>

                    </div>

                    <div class="form-group">
                        <small class="form-text text-muted">
                            Выбирете файлы изображения для загрузки
                        </small>
                        <input type="file" min="1" max="9999" name="task_images[]" multiple="true"
                               accept="image/*,image/jpeg/">
                    </div>

                    <hr>
                    <div id="add-input">

                    </div>
                    <a class="btn btn-dark btn-sm" id="btn-element" href="#">Добавить позицию</a>

                    <hr>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </form>
            </div>
        </div>
    </div>
@endsection
