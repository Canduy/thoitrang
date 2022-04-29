@extends('admin_layout')
@section('admin_content')
        <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
      
    </div>
    <div class="table-responsive">
      <?php
                        $mess = Session::get('mess');
                        if($mess){
                            echo $mess;
                            Session::put('mess',null);
                        }
                    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
        
            <td>STT</td>
            <th>Tên người đặt</th>
            <th>Mã đơn hàng</th>
            <th>Ngày tháng đặt hàng</th>
            <th>Tình trạng</th>
            <th></th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
          @endphp
          @foreach($all_order as $key => $order)
            @php
              $i++;
            @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{$order->Customer->customer_name}}</td>
            <td>{{$order->order_code}}</td>
            <td>{{$order->created_at}}</td>
            <td>
              @if($order->order_status==1)
                    Đơn hàng mới
                @else 
                    Đã xử lý
                @endif
            <td>
              <a href="{{URL::to('/view-order/'.$order->order_code)}}" class="active" ui-toggle-class=""><i class="fa fa-eye text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')" href="{{URL::to('/delete-order/'.$order->order_code)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
       <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{-- {{ $all_order->links() }} --}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

@endsection