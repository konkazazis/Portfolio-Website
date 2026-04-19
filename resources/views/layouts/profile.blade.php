@extends('layouts.master')

@section('title', 'Profile')

@push('head')
    <meta name="robots" content="noindex, nofollow">
@endpush

@section('content')
<div class="page-title">
	<div class="wrap">
		<h2>Profile</h2>
		<p>View your profile details below.</p>
	</div>
</div>

<div class="block">

	<div class="profile-detail">
		<strong>Username</strong>
		{{{ $account->username }}}
	</div>

	<div class="profile-detail">
		<strong>Email</strong>
		{{{ $account->email }}}
	</div>

	<div class="profile-detail">
		<strong>Registered</strong>
		{{{ $account->registered->format('F j, Y') }}}
	</div>

</div>
@endsection