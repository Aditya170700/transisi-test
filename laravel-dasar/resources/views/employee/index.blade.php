@extends('layouts.app')

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col">
                                <input type="file" class="form-control" name="excel">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            {{ __('Employee') }}
                            <div>
                                <a class="btn btn-sm btn-primary" href="{{ route('employees.create') }}">Create</a>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Import
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @elseif (session('failed'))
                            <div class="alert alert-success" role="alert">
                                {{ session('failed') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($results as $result)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $result->nama }}</td>
                                            <td>{{ $result->company->nama }}</td>
                                            <td>{{ $result->email }}</td>
                                            <td>
                                                <form action="{{ route('employees.destroy', $result->id) }}" method="post"
                                                    id="form-{{ $result->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-success btn-sm text-white"
                                                        href="{{ route('employees.edit', $result->id) }}">
                                                        Edit
                                                    </a>
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm text-white btn-hapus"
                                                        data-id="{{ $result->id }}">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Showing {{ $results->firstItem() ?? 0 }} to {{ $results->lastItem() }} of
                                {{ $results->total() }} result</span>
                            {{ $results->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
