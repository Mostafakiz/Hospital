<?php
namespace App\Interfaces\Sections;

interface SectionRepositoryInterface
{
    // Get All Sections
    public function index();
    // Store Sections 
    public function store($request);
    // Update Sections
    public function update($request);
    // Destroy Sections
    public function destroy($request);
}