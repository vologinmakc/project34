$(function () {
    $('.js-delete-image').each(function () {
        let component = $(this);

        component.on('click', function (event) {
            let image_id = this.getAttribute('data');

            let delete_img = confirm('Удалить изображение?');
            if (delete_img) {
                $.ajax({
                    url: '/cabinet/task/image/delete',
                    type: 'POST',
                    data: {id: image_id},
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('#'+image_id).remove();
                    },

                    error: function (msg) {
                    }
                });
            }
        });
    });
});
