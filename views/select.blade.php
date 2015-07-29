<form method="get">
    <?php $active = isset($attributes['active']) ? $attributes['active']  :'' ?>
    <select name="file">
        @foreach($files as $file)
        <option value="{{$file->getRelativePathname()}}" @if($active == $file->getRelativePathname()) selected="selected" @endif>
            {{$file->getRelativePathname()}}
        </option>
        @endforeach
    </select>

    <input type="button" value="{{_('Load')}}">
</form>