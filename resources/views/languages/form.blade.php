<div class='form-group'>
	<label for='name'>Name</label>
	<input class='form-control' type="text" name="name" value="{{ $language->name or "" }}">
</div>
<div class='form-group'>
    <label for='name'>Sentence-length Description</label>
    <input class='form-control' type="text" name="short_description" value="{{ $language->short_description or "" }}">
</div>
<div class='form-group'>
    <label for='notes'>Notes</label>
    <textarea class='form-control' type="text" name="notes">{{ $language->notes or ""}}</textarea>
</div>
