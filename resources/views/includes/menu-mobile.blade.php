<div class="menuMobile w-100 bg-white shadow-lg pb-3 pt-2 px-2 border-top">
	<ul class="list-inline d-flex bd-highlight m-0 mb-1 text-center">

				<li class="flex-fill bd-highlight">
					<a class="p-2 btn-mobile" href="{{url('/explore')}}" title="{{trans('admin.home')}}">
						<i class="feather icon-home icon-navbar" style="font-size: 28px;"></i>
					</a>
				</li>

				@if (!$settings->disable_creators_section)
				<li class="flex-fill bd-highlight">
					<a class="p-2 btn-mobile" href="{{url('creators')}}" title="{{trans('general.explore')}}">
						<i class="far	fa-compass icon-navbar" style="font-size: 28px;"></i>
					</a>
				</li>
				@endif
				
    			<li class="flex-fill bd-highlight">
                    @auth
                        @if (auth()->user()->verified_id == 'yes')
                            <!-- Usuário é um criador -->
                            <a class="p-2 btn-mobile btn-post position-relative" href="{{ url('/') }}?u=true" title="{{ trans('general.new_post') }}">
                                <i class="feather icon-plus-circle icon-navbar" style="font-size: 28px;"></i>
                            </a>
                        @else
                            <!-- Usuário não é um criador -->
                            <a class="p-2 btn-mobile btn-post position-relative" href="{{ url('/settings/verify/account') }}" title="{{ trans('general.new_post') }}">
                                <i class="feather icon-plus-circle icon-navbar" style="font-size: 28px;"></i>
                            </a>
                        @endif
                    @else
                        <a class="p-2 btn-mobile btn-post position-relative" href="{{ url('login') }}" title="{{ trans('general.login') }}">
                            <i class="feather icon-plus-circle icon-navbar" style="font-size: 28px;"></i>
                        </a>
                    @endauth
                </li>
                
                <li class="flex-fill bd-highlight">
                    @auth
                        @if (auth()->user()->verified_id == 'yes')
                            <a class="p-2 btn-mobile position-relative" href="{{ url('/dashboard') }}" title="{{ trans('general.balance') }}">
                                <i class="feather icon-dollar-sign icon-navbar" style="font-size: 28px;"></i>
                            </a>
                        @else
                            <a class="p-2 btn-mobile position-relative" href="{{ url('/my/wallet') }}" title="{{ trans('general.wallet') }}">
                                <i class="feather icon-dollar-sign icon-navbar" style="font-size: 28px;"></i>
                            </a>
                        @endif
                    @else
                        <a class="p-2 btn-mobile position-relative" href="{{ url('login') }}" title="{{ trans('general.login') }}">
                            <i class="feather icon-dollar-sign icon-navbar" style="font-size: 28px;"></i>
                        </a>
                    @endauth
                </li>

            <!--
			@if ($settings->shop)
				<li class="flex-fill bd-highlight">
					<a class="p-2 btn-mobile" href="{{url('shop')}}" title="{{trans('general.shop')}}">
						<i class="feather icon-shopping-bag icon-navbar"></i>
					</a>
				</li>
			@endif
			-->

			<li class="flex-fill bd-highlight">
                @auth
                    <a href="{{url(auth()->user()->username)}}" onmouseenter="console.log('{{ url(auth()->user()) }}')" class="p-2 btn-mobile position-relative" title="{{ trans('general.profile') }}">
                        <img src="{{Helper::getFile(config('path.avatar').auth()->user()->avatar)}}" class="rounded-circle" alt="{{ auth()->user()->name }}" width="30" height="30">
                    </a>
                @else
                    <a href="{{ url('login') }}" class="p-2 btn-mobile position-relative" title="{{ trans('general.login') }}">
                        <i class="feather icon-user icon-navbar" style="font-size: 28px;"></i>
                    </a>
                @endauth
            </li>
		</ul>
</div>