<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }

    .ck.ck-content ul,
    .ck.ck-content ul li{
        list-style-type: inherit;
    }

    .ck.ck-content ul {
    /* Default user agent stylesheet, you can change it to your needs. */
        padding-left: 40px;
    }

    .ck.ck-content ol {
    /* Default user agent stylesheet, you can change it to your needs. */
        padding-left: 40px;
    }
</style>
@push('scripts')
<script>
    ClassicEditor
        .create( document.querySelector('#ckeditor5'))
        .then( editor => {
            editor.model.document.on( 'change', () => {
                $('#preview_post_content').html(editor.getData());
            });
        })
        .catch( error => {
            console.error( error );
        });
</script>
@endpush
