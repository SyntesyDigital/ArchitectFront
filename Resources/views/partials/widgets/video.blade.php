
<div class="item {{$class}} {{$settings['htmlClass'] or ''}}">
  @if(isset($video))
    @include('front::partials.typologies.video',[
      "field" => $video,
      "settings" => $settings
    ])
  @endif
</div>
