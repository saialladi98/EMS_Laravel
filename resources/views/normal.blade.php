<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Normal User</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{asset('js/app.js')}}"></script>
        <style>
            body,html{
                margin: 0px;
                padding: 0px;
            }
            .navbar
            {
                background: transparent;
                width: 100%;
                padding: 8px;
                height: 30px;
            }
            @media screen and (max-width:479px)
            {
                body, .nav nav-tabs
                {
                    background-image: url("https://media.istockphoto.com/photos/white-pen-on-a-yellow-background-concept-picture-id1128159714?k=6&m=1128159714&s=170667a&w=0&h=vs7B7DybnvCrAWdWJX2FsvIKHxg5nwcmrHSNxUTxA8s=");
                }
            }
            @media screen  and (max-width:991px)
            {
                body, .nav nav-tabs
                {
                    background-image: url("https://media.istockphoto.com/photos/white-pen-on-a-yellow-background-concept-picture-id1128159714?k=6&m=1128159714&s=170667a&w=0&h=vs7B7DybnvCrAWdWJX2FsvIKHxg5nwcmrHSNxUTxA8s=");
                }
            }
            @media(min-width:992px) and (max-width:1024px)
            {
                body,.nav nav-tabs
                {
                    /* background-color: rgb(42, 99, 165); */
                    background-image: url("https://media.istockphoto.com/photos/white-pen-on-a-yellow-background-concept-picture-id1128159714?k=6&m=1128159714&s=170667a&w=0&h=vs7B7DybnvCrAWdWJX2FsvIKHxg5nwcmrHSNxUTxA8s=");
                }
            }
            .container
            {
                /* border: 3px solid black */
                background-image: url(image.jgp);
                background-repeat: no-repeat;
                background-size: cover;
                scroll-behavior: auto;
                padding-top: 30px;
                height: 55vh
            }
        </style>
    </head>
    <body>    
        <header>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                <li><a data-toggle="tab" href="#info">Personal Information</a></li>
                <li><a data-toggle="tab" href="#updateMobile">Update Mobile</a></li>
                <li><a data-toggle="tab" href="#updateAddress">Update Address</a></li>
                <li><a data-toggle="tab" href="#raiseIssue">Raise Issue</a></li>
                <li><a  href="login" style='margin-left:800px padding 20px'>Logout</a></li>
            </ul>
        </header>
        <div class="container" style='background-image: url("image.jpg")'>
            <!--Home-->
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h3><i><b>WELCOME</b></i></h3>
                    <p><b><i>“A dream doesn't become reality through magic; it takes sweat, determination and hard work.”</i></b></p>
                </div>
                <!--Personal Information-->
                <div id="info" class="tab-pane fade">
                    <h3>Your Information</h3>
                    <section id="tableInfo">
                        <i><b>
                        <table border="2" class="table table-striped">
                            <tr>
                                <th>Employee Id</th>
                                <th>First Name </th>
                                <th>Last Name</th>
                                <th>Mobile Number</th>
                                <th>Date Of Birth</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>City</th>
                            </tr>
                            @foreach($normalUser as $user)
                                <tr>
                                    <td>{{ $user->employee_id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{$user->mobile_no }}</td>
                                    <td>{{$user->date_of_birth }}</td>
                                    <td>{{ $user->communication_address }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->city }} </td>
                                </tr>
                            @endforeach
                        </table>
                        </b></i>
                    </section><br><br>
                </div>
                <!--Update mobile and communication Address-->
                <div id="updateMobile" class="tab-pane fade col-sm-8">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="feature-title ">Update Number</h4>
                            <hr>
                            <form action="updateMobile" method="POST">
                                @if(Session::has('normalMobileSuccess'))
                                    <div class="alert-success">{{Session::get('normalMobileSuccess')}}</div>
                                @endif
                                @if(Session::has('normalMobileFail'))
                                    <div class="alert-danger">{{Session::get('normalMobileFail')}}</div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <!-- <label for="employee_id" style="color: black;">Employee Id</label> -->
                                    <input type="text" required name="employee_id" value="{{ $user->employee_id }}" hidden>
                                    <span class="text-danger">@error('employee_id'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="mobile_no" style="color: black;">New Mobile Number</label>
                                    <input type="text" class="form-control col-sm-5" placeholder="Mobile Number" required pattern="^[6-9][0-9]{9}" name="mobile_no" value="{{old('mobile_no')}}">
                                    <span class="text-danger">@error('mobile_no'){{$message}}@enderror</span>
                                </div> <br><br>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div><br>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- Update Address form -->
            <div id="updateAddress" class="tab-pane fade col-sm-8">
                <div id="addressForm">
                    <div class="row">
                        <div class="col-md-3">
                            <h4 class="feature-title ">Update Address</h4>
                            <hr>
                            <form action="updateAddress" method="POST">
                                @if(Session::has('success'))
                                    <div class="alert-success">{{Session::get('success')}}</div>
                                @endif
                                @if(Session::has('fail'))
                                    <div class="alert-danger">{{Session::get('fail')}}</div>
                                @endif
                                @csrf
                                <div class="form-group">
                                    <!-- <label for="employee_id" style="color: black;">Employee Id</label> -->
                                    <input type="text" required name="employee_id" value="{{ $user->employee_id }}" hidden>
                                    <span class="text-danger">@error('employee_id'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="user_password" style="color: black;">New Address</label>
                                    <textarea class="form-control col-sm-5" placeholder="New Address" name="communication_address" value="{{old('communication_address')}}"></textarea>
                                    <span class="text-danger">@error('communication_address'){{$message}}@enderror</span>
                                </div> <br><br><br>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Raise an issue-->
            <div id="raiseIssue" class="tab-pane fade col-sm-8">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Raise Issue</h3>
                            <form action="raiseIssue" method="POST">
                            @if(Session::has('normalUserSuccess'))
                                <div class="alert alert-success"><strong>{{Session::get('normalUserSuccess')}}</strong></div>
                            @endif
                            @if(Session::has('normalUserFail'))
                                <div class="alert alert-danger"><strong>{{Session::get('normalUserFail')}}</strong></div>
                            @endif
                            @csrf
                                <div class="form-group">
                                    <!-- <label for="userName">Enter Employee Id</label> -->
                                    <input type="text" required name="employee_id" value="{{ $user->employee_id }}" hidden>
                                    <span  class="text-danger">@error('employee_id'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="user_password">Issue Name</label>
                                    <input type="text" class="form-control" placeholder="Issue Name" required name="issue_name" value="{{old('issue_name')}}">
                                    <span class="text-danger">@error('issue_name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="user_password">Issue Description</label>
                                    <textarea class="form-control" placeholder="Issue Description" required name="issue_desc" value="{{old('issue_desc')}}"></textarea>
                                    <span  class="text-danger">@error('issue_desc'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <!-- <label for="user_password">Issue Date</label> -->
                                    <input type="date" required name="issue_date" value="<?php echo date('Y-m-d'); ?>" hidden>
                                    <span  class="text-danger">@error('issue_date'){{$message}}@enderror</span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <style>
        body {
            background-image: url("https://i.pinimg.com/236x/01/49/82/014982deadbd7655c4f18facf5664006--power-point-presentation-business-presentation.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        ul {
            background-color: aliceblue;
            background: skyblue;
            padding: 20px;
            height: 70px;
            /* color:white; */
        }
        p {
            padding: 20px;
            word-spacing: 4px;
            color: black;
            font-size: large;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</html>
