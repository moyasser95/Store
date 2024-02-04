@extends('dash.style.main')


@section('content')
@if (Session::has('ms_admin'))
<div class="alert alert-success" role="alert">
  <span class="text-dark text-capitalize">{{ session('ms_admin') }}</span>
</div>
@endif
@if (Auth::guard('admin')->user()->can('create_user'))
<a href="{{ route('admin.create') }}" class="btn btn-primary">Add</a>
@endif
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">
<h4 class="card-title">Inverse table</h4>
<p class="card-description"> Add class <code>.table-dark</code>
</p>
<table class="table table-dark">
<thead>
<tr style="text-align: center;">
<th> # </th>
<th> Name </th>
<th> Email </th>
<th> Gender </th>
<th> prive</th>
<th>Edite/Delete</th>
</tr>
</thead>
<tbody>
@forelse ($data as $key=>$row)

<tr>
<td> {{ ++$key }} </td>
<td> {{ $row->name }} </td>
<td> {{ $row->email }} </td>
<td> {{ $row->gender==1?"male":"female" }} </td>
<td> {{ $row->type->prive==100?"supervisor":"" }} {{ $row->type->prive==200?"admin":"" }} {{ $row->type->prive==300?"owner":"" }} </td>
<td>
<a href="{{ route('admin.show',$row->id) }}" class="btn btn-primary">Edite</a>
@include('dash.style.modal')
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
