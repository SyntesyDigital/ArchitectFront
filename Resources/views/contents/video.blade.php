@php
  $htmlClass = isset($contentSettings) && isset($contentSettings['htmlClass']) ? $contentSettings['htmlClass'] : '';
  $pageType = isset($contentSettings) && isset($contentSettings['pageType']) ? $contentSettings['pageType'] : '';
  $idClass = isset($content) ? "id_".$content->id : '';
@endphp

@extends('front::layouts.master',[
  'title' => isset($content) ? $content->getFieldValue('title') : '',
  'mainClass' => $pageType.' '.$htmlClass.' '.$idClass,
  'routeAttributes' => $content->getFullSlug()
])

@section('content')

  @if(isset($content))
    <div class="container p-0 single-video">
      <div class="videos-list">
        @php
          $link =isset($fields['video']['value']['url'][App::getLocale()] )? $fields['video']['value']['url'][App::getLocale()] : null;
          if($link != null){
            $title = isset($fields['title']['value'][App::getLocale()]) ? $fields['title']['value'][App::getLocale()] : '';
            $description = isset($fields['description']['value'][App::getLocale()]) ? $fields['description']['value'][App::getLocale()] : '';
            $date =  date('d/m/Y h:i A',strtotime($fields['video']['created_at']));
            $youtube_id = explode('/',$link);
            $youtube_id = $youtube_id[sizeof($youtube_id)-1];
            $views = $fields['youtube-views']['value'][''];
            if($views > 1000){
              $views = round($views/1000).' K';
            }

          }
        @endphp
        @if(isset($link))
          <div id="{{$contentSettings['htmlId'] or ''}}" class="widget banc-media video {{$contentSettings['htmlClass'] or ''}}">

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
      </div>

      <div id="" class="separator " style="height:30px">
      </div>

      <div class="category-videos">
        <div id="related-videos"
          typology=2
          category="{{$content->categories()->first()->id}}"
          videoId="{{$content->id}}"
        >
        </div>
      </div>


    </div>

  @endif




@endsection

@push('javascripts')
<script>
    routes = {"categoryNews" : "{{route('blog.category.index' ,['slug' => ':slug'])}}"};
    $(function(){

    });
</script>
@endpush
