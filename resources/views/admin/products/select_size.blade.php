<select class="custom-select my-1 mr-sm-3" id="sizeinput" name="size_id" data-control="product-size">
    <option value="">Select</option>
    @foreach ($sizes ?? [] as $size)
        <option value="{{ $size->size->id }}" {{ $loop->first ? 'selected':'' }}>{{ $size->size->size }}</option>
    @endforeach
</select>