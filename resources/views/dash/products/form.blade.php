@csrf
<div class="form-group">
@error('name')<div style="color:red;">{{ $message }}</div>@enderror
<label for="exampleInputName1">Name</label>
<input type="text" class="form-control" value="{{ old('name',$pro->name??'') }}" name="name" id="exampleInputName1" placeholder="Name">
</div>
<div class="form-group">
@error('price')<div style="color:red;">{{ $message }}</div>@enderror
<label for="exampleInputEmail3">Price</label>
<input type="text" class="form-control" value="{{ old('price',$pro->price??'') }}" name="price" id="exampleInputEmail3" placeholder="price">
</div>
<div class="form-group">
@error('sale')<div style="color:red;">{{ $message }}</div>@enderror
<label for="exampleInputPassword4">sale</label>
<input type="text" class="form-control" value="{{ old('sale',$pro->sale??'') }}" name="sale" id="exampleInputPassword4" placeholder="sale">
</div>

<div class="form-group">
@error('count')<div style="color:red;">{{ $message }}</div>@enderror
<label for="exampleInputPassword4">count</label>
<input type="text" class="form-control" value="{{ old('count',$pro->count??'') }}" name="count" id="exampleInputPassword4" placeholder="count">
</div>
<div class="form-group">
@error('cateogry')<div style="color:red;">{{ $message }}</div>@enderror
<label for="exampleSelectGender">Cateogry</label>
<select name="cateogry" class="form-control" id="exampleSelectGender">
@forelse (config('cateogry')["cateogry"] as $val )
<option value="{{ $val }}" @selected($val==old("cateogry",$pro->cateogry??''))>{{ $val }}</option>

@empty

@endforelse
</select>
</div>
<div class="form-group">
@error('img')<div style="color:red;">{{ $message }}</div>@enderror
@error('img.*')<div style="color:red;">{{ $message }}</div>@enderror
<label>File upload</label>
<input type="file" multiple name="img[]" class="file-upload-default">
<div class="input-group col-xs-12">
<input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
<span class="input-group-append">
<button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
</span>
</div>
</div>

<button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
<button class="btn btn-light">Cancel</button>
</form>
</div>
</div>
</div>
