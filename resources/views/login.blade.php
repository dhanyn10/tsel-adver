@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card mt-3">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form id="login">
                        <input type="text" name="email" id="email" class="form-control mb-2" placeholder="email">
                        <button type="submit" class="btn btn-primary" id="submit">Kirim</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{route('register')}}">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $('#login').on('submit', (evt) => {
        evt.preventDefault()
        let email = $('#email').val()

        $.ajax("{{route('login')}}", {
            type: 'POST',
            data:
            {
                email: email
            },
            success: function (data) {
                console.log(data)
                if(data.code == 1) {
                    alert('Thankyou!')
                    setCookie("nama", data.nama, 1)
                    window.location = "{{route('dasbor')}}"
                } else {
                    alert('data belum ada')
                    const d = new Date()
                    d.setTime(d.getTime())
                    const last = d.toUTCString();
                    setCookie("error", last, 1)
                }
            }
        })
    })
</script>
@endsection