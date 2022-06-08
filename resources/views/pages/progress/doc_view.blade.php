@if ($ext == 'bmp' || $ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'gif' || $ext == 'tiff')
    <img src="{{asset('/files/task/'. $file_name)}}">
@else
    <iframe 
    src="http://docs.google.com/gview?url={{ asset('/files/task/'. $file_name) }}&embedded=true" 
    style="width:600px; height:500px;" 
    frameborder="0">
    </iframe>
@endif