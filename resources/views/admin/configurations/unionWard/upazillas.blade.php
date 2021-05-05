<label for="exampleInputEmail1">Upazilla</label>
<select onchange="get_union(this.value)" name="upazilla_id" class="form-control">
  <option>Select Upazilla</option>
  @foreach($upazillas as $upazilla)
    <option value="{{ $upazilla->id }}">{{ $upazilla->name }}</option>
  @endforeach
</select>