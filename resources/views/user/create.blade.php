@extends('layouts.app')

@section('subtitle', 'user')
@section('content_header_title', 'user')
@section('content_header_subtitle', 'Create')

@section('content_body')
{{-- @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif --}}
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat User</h3>
            </div>

            <form method="post" action="../user">
            @csrf {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="level_id">ID User</label>
                    <select class="form-control" name="level_id">
                        <option value=1>Administrator</option>
                        <option value=2>Manager</option>
                        <option value=3>Staff/Kasir</option>
                        <option value=4>Customer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="@error('username') is-invalid @enderror form-control" id="username" name="username" placeholder="Masukkan Username">
                    @error('username')
                           <div class="alert alert-danger">
                                 {{ $message }}
                           </div>
                            @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="@error('nama') is-invalid @enderror form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                    @error('nama')
                           <div class="alert alert-danger">
                                 {{ $message }}
                           </div>
                            @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="@error('password') is-invalid @enderror form-control" name="password" id="password" placeholder="Masukkan Password">
                    @error('password')
                           <div class="alert alert-danger">
                                 {{ $message }}
                           </div>
                            @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
    </div>
    @endsection