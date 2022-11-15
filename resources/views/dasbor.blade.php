@extends('layout')
@section('content')
<p id="nama"></p>
<p id="error"></p>
@endsection
@section('js')
<script>
    $('#nama').html('Selamat datang: '+ getCookie("nama"))
    let errCookie = getCookie("error");
    if(errCookie != "")
    $('#error').html("last error: "+ errCookie)
</script>
@endsection