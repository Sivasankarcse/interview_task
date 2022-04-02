@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5>Home Page</h5>
                </div>
                <div class="card-body">
                    <div class="container mb-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control search_gender" id="search_gender" name="search_gender" placeholder="Search Gender"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="search_dob" name="search_dob" placeholder="Search D.O.B"/>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="f_color" name="f_color" placeholder="Search Favorite Color"/>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="f_actor" name="f_actor" placeholder="Search Favorite Actor"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="search_friend_datatable" class="table table-striped mt-5">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Avatar</th>
                                <th>User Name</th>
                                <th>User Designation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($sno=0)
                            @foreach($usersLst as $user)
                            <tr>
                                <td>{{++$sno}}</td>
                                <td><img src="img/avatar/{{ $user->users->profile_pic }}" height='50px' width='80px'/></td>
                                <td>{{$user->users->name}}</td>
                                <td>{{$user->users->designation}}</td>
                            </tr>
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

        $("#search_gender").on("input",function()
        {
            var getGender = $('#search_gender').val();

            $.ajax({
                method: "POST",
                url: "/search_gender",
                data: { gender:getGender, _token:"{{csrf_token()}}"},
                success: function(data)
                {
                    console.log(data);
                    $("#search_friend_datatable tbody").html("");

                    var sno = 0;
                    var departCnt = "";

                    data.forEach(function(friendLst){
                        sno = sno+1;
                        
                        departCnt = departCnt+"<tr>";
                        departCnt = departCnt+"<td>"+sno+"</td>";
                        departCnt = departCnt+"<td><img src='img/avatar/'"+friendLst.profile_pic+"' height='50px' width='80px'/></td>";
                        departCnt = departCnt+"<td>"+friendLst.name+"</td>";
                        departCnt = departCnt+"<td>"+friendLst.designation+"</td>";
                        departCnt = departCnt+"</tr>";
                        
                    });

                    $("#search_friend_datatable tbody").append(departCnt);
                },error: function(err){
                    console.log(err);
                }
            });
        });

        $("#search_dob").on("input",function()
        {
            var getDob = $('#search_dob').val();

            $.ajax({
                method: "POST",
                url: "/search_dob",
                data: { dob:getDob, _token:"{{csrf_token()}}"},
                success: function(data)
                {
                    console.log(data);
                    $("#search_friend_datatable tbody").html("");

                    var sno = 0;
                    var departCnt = "";

                    data.forEach(function(friendLst){
                        sno = sno+1;

                        departCnt = departCnt+"<tr>";
                        departCnt = departCnt+"<td>"+sno+"</td>";
                        departCnt = departCnt+"<td><img src='img/avatar/'"+friendLst.profile_pic+"' height='50px' width='80px'/></td>";
                        departCnt = departCnt+"<td>"+friendLst.name+"</td>";
                        departCnt = departCnt+"<td>"+friendLst.designation+"</td>";
                        departCnt = departCnt+"</tr>";
                        
                    });

                    $("#search_friend_datatable tbody").append(departCnt);
                }
            });
        });

        $("#f_color").on("input",function()
        {
            var f_color = $('#f_color').val();

            $.ajax({
                method: "POST",
                url: "/search_color",
                data: { color:f_color, _token:"{{csrf_token()}}"},
                success: function(data)
                {
                    console.log(data);
                    $("#search_friend_datatable tbody").html("");

                    var sno = 0;
                    var departCnt = "";

                    data.forEach(function(friendLst){
                        sno = sno+1;

                        departCnt = departCnt+"<tr>";
                        departCnt = departCnt+"<td>"+sno+"</td>";
                        departCnt = departCnt+"<td><img src='/img/avatar/'"+friendLst.profile_pic+"' height='50px' width='80px'/></td>";
                        departCnt = departCnt+"<td>"+friendLst.name+"</td>";
                        departCnt = departCnt+"<td>"+friendLst.designation+"</td>";
                        departCnt = departCnt+"</tr>";
                        
                    });

                    $("#search_friend_datatable tbody").append(departCnt);
                }
            });
        });

        $("#f_actor").on("input",function()
        {
            var actor = $('#f_actor').val();

            $.ajax({
                method: "POST",
                url: "/search_actor",
                data: { actor:actor, _token:"{{csrf_token()}}"},
                success: function(data)
                {
                    console.log(data);
                    $("#search_friend_datatable tbody").html("");

                    var sno = 0;
                    var departCnt = "";

                    data.forEach(function(friendLst){
                        sno = sno+1;

                        departCnt = departCnt+"<tr>";
                        departCnt = departCnt+"<td>"+sno+"</td>";
                        departCnt = departCnt+"<td><img src='img/avatar/'"+friendLst.profile_pic+"' height='50px' width='80px'/></td>";
                        departCnt = departCnt+"<td>"+friendLst.name+"</td>";
                        departCnt = departCnt+"<td>"+friendLst.designation+"</td>";
                        departCnt = departCnt+"</tr>";
                        
                    });

                    $("#search_friend_datatable tbody").append(departCnt);
                }
            });
        });
    });
</script>
@endsection