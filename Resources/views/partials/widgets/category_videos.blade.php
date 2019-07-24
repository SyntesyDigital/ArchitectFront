@php
  $category_name = '';
  $category_name = Modules\Architect\Entities\Category::where('id',$field['settings']['category'])->first()->name;
@endphp

<div
  id="{{$field['settings']['htmlId'] or ''}}"
  class="{{$field['settings']['htmlClass'] or ''}} {{$field['settings']['columns'] or ''}} category-videos">

  <div id="category-videos"
    field="{{ isset($field) ? base64_encode(json_encode($field)) : null }}"
    categoryName = "{{$category_name}}"
  >
  </div>

</div>
