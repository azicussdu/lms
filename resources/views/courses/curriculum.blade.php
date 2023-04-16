<div class="tab-pane fade show active" id="curriculam" role="tabpanel"
aria-labelledby="curriculam-tab">
<div class="curriculam-cont">
{{--    <div class="title">--}}
{{--        <h6>{{ $course->name }} @lang(' Lecture Started')</h6>--}}
{{--    </div>--}}
    <div class="accordion" id="accordionExample">
        @foreach ($course->lessons as $key => $lesson)
            <div class="card">
                <div class="card-header" id="headingOne{{ $lesson->id }}" data-toggle="collapse"
                     data-target="#collapseOne{{ $lesson->id }}">
                    <h2 class="mb-0 title">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapseOne{{ $lesson->id }}" aria-expanded="true"
                                aria-controls="collapseOne">
                            @lang('Урок ' . $key + 1)
                        </button>
                        <strong style="font-size: 18px !important"
                                class="pull-right">{{ $lesson->title }} <br><span
                                class="pull-right"><i class="fa fa-clock-o"
                                                      aria-hidden="true"></i>{{ $lesson->duration }}</span></strong>
                    </h2>
                </div>

                <div id="collapseOne{{ $lesson->id }}" class="collapse"
                     aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <video width="660" height="450" controls>
                            <source src="{{ $lesson->video() }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        {!! $lesson->content !!}
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div> <!-- curriculam cont -->
</div>
