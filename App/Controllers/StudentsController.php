<?php

namespace App\Controllers;

use App\Models\Student;

class StudentsController extends BaseController {

    public function __construct() {
        $this->student = new Student();
    }
    public function index()
    {
        $students = $this->student->getAll();

        return $this->view('students.index', ['students' => $students]);
    }

    public function create()
    {
        return $this->view('students.create');
    }

    public function edit($id)
    {
        $i = $id;
        return $this->view('students.edit');
    }
}
