// Toggles a div state (collapsed or not)
function toggleDiv(name,imgid)
{
    if (document.getElementById(name).style.display == 'block' || document.getElementById(name).style.display == '')
    {
        document.getElementById(name).style.display = 'none';
        document.getElementById(imgid).innerHTML = '[+]';
    }
    else
    {
        document.getElementById(name).style.display = 'block';
        document.getElementById(imgid).innerHTML = '[-]';
    }
}

// adds forum style tags around a selected string
function formatText(area,tag) 
{
    var tarea = document.getElementById(area);

    if (document.selection)
    {
        tarea.focus();
        var sel = document.selection.createRange();

        sel.text = '['+tag+']' + sel.text + '[/'+tag+']';    
    }
    else
    {
        var len   = tarea.value.length;
        var start = tarea.selectionStart;
        var end   = tarea.selectionEnd;
        var sel   = tarea.value.substring(start, end);

        var replace = '['+tag+']' + sel + '[/'+tag+']';

        tarea.value = tarea.value.substring(0,start) + replace + tarea.value.substring(end,len); 
    }
}
