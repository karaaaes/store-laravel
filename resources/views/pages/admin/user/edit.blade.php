@extends('layouts.admin')

@section('title')
    Admin User
@endsection

@section('content')
    <!--Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">User</h2>
                <p class="dashboard-subtitle">Edit Your User</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Validasi Debug Error Laravel -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('user.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Nama User</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $item->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email User</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ $item->email }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password User</label>
                                                <input type="password" class="form-control" name="password">
                                                <small>kosongkan jika tidak ingin mengganti password</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Roles</label>
                                                <select name="roles" class="form-control">
                                                    <option  value="{{ $item->roles }}" selected>TIDAK DIGANTI</option>
                                                    <option value="USER">USER</option>
                                                    <option value="ADMIN">ADMIN</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-success px-5">Save Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
@endpush
