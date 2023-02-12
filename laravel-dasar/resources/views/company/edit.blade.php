@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            {{ __('Company Edit') }}
                            <a class="btn btn-sm btn-light" href="{{ route('companies.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('companies.update', $result->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-name">Nama</label>
                                        <input type="text" class="form-control" id="input-name" name="nama"
                                            value="{{ $result->nama }}" placeholder="Nama">
                                        @error('nama')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-email">Email</label>
                                        <input type="email" class="form-control" id="input-email" name="email"
                                            value="{{ $result->email }}" placeholder="Email">
                                        @error('email')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-logo">Logo</label>
                                        <input type="file" class="form-control" id="input-logo" name="logo">
                                        @error('logo')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-web">Website</label>
                                        <input type="text" class="form-control" id="input-web" name="website"
                                            value="{{ $result->website }}" placeholder="Website">
                                        @error('website')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
