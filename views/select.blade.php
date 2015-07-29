<form method="get">
    <select name="file">
        @foreach($files as $file)
        <option value="{{$file->getRelativePathname()}}">
            {{$file->getRelativePathname()}}
        </option>
        @endforeach
    </select>

    <input type="button" value="{{_('Load')}}">
</form>