<?php $active = isset($attributes['active']) ? $attributes['active']  :'' ?>
<select name="{{isset($attributes['name']) ? $attributes['name']  :'file'}}" class="{{isset($attributes['class']) ? $attributes['class']  :''}}">
    @foreach($files as $file)
    <option value="{{$file->getRelativePathname()}}" @if($active == $file->getRelativePathname()) selected="selected" @endif>
        {{$file->getRelativePathname()}}
    </option>
    @endforeach
</select>