@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header"><h5>Home Page</h5></div>
                <div class="card-body">
                    <table id="homeTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Avatar</th>
                                <th>User Name</th>
                                <th>User Designation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($sno=0)
                            @foreach($users as $user)
                            @if(auth()->user()->id != $user['id'])
                            <tr>
                                <td>{{++$sno}}</td>
                                <td><img src="img/avatar/{{ $user->profile_pic }}" height='50px' width='80px'/></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->designation}}</td>
                                <td><a href="/user-profile/{{$user->id}}" class="btn btn-sm btn-info">View</button>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready( function () {
        $('#homeTable').DataTable();
    });
</script>
@endsection