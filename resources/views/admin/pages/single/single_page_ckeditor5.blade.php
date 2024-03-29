<style>
    .ck-editor__editable_inline {
        min-height: 600px;
    }

    .ck.ck-content ul,
    .ck.ck-content ul li{
        list-style-type: inherit;
    }

    .ck.ck-content ul {
        padding-left: 19px;
    }

    .ck.ck-content ol {
        padding-left: 10px;
    }
</style>
@push('scripts')
<script>
    ClassicEditor
        .create( document.querySelector('#ckeditor5'))
        .then( editor => {
            editor.model.document.on( 'change', () => {
                $('#preview_content').html(editor.getData());

            });
        })
        .catch( error => {
            console.error( error );
        });
</script>
@endpush
