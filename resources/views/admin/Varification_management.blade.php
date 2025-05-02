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
                                <form method="GET" action="" class="verifivation">
                                    <input type="text" id="input-box" name="searchQuery" value="{{ request()->searchQuery }}" placeholder="Search by Name" autocomplete="off">
                                    <button type="submit"><img src="{{asset('admins/images/Tidbid-images/all-icons/search.png')}}" alt=""></button>
                                </form>
                            </div>
                        </div>


                    </div>
                    <form method="GET" action="" class="verifivations">
                        <div class="broker-date" @if(isset(request()->datefilter)) style="width: 240px;" @endif>

                            <input type="text" name="datefilter" value="{{ request()->datefilter}}" placeholder="Date Range" readonly>

                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="influ-table">
            <div id="table-responsive-1" class="table-responsive">
                <table>
                    <tr>
                        <th>S.No.</th>
                        <th>Influencer Name </th>
                        <th>Verification Date</th>
                        <th>Verification Platform</th>
                        <th>View Verification</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        @foreach($getVerification as $index => $row)
                        <tr>
                            <td>{{ $getVerification->firstItem() + $index}}.</td>
                            <td>{{ $row->getInfluencer->userName ? $row->getInfluencer->userName :''}}</td>
                            <td>{{date("m/d/Y", strtotime($row->verificationDate)) }}</td>

                           
                            <td>
                                @if($row->verificationPlatform == 'youtube')
                                <img src="{{asset('Influencer/images/youtube-icon.svg')}}">
                                @elseif($row->verificationPlatform == 'instagram')
                                <img src="{{asset('Influencer/images/instagram.svg')}}">
                                @elseif($row->verificationPlatform == 'tik-tok')
                                <img src="{{asset('Influencer/images/tik-tok-1.png')}}">
                                @elseif($row->verificationPlatform == 'snapchat')
                                <img src={{asset('Influencer/images/Snapchat1.png')}}>
                                @else
                                <img src="{{asset('Influencer/images/x-twitter.svg')}}">
                                @endif
                              
                            </td>
                         
                          

                            @if ($row->id == 3 || $row->id == 5 || $row->id == 7 || $row->id == 8 || $row->id == 10 || $row->id == 12 || $row->id == 14 || $row->id == 16 || $row->id == 18)
                            <td><a href="https://snap.com/en-US" target="_blank">View</a></td>
                            @else
                            <td><a href="https://www.instagram.com" target="_blank">View</a></td>
                            @endif


                            <td class="my-tog">


                                Decline
                                <label class="switch show-modal" data-toggle="modal" data-target="#accept-popup">
                                    <input type="checkbox" <?php if ($row->status == 'Activate') echo "checked"; ?> data-status="{{$row->status}}" data-id="{{ $row->id }}" class="changeStatus"> <span class="slider round"></span>
                                </label>
                                Accept

                            </td>




                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-felx justify-content-center">
                {{ $getVerification->onEachSide(1)->withQueryString()->links('admin.layout.pegination') }}
            </div>

        </div>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<!-- Suspend popup -- -->

<div class="modal fade" id="suspend-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-edit" role="document">
        <div class="modal-content clearfix">
            <div class="modal-heading">
                <button type="button" class="close close-btn-front"  onclick="refreshPage()">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="addpayment-card-form">
                    <form>
                        <div class="payment-card-wrap">
                            <img src="{{asset('admins/images/Tidbid-images/all-icons/verification-manage-imgs/cross.png')}}" alt="">
                            <h4 class="suspendedText">Decline </h4>
                            <p>Please confirm you want to
                                decline this member’s request?</p>
                            <div class="bottom-action-wrap">
                                <button type="button" onclick="onCheck()">Confirm</button>
                                <button type="submit">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Suspend popup -- -->

<!-- Active popup -- -->

<div class="modal fade suspendedUser" id="accept-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-edit" role="document">
        <div class="modal-content clearfix">
            <div class="modal-heading">
                <button type="button" class="close close-btn-front reloadPage">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="addpayment-card-form">
                    <form>
                        <input type="hidden" value="" class="verificationId">
                        <div class="payment-card-wrap">
                            <span class="actionimg"> <img src="{{asset('admins/images/accept-green.png')}}" alt=""></span>
                            <h4 class="suspendedText">Accept</h4>
                            <p class="messageMsg">Please confirm you want<br /> to
                                decline this member’s request?</p>
                            <div class="bottom-action-wrap">
                                <button type="button" onclick="changeStatuss()">Confirm</button>
                                <button type="submit">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Active popup -- -->


<!-- show verification chart popup -- -->

<div class="modal fade" id="chart-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-edit" role="document">
        <div class="modal-content clearfix">
            <div class="modal-heading">
                <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="addpayment-card-form">
                    <form>
                        <div class="payment-card-wrap">
                            <img src="{{asset('admins/images/Tidbid-images/all-icons/verification-manage-imgs/chart.png')}}" alt="">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- show verification chart popup -- -->

@include('admin.layout.footer')

<script>
    $(document).on('click', '.applyBtn', function() {
        $('.verifivations').submit();

    })
    $(document).on('click', '.cancelBtn', function() {
        $('.verifivations').submit();

    })



    $(document).ready(function() {
        $(document).on('change', '.changeStatus', function() {
            var status = $(this).attr('data-status');
            var ids = $(this).attr('data-id');
            var baseUrl = "{{url('/')}}";
            $('.verificationId').val(ids)
            if (status == 'Inactive') {
                $('.actionimg').html('<img src="' + baseUrl + '/public/admins/images/accept-green.png" alt="">');
                $('.suspendedText').text('Activate');
                $('.messageMsg').html('Please confirm you want to active this Verification request??')

            } else {
                $('.actionimg').html('<img src="' + baseUrl + '/public/admins/images/Tidbid-images/all-icons/user-mangement-imgs/suspend.png" alt="">')
                $('.suspendedText').text('Suspend');
                $('.messageMsg').html('Please confirm you want to to decline this Verification request??')
            }


        });
    });





  

    function changeStatuss() {
        var influencerId = $('.verificationId').val();

        if (influencerId) {
            $.ajax({
                type: 'post',
                url: "{{url('admin/changeInfluencerStatus')}}",
                data: {
                    id: influencerId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // beforeSend: function() {
                //     $('.suspendedText').text('....Please wait');
                // },
                success: function(response) {
                    if (response.status == 1) {

                        $('.deleteText').text(response.message);
                        toastr.success(response.message);
                        setInterval(function() {
                            location.reload(true);
                        }, 1000);
                    } else {
                        $('.deleteText').text(response.message);;
                    }
                }
            });
        } else {
            toastr.error("influencer id not found..");
        }
    }

    $(document).on('click','.reloadPage', function(){
        location.reload(true);
    })

    // function refreshPage() {
    //     alert('Refresh');
    //     window.location.reload();
    // }
</script>
