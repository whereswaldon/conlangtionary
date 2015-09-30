<div class='form-group'>
    <label for='word_id'>Definition for Word</label>
    <select class='form-control' type='select' name='word_id'>
        @forelse($words as $word)
            @if(isset($definition->word_id) && $definition->word_id == $word->id)
                <option name='{{$word->ascii_string}}' value='{{$word->id}}' selected>{{$word->ascii_string}}&nbsp;-&nbsp;{{$word->language->name}}</option>
            @else
                <option name='{{$word->ascii_string}}' value='{{$word->id}}'>{{$word->ascii_string}}&nbsp;-&nbsp;{{$word->language->name}}</option>
            @endif
        @empty
            <option name='' value=''>You need to add words before definitions</option>
        @endforelse
    </select>
</div>
<div class='form-group'>
	<label for='definition_number'>Definition Number</label>
	<input class='form-control' type="number" name="definition_number" value="{{ $definition->definition_number or 1 }}">
</div>
<div class='form-group'>
    <label for='definition_text'>Definition Text</label>
    <input class='form-control' type="text" name="definition_text" value="{{ $definition->definition_text or "" }}">
</div>
<div class='form-group'>
    <label for='notes'>Notes</label>
    <textarea class='form-control' type="text" name="notes">{{ $definition->notes or ""}}</textarea>
</div>
