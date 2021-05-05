<label for="exampleInputEmail1">Union</label>
<select onchange="get_ward(this.value)" name="union_id" class="form-control">
  <option>Select Union</option>
  @foreach($unions as $union)
    <option {{ (old('union_id') == $union->id) ? 'selected':'' }} value="{{ $union->id }}">{{ $union->name }}</option>
  @endforeach
</select>