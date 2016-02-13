@extends('app')

@section('styles')
    <link href="{{ URL::asset('vendor/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ URL::asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function() {
            $('#constituency-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/api/{{ $id }}/constituency',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'mp', name: 'mp' },
                    { data: 'signature_count', name: 'signature_count' },
                ],
                iDisplayLength:25,
                aLengthMenu: [25,50,100,200],
            });
        });

        $(function() {
            $('#country-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/api/{{ $id }}/country',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'signature_count', name: 'signature_count' },
                ],
                iDisplayLength:25,
                aLengthMenu: [25,50,100,200],
            });
        });
    </script>
@endsection

@section('content')
    <div class="container spark-screen">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ $attributes['action'] }} <br>
                    <small> Signatures: {{ number_format($attributes['signature_count']) }}</small>
                </h1>
                <p>{{ $attributes['background'] }}</p>
            </div>
        </div>

        <!-- Service Tabs -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Browse Data</h2>
            </div>
            <div class="col-lg-12">

                <ul id="myTab" class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#by-constituency" data-toggle="tab"><i class="fa fa-map-marker"></i> By Constituency</a>
                    </li>
                    <li class=""><a href="#by-country" data-toggle="tab"><i class="fa fa-globe"></i> By Country</a>
                    </li>
                    <li class=""><a href="#other-data" data-toggle="tab"><i class="fa fa-question"></i> Other Data</a>
                    </li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="by-constituency">
                        <h4>By Constituency</h4>
                        <table class="table table-striped" id="constituency-table">
                            <thead>
                            <th>Name</th>
                            <th>MP</th>
                            <th>Signatures</th>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="by-country">
                        <h4>By Country</h4>
                        <table class="table table-striped" id="country-table">
                            <thead>
                            <th>Name</th>
                            <th>Signatures</th>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="other-data">
                        <h4>Other Data</h4>
                        <p>Creator: {{ $attributes['creator_name'] }}</p>
                        <p>Last Updated: {{ date("h:i:s a, l jS F Y",strtotime(date($attributes['updated_at']))) }}</p>
                        <p><a href="http://petitionmap.unboxedconsulting.com/?petition={{ $id }}" target="_blank">View Map</a></p>
                        {{--Include information such as average number of signautres per hour since the petition started (accounting for closed time if set)--}}
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection