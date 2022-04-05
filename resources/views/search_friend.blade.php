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
                                    <select class="form-control live_search" id="search_gender" name="search_gender">
                                        <option value="">Choose Gender</option>
                                        <option value="male">Male</option>
                                        <option value="femail">Female</option>
                                        <option value="transgender">Transgender</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="date" class="form-control live_search" id="search_dob" name="search_dob" placeholder="Search D.O.B"/>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <input type="text" class="form-control live_search" id="f_color" name="f_color" placeholder="Search Favorite Color"/>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <input type="text" class="form-control live_search" id="f_actor" name="f_actor" placeholder="Search Favorite Actor"/>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="form-group">
                                    <button type="button" id="searchBtn" class="btn btn-info">Search</button>
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
        function showTable(){
            $('#search_friend_datatable').DataTable();
        }

        showTable();

        $("#searchBtn").on("click", function(){
            var getGender = $('#search_gender').val();
            var getDob = $('#search_dob').val();
            var getColor = $('#f_color').val();
            var getActor = $('#f_actor').val();

            $.ajax({
                method: "POST",
                url: "live_search",
                data: { getGender:getGender, getDob: getDob, getColor: getColor, getActor:getActor,  _token:"{{csrf_token()}}"},
                success: function(data)
                {
                    console.log(data);
                    if(data.length > 0){

                        $("#search_friend_datatable tbody").html("");

                        var sno = 0;
                        var departCnt = "";

                        data.forEach(function(friendLst){
                            sno = sno+1;
                            
                            departCnt = departCnt+"<tr>";
                            departCnt = departCnt+"<td>"+sno+"</td>";
                            departCnt = departCnt+"<td><img src='/img/avatar/"+friendLst.profile_pic+"' height='50px' width='80px'/></td>";
                            departCnt = departCnt+"<td>"+friendLst.name+"</td>";
                            departCnt = departCnt+"<td>"+friendLst.designation+"</td>";
                            departCnt = departCnt+"</tr>";
                            
                        });

                        $("#search_friend_datatable tbody").append(departCnt);
                    }else{
                        var table = $('#search_friend_datatable').DataTable();

                        //clear datatable
                        table.clear().draw();

                        //destroy datatable
                        table.destroy();
                    }
                    showTable();

                },error: function(err){
                    console.log(err);
                }
            });
        });
    });
</script>
@endsection