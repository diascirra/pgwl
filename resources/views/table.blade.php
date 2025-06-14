@extends('layout.templates')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Data Points</h4>
            </div>
            <div class="card-body"></div>
            <table class="table table-striped" id="pointstable">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Descriptions</th>
                    <th>Images</th>
                    <th>Created At</th>
                    <th>Update At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($points as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->description }}</td>
                        <td>
                            <img src="{{ asset('storage/images/' . $p->image) }}" alt="" width="100" title="{{$p->image}}">
                        </td>

                        <td>{{ $p->created_at }}</td>
                        <td>{{ $p->updated_at }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Data Polyline</h4>
            </div>
            <div class="card-body"></div>
            <table class="table table-striped" id="polylinestable">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Descriptions</th>
                    <th>Images</th>
                    <th>Created At</th>
                    <th>Update At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($polylines as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->description }}</td>
                        <td>
                            <img src="{{ asset('storage/images/' . $p->image) }}" alt="" width="100" title="{{$p->image}}">
                        </td>

                        <td>{{ $p->created_at }}</td>
                        <td>{{ $p->updated_at }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Data Polygon</h4>
            </div>
            <div class="card-body"></div>
            <table class="table table-striped" id="polygonstable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Descriptions</th>
                    <th>Images</th>
                    <th>Created At</th>
                    <th>Update At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($polygons as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->description }}</td>
                        <td>
                            <img src="{{ asset('storage/images/' . $p->image) }}" alt="" width="100" title="{{$p->image}}">
                        </td>

                        <td>{{ $p->created_at }}</td>
                        <td>{{ $p->updated_at }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
          </div>
    @endsection

    @section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
    @endsection

   @section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>

    <script>
        let tablepoints = new DataTable('#pointstable');
        let tablepolylines = new DataTable('#polylinestable');
        let tablepolygons = new DataTable('#polygonstable');
    </script>
@endsection

