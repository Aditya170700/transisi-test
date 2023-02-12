@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            {{ __('Company Create') }}
                            <a class="btn btn-sm btn-light" href="{{ route('companies.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">Nama</label>
                                        <input type="text" class="form-control form-control-sm" id="input-name"
                                            name="nama" value="{{ old('nama') }}" placeholder="Nama">
                                        @error('nama')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email</label>
                                        <input type="email" class="form-control form-control-sm" id="input-email"
                                            name="email" value="{{ old('email') }}" placeholder="Email">
                                        @error('email')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-logo">Logo</label>
                                        <input type="file" class="form-control form-control-sm" id="input-logo"
                                            name="logo" value="{{ old('logo') }}">
                                        @error('logo')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-web">Website</label>
                                        <input type="text" class="form-control form-control-sm" id="input-web"
                                            name="website" value="{{ old('website') }}" placeholder="Website">
                                        @error('website')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <button class="btn btn-sm btn-primary" type="submit">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
