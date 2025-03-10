@extends('admin.layout')

@section('content')
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="{{ url('panel/admin') }}">{{ __('admin.dashboard') }}</a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted">{{ __('admin.payment_settings') }}</span>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted">{{ $data->name }}</span>
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
				<div class="card-body p-lg-5">

					 <form method="POST" action="{{ url()->current() }}" enctype="multipart/form-data">
             @csrf

		        <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end">{{ trans('admin.fee') }}</label>
		          <div class="col-sm-10">
		            <input value="{{ $data->fee }}" name="fee" type="text" class="form-control">
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end">{{ trans('admin.fee_cents') }}</label>
		          <div class="col-sm-10">
		            <input value="{{ $data->fee_cents }}" name="fee_cents" type="text" class="form-control">
		          </div>
		        </div>

            <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end">Consumer Key</label>
		          <div class="col-sm-10">
		            <input value="{{ $data->key }}" name="key" type="text" class="form-control">
		          </div>
		        </div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-label text-lg-end">Consumer Secret</label>
					<div class="col-sm-10">
					  <input value="{{ $data->key_secret }}" name="key_secret" type="text" class="form-control">
					</div>
				  </div>

				  <div class="row mb-3">
					<label class="col-sm-2 col-form-label text-lg-end">Project ID</label>
					<div class="col-sm-10">
					  <input value="{{ $data->project_id }}" name="project_id" type="text" class="form-control">
					</div>
				  </div>

				  <div class="row mb-3">
					<label class="col-sm-2 col-form-label text-lg-end">Project Secret</label>
					<div class="col-sm-10">
					  <input value="{{ $data->project_secret }}" name="project_secret" type="text" class="form-control">
					</div>
				  </div>

            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0 text-lg-end">{{ trans('admin.status') }}</legend>
              <div class="col-sm-10">
                <div class="form-check form-switch form-switch-md">
                 <input class="form-check-input" type="checkbox" name="enabled" @if ($data->enabled) checked="checked" @endif value="1" role="switch">
               </div>
              </div>
            </fieldset>

				<fieldset class="row mb-3">
		          <legend class="col-form-label col-sm-2 pt-0 text-lg-end">{{ trans('admin.subscription') }}</legend>
		          <div class="col-sm-10">
		            <div class="form-check">
		              <input class="form-check-input" type="radio" name="subscription" id="radio1" @if ($data->subscription == 'yes') checked="checked" @endif value="yes">
		              <label class="form-check-label" for="radio1">
		                {{ trans('admin.active') }}
		              </label>
		            </div>
		            <div class="form-check">
		              <input class="form-check-input" type="radio" name="subscription" id="radio2" @if ($data->subscription == 'no') checked="checked" @endif value="no">
		              <label class="form-check-label" for="radio2">
		                {{ trans('admin.disabled') }}
		              </label>
		            </div>
								<small class="d-block">{{ trans('general.note_disable_subs_payment') }}</small>
		          </div>
		        </fieldset><!-- end row -->

						<div class="row mb-3">
		          <div class="col-sm-10 offset-sm-2">
		            <button type="submit" class="btn btn-dark mt-3 px-5">{{ __('admin.save') }}</button>
		          </div>
		        </div>

		       </form>

				 </div><!-- card-body -->
 			</div><!-- card  -->
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
@endsection
