@extends('layouts.admin')

@section('title')
    Admin Category
@endsection

@section('content')
    <!--Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Category</h2>
                <p class="dashboard-subtitle">Edit Your Category</p>
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
                                <form action="{{ route('category.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Nama Kategori</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $item->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Slug</label>
                                                <input type="text" class="form-control" name="slug"
                                                    value="{{ $item->slug }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Foto</label>
                                                <input type="file" class="form-control" name="photo">
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
