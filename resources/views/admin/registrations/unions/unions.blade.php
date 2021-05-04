<label for="exampleInputEmail1">Union</label>
<select name="union_id" class="form-control">
  <option>Select Union</option>
  @foreach($unions as $union)
    <option value="{{ $union->id }}">{{ $union->name }}</option>
  @endforeach
</select>