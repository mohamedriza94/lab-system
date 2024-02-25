@extends('administrator.layout.layout')

@section('contents')
<div class="container-fluid">

    {{-- Add or Update available time form --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($availableTime) ? 'Update Available Time' : 'Add Available Time' }}</h4>
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
                    <form method="post" action="{{ isset($availableTime) ? route('administrator.availableTime.update', ['id' => $availableTime->id]) : route('administrator.availableTime.add') }}">
                        @csrf
                        @if(isset($availableTime))
                        @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" id="date" name="date" value="{{ isset($availableTime) ? $availableTime->date : old('date') }}" min="{{ date('Y-m-d') }}">
                                    <label for="date">Date</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="time" class="form-control" id="start_time" name="start_time" value="{{ isset($availableTime) ? $availableTime->start_time : old('start_time') }}">
                                    <label for="start_time">Start Time (Format: HH:MM AM/PM)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="time" class="form-control" id="end_time" name="end_time" value="{{ isset($availableTime) ? $availableTime->end_time : old('end_time') }}">
                                    <label for="end_time">End Time (Format: HH:MM AM/PM)</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="capacity" name="capacity" value="{{ isset($availableTime) ? $availableTime->capacity : old('capacity') }}">
                                    <label for="capacity">Capacity</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="status" name="status">
                                        <option value="available" {{ (isset($availableTime) && $availableTime->status === 'available') || old('status') === 'available' ? 'selected' : '' }}>Available</option>
                                        <option value="fully_booked" {{ (isset($availableTime) && $availableTime->status === 'fully_booked') || old('status') === 'fully_booked' ? 'selected' : '' }}>Fully Booked</option>
                                        <option value="closed" {{ (isset($availableTime) && $availableTime->status === 'closed') || old('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="ms-auto mt-3 mt-md-0">
                                    <button type="submit" class="btn btn-primary text-white">{{ isset($availableTime) ? 'Update' : 'Submit' }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Available time table --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Available Times</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Capacity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($availableTimes as $availableTime)
                                <tr>
                                    <td>{{ $availableTime->date }}</td>
                                    <td>{{ $availableTime->start_time }}</td>
                                    <td>{{ $availableTime->end_time }}</td>
                                    <td>{{ $availableTime->capacity }}</td>
                                    <td>
                                        @if($availableTime->status == 'available')
                                        <span class="badge bg-success">Available</span>
                                        @elseif($availableTime->status == 'fully_booked')
                                        <span class="badge bg-warning text-dark">Fully Booked</span>
                                        @else
                                        <span class="badge bg-danger">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('administrator.availableTime.edit', ['id' => $availableTime->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('administrator.availableTime.delete', ['id' => $availableTime->id]) }}" method="POST">
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
