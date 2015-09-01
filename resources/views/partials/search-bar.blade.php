@inject('languages', '\App\Language')
@if(count($languages::all()) > 0)
    <div id="top-search-bar" class="row">
        <form action="/languages/search" method="POST">
            {!! csrf_field() !!}
            <div class="col-xs-4 form-group">
                <select class="form-control" name="language_id" type="select">
                    @foreach($languages::all() as $language)
                        <option value="{{$language->id}}">{{$language->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-5 form-group">
                <input name="search-term" type="text" class="form-control" />
            </div>
            <div class="col-xs-3 form-group">
                <button class="btn btn-default" type="submit">Search</button>
            </div>
        </form>
    </div>
@endif