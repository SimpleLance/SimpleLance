@extends(Config::get('Sentinel::config.layout'))

{{-- Web site Title --}}
@section('title')
@parent
Home
@stop

{{-- Content --}}
@section('content')
	<h4>Account Profile</h4>
	
  	<div class="well clearfix">
	    <div class="col-md-8">
		    @if ($user->first_name)
		    	<p><strong>First Name:</strong> {{ $user->first_name }} </p>
			@endif
			@if ($user->last_name)
		    	<p><strong>Last Name:</strong> {{ $user->last_name }} </p>
			@endif
		    <p><strong>Email:</strong> {{ $user->email }}</p>
			@if ($user->phone)
				<p><strong>Phone:</strong> {{ $user->phone }} </p>
			@endif
			@if ($user->address)
				<p>
					<strong>Address:</strong> <br />
					{{ $user->address }} <br />
					{{ $user->address2 }} <br />
					{{ $user->city }} {{ $user->state }},  {{ $user->post_code }}<br />
					{{ $user->country }} <br />
				</p>
			@endif
		</div>
		<div class="col-md-4">
			<p><em>Account created: {{ date("D, F d Y",strtotime($user->created_at)) }}</em></p>
			<p><em>Last Updated: {{ date("D, F d Y",strtotime($user->updated_at)) }} at {{ date("g:h a",strtotime($user->updated_at)) }}</em></p>
			<button class="btn btn-primary" onClick="location.href='{{ action('Sentinel\UserController@edit', array($user->id)) }}'">Edit Profile</button>
		</div>
	</div>

	<h4>Group Memberships:</h4>
	<?php $userGroups = $user->getGroups(); ?>
	<div class="well">
	    <ul>
	    	@if (count($userGroups) >= 1)
		    	@foreach ($userGroups as $group)
					<li>{{ $group['name'] }}</li>
				@endforeach
			@else 
				<li>No Group Memberships.</li>
			@endif
	    </ul>
	</div>
	
	<hr />
@stop
