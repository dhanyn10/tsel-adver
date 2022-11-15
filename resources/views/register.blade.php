@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card mt-3">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form id="register">
                        <input type="text" name="nama" id="nama" class="form-control mb-2" placeholder="nama">
                        <input type="text" name="email" id="email" class="form-control mb-2" placeholder="email">
                        <input type="text" name="telpon" id="telepon" class="form-control mb-2" placeholder="telp">
                        <button type="submit" class="btn btn-primary" id="submit">Kirim</button>
                    </form>
                </div>
                <div class="card-footer">
                    <a href="{{route('login')}}">Login</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $('#register').on('submit', (evt) => {
        evt.preventDefault()
        let nama = $('#nama').val()
        let email = $('#email').val()
        let telepon = $('#telepon').val()

        $.ajax("{{route('register')}}", {
            type: 'POST',
            data:
            {
                nama: nama,
                email: email,
                telepon: telepon
            },
            success: function (data) {
                if(data.status == 'fails') {
                    alert('input salah')
                } else if(data.status == 'exists') {
                    alert('data sudah ada')
                } else if('created') {
                    alert('Thankyou')
                }
            }
        })
    })
</script>
@endsection