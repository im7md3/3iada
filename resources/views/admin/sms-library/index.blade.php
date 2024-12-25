@extends('admin.layouts.admin')
@section('title')
{{ __('admin.sms_library') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
	<ol class="breadcrumb bg-light p-3">
		<a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
		<li class="breadcrumb-item active" aria-current="page">{{ __('admin.sms_library') }} - SMS</li>
	</ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
	<a href="{{ route('admin.sms_messages.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
	<table class="table table-hover">
		<thead class="table-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">{{ __('admin.title') }}</th>
				<th scope="col">{{ __('admin.content') }}</th>
                <th scope="col">{{ __('admin.managers') }}</th>

            </tr>
		</thead>
		<tbody>
			@foreach ($messages as $sms_message)
			<tr>
				<th scope="row">{{ $loop->index + 1 }}</th>
				<td>{{ $sms_message->title}}</td>
                <td>{{$sms_message->content}}</td>
				<td>
					<a class="btn btn-info btn-sm" href="{{ route('admin.sms_messages.edit',$sms_message) }}">{{ __('admin.Update')
						}}</a>
					<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
						data-bs-target="#delete_agent{{ $sms_message->id }}"><i></i>
						{{ __('admin.Delete') }}
					</button>
					@include('admin.sms-library.delete')
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $messages->links() }}

</div>

@endsection
