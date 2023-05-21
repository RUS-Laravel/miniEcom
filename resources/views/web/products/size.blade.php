<select name="size_id" id="size_id">
    <option value="">Select</option>
    @foreach ($sizes ?? [] as $size)
        <option value="{{ $size->size->id }}" {{ $loop->first ? 'selected':'' }}>{{ $size->size->size }}</option>
    @endforeach
</select>
