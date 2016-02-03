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
                            Explanation...
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
                                <p class="help-block">What is this?</p>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="source_pattern">Source Pattern</label>
                                <input type="text" id="source_pattern" class="form-control" name="source_pattern"
                                       required placeholder="PHP regular expression here...">
                                <p class="help-block">How does this work?</p>
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
                                <p class="help-block">What is this?</p>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="target_pattern">Target Pattern</label>
                                <input type="text" id="target_pattern" class="form-control" name="target_pattern"
                                       required placeholder="PHP regular expression here...">
                                <p class="help-block">How does this work?</p>
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