
@extends('front::layouts.master',[
  'name' => isset($category) ? $category->getFieldValue('name') : '',
  'mainClass' => 'video category',
  'routeAttributes' => ["slug" => $category->getFieldValue('slug')],
])

@section('content')

  @if(isset($category))
    <div class="container p-0">
        <div class="category-videos">
          <div id="videos-paginated"
            typology=2
            category="{{$category->id}}"
            categoryName = "{{$category->getFieldValue('name')}}"
          >
          </div>
        </div>

    </div>
  @endif

<!-- END ARTICLE -->
@endsection

@push('javascripts')
<script>
    routes = {"categoryNews" : "{{route('blog.category.index' ,['slug' => ':slug'])}}" };

    $(function(){

    });
</script>
@endpush
