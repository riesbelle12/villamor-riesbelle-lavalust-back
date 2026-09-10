<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

require_once __DIR__ . '/../middlewares/StudentMiddleware.php';

class StudentController extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // CHANGE THIS TO true OR false TO CONTROL PROFILE ACCESS
        $_SESSION['student_access'] = true;

        $this->call->view('student');
    }

    public function profile()
    {
        $middleware = new StudentMiddleware();

        return $middleware->handle(function () {

            $student = [
                'student_id' => '2024-00176',
                'name' => 'Riesbelle Villamor',
                'course' => 'Bachelor of Science in Information Technology',
                'year' => '3rd Year',
                'section' => 'F4',
                'email' => 'riesbellevillamor@gmail.com',
                'contact' => '0993 429 4309',
                'address' => 'Victoria',
                'skills' => 'Computer Literate, Digital Arts',
                'hobbies' => 'Dancing',
                'description' => 'A BSIT student who loves sleeping. ',
                'github' => 'https://github.com/riesbelle12'
            ];

            return $this->call->view('student_profile', $student);
        });
    }
}