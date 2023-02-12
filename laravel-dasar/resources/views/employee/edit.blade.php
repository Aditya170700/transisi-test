@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            {{ __('Employee Create') }}
                            <a class="btn btn-sm btn-light" href="{{ route('employees.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employees.update', $result->id) }}" method="POST">
                            @csrf
                            @method('PUT')
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
                                        <label class="form-control-label" for="input-company">Company</label>
                                        <select class="form-control js-example-basic-single" id="company"
                                            name="company_id">
                                            <option value="{{ $result->company_id }}" selected="selected">
                                                {{ $result->company->nama }}
                                            </option>
                                        </select>
                                        @error('company_id')
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
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                ajax: {
                    url: '/api/companies/for-select',
                    dataType: 'json',
                    method: 'GET',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    }
                }
            });
        });
    </script>
@endsection
