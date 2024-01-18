<div class="messenger-sendCard">
    <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
        @csrf
        <label><span class="fas fa-paperclip" style="color:#ee0033"></span><input disabled='disabled' type="file" class="upload-attachment" name="file" accept="image/*, .txt, .rar, .zip" /></label>
        <textarea readonly='readonly' name="message" class="m-send app-scroll" placeholder="Nhập tin nhắn của bạn"></textarea>
        <button disabled='disabled'><span class="fas fa-paper-plane" style="color:#ee0033"></span></button>
    </form>
</div>