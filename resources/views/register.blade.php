@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card mt-3">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <input type="text" name="nama" id="nama" class="form-control mb-2" placeholder="nama">
                    <input type="text" name="email" id="email" class="form-control mb-2" placeholder="email">
                    <input type="text" name="telpon" id="telepon" class="form-control mb-2" placeholder="telp">
                    <button type="button" class="btn btn-primary" id="submit">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{URL::asset('js/register.js')}}"></script>
@endsection