<p style="font-size: 160%;">Dear {{ $name }}, You mail has been sent.</p>

<p style="font-size: 100%; background-color: #DCDCDC;">
	<b>Sender:</b> {{ $name }} ( <a href="mailto:{{ $email }}">{{ $email }}</a> )<br>
	<b>Subject:</b> {{ $subject }}<br>
	<b>Message:</b> {{ $body }}<br>
</p>
