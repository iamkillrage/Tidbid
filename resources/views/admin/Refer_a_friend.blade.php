@include('admin.layout.header')

<!-- CONTENT -->
<section id="content-new">

    <!-- MAIN -->
    <main>
        <div class="influ-strip-2">
            <div class="influ-btns">
                <div class="main-wrap-form">
                    <div class="influ-search">
                      
                            <div class="search-box">
                                <div class="row">
                                <form method="GET" action="">
                                    <input type="text" id="input-box" name="searchQuery" value="{{ request()->searchQuery }}" placeholder="Search by Name" autocomplete="off">
                                    <button type="submit"><img src="{{asset('admins/images/Tidbid-images/all-icons/search.png')}}" alt=""></button>
                                    </form>
                                </div>
                            </div>
                       


                    </div>
                    <form method="GET" action="" class="userForm">
                        <div class="broker-date">
                            <input type="text" name="datefilter" value="" placeholder="Date Range" readonly>
                        </div>
                        <!-- <div class="quotes">
                          <!  <div class="dropdown-btn"><img src="images/Tidbid-images/all-icons/following-icon.png" alt="" class="src">&nbsp;Followings <i class="far fa-chevron-down"></i></div>
                            <div class="dropdown">
                                <div class="quotes-list">
                                    <div id="search-value-1" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value="">
                                            0-50</label>
                                    </div>
                                    <div id="search-value-2" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value="">
                                            50-100</label>
                                    </div>
                                    <div id="search-value-2" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value="">
                                            100-150</label>
                                    </div>
                                    <div id="search-value-3" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value="">
                                            150-200</label>
                                    </div>
                                    <div id="search-value-4" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value="">
                                            200-500</label>
                                    </div>
                                    <div id="search-value-5" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value="">
                                            >1000</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="quotes">
                            <div class="dropdown-btn"><img src="images/Tidbid-images/all-icons/successfull-drop-icon.png" alt="" class="src">&nbsp;Successful Bids <i class="far fa-chevron-down"></i></div>
                            <div class="dropdown">
                                <div class="quotes-list">
                                    <div id="search-value-1" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value=""> 0-5</label>
                                    </div>
                                    <div id="search-value-2" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value="">
                                            5-10</label>
                                    </div>
                                    <div id="search-value-2" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value="">
                                            10-15</label>
                                    </div>
                                    <div id="search-value-3" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value="">
                                            150-200</label>
                                    </div>
                                    <div id="search-value-4" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value="">
                                            15-20</label>
                                    </div>
                                    <div id="search-value-5" class="search-value">
                                        <label class="influ-btns-label"><input type="checkbox" value=""> >
                                            50</label>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="influ-table">
            <div id="table-responsive-1" class="table-responsive">
                <table>

                    <tr>
                        <th>S.No.</th>
                        <th>Name </th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date of Refer</th>
                        <th>Time of Refer</th>
                        <th>Refer to</th>
                        <th>Earned Reward</th>
                    </tr>

                    <tbody>
                        @foreach($getRefer as $index => $row)
                        <tr>
                            <td>{{ $getRefer->firstItem() + $index}}.</td>
                            <td>{{ $row->referredByUser->name ? $row->referredByUser->name :''}}</td>
                            <td>{{ $row->referredByUser->email ? $row->referredByUser->email :''}}</td>
                            <td>{{ $row->referredByUser->phone ? $row->referredByUser->phone :''}}</td>
                            <!-- <td>{{ $row->referDate }}</td> -->
                            <td>{{date("m/d/Y", strtotime($row->created_at)) }}</td>
                            <td>{{date("H:i:s", strtotime($row->created_at)) }}</td>
                            <td>{{ $row->referredByUser->userName }}</td>
                            <td>$10</td>
                        </tr>
                        @endforeach
                    </tbody>

                  
                </table>
            </div>
         
            <div class="d-felx justify-content-center">
                    {{ $getRefer->onEachSide(1)->withQueryString()->links('admin.layout.pegination') }}

                </div>

        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->
@include('admin.layout.footer')
<script>
      $(document).on('click', '.applyBtn', function() {
        setTimeout(function() {
            $('.userForm').submit();
        }, 1000);
    })

</script>