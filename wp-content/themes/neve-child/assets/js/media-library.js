jQuery(document).ready(function ($) {

    jQuery('#upload_image_button').on('click', function (event) {
        event.preventDefault();

        var file_frame;
        var wp_media_post_id = $(this).data('attachment_id');
        var set_to_post_id = $(this).data('post_id');

        if (file_frame) {
            file_frame.uploader.uploader.param('post_id', set_to_post_id);
            file_frame.open();
            return;
        } else {
            wp.media.model.settings.post.id = set_to_post_id;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select a image to upload',
            button: {
                text: 'Use this image',
            },
            multiple: false
        });

        file_frame.on('select', function () {
            attachment = file_frame.state().get('selection').first().toJSON();

            $('#image-preview').attr('src', attachment.url).css('width', 'auto');
            $('#image_attachment_id').val(attachment.id);

            wp.media.model.settings.post.id = wp_media_post_id;
        });

        file_frame.open();
    });

    jQuery('#remove_image_button').on('click', function (event) {
        event.preventDefault();

        $('.image-preview-wrapper').html('');

        $('#upload_image_button').data('attachment_id', null);
        $('#upload_image_button').data('post_id', null);
    });

    jQuery('a.add_media').on('click', function () {
        wp.media.model.settings.post.id = wp_media_post_id;
    });
});