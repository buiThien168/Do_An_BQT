@extends("Admin.Layouts.Master")
@section('Title', 'Send mail')
@section('Content')
<style type="text/css">
  .chosen-container-multi .chosen-choices li.search-field input[type="text"]{
    height: 27px !important;
  }
</style>
<div class="container-scroller">
  <x-admin.layouts.header-dashboard/>
  <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
    </div>
    <div class="side-bar-box" style="width: 250px;">
      <x-admin.layouts.side-bar/>
    </div>
    <div class="main-panel">
     <div class="content-wrapper px-0 py-3">
        <div class="row m-0">
          <div class="col-md-12 grid-margin p-0">
            <div class="row m-0">
              <div class="col-12 col-xl-12 mb-4 mb-xl-0 p-0">
                <div>
                  <div class="bg-white p-4">
                    <h4 class="mb-4">Gửi thư</h4>
                    <form method="post" action="{{url('admin/email-marketing/send-mail/add')}}">
                      @csrf
                      <div class="row m-0">
                        <div class="col-12 p-0 mb-4 fz95">
                          <label>Chọn mẫu Email để gửi</label>
                          <select name="admin_template_id" class="chosen" data-order="true"  id="multiselect" style="height: 50px;width: 100%;">
                            @foreach ($template as $item )
                            <option value="{{$item->id}}">{{$item->template_title}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-8 p-0 mb-4 fz95">
                           <label>Chọn người dùng</label>
                          <select name="list_users[]" class="chosen" data-order="true"  id="multiselect" multiple="true" style="height: 50px;width: 100%;">
                            @foreach ($listUser as $item )
                            <option value="{{$item->user_id}}">[ID: {{$item->user_id}}] {{$item->full_name}} - {{$item->email}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-4 p-0 mb-4 fz95 pl-3 mt-3">
                         <div class="form-check">
                          <label class="form-check-label">
                            <input class="checkbox" type="checkbox" name="send_email_all">
                            Gửi tới tất cả thành viên
                          </label>
                        </div>
                      </div>

                      <div class="col-12 p-0  text-center">
                        @if (\Session::has('msg'))
                        <span class="text-success mt-2">{!! \Session::get('msg') !!}</span>
                        @endif
                      </div>
                      <div class="col-12 p-0 pr-2 mb-2 text-center mt-3">
                        <button class="btn bg text-white">Gửi thư</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>   
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript">
  $(".chosen").chosen({
    width: "100%",
    height:"42px",
    enable_search_threshold: 10
  }).change(function(event)
  {
    if(event.target == this)
    {
      var value = $(this).val();
      $("#result").text(value);
    }
  });
  $('.chosen-search-input').val("")
</script>


<script type="text/javascript">
  $(document).ready(function() {
    $('input[type=radio][name=optradio]').change(function() {


      $.get("{{url('/admin/email-marketing/send-mail/loc-tai-khoan')}}/"+this.value, function(data, status){
        var html = "";
        $.each(data.getUserByType, function(i, item) {

          html +=`<option value="`+item.id+`">[ID: `+item.id+`] `+item.phone+` - `+item.name+`</option>`
        });
        console.log(html)
        $('#multiselect').html("Hello <b>world</b>!");

      });

    });
  });

</script>


@endsection








