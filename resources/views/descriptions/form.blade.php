<div class='form-group'>
    <label for='language_id'>Language</label>
    <select class='form-control' type='select' name='language_id'>
	    @forelse($languages as $language)
	    @if(isset($description->language_id) && $description->language_id == $language->id)
	    <option name='{{$language->name}}' value='{{$language->id}}' selected>{{$language->name}}</option>
	    @else
	    <option name='{{$language->name}}' value='{{$language->id}}'>{{$language->name}}</option>
	    @endif
	    @empty
	    <option name='' value=''>You need to add languages before descriptions</option>
	    @endforelse
    </select>
</div>
<div class='form-group'>
    <label for='description'>Description</label>
    <textarea class='form-control' type="text" name="description">{{ $description->description or ""}}</textarea>
</div>
