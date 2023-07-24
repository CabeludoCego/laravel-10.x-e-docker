@csrf

<input type="text" name="subject" value="{{ $support->subject ?? old('subject')}}">
<textarea name="body" cols="30" rows="5">{{ $support->body ?? old('body') }}</textarea>
<button type="submit">Enviar</button>
