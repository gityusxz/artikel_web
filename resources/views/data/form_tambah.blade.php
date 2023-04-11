


<form action="{{route('simpanPost')}}" encytpe="" method="post">
@csrf
<label>Nama</label>
<input type="text" name="nama">
<button type="submit">kirim</button>
</form>