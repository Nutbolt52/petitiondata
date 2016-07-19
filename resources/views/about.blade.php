@extends('app')

@section('metadata')
    <link rel="canonical" href="https://petitiondata.uk/about">

    <meta name="description" content="View a summary of information on the signatures from petitions on the UK Government Petition website" />
    <meta name="keywords" content="petition, data, petitions, uk government, open data, signature, signatures, information" />
@endsection

@section('content')
    <div class="container spark-screen">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Useful Tips</div>

                    <div class="panel-body">
                        <p>
                        <h4>Using the Site</h4>
                        <ul>
                            <li>You can obtain the petition ID by looking at the website address on the UK Gov. Petition website. It will be the last part made of up 6 numbers</li>
                            <li>You can enter this ID on the home page of UK Petition Data or simply at the end of the website address</li>
                            <li>The home page displays the most recent searches and how many times its been viewed on this website since being in the most recent list</li>
                            <li>The data is cached/stored for approximately 5 minutes</li>
                        </ul>

                        <h4>Navigating the Data</h4>
                        <ul>
                            <li>There are three tabs: By Constituency, By Country, and Other Data</li>
                            <li>You can alter the display of the table how you like, from displaying more entries, to sorting it by number of signatures</li>
                            <li>You can search using the Search box on each tab. This will search the entire dataset, allowing you to quickly find your own Constituency or Country</li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">About</div>

                    <div class="panel-body">
                        <p>The UK Petition Data website was written for two reasons. Firstly, I wished to explore the data made available under the Open Government License so I could easily see
                        how many people in areas around me were signing certain petitions; and secondly, I wished to expand my knowledge of using caching within the Laravel framework</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">License and Source Code</div>

                    <div class="panel-body">
                        <p>The UK Petiton Data website is open-sourced software licensed under the <a href="https://opensource.org/licenses/MIT" target="_blank">MIT license</a></p>
                        <p>The website is written in PHP, using the Laravel framework and makes use of Redis to cache the data. You can browse the source code of the website at the
                            <a href="https://github.com/Nutbolt52/petitiondata" target="_blank">GitHub repository</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection