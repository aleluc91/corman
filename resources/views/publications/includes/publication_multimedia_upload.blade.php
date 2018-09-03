@push('styles')
    <link href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fa/theme.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush


<h4 class="mt-4 mb-3">Upload new files</h4>
<div class="file-loading">
    @csrf
    <input id="publicationId" type="hidden" value="{{ $publication->id }}">
    <input type="file" id="filesToUpload" name="file[]"
           multiple  data-show-caption="true"
           data-msg-placeholder="Select {files} for upload...">
</div>
{{--<div class="mt-3" id="imageHolder" class="mt-3"></div>--}}

@push('body.scripts')
    <script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
    <!-- the main fileinput plugin file -->
    <script src="{{ asset('vendor/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
    <!-- optionally uncomment line below for loading your theme assets for a theme like Font Awesome (`fa`) -->
    <script src="{{ asset('vendor/bootstrap-fileinput/themes/fa/theme.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fa/theme.min.js') }}" type="text/javascript"></script>

    <!-- optionally if you need translation for your language then include  locale file as mentioned below -->
    <script type="text/javascript">
        $(document).ready(function () {
            console.log($("input[name = '_token']").val());
            $('#filesToUpload').fileinput({
                hideThumbnailContent: false, // hide image, pdf, text or other content in the thumbnail preview
                minFileCount: 1,
                maxFileCount: 5,
                overwriteInitial: false,
                theme: 'explorer-fa',
                uploadUrl: 'http://localhost/corman/public/multimedias/store',
                previewFileIcon: '<i class="fa fa-file"></i>',
                uploadExtraData: function() {
                    return{
                        publicationId : $('#publicationId').val(),
                        _token : $("input[name = '_token']").val()
                    }
                },
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'avi', 'mp4', 'mkv', 'mp3', 'pdf', 'doc', 'docx', 'ppt', 'pptx'],
                maxFileSize: 10000,
                maxFileCount: 5,
                uploadAsync: false,
                showUploadedThumbs: false,
                preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
                previewFileIconSettings: { // configure your icon file extensions
                    'doc': '<i class="fas fa-file-word text-primary"></i>',
                    'ppt': '<i class="fas fa-file-powerpoint text-primary"></i>',
                    'pdf': '<i class="fas fa-file-pdf text-primary"></i>',
                    'txt': '<i class="fas fa-file-text text-primary"></i>',
                    'mov': '<i class="fas fa-file-movie text-primary"></i>',
                    'mp3': '<i class="fas fa-file-audio text-primary"></i>',
                    'mp4': '<i class="fas fa-file-movie text-primary"></i>',
                    // note for these file types below no extension determination logic
                    // has been configured (the keys itself will be used as extensions)
                    'jpg': '<i class="fas fa-file-image text-primary"></i>',
                    'gif': '<i class="fas fa-file-image text-primary"></i>',
                    'png': '<i class="fas fa-file-image text-primary"></i>'
                },
                previewFileExtSettings: { // configure the logic for determining icon file extensions
                    'doc': function(ext) {
                        return ext.match(/(doc|docx)$/i);
                    },
                    'xls': function(ext) {
                        return ext.match(/(xls|xlsx)$/i);
                    },
                    'ppt': function(ext) {
                        return ext.match(/(ppt|pptx)$/i);
                    },
                    'zip': function(ext) {
                        return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                    },
                    'htm': function(ext) {
                        return ext.match(/(htm|html)$/i);
                    },
                    'txt': function(ext) {
                        return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
                    },
                    'mov': function(ext) {
                        return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                    },
                    'mp3': function(ext) {
                        return ext.match(/(mp3|wav)$/i);
                    }
                }
            });
        })
    </script>
@endpush