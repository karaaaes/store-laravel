@extends('layouts.admin')

@section('title')
    User
@endsection

@section('content')
    <!--Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">User</h2>
                <p class="dashboard-subtitle">Create New User</p>
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
                                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Nama User</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Email User</label>
                                                <input type="email" class="form-control" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password User</label>
                                                <input type="password" class="form-control" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Roles</label>
                                                <select name="roles" class="form-control" required>
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
