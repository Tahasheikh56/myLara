@extends("layout.head");
@extends("layout.sidebar");
<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
			<div class="row">
            <div class="col-md-12">

		<!--**********************************
            Chat box start
        ***********************************-->
			
			<div class="custom-tab-1">
				<ul class="nav nav-tabs bg-primary">
					<li class="nav-item">
						<a class="nav-link active text-light" data-bs-toggle="tab" href="#chat">Chat</a>
					</li>
				</ul>
				@if (isset($data) && count($data) > 0)
				<div class="tab-content">
					<div class="tab-pane fade active show" id="chat" role="tabpanel">
						<div class="card mb-sm-3 mb-md-0 contacts_card dz-chat-user-box">
							<div class="card-header chat-list-header text-center">
								<a href="#"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/><rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/></g></svg></a>
								<div>
									<h6 class="mb-1">Chat List</h6>
									<p class="mb-0">Show All</p>
								</div>
								<a href="#"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg></a>
							</div>
							<div class="card-body contacts_body p-0 dz-scroll  " id="DZ_W_Contacts_Body">
								<ul class="contacts ms-4 mt-3">

									<li class="active dz-chat-user">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												<img src="images/avatar/1.jpg" class="rounded-circle user_img" alt=""/>
												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												@foreach ($data as $new)
												<span><a href="{{ route('/chatPerson',['id' => $new->id]) }}">{{ $new->name }}</a></span>
												<p>{{ $new->name }} is online</p>
												@endforeach
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						@endif

						@if (isset($personData))
			
						<div class="card chat dz-chat-history-box">
							<div class="card-header chat-list-header text-center">
								<a href="{{ route('/chat') }}" class="dz-chat-history-back">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><polygon points="0 0 24 0 24 24 0 24"/><rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000) " x="14" y="7" width="2" height="10" rx="1"/><path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) "/></g></svg>
								</a>
								<div>
									<h6 class="mb-1">Chat with {{ $personData->name }}
										<span><img src="{{ asset( $personData->image )}}" class="rounded-circle ms-1" width="45px" alt="" srcset=""> </span>
									</h6>
									<p class="mb-0 text-success">Online</p>
								</div>							
								<div class="dropdown">
									<a href="#" data-bs-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg></a>
									<ul class="dropdown-menu dropdown-menu-end">
										<li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i> View profile</li>
										<li class="dropdown-item"><i class="fa fa-users text-primary me-2"></i> Add to close friends</li>
										<li class="dropdown-item"><i class="fa fa-plus text-primary me-2"></i> Add to group</li>
										<li class="dropdown-item"><i class="fa fa-ban text-primary me-2"></i> Block</li>
									</ul>
								</div>
							</div>
							<div class="card-body msg_card_body dz-scroll" id="">

							<!-- // show chat to home screen -->
							@if (isset($chatData))
							@foreach ($chatData as $chatShow)
							@if ($chatShow->senderId === session("user")->id)
							<div style="display: flex; justify-content: flex-end; margin-bottom: 15px;">
    <div style="margin-right: 10px;">
        <div style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden;">
            <img src="{{ asset(session('user')->image) }}" width="100%" alt="" style="object-fit: cover;">
        </div>
    </div>
    <div style="max-width: 70%; display: flex; flex-direction: column; align-items: flex-end;">
        <div style="background-color: #DCF8C6; padding: 10px; border-radius: 8px; word-wrap: break-word;">
            {{ $chatShow->message }}
        </div>
        <div style="margin-top: 5px; color: #888; font-size: 12px;">
            {{ $chatShow->time }}
        </div>
    </div>
</div>
@else
<div style="display: flex; justify-content: flex-start; margin-bottom: 15px;">
    <div style="margin-right: 10px;">
        <div style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden;">
            <img src="{{ asset($personData->image) }}" width="100%" alt="" style="object-fit: cover;">
        </div>
    </div>
    <div style="max-width: 70%; display: flex; flex-direction: column; align-items: flex-end;">
        <div style="background-color: gray; color: white; padding: 10px; border-radius: 8px; word-wrap: break-word;">
            {{ $chatShow->message }}
        </div>
        <div style="margin-top: 5px; color: #888; font-size: 12px;">
            {{ $chatShow->time }}
        </div>
    </div>
</div>
							@endif
							@endforeach
							@endif
                                  
								<form action="{{ route('/msgSend') }}" method="post">
									@csrf
								<div class="card-footer type_msg">
								<div class="input-group">
									<input type="text" name="msg" class="form-control" placeholder="Type your message..."/>
									<div class="input-group-append">
										<button type="submit" class="btn btn-primary mt-1"><i class="fa fa-location-arrow "></i></button>
									</div>
								</div>
							</div>
							<input type="hidden" name="sndrid" value="{{ session('user')->id }}">
							<input type="hidden" name="rcvid" value="{{ $personData->id }}">
							</form>
						</div>
					</div>
					@endif
<!-- Remove the Blade directives for chat rendering -->
<!-- <div class="card-body msg_card_body dz-scroll" id=""></div> -->

							<div class="card-footer"></div>
						</div>
					</div>
				</div>
			</div>
		<!--**********************************
            Chat box End
        ***********************************-->
							</div>
					</div>
					</div>
</div>

        <!--**********************************
            Sidebar end
        ***********************************-->
		
@extends("layout.footer");