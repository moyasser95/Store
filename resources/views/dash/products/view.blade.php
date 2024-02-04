@extends('dash.style.main')

@section('content')
@if (Session::has('ms_admin'))
<div class="alert alert-success" role="alert">
    <span class="text-dark text-capitalize">{{ session('ms_admin') }}</span>
</div>
@endif
<a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">
<h4 class="card-title">Inverse table</h4>
<p class="card-description"> Add class <code>.table-dark</code>
</p>
<table class="table table-dark text-center">
<thead>
<tr>
<th> # </th>
<th> name </th>
<th> price </th>
<th> sale </th>
<th> count </th>
<th> cateogry </th>
<th> images </th>
<th> Controller </th>

</tr>
</thead>
<tbody>
@forelse ($data as $key=>$row)
<tr>
<td> {{ ++$key }} </td>
<td> {{ $row->name }} </td>
<td> {{ $row->price }} </td>
<td> {{ $row->sale }} </td>
<td> {{ $row->count }} </td>
<td> {{ $row->cateogry }} </td>
<td>
@foreach ($row->images as $file)
<img src="{{ asset('storage/images/'.$file['file']) }}">
@endforeach
 </td>
 <td>
<a href="{{ route('product.show',$row->id) }}" class="btn btn-primary">Edite</a>

<form style="display: inline;" action="{{ route('product.destroy',$row->id) }}" method="post">
@csrf
@method("DELETE")
<input type="submit" value="Delete" class="btn btn-danger">
</form>
 </td>
</tr>

@empty

@endforelse
</tbody>
</table>
</div>
</div>
</div>
@endsection


