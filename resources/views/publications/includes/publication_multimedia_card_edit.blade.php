@push('styles')
    <link href="{{ asset('vendor/bootstrap-fileinput/css/fileinput.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fa/theme.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush

<div class="row">
    <div class="card w-100">
        <div class="card-body">
            <label>Publication multimedia</label>
            @if(!empty($publicationMultimedias))
                @foreach($publicationMultimedias as $multimedia)
                    <form action="{{ route('multimedias.destroy' , ['id' => $multimedia->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="row border p-2 mb-2">
                            <div class="col-md-2 col-sm-2 align-self-center">
                                @if(($multimedia->type === 'image/png') or ($multimedia->type === 'image/jpeg') or ($multimedia->type === 'image/jpg'))
                                    <i class="fas fa-file-image fa-3x text-primary"></i>
                                @elseif(($multimedia->type === 'video/mkv') or ($multimedia->type === 'video/avi') or ($multimedia->type === 'video/mp4'))
                                    <i class="fas fa-file-video fa-3x text-primary"></i>
                                @elseif($multimedia->type === 'audio/mpeg')
                                    <i class="fas fa-file-audio fa-3x text-primary"></i>
                                @endif
                            </div>
                            <div class="col-md-8 col-sm-8 align-self-center">
                                <h6>{{ $multimedia->name }}</h6>
                            </div>
                            <div class="col-md-2 col-sm-2 align-self-sm-end">
                                <!-- Button trigger modal -->
                                <button class="btn btn-link text-primary" type="button"
                                        data-toggle="modal" data-target="#fileModal{{ $multimedia->id }}">
                                    <i class="fas fa-search-plus"></i>
                                </button>
                                <button class="btn btn-link text-danger" type="submit">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                        </div>
                    </form>


                    <!-- Modal -->
                    <div class="modal fade" id="fileModal{{ $multimedia->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="fileModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fileModalTitle">{{ $multimedia->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('multimedias.destroy' , ['id' => $multimedia->id]) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        @if(($multimedia->type === 'image/png') or ($multimedia->type === 'image/jpeg') or ($multimedia->type === 'image/jpg'))
                                            <img class="img-fluid" src="{{ asset('storage/' . $multimedia->url) }}"
                                                 alt="">
                                        @elseif(($multimedia->type === 'video/mkv') or ($multimedia->type === 'video/avi') or ($multimedia->type === 'video/mp4'))
                                            <video class="w-100" controls>
                                                <source src="{{ asset('storage/' . $multimedia->url) }}"
                                                        type="{{ $multimedia->type }}">
                                            </video>
                                        @elseif($multimedia->type === 'audio/mpeg')
                                            <audio class="w-100" controls>
                                                <source src="{{ asset('storage/' . $multimedia->url) }}"
                                                        type="{{ $multimedia->type }}">
                                            </audio>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-link" data-dismiss="modal">
                                            <i class="fas fa-window-close fa-2x text-info"></i>
                                        </button>
                                        <button type="submit" class="btn btn-link">
                                            <i class="fas fa-trash-alt fa-2x text-danger"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="float-right">
                    {{ $publicationMultimedias->links() }}
                </div>
        </div>
        @else
            <h4>There are no images , videos or audios for this publication.</h4>
        @endif
    </div>

</div>


<div class="row mt-3">
    <div class="card w-100">
        <div class="card-body">
            <label>Upload new file</label>
            <div class="file-loading">
                @csrf
                <input id="publicationId" type="hidden" value="{{ $publication->id }}">
                <input type="file" id="filesToUpload" name="file[]"
                       multiple data-show-caption="true"
                       data-msg-placeholder="Select {files} for upload...">
            </div>
        </div>
    </div>

</div>

@push('body.scripts')
    <script src="{{ asset('vendor/bootstrap-fileinput/js/plugins/piexif.min.js') }}" type="text/javascript"></script>
    <!-- the main fileinput plugin file -->
    <script src="{{ asset('vendor/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
    <!-- optionally uncomment line below for loading your theme assets for a theme like Font Awesome (`fa`) -->
    <script src="{{ asset('vendor/bootstrap-fileinput/themes/fa/theme.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendor/bootstrap-fileinput/themes/explorer-fa/theme.min.js') }}"
            type="text/javascript"></script>

    <!-- optionally if you need translation for your language then include  locale file as mentioned below -->
    <script type="text/javascript">
        $(document).ready(function () {
            console.log($("input[name = '_token']").val());

            $('#filesToUpload').on('fileuploaded', function (event, data, previewId, index) {
                console.log('uploaded')
                window.reload(true);
            });

            $('#filesToUpload').on('filebatchuploadsuccess', function (event, data) {
                console.log('File batch upload success');
                window.location.reload(true);
            });


            $('#filesToUpload').fileinput({
                hideThumbnailContent: false, // hide image, pdf, text or other content in the thumbnail preview
                minFileCount: 1,
                maxFileCount: 5,
                overwriteInitial: false,
                theme: 'explorer-fa',
                uploadUrl: '/multimedias',
                previewFileIcon: '<i class="fa fa-file"></i>',
                uploadExtraData: function () {
                    return {
                        publicationId: $('#publicationId').val(),
                        _token: $("input[name = '_token']").val()
                    }
                },
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'avi', 'mp4', 'mkv', 'mp3', 'pdf', 'doc', 'docx', 'ppt', 'pptx'],
                maxFileSize: 10000,
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
                    'doc': function (ext) {
                        return ext.match(/(doc|docx)$/i);
                    },
                    'xls': function (ext) {
                        return ext.match(/(xls|xlsx)$/i);
                    },
                    'ppt': function (ext) {
                        return ext.match(/(ppt|pptx)$/i);
                    },
                    'zip': function (ext) {
                        return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
                    },
                    'htm': function (ext) {
                        return ext.match(/(htm|html)$/i);
                    },
                    'txt': function (ext) {
                        return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
                    },
                    'mov': function (ext) {
                        return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
                    },
                    'mp3': function (ext) {
                        return ext.match(/(mp3|wav)$/i);
                    }
                }
            });


        })
    </script>
@endpush


