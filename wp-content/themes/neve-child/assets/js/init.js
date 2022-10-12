jQuery(document).ready(function ($) {
    jQuery('#ads-form').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData();
        let timeToSend = '2000';

        const title = $(this).find('input[name="title"]').val();
        const email = $(this).find('input[name="email"]').val();

        formData.append("action", 'save_form_data');
        formData.append("image", $('#file')[0].files[0]);
        formData.append("title", title);
        formData.append("email", email);

        $.ajax({
            url: ajax_object.ajax_url,
            data: formData,
            method: 'POST',
            processData: false,
            contentType: false,
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.myprogress').text(percentComplete + '%');
                        $('.myprogress').css('width', percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function (data) {
                alert('The form was added');
                location.reload();
            }
        });
    });
})

