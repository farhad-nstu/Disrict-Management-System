<label for="exampleInputEmail1">Pouroshava</label>
<select onchange="get_ward(this.value)" name="pouroshava_id" class="form-control">
  <option>Select Pouroshava</option>
  @foreach($pouroshavas as $pouroshava)
    <option {{ (old('pouroshava_id') == $pouroshava->id) ? 'selected':'' }} value="{{ $pouroshava->id }}">{{ $pouroshava->name }}</option>
  @endforeach
</select>