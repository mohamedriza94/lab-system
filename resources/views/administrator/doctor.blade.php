@extends('administrator.layout.layout')

@section('contents')
<div class="container-fluid">

    {{-- Add or Update doctor form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($doctor) ? 'Update Doctor' : 'Add Doctor' }}</h4>
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
                    <form method="post" action="{{ isset($doctor) ? route('administrator.doctor.update', ['id' => $doctor->id]) : route('administrator.doctor.add') }}">
                        @csrf
                        @if(isset($doctor))
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" value="{{ isset($doctor) ? $doctor->email : old('email') }}">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ isset($doctor) ? $doctor->name : old('name') }}">
                                    <label for="name">Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nic" name="nic" value="{{ isset($doctor) ? $doctor->nic : old('nic') }}">
                                    <label for="nic">NIC</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" value="{{ isset($doctor) ? $doctor->dateOfBirth : old('dateOfBirth') }}">
                                    <label for="dateOfBirth">Date of Birth</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="specializedIn" name="specializedIn" value="{{ isset($doctor) ? $doctor->specializedIn : old('specializedIn') }}">
                                    <label for="specializedIn">Specialized In</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="ms-auto mt-3 mt-md-0">
                                    <button type="submit" class="btn btn-primary text-white">{{ isset($doctor) ? 'Update' : 'Submit' }}</button>
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
                    <h4 class="card-title">Doctors</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>NIC</th>
                                    <th>Date of Birth</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $doctor)
                                <tr>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->nic }}</td>
                                    <td>{{ $doctor->dateOfBirth }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('administrator.doctor.edit', ['id' => $doctor->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('administrator.doctor.delete', ['id' => $doctor->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
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
