<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RAC-19</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            .border-P{
                padding: 1rem;
                border-radius: 0.5rem;
                margin-bottom: 0;
            }
            .border-C{
                width: 32%;
                height: 30%;
                border: solid;
                background-color: rgb(299,299,299 1.00);
                margin-left: 55%;
                margin-top: -17.5%;
            }
            .btn-position-3{
                margin-left: 69%;
                margin-top: -3%; 
            }
            .btn-position-2{
                margin-left: 39%;
                margin-top: -6%;
            }
            .btn-position-1{
                margin-left: 16%;
                margin-top: -25%;
            }
            .color-T{
              background-color: rgb(249, 252, 132, 1.00);
            }
            .color-Y{
              background-color: rgb(255, 181, 71, 1.00); 
            }
            .color-U{
              background-color: rgb(112, 255, 88, 1.00); 
            }
            .color-I{
              background-color: rgb(255, 59, 59, 1.00); 
            }
            .posisi-T{
              margin-top: -0.2%;
              margin-left: 1%;
              width: 600px;
            }
            .grafik{
                width: 430px;
                margin-left: 55%;
            }
            .size-btn{
              height: 120px;
              width: 80px;
              border: none;
              background: none;
            }
            .btn-postion-img-1{
              margin-top: 2%;
              margin-left: 15%;
            }
            .btn-postion-img-2{
              margin-top: -12%;
              margin-left: 40%;

            }.btn-postion-img-3{
              margin-top: -15.5%;
              margin-left: 70%;
            }
            .size-pic{
              width: 200px;
              height: 200px;
            }
            .pasien-div{
              position: relative;
              width: 50%;
              top: 4%;
              transition: opacity 1s ease-in-out;
            }
            .pasien-div img{
              position: absolute;
              left: 0;
              width: 30%;
              margin-top: 6%;
              transition: opacity 1s ease-in-out;
            }
            .pasien-div .pasien:hover{
              opacity: 0;
            }
            .maps-div{
              position: relative;
              width: 50%;
              top: -10%;
              transition: opacity 1s ease-in-out;
            }
            .maps-div img{
              position: absolute;
              left: 85%;
              width: 30%;
              margin-top: 2.5%;
              transition: opacity 1s ease-in-out;
            }
            .maps-div .maps:hover{
              opacity: 0;
            }
            .hospital-div{
              position: relative;
              width: 50%;
              top: -13%;
              transition: opacity 1s ease-in-out;
            }
            .hospital-div img{
              position: absolute;
              left: 167%;
              width: 30%;
              height: 800%;
              margin-top: 3%;
              transition: opacity 1s ease-in-out;
            }
            .hospital-div .hospital:hover{
              opacity: 0;
            }
        </style>
    </head>
    <body>
        @extends('layouts.app')

        @section('content')
        <div class="kontent">
            <center>
                <label><h1>Informasi Covid Di Indonesia</h1></label><br>
                <label><h6>Update tanggal 23-05-2020</h6></label>
            </center>
            @if(!empty(Auth::user()->name))
                @if(Auth::user()->name == 'Ramdan Rohendi')
                    <center>
                        <button class="btn-success">Edit Data</button>
                    </center>
                @endif
            @endif
            <table class="border posisi-T">
                <tr class="color-T">
                    <td><h4 class="border-P">Terkonfirmasi</h4></label></td>
                    <td>20.796</td>
                </tr>
                <tr class="color-Y">
                    <td><h4 class="border-P">Dalam Pengawasan</h4></td>
                    <td>11.028  </td>
                </tr>
                <tr class="color-U">
                    <td><h4 class="border-P">Sembuh</h4></td>
                    <td>5.057</td>
                </tr>
                <tr class="color-I">
                    <td><h4 class="border-P">Meninggal</h4></td>
                    <td>1.326</td>
                </tr>
            </table>
            
            <form class="border-C">&nbsp;
                Grafik Data Covid-19
            </form>

            <div class="grafik">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        

        <div class="pasien-div">
            <a class="size-btn btn-postion-img-1" href="{{ url('/pasien') }}">
                <img src="{{ url('assets/img/pasien-primary.png') }}" class="pasien-primary size-pic">
                <img src="{{ url('assets/img/pasien.png') }}" class="pasien size-pic">
            </a>
        </div>

        <div class="maps-div">
            <a class="size-btn btn-pos tion-img-2" href="{{ url('/daerah') }}">
                <img src="{{ url('assets/img/maps-primary.png') }}" class="maps-primary size-pic" >
                <img src="{{ url('assets/img/maps.png') }}" class="maps size-pic" >
            </a>
        </div>

        <div class="hospital-div">
            <a class="size-btn btn-postion-img-3" href="{{ url('/rs') }}">
                <img src="{{ url('assets/img/hospital-primary.png') }}" class="size-pic hospital-primary">
                <img src="{{ url('assets/img/hospital.png') }}" class="size-pic hospital">
            </a>
        </div>

        <script>
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Positif", "PDP", "Sembuh", "Meninggal"],
                    datasets: [{
                        label: 'Data Covid-19',
                        data: [20.796, 11.028, 5.057, 1.326],
                        backgroundColor: [
                        'rgb(249, 252, 132, 0.5)',
                        'rgb(255, 181, 71, 0.5)',
                        'rgb(112, 255, 88, 0.5)',
                        'rgb(255, 59, 59, 0.5)'
                        ],
                        borderColor: [
                        'rgb(249, 252, 132, 1.5)',
                        'rgb(255, 181, 71, 1.5)',
                        'rgb(112, 255, 88, 1.5)',
                        'rgb(255, 59, 59, 1.5)',
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        </script>
        @endsection

    </body>
</html>
