<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Screen</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!-- naviagtion -->
        <header>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                <li><a data-toggle="tab" href="#info">Personal Info</a></li>
                <li><a data-toggle="tab" href="#employees">Employees</a></li>
                <li><a data-toggle="tab" href="#issueresolver">Resolve Issue</a></li>
                <li><a data-toggle="tab" href="#projectInformation">Project Information</a></li>
                <li><a data-toggle="tab" href="#projectbyId">Project by Id</a></li>
                <li><a data-toggle="tab" href="#raiseIssue">Raise Issue</a></li>
                <li><a href="login">Logout</a></li>
            </ul>
        </header>
        <!--Home-->
        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <h3><i><b>WELCOME</b></i></h3>
                <p>Train people well enough so they can leave, treat them well enough so they don't want to.” – Richard Branson. ...<br>
                “A successful man is one who can lay a firm foundation with the bricks others have thrown at him.” – David Brinkley. ...</p>
            </div>
            <!--Manager Information-->
            <div id="info" class="tab-pane fade">
                <h3>Your Information</h3>
                <section id="tableInfo">
                    <i><b>
                    <table border="2" class="table">
                        <tr>
                            <th>Employee Id</th>
                            <th>First Name </th>
                            <th>last Name</th>
                            <th>Mobile Number</th>
                            <th>Date Of Birth</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>City</th>
                        </tr>
                        @foreach($collection as $user)
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
            <!--employees information-->
            <div id="employees" class="tab-pane fade col-sm-8">
                <table border="2" id="employeeInfo" class="table table-striped">
                    <h4><b>Employees</b></h4>
                    <tr>
                        <b><th>Employee Name</th></b>
                        <th>View Details</th>
                        <th>Delete</th>
                        <th>Project</th>
                        <th>Update</th>
                    </tr>
                    @foreach($collectionInfo as $user)
                        <tr>
                            <td>{{$user['first_name']." ".$user['last_name']}}</td>
                            <td><a href={{"employeeProfile/".$user['employee_id']}}>view details</a></td>
                            <td><a href={{"delete/".$user['employee_id']}}>delete</a></td>
                            <td><a href={{"projectInfo/".$user['employee_id']}}>view Project</a></td>
                            <td><a href="updateEmployee">Update Details</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- Resolve issue -->
            <div id="issueresolver" class="tab-pane fade ">
                <h3>Issues</h3>
                <table border="1" class="table">
                    <tr>
                        <td>Employee Id</td>
                        <td>Issue Id</td>
                        <td>Issue Name</td>
                        <td>Issue Desc</td>
                        <td>Status</td>
                        <td>Resolve</td>
                    </tr>
                    @foreach($issues as $value)
                        <tr>
                            <th>Employee Id</th>
                            <th>First Name </th>
                            <th>last Name</th>
                            <th>Mobile Number</th>
                            <th>Date Of Birth</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>City</th>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!--project information-->
            <div id="projectInformation" class="tab-pane fade col-sm-8">
                <b>
                <table border="2" class="table table-striped">
                    <h4><b>All Projects</b></h4>
                    <tr>
                        <th>Project id</th>
                        <th>Project Name</th>
                        <th>Project Desc</th>
                        <th>Project start date</th>
                        <th>Project end date</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($projects as $user)
                        <tr>
                            <td>{{$user['project_id']}}</td>
                            <td>{{$user['project_name']}}</td>
                            <td>{{$user['project_desc']}}</td>
                            <td>{{$user['project_start_date']}}</td>
                            <td>{{$user['project_end_date']}}</td>
                            <td><a href="updateProject">Edit</a></td>
                            <td><a href={{"deleteProject/".$user['project_id']}}>delete</a></td>
                        </tr>
                    @endforeach
                </table>
                </b>
            </div>
            <!--project information by id-->
            <div id="projectbyId" class="tab-pane fade col-sm-8">
                <div class="row">
                    <div class="col-md-3">
                        <form id="projectInfoById" action="projectInformation" method="POST">
                            <h4><b>Retrive project Details</b></h4>
                            @if(Session::has('success'))
                                <div class="alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if(Session::has('fail'))
                                <div class="alert-danger">{{Session::get('fail')}}</div>
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="employeeid" style="color: black;">Employee id</label>
                                <input type="text" class="form-control col-sm-2" placeholder="Enter employeeid" name="employeeid">
                                <span class="text-danger">@error('employeeid'){{$message}}@enderror</span>
                            </div><br><br>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--Raise an issue-->
            <div id="raiseIssue" class="tab-pane fade col-sm-8">
                <h3 class="col-sm-8">Raise Issue</h3>
                <div id="raiseIssue">
                    <form  action="issueByAdmin"  method="post">
                        @if(Session::has('issueSuccess'))
                            <div class="alert-success col-sm-5">{{Session::get('issueSuccess')}}</div>
                        @endif
                        @if(Session::has('issueFail'))
                            <div class="alert-danger col-sm-5">{{Session::get('issueFail')}}</div>
                        @endif
                        @csrf
                        <div class="col-sm-6">
                            <div class="form-group">
                                <!-- Employee id :<br> -->
                                <input type="text"  name="employee_id" required  value="{{$user->employee_id}}" hidden><br>
                                Issue Name :<br>
                                <input type="text" class="form-control col-sm-3"  name="issue_name" required  placeholder="Issue Name"><br>
                                Issue Description :<br>
                                <textarea  class="form-control col-sm-3"  name="issue_desc" required  placeholder="Issue Description"></textarea><br>
                                <input type="date" required name="issue_date" value="<?php echo date('Y-m-d'); ?>" hidden>
                                <br><br>
                                <br>
                                <button type="submit" class="btn btn-warning">Submit</button>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <style>
        body
        {
            background-image: url("https://i.pinimg.com/236x/01/49/82/014982deadbd7655c4f18facf5664006--power-point-presentation-business-presentation.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
        ul
        {
            background-color: aliceblue;
            background: skyblue;
            padding: 20px;
            height: 70px;
            /* color:white; */
        }
        p
        {
            padding: 20px;
            word-spacing: 4px;
            color: black;
            font-size: large;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</html>