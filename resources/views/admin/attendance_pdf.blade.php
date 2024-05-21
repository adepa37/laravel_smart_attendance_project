<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report PDF</title>
    <!-- Include any necessary CSS stylesheets or meta tags here -->
</head>

<body>
    <h1>Attendance Report</h1>

    <!-- Display the date range of the report if dates are not null -->
    @if($startDate && $endDate)
    <p>Report Period: {{ $startDate->format('Y-m-d') }} to {{ $endDate->format('Y-m-d') }}</p>
    @else
    <p>Report Period: No dates selected</p>
    @endif

    <!-- Display the attendance data in a table -->
    <div class="table-responsive">
        <!-- Display the attendance data in a table -->
        <table border="1">
            <thead>
                <tr>
                    <td>Employee ID</td>
                    <td>Date</td>
                    <td>Check In</td>
                    <td>Check In Time</td>
                    <td>Check Out</td>
                    <td>Check Out Time</td>
                    <td>Late</td>
                    <td>On Leave</td>>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceData as $attendance)
                <tr>
                    <td>{{ $attendance-> employee_id}}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->check_in }}</td>
                    <td>{{ $attendance->check_in_time }}</td>
                    <td>{{ $attendance->check_out}}</td>
                    <td>{{ $attendance->check_out_time}}</td>
                    <td>{{ $attendance->late ? 'Yes' : 'No' }}</td>
                    <td>{{ $attendance->on_leave}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include any additional content or styling as needed -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "pagingType": "full_numbers",

            });
        });
    </script>
</body>

</html>
