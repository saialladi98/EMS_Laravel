<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * set Previous url
     */
    public function from(string $url)
    {
        $this->app['session']->setPreviousUrl($url);
        return $this;
    }

    /**
     * Login Test
     * @dataProvider loginData
     */

    public function testLogin($username, $password, $status, $redirectTo)
    {
        fwrite(STDOUT, "\n" . __METHOD__ . " $username" . " $password\n");
        $response = $this->from('login')
            ->post(
                '/loginFunction', [
                    "userid" => $username,
                    "password" => $password,
                ]);
        $response->assertStatus($status);
        $response->assertRedirect($redirectTo);
    }

    /**
     * data provider for testLogin function
     */
    public function loginData()
    {
        return ([
            ["ganga@gmail.com", "ganga@12345", 302, "normal"], // normal
            ["Shreya@gmail.com", "Shreya@123", 302, "login"], // admin
            ["ganga@gmail.com", "abcd", 302, "login"], //wrong password
            //["abcd123", "1234", 302, "login"], // invalid credenial
        ]);
    }

    /**
     * @dataProvider  normalMob
     */

    public function testNormalMob($emp_id, $mobile, $status, $redirectTo)
    {
        fwrite(STDOUT, "\n" . __METHOD__ . " $emp_id" . " $mobile\n");
        $response = $this->from('normal')
            ->post(
                '/updateMobile', [
                    "employee_id" => $emp_id,
                    "mobile_no" => $status,
                ]);
        $response->assertStatus($status);
        $response->assertRedirect($redirectTo);
    }

    public function normalMob()
    {
        return ([
            ["5", "9866506401", 302, "normal"],
        ]);
    }

    /**
     * Testing Login Route
     */
    public function testRouteLogin()
    {
        fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->get("login");
        $response->assertStatus(200);
    }

    /**
     * Testing Reset Password Route
     */

    public function testResetPasswordRoute()
    {
        fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->get("forgetPassword");
        $response->assertStatus(200);
    }

    /**
     * Testing resetpassword function
     * @dataProvider resetData
     */

    public function testResetPassword($username, $password, $newPassword, $status, $redirectTo)
    {
        fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->from('forgetPassword')
            ->post(
                "resetPassword",
                [
                    "user_id" => $username,
                    "password" => $password,
                    "re_password" => $newPassword,
                ]);
        $response->assertStatus($status);
        $response->assertRedirect($redirectTo);
    }

    /**
     * Data provider for testResetPassword
     */

    public function resetData()
    {
        return ([
            ["ganga@gmail.com", "ganga@123", "ganga@123", 302, "forgetPassword"],
            ["sai@gmail.com", "sai@123", "Sai@123", 302, "forgetPassword"],
        ]);
    }

    public function testRegisterRoute()
    {
        fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->get("register");
        $response->assertStatus(200);
    }

    /**
     * @dataProvider inputRegister
     */

    public function testRegisterForm($first_name, $last_name, $mobno, $dateOfBirth, $gender, $address, $city, $typeOfUser, $password, $user_id, $status, $redirectTo)
    {
        fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->from('register')
            ->post(
                "resetPassword",
                [
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "mobile_no" => $mobno,
                    "dateOfBirth" => $dateOfBirth,
                    "gender" => $gender,
                    "communication_address" => $address,
                    "city" => $city,
                    "type_of_user" => $typeOfUser,
                    "password" => $password,
                    "user_id" => $user_id,
                ]);
        $response->assertStatus($status);
        $response->assertRedirect($redirectTo);
    }
    
    public function inputRegister()
    {
        return ([
            ["Mira", "Kumari", "9973032554", '22-01-1999', "female", "patna", "hyderabad", "normal user", "Mira@123", "Mira@gmail.com", 302, "register"],

        ]);
    }
}
