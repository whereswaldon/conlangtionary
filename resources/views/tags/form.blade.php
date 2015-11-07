<div class='form-group'>
    <label for='language_id'>Language</label>
    <select class='form-control' type='select' name='language_id'>
	    @forelse($languages as $language)
	    @if((isset($tag->language_id) && $tag->language_id == $language->id)
	    || (isset($target_language) && $language->id == $target_language->id))
	    <option name='{{$language->name}}' value='{{$language->id}}' selected>{{$language->name}}</option>
	    @else
	    <option name='{{$language->name}}' value='{{$language->id}}'>{{$language->name}}</option>
	    @endif
	    @empty
	    <option name='' value=''>You need to add languages before tags</option>
	    @endforelse
    </select>
</div>
<div class='form-group'>
	<label for='name'>Tag</label>
	<input class='form-control' type="text" name="name" value="{{ $tag->name or "" }}">
</div>
<div class='form-group'>
	<label for='abbreviation'>Abbreviation</label>
	<input class='form-control' type="text" name="abbreviation" value="{{ $tag->abbreviation or "" }}">
</div>
<div class='form-group'>
	<label for='description'>Description</label>
	<textarea class='form-control' type="text" name="description">{{ $tag->description or ""}}</textarea>
</div>
<div class='form-group'>
    <label for='notes'>Notes</label>
    <textarea class='form-control' type="text" name="notes">{{ $tag->notes or ""}}</textarea>
</div>
