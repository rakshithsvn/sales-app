
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<div>
		<p><h2>@if(@$subject) {{$subject}} @else Enquiry Details @endif </h2>

			<strong>Name</strong> 	  : {{$name}}<br/>
			<strong>Email</strong> 	  : {{$email}}<br/>
			<strong>Mobile No</strong> : {{$phone}}<br/>
            @if(@$website)
			<strong>Website </strong>   : {!! $website !!}
			@endif
            @if(@$city)
			<strong>City </strong>   : {!! $city !!}
			@endif
            @if(@$country)
			<strong>Country </strong>   : {!! $country !!}
			@endif
			@if(@$message_content)
			<strong>Message </strong>   : {!! $message_content !!}
			@endif

		</p>

	</div>
</body>
</html>
