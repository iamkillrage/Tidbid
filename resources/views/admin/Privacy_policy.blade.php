@include('admin.layout.header')
<style>
    .cke_notifications_area {
        dislpay: none !important;
    }
</style>
    <!-- CONTENT -->
    <section id="content-new">

        <!-- MAIN -->
        <main>


            <div class="terms-wrap">
                <form >
                    <!-- HEADING -->
                    <!-- <h1>Terms and Condition Heading</h1>
						<input type="text" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit" class="term-input" readonly> -->
                    <!-- PARA -->

                    <div class="all-selected-aboutus">
                        <div class="headingsec-wrap">
                            <h4>Privacy Policy</h4>
                            <a href="#" class="about-save-btn" class="show-modal" data-toggle="modal" data-target="#terms-popup"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                        </div>
                        
                        {!! $PrivacyPolicy->discription !!}
                    </div>
                    <!-- <div class="abouts-us-btnwrap">
							<a href="#" type="submit" class="about-edit-btn"> Edit</a>
							<a href="#" type="submit" class="about-save-btn"> Save</a>
						</div> -->
                </form>
            </div>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->



    <!-- Delete popup -- -->

    <div class="modal fade" id="terms-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-dialog-edit" role="document">
            <div class="modal-content clearfix">
                <div class="modal-heading">
                    <button type="button" class="close close-btn-front" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="addpayment-card-form">
                        <form id="privacy-form" action="{{ url('admin/privacy-policy-add') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{!! $PrivacyPolicy->id ? $PrivacyPolicy->id:'' !!}">
                            <h2 class="">Privacy Policy</h2>
                            <div class="payment-card-wrap">
                                <textarea name="description">{!! $PrivacyPolicy->discription !!}</textarea>
                                <div class="privacy-terms-wrap">
                                    <button type="submit">Save</button>
                                    <!-- <button type="submit">Cancel</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete popup -- -->

    <!-- Logout popup -- -->

    @include('admin.layout.footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        $(document).on('keyup', "#input-box", function() {
            if ($(this).val() != '')
                $(".result-box").show();
            else
                $(".result-box").hide();
        })
    </script>
    <script>
    CKEDITOR.editorConfig = function(config) {
            config.versionCheck = false; // Disable version warning
        };
    </script>
    <script>
        CKEDITOR.replace('description', {
            height: "70px",
        });
    </script>

  