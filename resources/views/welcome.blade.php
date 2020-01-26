@extends("layouts.master")

@section("css_section")
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
@endsection

@section("content_section")

<br /><br />
<h3>Your current position:</h3>
<div>Hello {{ auth()->user()->username }},</div>
<div>your ip is {{ $userip }}, <br />
    You're logged in from {{ $locationDetails->region_name . ", " . $locationDetails->city_name }}<br />
    Your coordinates ( lat = {{ $locationDetails->latitude }}, long = {{ $locationDetails->longitude }} )<br />
</div>

<br /><br />



<h3>Nearby Shops:</h3>
<div class="table-responsive">
<table id="nearby-shops-list" class="table table-striped jambo_table bulk_action">
    <thead><tr class="headings">
@foreach($columns as $col)
<th>{{ $col }}</th>
@endforeach
<th></th>
    </tr></thead>

    <tbody>
        @foreach($allShops as $shop)
        <tr>
            <td>{{ $shop->name }}</td>
            <td>{{ $shop->city_name }}</td>
            <td>{{ $shop->region_name }}</td>
            <td>{{ $shop->country_name }}</td>
            <td>{{ $shop->latitude }}</td>
            <td>{{ $shop->longitude }}</td>
            <td>
                <span class="locate-shop glyphicon glyphicon-map-marker" href="#/location-arrow" data="{{ $shop->address }}" style="cursor: pointer;">
                </span>
            </td>
            <td>
                <span style="cursor: pointer;" class="like-shop" data-shop-id="{{ $shop->id }}">
                    <i class="fa fa-heart" style="color: red;"></i>
                </span>
                <span style="cursor: pointer;" class="dislike-shop" data-shop-id="{{ $shop->id }}">
                    <i class="fa fa-ban"></i>
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>




<!-- ============= Modals ============= -->
<div class="modal fade bs-example-modal-lg" role="dialog" aria-modal="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Shop Address</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="modal-body-content"></div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>

@endsection

@section("js_section")
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        $("#nearby-shops-list").DataTable({"bSort" : false});
        $(".locate-shop").click(function(){
            var address = $(this).attr("data");
            $(".modal .modal-body-content").html(address);
            $(".modal").modal();
        });
        $(".like-shop").click(function(evt){
            var shopID = $(this).attr("data-shop-id");
            //var csrf_token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route("shops.like-shop") }}',
                type: 'post',
                data: { shopID: shopID, "_token": "{{ csrf_token() }}", }
            }).done(function(data){
                alert(data);
                window.location.href = window.location.href;
            })
        });
        
        $(".dislike-shop").click(function(evt){
            var shopID = $(this).attr("data-shop-id");
            //var csrf_token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route("shops.dislike-shop") }}',
                type: 'post',
                data: { shopID: shopID, "_token": "{{ csrf_token() }}", }
            }).done(function(data){
                alert(data);
                window.location.href = window.location.href;
            })
        });
    });
    
</script>
@endsection