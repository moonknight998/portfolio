@push('scripts')
<!--Summernote Post-->
<script src="{{asset('lang/summernote-vi-VN.js')}}"></script>
<script>
    $('#summernote-post').summernote({
        lang: 'vi-VN',
        placeholder: '{{__('admin/common.type_your_content')}}',
        tabsize: 2,
        height: 360,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture', 'video']],
        ],
        callbacks: {
        onChange: function(contents, $editable) {
            console.log(contents);
            $('#preview_post_content').html(contents);
        }
        }
    });
</script>
@endpush