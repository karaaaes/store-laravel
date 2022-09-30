@extends('layouts.admin')

@section('title')
    Admin Transaction
@endsection

@section('content')
    <!--Section Content-->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Transaction</h2>
                <p class="dashboard-subtitle">Edit Your Transaction</p>
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
                                <form action="{{ route('transaction.update', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Kategori Transaction</label>
                                                <select name="transactions_status" class="form-control">
                                                        <option value="{{ $item->transactions_status }}">{{ $item->transactions_status }}</option>
                                                        <option value="" disabled> ---------------- </option>
                                                        <option value="PENDING">PENDING</option>
                                                        <option value="SHIPPING">SHIPPING</option>
                                                        <option value="SUCCESS">SUCCESS</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Total Price</label>
                                                <input type="number" class="form-control" name="total_price"
                                                    value="{{ $item->total_price }}" required>
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
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush
