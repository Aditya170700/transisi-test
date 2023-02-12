@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            {{ __('Company') }}
                            <a class="btn btn-sm btn-primary" href="{{ route('companies.create') }}">Create</a>
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
                                        <th scope="col">Email</th>
                                        <th scope="col">Logo</th>
                                        <th scope="col">Website</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($results as $result)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $result->nama }}</td>
                                            <td>{{ $result->email }}</td>
                                            <td>
                                                <img src="{{ asset($result->logo) }}" width="100">
                                            </td>
                                            <td>{{ $result->website }}</td>
                                            <td>
                                                <form action="{{ route('companies.destroy', $result->id) }}" method="post"
                                                    id="form-{{ $result->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-success btn-sm text-white"
                                                        href="{{ route('companies.edit', $result->id) }}">
                                                        Edit
                                                    </a>
                                                    <a class="btn btn-primary btn-sm text-white"
                                                        href="{{ route('companies.show', $result->id) }}" target="_blank">
                                                        Show
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
                                            <td colspan="6" class="text-center">Tidak ada data</td>
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
