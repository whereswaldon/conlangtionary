<div class='form-group'>
	<label for='name'>Name</label>
	<input class='form-control' type="text" name="name" value="{{ $language->name or "" }}">
</div>
<div class='form-group'>
    <label for='notes'>Notes</label>
    <textarea class='form-control' type="text" name="notes">{{ $language->notes or ""}}</textarea>
</div>
