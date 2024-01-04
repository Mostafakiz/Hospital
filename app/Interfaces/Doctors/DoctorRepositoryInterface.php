<?php
namespace App\Interfaces\Doctors;

interface DoctorRepositoryInterface
{
    // Get All Doctors
    public function index();
    // Create Doctor
    public function create();
    // Store Doctor
    public function store($request);
    // delete Doctor
    public function destroy($request);
}