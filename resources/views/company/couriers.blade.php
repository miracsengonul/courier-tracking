<html>
<head>
    @include('company.head')
</head>
<body>
@include('company.navbar')
<div class="container" style="text-align: center">
    <img src="{{asset('images/icon/delivery-courier.png')}}" width="64" alt="">
    <h3>Kuryeleriniz</h3>
    <hr>
    @if (\Session::has('error'))
        <div class="alert alert-danger" style="font-weight: bold">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
        <hr>
    @endif
    <div class="btn btn-lg btn-default" data-toggle="modal" data-target="#myModal" style="margin-bottom: 25px">+ Kurye Ekle</div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <form action="{{route('company-courier-add')}}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Kurye Ekle</h4>
                    </div>
                    <div class="modal-body">
                        <input autocomplete="off" type="text" class="form-control" name="courier_name" placeholder="Kurye Adı" style="height: 45px;margin-bottom: 15px;color:black">
                        <input autofocus autocomplete="off" type="text" class="form-control phone" name="courier_phone" placeholder="Kurye Telefon" style="height: 45px;margin-bottom: 15px;color:black">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
                        <input type="submit" class="btn btn-primary" value="Ekle">
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="row">
        @foreach($couriers as $courier)
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">{{$courier->name ?? 'İsimsiz'}}</div>
                    <div class="panel-body phone-place" style="text-align: center">{{$courier->telephone}}</div>
                    <div class="panel-footer">
                        <a href="{{route('company-courier-delete', ['id' => $courier->id])}}">
                            <div class="btn btn-danger" style="width: 100%;">Sil</div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.phone').mask('(000) 000 00 00');
        $('.phone-place').mask('(000) 000 00 00');
    });
</script>
</body>
</html>
