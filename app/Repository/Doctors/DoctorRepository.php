<?php
namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Image;
use App\Models\Section;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait;
    public function index()
    {
        $doctors = Doctor::all();
        return view('Dashboard.Doctors.index', compact('doctors'));
    }
    public function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctors.add', compact('sections', 'appointments'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $doctor = new Doctor();
            $doctor->email = $request->email;
            $doctor->password = Hash::make($request->password);
            $doctor->section_id = $request->section_id;
            $doctor->phone = $request->phone;
            $doctor->price = $request->price;
            $doctor->status = 1;
            $doctor->save();
            $doctor->name = $request->name;
            $doctor->appointments = implode(",", $request->appointments);
            $doctor->save();
            $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $doctor->id, 'App\Models\Doctor');
            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.create');
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }
    public function destroy($request)
    {
        if ($request->page_id == 1) {

            if ($request->filename) {

                $this->Delete_attachment('upload_image', 'doctors/' . $request->filename, $request->id, $request->filename);
            }
            Doctor::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('Doctors.index');
        } else {

        }
    }
}