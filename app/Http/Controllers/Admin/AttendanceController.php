<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employees;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Dompdf\Dompdf;


class AttendanceController extends Controller
{
    public function index()
    {
        return view('admin.attendance');
    }

    public function alldata()
    {
        $attendance = Attendance::all();
        return view('admin.attendance')->with('attendance', $attendance);
    }

    public function show()
    {

        // Retrieve the count of employees
        $employeeCount = employees::count();

        // Retrieve the count of employees
        $attendance = Attendance::all();

        // Get the count of attendance records for each employee
        $attendanceCounts = DB::table('attendance')
            ->select('employee_id', DB::raw('count(*) as attendance_count'))
            ->groupBy('employee_id')
            ->get();

        // Find the maximum attendance count
        $maxAttendanceCount = $attendanceCounts->max('attendance_count');

        // Filter employees with the maximum attendance count
        $employeesWithMostAttendance = $attendanceCounts->where('attendance_count', $maxAttendanceCount);

        // Count the number of employees with the maximum attendance count
        // $countEmployeesWithMostAttendance = $employeesWithMostAttendance->count();

        // Assuming $attendanceCounts contains the attendance counts for each employee
        $lowestAttendanceCount = $attendanceCounts->min('attendance_count');

        // Filter employees with the lowest attendance count
        $employeesWithLowAttendance = $attendanceCounts->where('attendance_count', $lowestAttendanceCount);

        // Get the current date
        $currentDate = Carbon::today()->toDateString();

        // Count the number of check-ins for the current day
        $checkInsTodayCount = Attendance::whereDate('date', $currentDate)->count();

        // Count the number of check-outs for the current day
        $checkOutsTodayCount = Attendance::whereDate('date', $currentDate)
            ->whereNotNull('check_out_time') // Make sure check-out time is not null
            ->count();

        // Count the number of late check-ins for the current day
        $lateCheckInsTodayCount = Attendance::whereDate('date', $currentDate)
            ->where('late', true) // Filter for late check-ins
            ->count();



        // Pass the count to the view
        // return view('admin.dashboard', ['attendance' => $attendance]);
        return view('admin.dashboard', compact(
            'employeeCount',
            'attendance',
            'employeesWithMostAttendance',
            'employeesWithLowAttendance',
            'checkInsTodayCount',
            'checkOutsTodayCount',
            'lateCheckInsTodayCount'
        ));
    }

    public function generatePdf(Request $request)
    {

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Get the attendance data (similar to the previous method)
        $attendanceData = Attendance::whereBetween('date', [$startDate, $endDate])->get(); // Adjust this to your query
        // Retrieve start and end dates from the request

        // Pass the data to the view
        $pdf = new Dompdf();
        $pdf->loadHtml(view('admin.attendance_pdf', compact('attendanceData', 'startDate', 'endDate')));

        // Render the PDF
        $pdf->render();

        // Output the generated PDF
        return $pdf->stream('attendance_report.pdf');
    }

    public function show1(Request $request)
    {
        // Retrieve start and end dates from the request
        $startDate = $request->input('start_date', now()->startOfMonth());
        $endDate = $request->input('end_date', now()->endOfMonth());

        // Retrieve attendance data based on the selected date range
        $attendanceData = Attendance::whereBetween('date', [$startDate, $endDate])->get();

        // Pass the attendance data to the view for rendering
        return view('admin.attendance_report', [
            'attendanceData' => $attendanceData,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
