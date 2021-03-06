<div class='form-group'>
    <label for='word_id'>Definition for Word</label>
    <select class='form-control' type='select' name='word_id'>
        @forelse($words as $word)
            @if((isset($definition->word_id) && $definition->word_id == $word->id)
            || (isset($target_word) && $word->id == $target_word->id))
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
    <label for='definition_text'>Definition Text</label>
    <input class='form-control' type="text" name="definition_text" value="{{ $definition->definition_text or "" }}">
</div>
@if(isset($tags))
    <div class='form-group'>
        <label for='tags'>Tags</label>
        <select id="tags" class="form-control" name="tags[]" multiple="multiple">
            @foreach($tags as $tag)
                <option name="{{$tag->name}}" value="{{$tag->name}}"
                @if((isset($definition) && $definition->tags->contains($tag)))
                    selected
                @endif
                >{{$tag->name}}</option>
            @endforeach
        </select>
    </div>
@endif
<div class='form-group'>
    <label for='notes'>Notes</label>
    <textarea class='form-control' type="text" name="notes">{{ $definition->notes or ""}}</textarea>
</div>
