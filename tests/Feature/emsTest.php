<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
     /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * set Previous url
    */
    public function from(string $url)
    {
        $this->app['session']->setPreviousUrl($url);
        return $this;
    }

    // testcase for loginpage
    /**
     * Login Test
     * @dataProvider loginData
     */
    public function testLogin($username, $password, $status, $redirectTo)
    {
        fwrite(STDOUT, "\n" . __METHOD__ . "\n");
        $response = $this->from('login')
            ->post(
                'loginFunction', [
                    "user_id" => $username,
                    "password" => $password,
                ]);
        $response->assertStatus($status);
        $response->assertRedirect($redirectTo);
    }
    /**
     * Data provider for testLogin function
    */
    public function loginData()
    {
        return ([
            ["Mira@gmail.com", "mira#123", 302, "login"],
            ["Sai@gmail.com", "sai@1234", 302, "login"],
            ["Shreyashi@gmail.com", "shreya@123", 302, "login"],
            ["abcd123", "1234", 302, "login"],
        ]);
    }
// testcase for login route
public function testloginPage()
{
    $response = $this->get('/login');
    $response->assertStatus(200);
    // $response->assertViewIs('login');
}

// testcase for registerpage route
public function testregisterPage()
{
    $response = $this->get('/register');
    $response->assertStatus(200);
} 
 
// testcase for forgetpassword route
public function testforgetPasswordPage()
{
    $response = $this->get('/forgetPassword');
    $response->assertStatus(200);
}

// testcase for reset password
/**
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
        ["Mira@gmail.com", "mira@123", "mira@123", 302, "forgetPassword"],
        ["Sai@gmail.com", "abcd123", "xyx123", 302, "forgetPassword"],
    ]);
}

// public function test_interacting_with_cookies()
// {
//     $response = $this->withCookie('color', 'blue')->get('/');

//     $response = $this->withCookies([
//         'color' => 'blue',
//         'password' => 'Mira@123',
//     ])->get('/');
//     $response->assertStatus(200);
// }

/**
 * @dataProvider inputRegister
*/
public function testRegisterForm($first_name,$last_name,$mobno,$dateOfBirth,$gender,$address,$city,$typeOfUser,$password,$status,$redirectTo)
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
                "communication_address" =>$address,
                "city" => $city,
                "type_of_user" => $typeOfUser,
                "password" => $password   
            ]);
            $response->assertStatus($status);
           $response->assertRedirect($redirectTo);
}

public function inputRegister()
{
    return ([
        ["Mira", "Kumari", "9973032554",'22-01-1999',"female","patna","hyderabad","normal user","Mira@123",302,"register" ],
        
    ]);
}

// testcase for update mobile number
public function test_updateMobile()
{
    $response = $this->call('POST', 'updateMobile', array(
        '_token' => csrf_token(),
    ));
    $this->assertEquals(500, $response->getStatusCode());
}

}
