@extends('app')

@section('metadata')
    <link rel="canonical" href="https://petitiondata.uk/">

    <meta name="description" content="View a summary of information on the signatures from petitions on the UK Government Petition website" />
    <meta name="keywords" content="petition, data, petitions, uk government, open data, signature, signatures, information" />
@endsection

@section('content')
    <div class="container spark-screen">

        @if (session('error'))
            <div class="alert alert-dismissible alert-warning col-md-10 col-md-offset-1">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <h4>Woops!</h4>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">UK Petition Data Browser</div>

                    <div class="panel-body">
                        <p>Enter the ID of a petition on the <a href="https://petition.parliament.uk/" target="_blank">UK Government Petition website</a> and view a summary of
                            information on the
                            signatures provides</p>
                        <p>This displays a summary of information publicly available and covered under the Open Government Licence, and is a summary per ONS area. No information is
                            available on specific people/signatures</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="vue-form">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Petition ID</div>

                    <div class="panel-body">
                        <p>Please provide the ID of the petition. This is the number as part of the web address, usually 6 digits</p>

                        <form v-else transition="fade" class="form-horizontal" role="form" method="POST"
                              action="{{ url('/petition') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('petition_id') ? ' has-error' : '' }}">

                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="petition_id" value="{{ old('petition_id') }}">

                                    @if ($errors->has('petition_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('petition_id') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        View Data
                                    </button>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        @if (count($searches) > 0)
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">Most Recent Searches</div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                <th>Petition Title</th>
                                <th>View Count</th>
                                </thead>
                                <tbody>
                                @foreach ($searches as $search)
                                    <tr>
                                        <td class="table-text">
                                            <div><a href="{{ action('PetitionData@GetAndDisplayData', [$search['petitionID']]) }}">{{ $search['title'] }}</a></div>
                                        </td>
                                        <td class="table-text">
                                            <div>{{ $search['count'] }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection