<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18 top_heading_text">{{ $heading ?? '' }}</h4>

            {{--                                <div class="page-title-right">--}}
            {{--                                    <ol class="breadcrumb m-0">--}}
            {{--                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>--}}
            {{--                                        <li class="breadcrumb-item active">Horizontal Layout</li>--}}
            {{--                                    </ol>--}}
            {{--                                </div>--}}

            @if(isset($goBack))
            <button onclick="location.href='{{ $goBack }}'" type="button" class="mt-4 btn waves-effect" >
                <i style="font-size: 15px" class="fas fa-backspace"> Go Back</i>
            </button>
                @endif
        </div>

    </div>
</div>
