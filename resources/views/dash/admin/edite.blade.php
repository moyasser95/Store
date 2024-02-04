@extends('dash.style.main')
@section('content')
<div class="col-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">
<h4 class="card-title">Basic form elements</h4>
<p class="card-description"> Basic form elements </p>
<form class="forms-sample" action="{{ route('admin.update',$data->id) }}" method="post">
@csrf
@method('PUT')
<div class="form-group">
@error('name')
<div class="alert alert-danger" role="alert">{{ $message }}</div>
@enderror
<label for="exampleInputName1">Name</label>
<input type="text" class="form-control" name="name" value="{{ old('name')??$data->name }}" id="exampleInputName1" placeholder="Name">
</div>

<div class="form-group">
@error('email')
<div class="alert alert-danger" role="alert">{{ $message }}</div>
@enderror
<label for="exampleInputEmail3">Email address</label>
<input type="email" class="form-control" name="email" value="{{ old('email')??$data->email }}" id="exampleInputEmail3" placeholder="Email">
</div>





<div class="form-group">
@error('Gender')
<div class="alert alert-danger" role="alert">{{ $message }}</div>
@enderror
<label for="exampleSelectGender">Gender</label>
<select class="form-control" id="exampleSelectGender" name="gender">
{{ $data->gender }}
<option value="1"  @selected($data->gender==1)  >Male</option>
<option value="0"  @selected($data->gender==0) >Female</option>
</select>
</div>

<div class="form-group">
@error('prive')
<div class="alert alert-danger" role="alert">{{ $message }}</div>
@enderror
<label for="exampleSelectGender">prive</label>
<select class="form-control" id="exampleSelectGender" name="prive">
@foreach (config('permission')['prive'] as $key=>$val )
<option value="{{ $key }}"  @selected($data->type->prive==$key)>{{ $val }}</option>

@endforeach
</select>
</div>


@foreach (config('permission')['permissions'] as $val )
<div class="form-check">
<label class="form-check-label">
<input type="checkbox" class="form-check-input" @checked(in_array($val,$data->type->permissions)) name="permissions[]" value="{{ $val }}"> {{ $val }} <i class="input-helper"></i></label>
</div>
@endforeach

<button type="submit" class="btn btn-gradient-primary me-2">Update</button>
<button class="btn btn-light">Cancel</button>
</form>
</div>
</div>
</div>

@endsection
