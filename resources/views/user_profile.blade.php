@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>User Profile</h5>
                    <input type="hidden" id="friend_id" value="{{$profile->id}}"/>
                    <a id="add_user" class="btn btn-sm btn-secondary bg-white">{{$profile['friend_status'] == Null ? 'Add Friend': 'Friends'}}</a>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <h5>Name                      : <span class="badge bg-info">{{$profile->name}}</span></h5>
                                <h5>email                     : <span class="badge bg-info">{{$profile->email}}</span></h5>
                                <h5>dob                       : <span class="badge bg-info">{{$profile->dob}}</span></h5>
                                <h5>Designation               : <span class="badge bg-info">{{$profile->designation}}</span></h5>
                                <h5>Gender                    : <span class="badge bg-info">{{$profile->gender}}</span></h5>
                                <h5>Country                   : <span class="badge bg-info">{{$profile->country}}</span></h5>
                                <h5>Favorite Color            : <span class="badge bg-info">{{$profile->favorite_color}}</span></h5>
                                <h5>Favorite Actor            : <span class="badge bg-info">{{$profile->favorite_actor}}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready( function () {

        $("#add_user").on("click",function()
        {
            var friendId = $('#friend_id').val();

            $.ajax({
                method: "POST",
                url: "/add_friend",
                data: { friendId:friendId, _token:"{{csrf_token()}}"},
                success: function(data)
                {
                    console.log(data);
                    $('#add_user').html('Friends');
                    toastr.success('Success', 'Your Friend List Added Successfully');
                },failure: function(err){
                    console.log(err);
                }

            });
        });
    });
</script>
@endsection