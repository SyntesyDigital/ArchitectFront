@php
  $settings = isset($settings) ? $settings : $field['settings'];

  $link = isset($field['fields']['video']['values']['url'][App::getLocale()]) ? $field['fields']['video']['values']['url'][App::getLocale()] : null;
  if($link != null){
    $title = isset($field['fields']['title']['values'][App::getLocale()]) ? $field['fields']['title']['values'][App::getLocale()] : '';
    $description = isset($field['fields']['description']['values'][App::getLocale()]) ? $field['fields']['description']['values'][App::getLocale()] : '';
    $date = date('d/m/Y h:i A',strtotime($field['fields']['video']['created_at']));
    $youtube_id = explode('/',$link);
    $youtube_id = $youtube_id[sizeof($youtube_id)-1];
    $views = $field['fields']['youtube-views']['values'][''];
    if($views > 1000){
      $views = round($views/1000).' K';
    }
  }
@endphp
@if(isset($link))
<div id="{{$settings['htmlId'] or ''}}" class="widget banc-media video {{$settings['htmlClass'] or ''}}">

  <div class="col-md-6 iframe-container">
    <iframe width="100%"  src="https://www.youtube.com/embed/{{$youtube_id}}?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
  </div>
  <div class="col-md-6 text-container">
    <h4 class="titol">{{$title}}</h4>
    {!!$description!!}
    <p class="date">{{$date}}</p>
    <p class="actions">{{$views}} |
        @php
					$shareUrl = urlencode($link);
				@endphp
         <a href="https://www.facebook.com/sharer/sharer.php?u={{$shareUrl}}&t={{$title}}"
  					class="share-button first-share-btn"
  					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
  					 target="_blank" title="Share on Facebook">
             <i class="fa fa-facebook"></i>
  				</a>

          <a href="https://twitter.com/share?url={{$shareUrl}}&text={{$title}}"
  					class="share-button"
  					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
  					 target="_blank" title="Share on Twitter">
             <i class="fa fa-twitter"></i>
  				</a>

          <a href="mailto:?subject={{$title}}&body={{$shareUrl}}"
  					class="mail-button">
            <i class="fa fa-envelope" ></i>
  				</a>
    </p>
  </div>
</div>
@endif
