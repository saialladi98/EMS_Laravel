<?php

namespace App\Http\Controllers;

use App\Models\employee;
use App\Models\employee_project;
use App\Models\issue;
use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //login validation method
    public function loginUser(Request $req)
    {
        $req->validate(
            [
                'userid' => 'required ',
                'password' => 'required|min:5',
            ]
        );
        $id = $req->input('userid');
        $password = $req->input('password');
        $data = employee::where('user_id', '=', $id)->first();
        $userdata = DB::table('employees')
                    ->where('user_id', $id)
                    ->get();
        if ($data) {
            if ($password == $data->user_password) {
                if ($data->type_of_user == "normal user") {
                    return view('normal', ['normalUser' => $userdata]);
                } else if ($data->type_of_user == "manager") {
                    $result = json_decode($userdata, true);
                    foreach ($result as $key => $value) {
                        $val = array_values(array($key => $value));
                        $val = $value;
                        $res = array_values($val);
                    }
                    $manager_id_value = $res[0];
                    $employees = employee::all();
                    $deleteEmployees = employee_project::all();
                    $employeeUnderManager = DB::table('employees')
                        ->join('employee_projects', 'employee_projects.employee_id', '=', 'employees.employee_id')
                        ->select('employees.employee_id', 'employees.first_name', 'employees.last_name')
                        ->where('employee_projects.manager', '=', $manager_id_value)
                        ->get();
                    $result = json_decode($employeeUnderManager, true);
                    $res = DB::table('issues')
                          ->join('employees', 'employees.employee_id', '=', 'issues.employee_id')
                          ->join('employee_projects', 'employee_projects.employee_id', "=", 'employees.employee_id')
                          ->select('issues.issue_id', 'issues.issue_type', 'issues.issue_desc', 'employees.first_name', 'employees.last_name')
                          ->where('employee_projects.manager', '=', $manager_id_value)
                          ->get();
                    $result2 = json_decode($res, true);
                    $proj = project::all();
                    $emp_proj = employee_project::all();
                    $issue = issue::all();
                    $allemployees = employee::all()->where('type_of_user', '=', "normal user");
                    return view('manager', ['collection' => $userdata,
                        'showEmployeeCollection' => $result,
                        'projects' => $proj,
                        'deleteCollection' => $deleteEmployees,
                        'employeeIssueList' => $result2,
                        'employeeList' => $allemployees,
                    ]);
                    return view('manager', ['collection' => $userdata]);
                } else if ($data->type_of_user == "admin") {
                    $employees = employee::all();
                    $proj = project::all();
                    $issue = issue::all();
                    return view('admin', ['collection' => $userdata,
                        'collectionInfo' => $employees,
                        'projects' => $proj,
                        'issues' => $issue,
                    ]);
                }
            } else {
                return back()->with('fail', 'Invalid Password');
            }
        } else {
            return back()->with('fail', 'Invalid UserId');
        }
    }

    // Registration method
    public function registerMethod(Request $req)
    {
        $employee = new Employee;
        $employee->first_name = $req->fname;
        $employee->last_name = $req->lname;
        $employee->mobile_no = $req->mobile;
        $employee->date_of_birth = $req->dateOfBirth;
        $employee->gender = $req->gender;
        $employee->communication_address = $req->address;
        $employee->city = $req->cities;
        $employee->type_of_user = $req->userType;
        $employee->user_password = $req->password;
        $employee->user_id = $employee->first_name . "@gmail.com";
        $result = $employee->save();
        if ($result) {
            return back()->with('success', 'Registred Successfully');
        } else {
            return back()->with('fail', 'Failed to Register');
        }
    }

    // resetPassword
    public function resetPassword(Request $req)
    {
        $userid = $req->userid;
        $password = $req->password;
        $req->validate([
            'userid' => 'required',
            'password' => 'required | min:8',
            're_password' => 'required |min:8 ',
        ]);
        $user = employee::where('user_id', '=', $req->userid)->first();
        if ($user) {
            if ($req->password == $req->re_password) {
                $result = DB::table('employees')
                         ->where('user_id', $userid)
                         ->update([
                         'user_password' => $password,
                         ]);
                return back()->with('success', 'Password Updated Successfully !!!');
            } else {
                return back()->with('fail', "Password doesn't Match!");
            }
        } else {
            return back()->with('fail', "User doesn't exist!");
        }
    }

    //task perform by normal user
    //1.update mobile number method
    public function editMobile(Request $req)
    {
        $employee = employee::where('employee_id', $req->employee_id)->update(array('mobile_no' => $req->mobile_no));
        $data = employee::where('employee_id', $req->employee_id)->get();
        if ($employee) {
            session()->flash('normalMobileSuccess', 'Number Updated Successfully');
            return view('normal', ["normalUser" => $data]);
        } else {
            $data2 = employee::where('employee_id', $req->employee_id)->get();
            session()->flash('normalMobileFail', "Number doesn't Updated");
            return view('normal', ["normalUser" => $data2]);
        }
    }

    //2.update communication address
    public function updateAddress(Request $req)
    {
        $employee = employee::where('employee_id', $req->employee_id)->update(array('communication_address' => $req->communication_address));
        $data = employee::where('employee_id', $req->employee_id)->get();
        if ($employee) {
            session()->flash('success', ' Address Updated Successfully');
            return view('normal', ["normalUser" => $data]);
        } else {
            $data2 = employee::where('employee_id', $req->employee_id)->get();
            session()->flash('fail', "Address doesn't Updated");
            return view('normal', ["normalUser" => $data2]);
        }
    }

    //3.raise issue
    public function submitIssue(Request $req)
    {
        $issue = new issue;
        $issue->issue_type = $req->issue_name;
        $issue->issue_desc = $req->issue_desc;
        $issue->issue_created_date = $req->issue_date;
        $issue->employee_id = $req->employee_id;
        $issue->save();
        $data = employee::where('employee_id', $req->employee_id)->get();
        if ($data) {
            session()->flash('normalUserSuccess', 'Issue Raised Successfully ');
            return view('normal', ["normalUser" => $data]);
        } else {
            session()->flash('normalUserFail', "Issue doesn't raised");
            return view('normal', ["normalUser" => $data]);
        }
    }

    // task perform by manager
    //To delete a employee from project by manager
    public function deleteEmployee($id)
    {
        $data = employee_project::where('emp_proj_id', $id);
        $result = $data->delete();
        if ($result) {
            ?>
                <script>
                    alert("Employee Deleted Successfully");
                </script>
            <?php
        } else {
            ?>
                <script>
                    alert("Employee Not Deleted Successfully");
                </script>
            <?php
        }
    }

    //add Employee to project
    public function updateEmployeeFromManager(Request $req)
    {
        $manager_id = $req->manager_id;
        $emp_proj = new employee_project();
        $emp_proj->employee_id = $req->input('emp_id');
        $emp_proj->project_id = $req->input('proj_id');
        $emp_proj->manager = $manager_id;
        $result = $emp_proj->save();
        if ($result) {
            ?>
                <script>
                    alert("Employee Added Successfully");
                </script>
            <?php
        } else {
            ?>
                <script>
                    alert("Employee Not Added Successfully");
                </script>
            <?php
        }
    }

    //manager Issues
    public function managerIssue(Request $req)
    {
        $issue = new issue();
        $issue->issue_type = $req->input('issue_name');
        $issue->issue_desc = $req->input('issue_desc');
        $issue->issue_created_date = $req->input('issue_date');
        $issue->employee_id = $req->input('employee_id');
        $result = $issue->save();
        if ($result) {
            ?>
                <script>
                    alert("Issue Raised Successfully");
                </script>
            <?php
        } else {
            ?>
                <script>
                    alert("Issue Not Raised Successfully");
                </script>
            <?php
        }
    }

    //update manager mobile
    public function editManagerMobile(Request $req)
    {
        $employee = new employee();
        $newNumber = $req->input('newMobileNumber');
        $employee_id = $req->input('employee_id');
        $result = employee::where('employee_id', $employee_id)
                  ->update([
                    'mobile_no' => $newNumber,
                   ]);
        if ($result) {
            ?>
                <script>
                    alert("Number Updated Successfully");
                </script>
            <?php
        } else {
            ?>
                <script>
                    alert("Number Not Updated");
                </script>
            <?php
        }
    }

    //update manager address
    public function editManagerAddress(Request $req)
    {
        $employee = new employee();
        $newAddress = $req->input('newAddress');
        $employee_id = $req->input('employee_id');
        $result = employee::where('employee_id', $employee_id)
                  ->update([
                  'communication_address' => $newAddress,
                  ]);
        if ($result) {
            ?>
                <script>
                    alert("Address Updated Successfully");
                </script>
            <?php
        } else {
            ?>
                <script>
                alert("Address Not Updated Successfully");
                </script>
            <?php
        }
    }

    //admin screen
    // particuler employees information
    public static function getEmpDetail($id)
    {
        $data = employee::where('employee_id', $id)->get();
        return view('employeeProfile', ['collection' => $data]);
    }

    //delete particular employee
    public function removeEmployee($id)
    {
        $data = employee::where('employee_id', $id);
        $result = $data->delete();
        if ($result) {
            ?>
                <script>
                    alert("Employee Deleted Successfully");
                </script>
            <?php
        } else {
            ?>
                <script>
                    alert("Employee Not Deleted Successfully");
                </script>
            <?php
        }
    }

    //get project details of a particular employee
    public function getProjectDetails($id)
    {
        $res = DB::table('employees')
              ->join('employee_projects', 'employee_projects.employee_id', '=', 'employees.employee_id')
              ->join('projects', 'projects.project_id', '=', 'employee_projects.project_id')
              ->select('employee_projects.employee_id', 'employee_projects.project_id', 'employee_projects.manager', 'projects.project_name', 'projects.project_desc', 'projects.project_start_date', 'projects.project_end_date')
              ->where('employees.employee_id', '=', $id)
              ->get();
        $result = json_decode($res, true);
        return view('projectInfo', ['projects' => $result]);
    }

    //all Projects assigned to particular employee
    public function allProject(Request $req)
    {
        $res = DB::table('employees')
              ->join('employee_projects', 'employee_projects.employee_id', '=', 'employees.employee_id')
              ->join('projects', 'projects.project_id', '=', 'employee_projects.project_id')
              ->select('employee_projects.employee_id', 'employee_projects.project_id', 'employee_projects.manager', 'projects.project_name', 'projects.project_desc', 'projects.project_start_date', 'projects.project_end_date')
              ->where('employees.employee_id', '=', $req->employeeid)
              ->get();
        $result = json_decode($res, true);
        if ($result) {
            return view('projectInfo', ['projects' => $result]);
        } else {
            return "Project Not Assigned to Employee";
        }
    }

    //remove project by admin
    public function removeProjectByAdmin($id)
    {
        $data = project::where('project_id', $id);
        $result = $data->delete();
        if ($result) {
            return "Project Deleted Successfully";
        } else {
            return "Project Not Deleted Successfully";
        }
    }

    // issue solved by admin
    public function resolveIssue($id)
    {
        $result = issue::where('issue_id', $id)->update(array('status' => "solved"));
        if ($result) {
            ?>
                <script>
                    alert("Issue Resolved Successfully");
                </script>
            <?php
        } else {
            ?>
                <script>
                    alert("Issue Not Resolved");
                </script>
            <?php
        }
    }

    //update employee by admin
    public function updateEmployee(Request $req)
    {
        $id = $req->employeeid;
        $first_name = $req->fname;
        $last_name = $req->lname;
        $mobile_no = $req->mobile;
        $dateOfBirth = $req->date;
        $gender = $req->gender;
        $address = $req->address;
        $city = $req->cities;
        $typeOfUser = $req->typeOfUser;
        if ($first_name) {
            $data1 = employee::where('employee_id', $id)->update(array('first_name' => $first_name));
            return back()->with('success', 'Details Updated Sucessfully');
        }
        if ($last_name) {
            $data1 = employee::where('employee_id', $id)->update(array('last_name' => $last_name));
            return back()->with('success', 'Details Updated Sucessfully');
        }
        if ($mobile_no) {
            $data1 = employee::where('employee_id', $id)->update(array('mobile_no' => $mobile_no));
            return back()->with('success', 'Details Updated Sucessfully');
        }
        if ($dateOfBirth) {
            $data1 = employee::where('employee_id', $id)->update(array('date_of_birth' => $dateOfBirth));
            return back()->with('success', 'Details Updated Sucessfully');
        }
        if ($gender) {
            $data1 = employee::where('employee_id', $id)->update(array('gender' => $gender));
            return back()->with('success', 'Details Updated Sucessfully');
        }
        if ($address) {
            $data1 = employee::where('employee_id', $id)->update(array('communication_address' => $address));
            return back()->with('success', 'Details Updated Sucessfully');
        }
        if ($city) {
            $data1 = employee::where('employee_id', $id)->update(array('city' => $city));
            return back()->with('success', 'Details Updated Sucessfully');
        }
        if ($typeOfUser) {
            $data1 = employee::where('employee_id', $id)->update(array('type_of_user' => $typeOfUser));
            return back()->with('success', 'Details Updated Sucessfully');
        } else {
            return back()->with('fail', 'Details Not Updated');
        }
    }

    //submit issue
    public function submitIssueByAdmin(Request $req)
    {
        $issue = new issue();
        $issue->issue_type = $req->input('issue_name');
        $issue->issue_desc = $req->input('issue_desc');
        $issue->issue_created_date = $req->input('issue_date');
        $issue->employee_id = $req->input('employee_id');
        $issue->save();
        $result = $issue->save();
        if ($result) {
            ?>
                <script>
                    alert("Issue Raised Successfully");
                </script>
            <?php
        } else {
            ?>
                <script>
                    alert("Issue Not Raised Successfully");
                </script>
            <?php
        }
    }

    //add project by admin
    public function addProject(Request $req)
    {
        $project = new project;
        $project->project_name = $req->project_name;
        $project->project_desc = $req->project_desc;
        $project->project_start_date = $req->start_date;
        $project->project_end_date = $req->end_date;
        $result = $project->save();
        if ($result) {
            ?>
                <script>
                    alert("Project Added Successfully");
                </script>
            <?php
        } else {
            ?>
                <script>
                    alert("Project Not Added Successfully");
                </script>
            <?php
        }
    }

    //update project Function
    public function updateProject(Request $req)
    {
        $id = $req->project_id;
        $project_date = DB::Table('projects')->select('project_start_date')->where('project_id', $id)->get();
        $project_name = $req->project_name;
        $project_desc = $req->project_desc;
        $project_start_date = $req->start_date;
        $project_end_date = $req->end_date;
        
        if ($project_name) {
            $data1 = project::where('project_id', $id)->update(array('project_name' => $project_name));
            return back()->with('success', 'Sucessfully updated!!!');
        }
        if ($project_desc) {
            $data2 = project::where('project_id', $id)->update(array('project_desc' => $project_desc));
            return back()->with('success', 'Sucessfully updated!!!');
        }
        if ($project_start_date) {
            $data2 = project::where('project_id', $id)->update(array('project_start_date' => $project_start_date));
            return back()->with('success', 'Sucessfully updated!!!');
        }
        if ($project_end_date) {
            return back()->with('success', 'Sucessfully updated!!!');
        } else {
            return back()->with('fail', ' Details not updated!!!');
        }
    }
}