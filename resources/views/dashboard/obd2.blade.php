@extends('layouts.index')
@section('css')
<link rel="stylesheet" href="{{asset('stisla/dist/assets/modules/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{asset('stisla/dist/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('stisla/dist/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
@endsection
@section('js')
<script src="{{asset('stisla/dist/assets/modules/datatables/datatables.min.js')}}"></script>
<script src="{{asset('stisla/dist/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('stisla/dist/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('stisla/dist/assets/modules/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('stisla/dist/assets/js/page/modules-datatables.js')}}"></script>
@endsection
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1><img src="/prismax.jpeg" style="height: 50%; width: 50%"></h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
          <div class="breadcrumb-item">OBD 2</div>
        </div>
      </div>

      <div class="section-body">
        @if($id)
        <h2 class="section-title">Data OBD 2 - ID: {{$id}}</h2>
        @else
        <h2 class="section-title">Data OBD 2</h2>
        @endif

        <div class="row">
            <div class="col-3">
                <div class="card" style="background-color: pink;">
                    <div id='myDiv'></div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div id='myDiv2'></div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div id='myDiv3'></div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div id='myDiv4'></div>
                </div>
            </div>

            {{-- <div class="col-6">
                <div class="card">
                    <div id='myDiv5'></div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div id='myDiv6'></div>
                </div>
            </div> --}}

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h4>Average Speed (KM)</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="400" height="100"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h4>Distance Total (KM)</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2" width="400" height="100"></canvas>
                    </div>
                </div>
            </div>

        </div>
        <script src='https://cdn.plot.ly/plotly-2.27.0.min.js'></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            function updateSpeedometer(value) {
                var data = [
                    {
                        domain: { x: [0, 1], y: [0, 1] },
                        value: value,
                        title: { text: "Speedometer (km/h)" },
                        type: "indicator",
                        mode: "gauge+number",
                        gauge: { axis: { range: [null, 100] } }
                    }
                ];

                Plotly.newPlot('myDiv', data, { width: 265, height: 250, margin: { t: 0, b: 0 } });
            }

            function updateFuelLevel(value) {
                var data = [
                    {
                        domain: { x: [0, 1], y: [0, 1] },
                        value: value,
                        title: { text: "Fuel Level (L)" },
                        type: "indicator",
                        mode: "gauge+number",
                        gauge: { axis: { range: [null, 100] } }
                    }
                ];

                Plotly.newPlot('myDiv2', data, { width: 265, height: 250, margin: { t: 0, b: 0 } });
            }

            function updateAccuLevel(value) {
                var data = [
                    {
                        domain: { x: [0, 1], y: [0, 1] },
                        value: value,
                        title: { text: "Accu Level (V)" },
                        type: "indicator",
                        mode: "gauge+number",
                        gauge: { axis: { range: [null, 100] } }
                    }
                ];

                Plotly.newPlot('myDiv3', data, { width: 265, height: 250, margin: { t: 0, b: 0 } });
            }

            function updateTemperatureLevel(value) {
                var data = [
                    {
                        domain: { x: [0, 1], y: [0, 1] },
                        value: value,
                        title: { text: "Temperature Level (C)" },
                        type: "indicator",
                        mode: "gauge+number",
                        gauge: { axis: { range: [null, 100] } }
                    }
                ];

                Plotly.newPlot('myDiv4', data, { width: 265, height: 250, margin: { t: 0, b: 0 } });
            }

            function updateSpeed(dataPoints, timestamps) {
                var data = [
                    {
                        x: timestamps,
                        y: dataPoints,
                        type: 'scatter',
                        mode: 'lines+markers',
                        line: { shape: 'linear' },
                        marker: { size: 8 },
                        // Menggunakan maxpoints untuk membatasi jumlah titik yang ditampilkan
                        maxpoints: 10
                    }
                ];

                var layout = {
                    title: 'Average Speed (KM)',
                    yaxis: {
                        range: [0, Math.max(...dataPoints)]
                    }
                };

                Plotly.newPlot('myDiv5', data, layout);
            }

            function updateDistanceTotal(dataPoints, timestamps) {
                var data = [
                    {
                        x: timestamps,
                        y: dataPoints,
                        type: 'scatter'
                    }
                ];

                var layout = {
                    title: 'Distance Total (KM)'
                };

                Plotly.newPlot('myDiv6', data, layout);
            }

            function fetchData() {
                $.get('/getObd2', function (data) {
                    updateSpeedometer(data[0].speedometer);
                    updateFuelLevel(data[0].fuel);
                    updateAccuLevel(data[0].accu);
                    updateTemperatureLevel(data[0].temperature);
                    updateSpeed(data.map(item => item.speed), data.map(item => item.updated_at));
                    updateDistanceTotal(data.map(item => item.distance), data.map(item => item.updated_at));
                });
            }

            fetchData();
            setInterval(fetchData, 5000);
        </script>

        <script src="{{asset('stisla/dist/assets/modules/chart.min.js')}}"></script>
        {{-- <script src="{{asset('stisla/dist/assets/js/page/modules-chartjs.js')}}"></script> --}}
        <script>
            // Fungsi untuk memperbarui data chart
            function updateChartData() {
                $.ajax({
                    url: 'http://localhost:8000/getObd2Latest',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Sesuaikan properti labels dan data sesuai dengan respons API
                        myChart.data.labels = response.timeLabels.map(function(label) {
                            return new Date(label).toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                        });
                        myChart.data.datasets[0].data = response.speed.map(Number);

                        myChart2.data.labels = response.timeLabels.map(function(label) {
                            return new Date(label).toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                        });
                        myChart2.data.datasets[0].data = response.distance.map(Number);

                        // Perbarui chart
                        myChart.update();
                        myChart2.update();
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            // Inisialisasi chart
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [], // Labels akan diperbarui oleh data dari API
                    datasets: [{
                        label: 'Statistics',
                        data: [],
                        borderWidth: 2,
                        backgroundColor: '#6777ef',
                        borderColor: '#6777ef',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#ffffff',
                        pointRadius: 4
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                drawBorder: false,
                                color: '#f2f2f2',
                            },
                            ticks: {
                                beginAtZero: true,
                                stepSize: 5 // Sesuaikan ini sesuai kebutuhan
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 10, // Batasan maksimal jumlah tick di sumbu X
                                maxRotation: 0, // Rotasi label sumbu X
                                minRotation: 0, // Rotasi label sumbu X
                            }
                        }]
                    },
                }
            });

            // Perbarui data chart setiap detik
            setInterval(updateChartData, 1000);

            // Inisialisasi chart Distance
            var ctx2 = document.getElementById("myChart2").getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: [], // Labels akan diperbarui oleh data dari API
                    datasets: [{
                        label: 'Statistics',
                        data: [],
                        borderWidth: 2,
                        backgroundColor: '#6777ef',
                        borderColor: '#6777ef',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#ffffff',
                        pointRadius: 4
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                drawBorder: false,
                                color: '#f2f2f2',
                            },
                            ticks: {
                                beginAtZero: true,
                                stepSize: 5 // Sesuaikan ini sesuai kebutuhan
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 10, // Batasan maksimal jumlah tick di sumbu X
                                maxRotation: 0, // Rotasi label sumbu X
                                minRotation: 0, // Rotasi label sumbu X
                            }
                        }]
                    },
                }
            });

            // Perbarui data chart setiap detik
            setInterval(updateChartDataDistance, 1000);
        </script>


        {{-- <div class="row">
          <div class="col-3">
            <div class="card">
                <script src='https://cdn.plot.ly/plotly-2.27.0.min.js'></script>
                <div id='myDiv'></div>
                <script>
                    var data = [
                        {
                            domain: { x: [0, 1], y: [0, 1] },
                            value: 50,
                            title: { text: "Speedometer" },
                            type: "indicator",
                            mode: "gauge+number",
                            gauge: { axis: { range: [null, 200] } }
                        }
                    ];

                    var layout = { width: 265, height: 250, margin: { t: 0, b: 0 } };
                    Plotly.newPlot('myDiv', data, layout);
                </script>
            </div>
          </div>

          <div class="col-3">
            <div class="card">
                <div id='myDiv2'></div>
                    <script>
                        var data = [
                            {
                                domain: { x: [0, 1], y: [0, 1] },
                                value: 30,
                                title: { text: "Fuel Level" },
                                type: "indicator",
                                mode: "gauge+number",
                                gauge: { axis: { range: [null, 100] } }
                            }
                        ];

                        var layout = { width: 265, height: 250, margin: { t: 0, b: 0 } };
                        Plotly.newPlot('myDiv2', data, layout);
                    </script>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div id='myDiv4'></div>
                    <script>
                        var data = [
                            {
                                domain: { x: [0, 1], y: [0, 1] },
                                value: 90,
                                title: { text: "Accu Level" },
                                type: "indicator",
                                mode: "gauge+number",
                                gauge: { axis: { range: [null, 100] } }
                            }
                        ];

                        var layout = { width: 265, height: 250, margin: { t: 0, b: 0 } };
                        Plotly.newPlot('myDiv4', data, layout);
                    </script>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div id='myDiv5'></div>
                    <script>
                        var data = [
                            {
                                domain: { x: [0, 1], y: [0, 1] },
                                value: 60,
                                title: { text: "Temperature Level" },
                                type: "indicator",
                                mode: "gauge+number",
                                gauge: { axis: { range: [null, 100] } }
                            }
                        ];

                        var layout = { width: 265, height: 250, margin: { t: 0, b: 0 } };
                        Plotly.newPlot('myDiv5', data, layout);
                    </script>
                </div>
            </div>

            <script src='https://cdn.plot.ly/plotly-2.27.0.min.js'></script>
            <div class="col-6">
                <div class="card">
                    <div id='myDiv6'></div>
                    <script>
                        var layout = {
                            title:'Distance Total (KM)'
                        };

                        var data = [
                        {
                            x: ['15:00:00', '15:20:00', '15:40:00', '16:00:00'],
                            y: [10, 11, 12],
                            type: 'scatter'
                        }
                        ];

                        Plotly.newPlot('myDiv6', data, layout);
                    </script>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div id='myDiv7'></div>
                    <script>
                        var layout = {
                            title:'Distance Total (KM)'
                        };

                        var data = [
                        {
                            x: ['15:00:00', '15:20:00', '15:40:00', '16:00:00'],
                            y: [10, 15, 13, 17],
                            type: 'scatter'
                        }
                        ];

                        Plotly.newPlot('myDiv7', data, layout);
                    </script>
                </div>
            </div>
        </div> --}}

      </div>
    </section>
