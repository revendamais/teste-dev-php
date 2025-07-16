<form action="{{route('upload.upload')}}" enctype="multipart/form-data" method="post">
    @csrf
    <input type="file" placeholder="upload file" name="file" />
    <button type="submit">upload</button>
</form>
<br>
<a download="Arquivo.zip" href="files/19abe04062d323ac0a69f0739f807d11.zip">Arquivo.zip</a>