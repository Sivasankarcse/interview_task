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
                                <th>Match Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($sno=0)
                            @foreach($match_friends as $usr)
                            @if($usr->users !== Null)
                            @if($usr->percentage >= 50)
                            <tr>
                                <td>{{++$sno}}</td>
                                <td><img src="/img/avatar/{{ $usr->users->profile_pic }}" height='50px' width='80px'/></td>
                                <td>{{$usr->users->name}}</td>
                                <td>{{$usr->users->designation}}</td>
                                <td><span class="badge bg-danger">{{$usr->percentage}} %</span></td>
                            </tr>
                            @endif
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