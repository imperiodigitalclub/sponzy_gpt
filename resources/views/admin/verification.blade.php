@extends('admin.layout')

@section('content')
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="{{ url('panel/admin') }}">{{ __('admin.dashboard') }}</a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted">{{ __('admin.verification_requests') }} ({{$data->total()}})</span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

			@if (session('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check2 me-1"></i>	{{ session('success_message') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="bi bi-x-lg"></i>
                </button>
                </div>
              @endif

			  @include('errors.errors-forms')

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-4">

					<div class="table-responsive p-0">
					<table class="table table-hover">
						<tbody>
							@if ($data->count() !=  0)
								<tr>
									<th class="active">ID</th>
									<th class="active">{{ trans('admin.user') }}</th>
									<th class="active">{{ trans('general.country') }}</th>
									<th class="active">{{ trans('general.image') }}</th>
									<th class="active">WhatsApp</th>
									<th class="active">Instagram</th>
									<th class="active">{{ trans('admin.date') }}</th>
									<th class="active">{{ trans('admin.actions') }}</th>
								</tr>

								@foreach ($data as $verify)
									<tr>
										<td>{{ $verify->id }}</td>
										<td>
											@if (! isset($verify->user()->username))
												<em>{{ trans('general.no_available') }}</em>
											@else
												<a href="{{ url($verify->user()->username) }}" target="_blank">{{ $verify->user()->name }}
													<i class="bi-box-arrow-up-right ms-1"></i>
												</a>
											@endif
										</td>
										<td>
											@if (! isset($verify->user()->username) || isset($verify->user()->username) && ! isset($verify->user()->country()->country_name))
												<em>{{ trans('general.no_available') }}</em>
											@else
												{{ $verify->user()->country()->country_name }}
											@endif
										</td>
										<td>
											<a href="{{ Helper::getFile(config('path.verification').$verify->image) }}" class="glightbox" data-gallery="gallery{{$verify->id}}">
												{{ trans('admin.see_document_id') }} <i class="bi-arrows-fullscreen ms-1"></i>
											</a>
											@if ($verify->image_reverse)
												<a href="{{ Helper::getFile(config('path.verification').$verify->image_reverse) }}" class="glightbox d-none" data-gallery="gallery{{$verify->id}}">
													{{ trans('admin.see_document_id') }} <i class="bi-arrows-fullscreen ms-1"></i>
												</a>
											@endif
											@if ($verify->image_selfie)
												<a href="{{ Helper::getFile(config('path.verification').$verify->image_selfie) }}" class="glightbox d-none" data-gallery="gallery{{$verify->id}}">
													{{ trans('admin.see_document_id') }} <i class="bi-arrows-fullscreen ms-1"></i>
												</a>
											@endif
										</td>
										<td>
											@if ($verify->user()->whatsapp)
												@php
													$phone = preg_replace('/\D/', '', $verify->user()->whatsapp);
													$phoneLink = 'https://wa.me/55' . $phone;
												@endphp
												<a href="{{ $phoneLink }}" target="_blank">
													{{ $verify->user()->whatsapp }} <i class="bi-box-arrow-up-right ms-1"></i>
												</a>
											@else
												<span class="text-muted"><em>{{ __('general.not_applicable') }}</em></span>
											@endif
										</td>
										<td>
										@if ($verify->user()->instagram)
										@php
											$instagram = $verify->user()->instagram;
											$isLink = preg_match('/^http(s)?:\/\//', $instagram);
											$instagramLink = $isLink ? $instagram : 'https://instagram.com/' . ltrim($instagram, '@');
										@endphp
										<a href="{{ $instagramLink }}" target="_blank">
											{{ $verify->user()->instagram }} <i class="bi-box-arrow-up-right ms-1"></i>
										</a>
										@else
											<span class="text-muted"><em>{{ __('general.not_applicable') }}</em></span>
										@endif
										</td>
										<td>{{ Helper::formatDate($verify->created_at) }}</td>
										<td>
											@if ($verify->status == 'pending')
												<div class="d-flex">
													@if (isset($verify->user()->username))
														{!! Form::open([
															'method' => 'POST',
															'url' => url('panel/admin/verification/members/approve', $verify->id).'/'.$verify->user_id,
															'class' => 'displayInline'
														]) !!}
														{!! Form::button('<i class="bi-check2"></i>', ['class' => 'btn btn-success btn-sm rounded-pill actionApprove me-2', 'title' => trans('admin.approve')]) !!}
														{!! Form::close() !!}
													@endif
													{!! Form::open([
														'method' => 'POST',
														'url' => url('panel/admin/verification/members/delete', $verify->id).'/'.$verify->user_id,
														'class' => 'displayInline'
													]) !!}
													{!! Form::button('<i class="bi-x"></i>', ['class' => 'btn btn-danger btn-sm rounded-pill actionDeleteVerification', 'title' => trans('admin.reject')]) !!}
													{!! Form::close() !!}
												</div>
											@else
												<span class="rounded-pill badge bg-success">{{ trans('admin.approved') }}</span>
											@endif
										</td>
									</tr>
								@endforeach
							@else
								<h5 class="text-center p-5 text-muted fw-light m-0">{{ trans('general.no_results_found') }}</h5>
							@endif
						</tbody>
					</table>
							</div><!-- /.box-body -->

				 </div><!-- card-body -->
 			</div><!-- card  -->

		@if ($data->lastPage() > 1)
			{{ $data->links() }}
		@endif
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
@endsection