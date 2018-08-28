<div class="row">
    <div class="col-md-8 offset-4">
            <div class="input-group mb-3">
                <select class="custom-select" id="type">
                    <option value="none" selected>Select a value...</option>
                    <option value="type">Type</option>
                    <option value="topic">Topic</option>
                    <option value="year">Year</option>
                </select>
                <select class="custom-select" id="noneSelect" disabled>

                </select>
                <select class="custom-select" id="typeSelect" hidden>
                    <option value="none">Select a value...</option>
                    @if(!empty($singleType))
                    @foreach($singleType as $type)
                    <option value="{{$type}}">{{$type}}</option>
                    @endforeach
                    @else
                    <option>No values...</option>
                    @endif
                </select>
                <select class="custom-select" id="topicSelect" hidden>
                    <option value="none">Select a value...</option>
                    @if(!empty($singleTopic))
                    @foreach($singleTopic as $topic)
                    <option value="{{$topic}}">{{$topic}}</option>
                    @endforeach
                    @else
                    <option>No values...</option>
                    @endif
                </select>
                <select class="custom-select" id="yearSelect" hidden>
                    <option value="none">Select a value...</option>
                    @if(!empty($singleYear))
                    @foreach($singleYear as $year)
                    <option value="{{$year}}">{{$year}}</option>
                    @endforeach
                    @else
                    <option>No values...</option>
                    @endif
                </select>
                <div class="input-group-append">
                    <button id="btnSubmit" class="btn btn-info">Filter</button>
                </div>
            </div>
    </div>

</div>

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#type').on('change' , function()  {
            value = $(this).val();
            noneSelect = $('#noneSelect');
            typeSelect = $('#typeSelect');
            topicSelect = $('#topicSelect');
            yearSelect = $('#yearSelect');
            switch($(this).val()){
                case "type" :
                    noneSelect.attr('hidden' , true);
                    typeSelect.attr('hidden' , false);
                    topicSelect.attr('hidden' , true);
                    yearSelect.attr('hidden' , true);;
                    break;
                case "topic" :
                    noneSelect.attr('hidden' , true);
                    typeSelect.attr('hidden' , true);
                    topicSelect.attr('hidden' , false);
                    yearSelect.attr('hidden' , true);
                    break;
                case "year" :
                    noneSelect.attr('hidden' , true);
                    typeSelect.attr('hidden' , true);
                    topicSelect.attr('hidden' , true);
                    yearSelect.attr('hidden' , false);
                    break;
            }

        })

        $('#btnSubmit').on('click' , function() {
            switch($('#type').val()){
                case "type" :
                    if(!$('#typeSelect').val() !== "none")
                        window.location.href = 'publications/index/type/' + $('#typeSelect').val();
                    break;
                case "topic" :
                    noneSelect.attr('hidden' , true);
                    typeSelect.attr('hidden' , true);
                    topicSelect.attr('hidden' , false);
                    yearSelect.attr('hidden' , true);
                    break;
                case "year" :
                    if(!$('#yearSelect').val() !== "none")
                        window.location.href = 'publications/index/year/' + $('#yearSelect').val();
                    break;
                    break;
            }
        });

    })
</script>
@endpush()

