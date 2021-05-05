<label for="exampleInputEmail1">Ward</label>
<select name="union_ward_id" class="form-control">
  <option>Select Ward</option>
  @foreach($wards as $ward)
    <option value="{{ $ward->id }}">{{ $ward->name }}</option>
  @endforeach
</select>