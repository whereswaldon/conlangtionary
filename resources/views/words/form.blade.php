<div class="panel panel-default">
    <div class="panel-heading">
        <p>Word</p>
    </div>
    <div class="panel-body">
        <div class='form-group'>
            <label for='ascii_string'>Word</label>
            <input class='form-control' type="text" name="ascii_string" value="{{ $word->ascii_string or "" }}">
        </div>
        <div class='form-group'>
            <label for='language_id'>Language</label>
            <select class='form-control' type='select' name='language_id'>
                @forelse($languages as $language)
                    @if((isset($word->language_id) && $word->language_id == $language->id)
                    || (isset($target_language) && $language->id == $target_language->id))
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
            <label for='notes'>Word Notes</label>
            <textarea class='form-control' type="text" name="notes">{{ $word->notes or ""}}</textarea>
        </div>
    </div>
</div>
@if(isset($withDefinition) && $withDefinition)
    <div class="panel panel-default">
        <div class="panel-heading">
            <p>Definition</p>
        </div>
        <div class="panel-body">
            <input type="hidden" name="withDefinition" value="true"/>
            <div class='form-group'>
                <label for='definition_text'>Definition Text</label>
                <input class='form-control' type="text" name="definition_text" value="{{ $definition->definition_text or "" }}">
            </div>
                <div class='form-group'>
                    <label for='tags'>Definition Tags</label>
                    <select id="tags" class="form-control" name="definition_tags[]" multiple="multiple">
                        @foreach($target_language->tags as $tag)
                            <option name="{{$tag->name}}" value="{{$tag->name}}"
                            @if((isset($definition) && $definition->tags->contains($tag)))
                                    selected
                                    @endif
                                    >{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
            <div class='form-group'>
                <label for='notes'>Definition Notes</label>
                <textarea class='form-control' type="text" name="definition_notes">{{ $definition->notes or ""}}</textarea>
            </div>
        </div>
    </div>
@endif
