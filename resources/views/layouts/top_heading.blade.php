<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h3 class="top_heading_text mb-0">{{ $heading ?? '' }}</h3>

            {{--                                <div class="page-title-right">--}}
            {{--                                    <ol class="breadcrumb m-0">--}}
            {{--                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Layouts</a></li>--}}
            {{--                                        <li class="breadcrumb-item active">Horizontal Layout</li>--}}
            {{--                                    </ol>--}}
            {{--                                </div>--}}

            @if(isset($goBack))
            <button onclick="location.href='{{ $goBack }}'" type="button" class="btn waves-effect btn-primary" >
                <i style="font-size: 15px" class="fas fa-backspace mr-5"> </i>
                <span>Go Back</span>
            </button>
                @endif
        </div>

    </div>
</div>
