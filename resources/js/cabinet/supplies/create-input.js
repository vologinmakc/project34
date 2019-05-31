$(function () {
    $('#add-input').each(function () {
        let component = $(this),
            cnt = 1;


        $('#btn-element').on('click', function () {
            let input = `<div class="form-group">
                            <label for="taskTitleInput"><small class="text-info"><i>Новая позиция</i></small></label>
                            <input type="text" class="form-control" name="sub_task${cnt}"
                                      placeholder="Описание" required>
                         </div>`;
            component.append(input);
            cnt++;
        });


    });
});

// скрипт для отправки состояния чекбокса подзадач(subtasks)
$(function () {
    $('.js-checkbox').each(function () {
        let component = $(this);

        component.on('click', function (event) {
            let checkbox_id = this.getAttribute('data');
            let checkbox_status = this.checked;

            let hidden_input = $('#' + checkbox_id);
            hidden_input.attr('name', checkbox_id);
            hidden_input.val(checkbox_status);
        });
    });
});

// скрипт для изменения статуса задачи
$(function () {
    $('.js-status-modal').each(function () {
        let component = $(this);

    });

    $('#updateStatus').on('show.bs.modal', function (e) {
        let el_task_status = (e.relatedTarget),
        task_id = el_task_status.getAttribute('data');

        // добавим в скрытое поле id задачи
        let input_hidden_modal = $(this).find('#task_id');
        input_hidden_modal.val(task_id);
    })
});
