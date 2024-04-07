@extends('administrator.layout.layout')

@section('contents')
<div class="container-fluid">

    {{-- Add or Update Test Type form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($testType) ? 'Update Test Type' : 'Add Test Type' }}</h4>
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="{{ isset($testType) ? route('administrator.testType.update', ['id' => $testType->id]) : route('administrator.testType.add') }}">
                        @csrf
                        @if(isset($testType))
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="name" class="form-control" id="name" name="name" value="{{ isset($testType) ? $testType->name : old('name') }}">
                                    <label for="name">Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="description" name="description" value="{{ isset($testType) ? $testType->description : old('description') }}">
                                    <label for="Description">Description</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="price" name="price" value="{{ isset($testType) ? $testType->price : old('price') }}">
                                    <label for="Price">Price</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="ms-auto mt-3 mt-md-0">
                                    <button type="submit" class="btn btn-primary text-white">{{ isset($testType) ? 'Update' : 'Submit' }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Doctor table --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Test Types</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($testTypes as $testType)
                                <tr>
                                    <td>{{ $testType->name }}</td>
                                    <td>{{ $testType->description }}</td>
                                    <td>{{ $testType->price }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('administrator.testType.edit', ['id' => $testType->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')

@endsection
