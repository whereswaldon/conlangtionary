<div class='form-group'>
	<label for='ascii_string'>Word</label>
	<input class='form-control' type="text" name="ascii_string" value="{{ $word->ascii_string or "" }}">
</div>
<div class='form-group'>
    <label for='language_id'>Language</label>
    <select class='form-control' type='select' name='language_id'>
	    @forelse($languages as $language)
	    @if(isset($word->language_id) && $word->language_id == $language->id)
	    <option name='{{$language->name}}' value='{{$language->id}}' selected>{{$language->name}}</option>
	    @else
	    <option name='{{$language->name}}' value='{{$language->id}}'>{{$language->name}}</option>
	    @endif
	    @empty
	    <option name='' value=''>You need to add languages before words</option>
	    @endforelse
    </select>
</div>
<div class='form-group'>
    <label for='notes'>Notes</label>
    <textarea class='form-control' type="text" name="notes">{{ $word->notes or ""}}</textarea>
</div>
