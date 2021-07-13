@extends('layouts.index')
@section('content')
	<!--a href="{{url('logout')}}">Cerrar Sesión</a>
	<form action="" id="send_tweets">
		@csrf
		<input type="text" placeholder="¿Qué está pasando?" maxlength="250" name="content_tweet" id="content_tweet">
		<button id="save_tweet">Twittear</button>
	</form>
	<h1>Listado de tweets {{Route::CurrentRouteName()}}</h1>
	<div id="lists_tweets">
		@foreach($tweets as $tweet)
			<li>{{$tweet->content}}</li>
		@endforeach()
	</div-->
	<div class="row">
		<div class="col-first sidebard-left">
			<div class="brand">
				<i class='fab fa-twitter'></i>
			</div>
			<div class="menu">
				<div class="menu-item">
			        <a href="{{url('/home')}}" class="{{Route::CurrentRouteName() == 'home' ? 'active' : ''}}">
			        	<i class='bx bx-home-circle'></i>
			        	<h2>Inicio</h2>
			        </a>
			    </div>
		      	<div class="menu-item">
		        	<a href="" class="{{Route::CurrentRouteName() == 'explorar' ? 'active' : ''}}">
						<i class='fas fa-hashtag'></i>
				        <h2>Explorar</h2>
		        	</a>
		      	</div>
		      	<div class="menu-item">
		        	<a href="" class="{{Route::CurrentRouteName() == 'mensajes' ? 'active' : ''}}">
						<i class="far fa-envelope"></i>
				        <h2>Mensajes</h2>
		        	</a>
		      	</div>
		      	<div class="menu-item">
		        	<a href="" class="{{Route::CurrentRouteName() == 'notificaciones' ? 'active' : ''}}">
						<i class="far fa-bell"></i>
				        <h2>Notificaciones</h2>
		        	</a>
		      	</div>
		      	<div class="menu-item">
		        	<a href="" class="{{Route::CurrentRouteName() == 'guardados' ? 'active' : ''}}">
						<i class="far fa-bookmark"></i>
				        <h2>Guardados</h2>
		        	</a>
		      	</div>
		      	<div class="menu-item">
		        	<a href="" class="{{Route::CurrentRouteName() == 'listas' ? 'active' : ''}}">
						<i class="fas fa-clipboard-list"></i>
				        <h2>Listas</h2>
		        	</a>
		      	</div>
		      	<div class="menu-item">
		        	<a href="" class="{{Route::CurrentRouteName() == 'profile' ? 'active' : ''}}">
						<i class="far fa-user"></i>
				        <h2>Perfil</h2>
		        	</a>
		      	</div>
		      	<div class="menu-item">
		        	<a href="" class="{{Route::CurrentRouteName() == '' ? 'active' : ''}}">
						<i class="fas fa-ellipsis-h"></i>
				        <h2>Mas opciones</h2>
		        	</a>
		      	</div>
		      	<div class="menu-item">
		        	<a href="javascript:logout_confirm();">
						<i class="fas fa-sign-out-alt"></i>
				        <h2>Cerrar Sesión</h2>
		        	</a>
		      	</div>
			</div>
		</div>
		<div class="col-second container-feed">
			<div class="container-header">
		        <h2>Hola: {{Auth::user()->full_name}} <a href=""><i class="fas fa-magic"></i></a></h2>
		    </div>
		    <div class="container-body">
		    	<div class="tweet_box">
			        <form action="" id="send_tweets">
			        	@csrf
				        <div class="tweet_control">
				            <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="">
				            <input type="text" name="content_tweet" id="content_tweet" placeholder="¿Que está pasando?">
				        </div>
			          	<button id="save_tweet" class="btn_send_tweet">Tweet</button>
			        </form>
			    </div>
			    <div id="posts">
			    	@if(!count($tweets))
					    <div class="without-posts">
					    	<h2>¡Bienvenido a Twitter!</h2>
					    	<br>
					    	<p>Este es el mejor lugar para ver lo que está pasando en tu mundo. Busca personas y temas para seguir ahora.</p>
					    </div>
					@else
						@foreach($tweets as $tweet)
							<div class="post">
						        <div class="post__avatar">
						          <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="">
						        </div>
						        <div class="post__body">
						          	<div class="post__header">
							            <div class="post__headerText">
							              <h3>
							                <a href="">{{$tweet->user->full_name}}</a>
							                <span class="post__headerSpecial"><i class="fas fa-certificate"></i> <a href="#">{{'@'.$tweet->user->name}}</a> <i class="date_posted">{{date('d/m/Y', strtotime($tweet->created_at))}}</i></span>
							              </h3>
							            </div>
							            <div class="post__headerDescription">
							              <p>{{$tweet->content}}</p>
							            </div>
						          	</div>
						        </div>
						    </div>
						@endforeach()
				    @endif()
			    </div>
		    </div>
		</div>
		<div class="col-third sidebard-right">
			<div class="search_box">
				<div class="search_control">
					<i class="fas fa-search"></i>
					<input type="search" name="" placeholder="Buscar en Twitter">
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h2>Tendencias <a href="#" class="action-card"><i class="fas fa-cog"></i></a></h2>
				</div>
				<div class="card-body">
					<div class="card-item">
						<a href="">
							<div class="trending_item">
								<p>Tendencia de algo</p>
								<h3 class="trending_name">#SOS</h3>
								<p>50mil tweets</p>
							</div>
						</a>							
					</div>
					<div class="card-item">
						<a href="">
							<div class="trending_item">
								<p>Tendencia de algo</p>
								<h3 class="trending_name">#SOS</h3>
								<p>50mil tweets</p>
							</div>
						</a>							
					</div>
					<div class="card-item">
						<a href="">
							<div class="trending_item">
								<p>Tendencia de algo</p>
								<h3 class="trending_name">#SOS</h3>
								<p>50mil tweets</p>
							</div>
						</a>							
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h2>¿A quién seguir? <a href="#" class="action-card"><i class="fas fa-cog"></i></a></h2>
				</div>
				<div class="card-body">
					@foreach($users as $user)
						<div class="card-item">
							<div class="who_follow">
								<img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="">
								<div class="who_follow_box">
									<a href="">
										<h3 class="who_follow_name">{{$user->full_name}}</h3>
										<p>{{'@'.$user->name}}</p>
									</a>
								</div>
								<a href="" class="follow_link">Seguir</a>
							</div>
						</div>
					@endforeach()
				</div>
			</div>
		</div>
		<div class="modal" id="modal_tweet" style="display: none;">
			<div class="modal-content">
				<div class="modal-header">
					<a href="javascript:close_modal();"><i class="fas fa-times"></i></a>
				</div>
				<div class="modal-body">	                        				
					<h1 style="text-align: center;">Confirme cierre de sesión</h1>
					<a href="{{url('logout')}}" class="btn_tweet">Si</a>
				</div>
			</div>
		</div>
	</div>
@endsection()

@section('scripts')
<script type="text/javascript" src="{{url('/main.js')}}"></script>
@endsection
