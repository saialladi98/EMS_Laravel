<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Manager Screen</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <header>
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
        <li><a data-toggle="tab" href="#info">Personal Info</a></li>
        <li><a data-toggle="tab" href="#update">Update Details</a></li>
        <li><a data-toggle="tab" href="#raiseIssue">Raise Issue</a></li>
        <li><a data-toggle="tab" href="#emp">Employees</a></li>
        <li><a data-toggle="tab" href="#del">Delete</a></li>
        <li><a data-toggle="tab" href="#issue">Employee Issues</a></li>
        <li><a data-toggle="tab" href="#add">Add Employee</a></li>
        <li><a  href="login">Logout</a></li>
      </ul>
    </header>
    <div class="container" style='background-image: url("image.jpg")'>
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
        <!--Update mobile and all-->
        <div id="update" class="tab-pane fade col-sm-8">
          <h3 class="col-lg-12">Moblie Number</h3>
          <div id="mobileForm">
            <form id="mobileForm" action="managerMobileUpdate"  method="POST">
              @if(session('msg'))
                <h5 class="text-center" style="color:darkred; ">{{session('msg')}}</h5>
              @endif
              @if(Session::has('mobileFail'))
                <div class="alert-danger col-sm-5">{{Session::get('mobileFail')}}</div>
              @endif
              @csrf
              <div class="col-sm-4">
                <div class="form-group">
                  <!-- Employee Id :<br> -->
                  <input type="text"  name="employee_id" required  value="{{$user->employee_id}}" hidden><br>
                  New Mobile Number :<br>
                  <input type="text" class="form-control col-sm-4"  name="newMobileNumber" required pattern="^[6-9][0-9]{9}$" placeholder="Mobile Number"><br>
                  <br>
                  <button type="submit" class="btn btn-warning">Submit</button>
                  <br>
                </div>
              </div>
            </form>
          </div>
          <h3 class="col-lg-12">Address</h3>
          <div id="addressForm">
            <form id="addressForm" action="managerAddressUpdate"  method="post">
              @if(Session::has('addressSuccess'))
                <div class="alert-success col-sm-5">{{Session::get('addressSuccess')}}</div>
              @endif
              @if(Session::has('addressFail'))
                <div class="alert-danger col-sm-5">{{Session::get('addressFail')}}</div>
              @endif
              @csrf
              <div class="col-sm-8">
                <div class="form-group">
                  <!-- Employee id :<br> -->
                  <input type="text"  name="employee_id" required  value="{{$user->employee_id}}" hidden><br>
                  New Address :<br>
                  <textarea type="text" class="form-control col-sm-6"  name="newAddress" required  placeholder="Address"></textarea><br>
                  <br><br>
                  <button type="submit" class="btn btn-warning">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!--Raise an issue-->
        <div id="raiseIssue" class="tab-pane fade col-sm-8">
          <h3 class="col-sm-8">Raise Issue</h3>
          <div id="issueForm">
            <form id="issueForm" action="mangerIssues"  method="post">
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
                  <textarea  class="form-control col-sm-6"  name="issue_desc" required  placeholder="Issue Description"></textarea><br>
                  <input type="date" required name="issue_date" value="<?php echo date('Y-m-d'); ?>" hidden>
                  <br><br>
                  <button type="submit" class="btn btn-warning">Submit</button>
                  <br>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!--the below code is for employee to that paticular manager-->
        <div id="emp" class="tab-pane fade">
          <h3>To see employees who are assigned to you. Please click below button</h3>
          <div id="toDisplayEmployees">
            <p><button id="listOfEmployees" class="btn btn-primary">See Employees</button></p>
          </div>
          <div id="employessList" >
            <table border="1" class="table table-striped">
              <tr>
                <td>Employee Id</td>
                <td>First Name</td>
                <td>Last Name</td>
              </tr>
              @foreach($showEmployeeCollection as $value)
                <tr>
                  <td>{{$value['employee_id']}}</td>
                  <td>{{$value['first_name']}}</td>
                  <td>{{$value['last_name']}}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
        <!--the below code is for delete employee operation-->
        <div id="del" class="tab-pane fade">
          <h3>To remove paticular employee from a project. Please click on below button</h3>
          <div id="toDisplayDelete">
            <p><button id="deleteEmployee" class="btn btn-primary">Remove Employee</button></p>
          </div>
            <div id="todeleteDisplay" >
              <table border="1" class="table table-striped">
                <tr>
                  <td>Employee Project Id</td>
                  <td>Employee Id</td>
                  <td>Project Id</td>
                  <td>Delete</td>
                </tr>
                @foreach($deleteCollection as $val)
                  <tr>
                    <td>{{$val['emp_proj_id']}}</td>
                    <td>{{$val['employee_id']}}</td>
                    <td>{{$val['project_id']}}</td>
                    <td><a href="deleteEmp/{{$val['emp_proj_id']}}">Delete</a></td>
                  </tr>
                @endforeach
              </table>
          </div>
        </div>
        <!--the below code is to see employees issues-->
        <div id="issue" class="tab-pane fade">
          <h3>To see employees. Please click below button</h3>
          <div id="toDisplayEmployeeIssues">
            <p><button id="issuesOfEmployees" class="btn btn-primary">Issues List</button></p>
          </div>
          <div id="employessIssuesList" >
            <table border="1" class="table table-striped">
              <tr>
                <td>Issue Id</td>
                <td>Issue Name</td>
                <td>Issue Desc</td>
                <td>Employee Fname</td>
                <td>Employee Lname</td>
              </tr>
              @foreach($employeeIssueList as $value)
                <tr>
                  <td>{{$value['issue_id']}}</td>
                  <td>{{$value['issue_type']}}</td>
                  <td>{{$value['issue_desc']}}</td>
                  <td>{{$value['first_name']}}</td>
                  <td>{{$value['last_name']}}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
        <!--the below code is for add employee operation-->
        <div id="add" class="tab-pane fade">
          <h3>Below tables will help you to assign an employee to paticular project</h3>
          <div id="tables">
            <div class="col-md-6">
              <h5>To see employee. Please click below button</h5>
              <p><button id="seeEmployee" class="btn btn-primary">See Employee</button></p>
              <table border="1" id="employeeTable"  class="table table-striped">
                <tr>
                  <td>Employee Id</td>
                  <td>Employee Fname</td>
                  <td>Employee Lname</td>
                </tr>
                @foreach($employeeList as $value)
                  <tr>
                    <td>{{$value['employee_id']}}</td>
                    <td>{{$value['first_name']}}</td>
                    <td>{{$value['last_name']}}</td>
                  </tr>
                @endforeach
              </table>
          </div>
          <div class="col-md-6">
            <h5>To see projects. Please click below button</h5>
            <p><button id="seeProjects" class="btn btn-primary">See Projects</button></p>
            <table border="1" id="projectTable" class="table table-striped">
              <tr>
                <td>Project Id</td>
                <td>Project Name</td>
                <td>Project Desc</td>
              </tr>
              @foreach($projects as $value)
                <tr>
                  <td>{{$value['project_id']}}</td>
                  <td>{{$value['project_name']}}</td>
                  <td>{{$value['project_desc']}}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
        <div id="toDisplayAdd" class="col-md-12">
          <h5>To add a employee to a project. Please hit below button</h5>
          <p><button id="addEmployee" class="btn btn-primary">Add Employee</button></p>
          <form action="employeeInsert" method="post" id="toAddDisplay">
            @if(Session::has('addEmployeeSuccess'))
              <div class="alert-success col-sm-5">{{Session::get('addEmployeeSuccess')}}</div>
            @endif
            @if(Session::has('addEmployeeFail'))
              <div class="alert-danger col-sm-5">{{Session::get('addEmployeeFail')}}</div>
            @endif
            @csrf
            <div class="col-md-4">
              <!-- Manager Id:<br> -->
              <input  required type="text" name="manager_id" value="{{$user->employee_id}}" hidden><br>
              Employee Id:
              <input  class="form-control col-md-3" required type="text" name="emp_id" placeholder="Employee Id"><br>
              Project Id:
              <input  class="form-control col-md-3" required type="text" name="proj_id" placeholder="Project Id"><br>
              <br><br>
              <button class="btn btn-warning" type="submit">Submit</button>
            </div>
          </form>
        <div>
      </div>    
    </div>
    <!-- script for buttons -->
    <script>
      $(document).ready(function() {
        $('#todeleteDisplay').hide()
        $('#deleteEmployee').click(function() {
          $('#todeleteDisplay').toggle(1000);
        });
      });

      $(document).ready(function() {
        $('#toAddDisplay').hide()
        $('#addEmployee').click(function() {
          $('#toAddDisplay').toggle(1000);
        });
      });

      $(document).ready(function() {
        $('#employessList').hide();
        $('#listOfEmployees').click(function() {
          $('#employessList').toggle(1000);
        });
      });

      $(document).ready(function() {
        $('#employessIssuesList').hide()
        $('#issuesOfEmployees').click(function() {
          $('#employessIssuesList').toggle(1000);
        });
      });

      $(document).ready(function() {
        $('#employeeTable').hide()
        $('#seeEmployee').click(function() {
          $('#employeeTable').toggle(1000);
        });
      });

      $(document).ready(function() {
        $('#projectTable').hide()
        $('#seeProjects').click(function() {
          $('#projectTable').toggle(1000);
        });
      });
    </script>
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