</div>

<!-- Modal "Add Item" -->
<div class="modal fade" id="modal-add-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Name Item">
                    </div>
                    <div class="form-group">
                        <label for="brand" class="col-form-label">Brand:</label>
                        <input type="text" class="form-control" id="brand" placeholder="Brand Item">
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type:</label>
                        <select class="form-control" id="type">
                            <option value="out">Out</option>
                            <option value="in">In</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stock" class="col-form-label">Stock:</label>
                        <input type="number" class="form-control" id="stock" placeholder="Total Stock">
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="col-form-label">Category:</label>
                        <select class="form-control" id="category_id">
                            {{-- @foreach ($categories as $category) --}}
                                {{-- <option value="{{ $category['id'] }}">{{ $category['name_category'] }}</option> --}}
                            {{-- @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vendor_id" class="col-form-label">Vendor:</label>
                        <select class="form-control" id="vendor_id">
                            {{-- @foreach ($vendors as $vendor) --}}
                                {{-- <option value="{{ $vendor['id'] }}">{{ $vendor['name'] }}</option> --}}
                            {{-- @endforeach --}}
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add-item">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing item -->
<div class="modal fade" id="modal-edit-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="edit-name" class="col-form-label">Name:</label>
                        <input type="hidden" class="id-edit">
                        <input type="text" class="form-control" id="edit-name">
                    </div>
                    <div class="form-group">
                        <label for="brand" class="col-form-label">Brand:</label>
                        <input type="text" class="form-control" id="edit-brand" placeholder="Brand Item">
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type:</label>
                        <select class="form-control" id="edit-type">
                            <option value="out">Out</option>
                            <option value="in">In</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-stock" class="col-form-label">Stock:</label>
                        <input type="number" class="form-control" id="edit-stock">
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="col-form-label">Category:</label>
                        <select class="form-control" id="edit-category_id">
                            {{-- @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}">{{ $category['name_category'] }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vendor_id" class="col-form-label">Vendor:</label>
                        <select class="form-control" id="edit-vendor_id">
                            {{-- @foreach ($vendors as $vendor)
                                <option value="{{ $vendor['id'] }}">{{ $vendor['name'] }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="edit-item">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection
