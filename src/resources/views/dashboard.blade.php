<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <!-- Ajax -->
        <script integrity="sha256-SdcGm4w67Jc4NSk7RGSrswTBmv4TXTbyzK6LM9j+lO0=" src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" crossorigin="anonymous" defer></script>

        <style>
            .card:hover{
                filter:drop-shadow(2px 5px 4px rgba(0.4, 69, 134, 0.4));
            }

            .search-data{
                border-top: 0px;
                border-left: 0px;
                border-right: 0px;
            }

            body {
                height: 100%;
                background-image: linear-gradient({{ $backgroundColor }}, #FFFFFF);
            }
            /* #container {
                min-width: 310px;
                max-width: 800px;
                height: 400px;
                margin: 0 auto;
            } */

            .highcharts-credits {
                display: none;
            }
        </style>
    </head>
    <body class="container mt-4">
        @if($navbar == 'on')
            <nav class="col-md-4 navbar bg-transparent">
                <form class="container-fluid">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Search</span>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </form>
            </nav>
        @endif
        {{-- Title card --}}
        <div class="row">
            @for($i = 0; $i < count($modelCounts); $i++)
                <div class="col-md-4 mb-2 mt-2">
                    <div class="card" style="background-color:{{ $cardBackgroundColor }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $modelNames[$i] }}</h5>
                            <hr>
                            <p class="card-text">Total entries: {{ $getTotalCount[$i] }}</p>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        <div class="row">
            <div class="col-md-4 mb-2 mt-2">
                <div class="card" style="background-color:{{ $cardBackgroundColor }}">
                    <div class="card-body">
                    <div id="container" style="background-color:{{ $cardBackgroundColor }}"></div>

                    </div>
                </div>
            </div>
            <div class="card col-md-8 ml-2" style="background-color:{{ $cardBackgroundColor }}">
                <div class="row">
                    
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="row">
            @for($i = 0; $i < count($models); $i++)
                <div class="col-md-6 mb-2 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="mb-3 col-sm-6 float-start">
                                <h2>
                                    {{ $modelNames[$i] }}
                                </h2>
                            </div>
                            @if($tableSearch == 'on')
                                <div class="form-floating mb-3 col-sm-6 float-end">
                                    <input type="hidden" value="{{ implode(' ',$columns[$i]) }}" readonly class="columns">
                                    <input type="text" class="form-control search-data" data-model="{{ $modelPaths[$i] }}" data-model-name="{{ $modelNames[$i] }}" placeholder="Search...">
                                    <label for="search-data">Search Data</label>
                                </div>
                            @endif
                        </div>
                        <div class="card-body" style="background-color:{{ $tableBackgroundColor }};">
                            <table class="table @foreach($tableStyles as $tableStyle){{ $tableStyle }} @endforeach" style="color:{{ $tableTextColor }}">
                                <thead>
                                    <tr>
                                        @foreach($columns[$i] as $column)
                                            <th>{{ ucfirst($column) }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="tbody-{{ $modelNames[$i] }}">
                                    @foreach($modelDatas[$i] as $modelData)
                                    <tr> 
                                        @foreach($columns[$i] as $column)
                                            <td>{{ $modelData->$column }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            @endfor
        </div>

    </body>
</html>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    const url = window.location.origin;

    var modelName = <?php echo json_encode($chartData);?>;

    $(document).on('keyup', '.search-data', function() {
        var dataString = {}
        dataString['data'] = $(this).val();
        dataString['table'] = $(this).data('model');
        dataString['model_name'] = $(this).data('model-name');
        dataString['columns'] = $(this).parent().find('.columns').val();
        $.ajax({
        url: url + '/search-data',
        dataType: "json",
        method: "POST",
        data: dataString
        }).done(function(success) {
            var tr = '';
            var td;

            $.each(success.getData, function(k, value) {
               tr += '<tr>';
                $.each(value, function(i, column) {
                   tr += '<td>'+column+'</td>';
                });
                tr += '</tr>'
            });
            $('.tbody-'+success.modelName).html(tr)
        });
                
    });


    Highcharts.chart('container', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Report'
        },

        // apply custom CSS to data table
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    style: {
                    fontWeight: 'normal',
                    color: '#666666'
                    }
                }
            }
        },      
        series: [{
            name: 'Data',
            data: modelName
        }],
    });

    
</script>
