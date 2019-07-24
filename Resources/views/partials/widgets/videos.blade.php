@php

  $videos = null;

  if(isset($field['fields'][0]) && isset($field['fields'][0]['value']) && sizeof($field['fields'][0]['value']) > 0){
      $videos = $field['fields'][0]['value'];
  }

@endphp
@if(isset($videos))
<div class="container p-0">
  <div id="{{$field['settings']['htmlId'] or ''}}" class="videos-list {{$field['settings']['htmlClass'] or ''}} {{$field['settings']['columns'] or ''}}">
    <div id="carousel-video" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @php $i = 0; @endphp
        @foreach($videos as $video)
          <li data-target="#carousel-full" data-slide-to="{{$i}}" class="{{$i == 0 ? 'active' : ''}}"></li>
          @php $i++; @endphp
        @endforeach
      </ol>

      <div class="carousel-inner" role="listbox">
        @php $i = 0; @endphp
        @foreach($videos as $video)
            @include('front::partials.widgets.video',[
              "field" => $video,
              "settings" => $field['settings'],
              "class" => $i == 0 ? 'active' : ''
            ])
            @php $i++; @endphp
        @endforeach
      </div>
      @if(count($videos) > 1)
        <a class="left carousel-control" href="#carousel-video" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel-video" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
      @endif
  </div>
</div>
@endif
