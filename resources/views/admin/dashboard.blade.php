@extends('layouts.master')


@section('title')
Dashboard | Staff Atendance
@endsection


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">

                <h2 style="margin: 30px;">Dashboard</h2>
            </div>

            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">{{ $employeeCount }}</div>
                        <div class="cardName">Total Employees</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="person-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $checkInsTodayCount }}</div>
                        <div class="cardName">Checked in Employees</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="checkmark-done-circle-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $lateCheckInsTodayCount }}</div>
                        <div class="cardName">No. of Late Employees</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="calendar-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $checkOutsTodayCount }}</div>
                        <div class="cardName">Checked Out Employees</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">5</div>
                        <div class="cardName">No. of Visitors</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="details2">
                <div class="recentOrders2">
                    <div id="piechart_3d" style="width: 100%; height: 100%;"></div>
                </div>
                <div class="recentCustomers2">
                    <div id="curve_chart" style="width: 100%; height: 100%"></div>
                </div>
            </div>

            <!--========================== Order Details List =================================-->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Attendance List</h2>
                        <a href="./attendance" class="btn">View All</a>
                    </div>

                    <table id="exampleAll" class="display">
                        <thead class=" text-primary">
                            <td>Employee ID</td>
                            <td>Date</td>
                            <td>Check In</td>
                            <td>Check In Time</td>
                            <td>Check Out</td>
                            <td>Check Out Time</td>
                            <td>Hours Worked</td>
                            <td>Late</td>
                            <td>On Leave</td>
                        </thead>

                        <tbody>
                            @foreach($attendance as $attendance)

                            @php
                            // Convert check-in and check-out times to DateTime objects
                            $checkInTime = new DateTime($attendance->check_in_time);
                            $checkOutTime = new DateTime($attendance->check_out_time);

                            // Calculate the difference between check-out and check-in times
                            $hoursWorked = $checkOutTime->diff($checkInTime)->format('%h:%I:%S');
                            @endphp
                            <tr>
                                <td>{{ $attendance->employee_id}}</td>
                                <td>{{ $attendance->date}}</td>
                                <td>{{ $attendance->check_in}}</td>
                                <td>{{ $attendance->check_in_time}}</td>
                                <td>{{ $attendance->check_out}}</td>
                                <td>{{ $attendance->check_out_time}}</td>
                                <td>{{ $hoursWorked }}</td>
                                <td>{{ $attendance->late}}</td>
                                <td>{{ $attendance->on_leave}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>


                <!--============================== New Customers======================================-->
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Best Employees</h2>
                    </div>
                    <table id="exampleMost" class="display">
                        <thead class=" text-primary">
                            <tr>
                                <td>Employee ID</td>

                                <td>Attendance Count</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeesWithMostAttendance as $memployee)
                            <tr>
                                <td>{{ $memployee->employee_id }}</td>

                                <td>{{ $memployee->attendance_count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Employees with low Attendance</h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="exampleLow" class="display">
                                        <thead class=" text-primary">
                                            <tr>
                                                <th>Employee ID</th>
                                                <!-- <th>Employee Name</th> -->
                                                <th>Attendance Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employeesWithLowAttendance as $employee)
                                            <tr>
                                                <td>{{ $employee->employee_id }}</td>

                                                <td>{{ $employee->attendance_count }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]
        ]);

        var options = {
            title: 'Employees Daily Attendance',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Year', 'Sales', 'Expenses'],
            ['2004', 1000, 400],
            ['2005', 1170, 460],
            ['2006', 660, 1120],
            ['2007', 1030, 540]
        ]);

        var options = {
            title: 'Employees Attendace Performance',
            curveType: 'function',
            legend: {
                position: 'bottom'
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
</script>

<script>
    $(document).ready(function() {
        $('#exampleAll').DataTable({
            "pagingType": "full_numbers",

        });
    });

    $(document).ready(function() {
        $('#exampleMost').DataTable({
            "pagingType": "full_numbers"
        });
    });

    $(document).ready(function() {
        $('#exampleLow').DataTable({
            "pagingType": "full_numbers"
        });
    });
</script>



@endsection
