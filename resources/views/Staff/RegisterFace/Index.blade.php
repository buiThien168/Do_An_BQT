@extends("Staff.Layouts.Master")
@section('Title', 'Face registration')
@section('Content')
<div class="container-scroller">
  <x-staff.layouts.header-dashboard/>
  <div class="container-fluid page-body-wrapper">
    <div class="theme-setting-wrapper">
    </div>
    <div class="side-bar-box" style="width: 250px;">
      <x-staff.layouts.side-bar/>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container bg-white" style="padding-top: 10px;">
      <div class="shadow-smbox" style="margin: auto;width: 660px;padding: 10px;">
        <p class="fz95 tx font-weight-bold text-center">Face sampling</p>
        <div id="ok"></div>
        <video id="player" controls autoplay width="640px" height="480px">
        </video>
        <button id="capture" class="d-none">sj</button>
        <p id="status" class="fz95 tx mt-2 text-center">Loading</p>
      </div>


      <canvas id="snapshot" class="d-none" width=640 height=480></canvas>
    </div>

    <style type="text/css">
      #ok{
        position: absolute;
        width: 640px;
        height: 480px;
        opacity: 0.3;
        background: linear-gradient(#03A9F4,#03A9F4), 
        linear-gradient(90deg, #ffffff33 1px,transparent 0,transparent 19px),
        linear-gradient(#ffffff33 1px,transparent 0,transparent 19px),
        linear-gradient(transparent, #2196f387);
        background-size:100% 1.5%, 10% 100%,100% 10%, 100% 100%;
        background-repeat: no-repeat,repeat,repeat,no-repeat;
        background-position: 0 0,0 0, 0 0, 0 0;
        clip-path: polygon(0% 0%, 100% 0%, 100% 1.5%, 0% 1.5%);
        animation: move 2s infinite linear;
      }
      @keyframes move{
        to{
          background-position: 0 100%,0 0, 0 0, 0 0;
          clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%);
        }

      }
      .box {
        --b:5px;   /* thickness of the border */
        --c:red;   /* color of the border */
        --w:20px;  /* width of border */


        border:var(--b) solid transparent; /* space for the border */
        --g:#0000 90deg,var(--c) 0;
        background:
        conic-gradient(from 90deg  at top    var(--b) left  var(--b),var(--g)) 0    0,
        conic-gradient(from 180deg at top    var(--b) right var(--b),var(--g)) 100% 0,
        conic-gradient(from 0deg   at bottom var(--b) left  var(--b),var(--g)) 0    100%,
        conic-gradient(from -90deg at bottom var(--b) right var(--b),var(--g)) 100% 100%;
        background-size:var(--w) var(--w);
        background-origin:border-box;
        background-repeat:no-repeat;


      }
    </style>
    <script type="text/javascript">
      var countFace = 0;
      var player = document.getElementById('player');
      var snapshotCanvas = document.getElementById('snapshot');
      var captureButton = document.getElementById('capture');

      var handleSuccess = function(stream) {
    // Attach the video stream to the video element and autoplay.
    player.srcObject = stream;
    setInterval(async () => {
      $('#capture').click();
      console.log('click')
      countFace++;
      $('#status').text(countFace+'/3 st sampling');
      if(countFace==3){
       window.location.href = "{{url('identity-management')}}";
     }
   },7000);
  };

  captureButton.addEventListener('click', function() {
    var context = snapshot.getContext('2d');
    // Draw the video frame to the canvas.
    context.drawImage(player, 0, 0, snapshotCanvas.width,
      snapshotCanvas.height);
    // console.log(context.canvas.toDataURL());
    var data = new FormData();
    data.append("image", context.canvas.toDataURL('image/jpeg'));

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax
    ({
      type: 'POST',
      url: '{{url('register-faces')}}',
      processData: false,
      contentType: false,
      data: data,
      success: function (result) {
        console.log(result);
      },
      error: function (result) {
      }
    });
  });

  navigator.mediaDevices.getUserMedia({video: true})
  .then(handleSuccess);
</script>
<script type="text/javascript">

</script>
</div>
@endsection








