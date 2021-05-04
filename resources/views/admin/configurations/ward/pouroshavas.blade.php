<label for="exampleInputEmail1">Pouroshava</label>
<select name="pouroshava_id" class="form-control">
  <option>Select Pouroshava</option>
  @foreach($pouroshavas as $pouroshava)
    <option value="{{ $pouroshava->id }}">{{ $pouroshava->name }}</option>
  @endforeach
</select>