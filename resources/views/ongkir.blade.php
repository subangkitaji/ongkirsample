<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Ongkir</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">LARAVEL CEK ONGKIR RAJA ONGKIR </h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#">Laravel</a>
            <a class="p-2 text-dark" href="#">Codeigniter</a>
            <a class="p-2 text-dark" href="#">Jquery</a>
            <a class="p-2 text-dark" href="#">Vue Js</a>
        </nav>
        <a class="btn btn-outline-primary" target="_blank" href="#">Ongkir Cek</a>
    </div>

    <div class="container">
        <div class="card">
            <form action="{{ url('/') }}" method="get">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <h6>nama anda</h6>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>kirim dari</h6>
                                <select name="province_from" id="" class="form-control">
                                    <option value="pilih">pilih provinsi</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->id}}" holder="pilih provinsi">{{$province->province}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="origin" id="" class="form-control">
                                    <option value="" holder="pilih kota"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>kirim ke</h6>
                                <select name="province_destination" id="" class="form-control">
                                    <option value="pilih">pilih provinsi</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->id}}" holder="pilih provinsi">{{$province->province}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="destination" id="" class="form-control">
                                    <option value="" holder="pilih kota"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>berat paket</h6>
                                <input type="text" id="" class="form-control" name="weight">
                                <small>dalam gram cth:1700/1.7kg</small>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>pilih kurir</h6>
                                <select name="courier" id="" class="form-control">
                                    <option value="pilih kurir.."></option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-block">hitung ongkir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($ongkir)
                    <div class="row">
                        <div class="col">                           
                            <table class="table table-striped table-bordered table-hovered" width="100%">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Estimasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach($ongkir as $result)
                                   <tr>
                                    <td>{{$result['service']}}</td>
                                    <td>{{$result['description']}}</td>
                                    <td>{{$result['cost'][0]['value']}}</td>
                                    <td>{{$result['cost'][0]['etd']}}</td>
                                   </tr>
                                   @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    @else
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="province_from"]').on('change', function () {
                var cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: 'getCity/ajax/' + cityId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="origin"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="origin"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="origin"]').empty();
                }
            });
            $('select[name="province_destination"]').on('change', function () {
                var cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: 'getCity/ajax/' + cityId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="destination"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="destination"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="destination"]').empty();
                }
            });
        });

    </script>
</body>

</html>
