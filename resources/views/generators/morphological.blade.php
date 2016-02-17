@extends('layouts.inner')

@section('main-content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Morphological Word Generator
        </div>
        <div class="panel-body">
            <form method="POST"
                  action="{{ action('LanguagesController@processMorphologicalGenerator',
                  ['language_id' => $language->id]) }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12">
                        <p class="help-block">
                            This generator allows you to take existing vocabulary and transform it into new vocabulary
                            according to rules. This is only effective for transformations that are "regular" in the
                            formal grammatical sense. An example of its useage would be as follows:
                            To transform the English infinitive into the English present tense:
                            For your source tags, you want to select the following tags:<br>
                            Verb, Infinitive, Regular-Conjugation<br>
                            For your source Pattern, you'll want to use a PHP regular expression to match against the
                            ascii strings of all words with those tags. In this case,<br>
                            /to ([[:alpha:]]+)/<br>
                            should match any English infinitive. The parenthesis cause PHP to save the section of the
                            string for reuse.
                            For your target tags, you want to select:<br>
                            Verb, Present-Tense, First-Person, Second-Person, Regular-Conjugation<br>
                            For the target pattern, you get to reuse any captured sections of the string from the
                            pattern. In our example, we capture any number of alphanumeric characters after the word "to".
                            Since that section of the string is the first section of the pattern wrapped in parenthesis,
                            it is captured and bound to the token $1. If we had used a second pair of parenthesis,
                            whatever substring matched it would be bound to the token $2. For the target pattern, we can
                            use those tokens in a new context.
                            For this example's purposes, the target pattern is simply<br>
                            $1<br>
                            which means for the captured part of the word to used by itself.<br>
                            This would take a string like "to walk" (if it was a word with a definition that had all
                            the proper tags) and would bind $1 to the substring "walk". It would then use "walk" by itself
                            as the word entry for the new definition (which automatically has the new tags).<br>
                            You could use similar methods to take Singular Nouns and make Plural Nouns (source pattern:
                            /([[:alpha:]]+)/ target pattern: $1s)<br>
                            For more information about how to use this generator, please consult the PHP documentation
                            for the <a href="http://php.net/manual/en/function.preg-replace.php">preg_replace function</a>.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <fieldset>
                            <legend>Source</legend>
                            <div class="form-group">
                                <label for="source_tags" class="control-label">Source Tags</label>
                                <select multiple id="source_tags" class="form-control" name="source_tags[]">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                                <p class="help-block">Select all of the tags that a definition must have to be affected
                                by this rule.</p>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="source_pattern">Source Pattern</label>
                                <input type="text" id="source_pattern" class="form-control" name="source_pattern"
                                       required placeholder="PHP regular expression here...">
                                <p class="help-block">Write a PHP regular expression to match the words that have
                                definitions with the above tags.</p>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-6">
                        <fieldset>
                            <legend>Target</legend>
                            <div class="form-group">
                                <label for="target_tags" class="control-label">Target Tags</label>
                                <select multiple id="target_tags" class="form-control" name="target_tags[]">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                                <p class="help-block">Select all of the tags that the product definitions of this
                                transformation should have.</p>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="target_pattern">Target Pattern</label>
                                <input type="text" id="target_pattern" class="form-control" name="target_pattern"
                                       required placeholder="PHP regular expression here...">
                                <p class="help-block">Use the captured segments of the word in a new expression.</p>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3">
                        <button style="width:100%" class="btn btn-default" type="submit">Generate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection