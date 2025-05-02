@extends('User.LayoutWebsite.masterwebsite')
@section('content')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <title>My Transactions | TidBid</title>

</head>

<body>

    <!-- Header-Section -->
    <header>
        @include('User.Navbar.nav')
    </header>
    <!-- Header-Section -->

    <!-- Main-Section -->
    <main>

        <div class="prof_lefsect">
            <div class="container">
                <div class="row">
                    @include('Sidebar.sidebar')

                  
          <div class="col-lg-9 col-md-12">
            <div class="pro_right p-0">

              <div class="broker-wrap transactions-wrap">

                <div class="trans_h">
                  <h3>My Transactions</h3>

                </div>



                <div class="broker-filters pr-0">
                <form method="get" class="filterData">
                  <div class="broker-date whit-range">
                    
                    <input type="text" name="datefilter" class="datefilter" placeholder="Date Range" value="{{  request()->datefilter}}" readonly>
                  

                  </div>
                  </form>
                 
                
                  <div class="broker-download download_1 pr-0">
                    <a href="{{url('export-user-transection')}}" class="download-transection" download="download"><img src="{{asset('Influencer/images/download_1.png')}}" alt="">Download</a>
                  </div>
                </div>
                <div class="transactions-table table-responsive">
                  <table class="table">
                    <tr>
                      <th>S. No.</th>
                      <th>User Name</th>
                      <th> Date & Time </th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Amount</th>
                    </tr>
                    
                    @forelse($transection as $index=>$row)
                    <tr>
                    <td>{{ $transection->firstItem() + $index}}.</td>
                      <td>{{ $row->getUser->name }}</td>
                      <td>{{ date("D,M d, Y H:i:s", strtotime($row->date_time)) }}</td>
                      <td>
                        <div class="description-in">
                          <div class="description-in-image">
                            <img src="{{asset('Influencer/images/noimage.jpg')}}" alt="">
                          </div>
                          <div class="description-in-text">
                            @if($row->getStream)
                            <!-- Agar transaction stream se related hai, to what_to_expect dikhayein -->
                            <p><b>{{ $row->getStream->what_to_expect }}</b></p>
                            <p>Stream Transaction</p>
                            @else
                            <!-- Otherwise default message -->
                            <p><b>No Data</b></p>

                            @endif
                          </div>
                        </div>
                      </td>
                      <td>Online</td>
                      <td><b class="pink-color">+${{$row->amount}}</b></td>
                    </tr>
                    @empty
                     <tr>
                      <td colspan="5">No data found</td>
                     </tr>
                    @endforelse
                  </table>
                </div>
              </div>

              {{ $transection->onEachSide(1)->withQueryString()->links('Influencer.layout.pagination') }}


            </div>
          </div>

                </div>
            </div>
        </div>

    </main>

</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
     $('.download-transection').click(function(){
        $('.export-transection').submit();
     })
     $(document).on('click', '.applyBtn', function(){
       $('.filterData').submit();
     })

     $(document).on('click', '.cancelBtn', function(){
      window.location.href = "user-my-transactions";
     })
	
</script>
@endsection